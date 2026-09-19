<?php

namespace App\Services;

use App\Models\Visitor;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class VisitorPosterGenerator
{
    private const BLUE = '#376caf';

    /** @var ImageManager */
    private $manager;

    public function generate(Visitor $visitor, string $photoPath): string
    {
        $this->manager = new ImageManager(['driver' => config('image.driver', 'gd')]);
        // Match the supplied artwork's 9:16 portrait size exactly.
        $poster = $this->manager->canvas(900, 1600, '#ffffff');
        $boldFont = public_path('fonts/Montserrat-Bold.ttf');
        $regularFont = public_path('fonts/Montserrat-Regular.ttf');

        $this->drawBackground($poster);
        $this->addText($poster, "I'M COMING TO OPTIC EXPO,", 450, 67, $regularFont, 38, '#ffffff');
        $this->addText($poster, 'ARE YOU COMING?', 450, 133, $boldFont, 48, '#ffffff');

        $photoFrame = $this->manager->canvas(614, 614, self::BLUE);
        $photoFrame->mask($this->roundedMask(614, 614, 46));
        $poster->insert($photoFrame, 'top-left', 143, 238);

        $photo = $this->manager->make($photoPath)->orientate()->fit(590, 590);
        $photo->mask($this->roundedMask(590, 590, 40));
        $poster->insert($photo, 'top-left', 155, 250);

        $name = $this->limit(strtoupper((string) $visitor->name), 30);
        $company = $this->limit(strtoupper((string) $visitor->companyName), 35);
        $city = $this->limit(strtoupper((string) $visitor->city), 24);

        $this->addText($poster, 'PROUD VISITOR', 450, 890, $boldFont, 38, '#111111');
        $this->addText($poster, 'MR. ' . ($name ?: 'VALUED VISITOR'), 450, 943, $boldFont, 35, '#111111');

        $details = implode(', ', array_filter([$company, $city]));
        if ($details !== '') {
            $this->addText($poster, '[ ' . $details . ' ]', 450, 1000, $boldFont, 28, self::BLUE);
        }

        $this->addText($poster, 'SUPPORTED BY', 235, 1057, $boldFont, 15, '#111111');
        $this->addText($poster, 'CO-SPONSORED BY', 680, 1057, $boldFont, 15, '#111111');
        $this->insertContained($poster, public_path('assets/front/img/Optic-Expo-Asso.png'), 45, 1080, 380, 105);
        $this->insertContained($poster, public_path('assets/front/img/Optic-Expo-Arise.png'), 570, 1075, 275, 110);

        $poster->rectangle(0, 1218, 900, 1305, function ($shape) {
            $shape->background(self::BLUE);
        });
        $this->addText($poster, '»  REGISTER AND JOIN ME!', 200, 1262, $boldFont, 22, '#ffffff');
        $this->addText($poster, 'www.opticexhibition.com', 680, 1262, $boldFont, 18, '#ffffff');
        $this->insertVisitorQrCode($poster, $visitor, 342, 1165, 155);

        $this->insertContained($poster, public_path('assets/front/img/optic-2024.png'), 35, 1360, 485, 160);
        $this->addText($poster, $this->eventDate(), 700, 1408, $boldFont, 25, '#111111');
        $this->addText($poster, 'AHMEDABAD', 700, 1462, $boldFont, 31, self::BLUE);
        $this->addText($poster, $this->eventVenue(), 450, 1560, $boldFont, 21, '#111111');

        return (string) $poster->encode('jpg', 94);
    }

    private function drawBackground(Image $poster): void
    {
        $poster->rectangle(0, 0, 900, 450, function ($shape) {
            $shape->background(self::BLUE);
        });

        // The large white circles produce the curved transition from the reference artwork.
        $poster->circle(1320, 450, 980, function ($shape) {
            $shape->background('#ffffff');
        });

        // A subtle spectacle pattern keeps the white area from looking empty.
        for ($y = 520; $y < 1540; $y += 210) {
            for ($x = 40 + (($y / 210) % 2 ? 90 : 0); $x < 900; $x += 250) {
                $poster->ellipse(115, 55, (int) $x, $y, function ($shape) {
                    // Intervention Image 2 does not accept CSS rgba() color strings.
                    $shape->border(5, '#f4f7fb');
                });
            }
        }
    }

    private function roundedMask(int $width, int $height, int $radius): Image
    {
        $mask = $this->manager->canvas($width, $height, '#000000');
        $mask->rectangle($radius, 0, $width - $radius, $height, function ($shape) {
            $shape->background('#ffffff');
        });
        $mask->rectangle(0, $radius, $width, $height - $radius, function ($shape) {
            $shape->background('#ffffff');
        });

        foreach ([[$radius, $radius], [$width - $radius, $radius], [$radius, $height - $radius], [$width - $radius, $height - $radius]] as [$x, $y]) {
            $mask->circle($radius * 2, $x, $y, function ($shape) {
                $shape->background('#ffffff');
            });
        }

        return $mask;
    }

    private function insertContained(Image $poster, string $path, int $x, int $y, int $width, int $height): void
    {
        if (! is_file($path)) {
            return;
        }

        $logo = $this->manager->make($path);
        $logo->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $poster->insert($logo, 'top-left', $x + (int) (($width - $logo->width()) / 2), $y + (int) (($height - $logo->height()) / 2));
    }

    private function insertVisitorQrCode(Image $poster, Visitor $visitor, int $x, int $y, int $size): void
    {
        $fileName = 'visitor_' . $visitor->getKey() . '.png';
        $paths = [
            public_path('qrcodes/' . $fileName),
            public_path('Ahmedabad/qrcodes/' . $fileName),
            public_path('../Ahmedabad/qrcodes/' . $fileName),
        ];

        foreach ($paths as $path) {
            if (is_file($path)) {
                $qrCode = $this->manager->make($path)->fit($size, $size);
                $poster->rectangle($x - 8, $y - 8, $x + $size + 8, $y + $size + 8, function ($shape) {
                    $shape->background('#ffffff');
                    $shape->border(5, self::BLUE);
                });
                $poster->insert($qrCode, 'top-left', $x, $y);

                return;
            }
        }
    }

    private function addText(Image $image, string $text, int $x, int $y, string $font, int $size, string $color): void
    {
        $image->text($text, $x, $y, function ($fontStyle) use ($font, $size, $color) {
            $fontStyle->file($font);
            $fontStyle->size($size);
            $fontStyle->color($color);
            $fontStyle->align('center');
            $fontStyle->valign('middle');
        });
    }

    private function eventDate(): string
    {
        return strtoupper(config('app.front_header_date') ?: '3 • 4 • 5 OCTOBER 2026');
    }

    private function eventVenue(): string
    {
        return strtoupper($this->limit((string) (config('app.site_venue') ?: 'EKA CLUB, AHMEDABAD'), 62));
    }

    private function limit(string $value, int $length): string
    {
        $value = trim($value);

        return mb_strlen($value) > $length
            ? mb_substr($value, 0, $length - 1) . '…'
            : $value;
    }
}
