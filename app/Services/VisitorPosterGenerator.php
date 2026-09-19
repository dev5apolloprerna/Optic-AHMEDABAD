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
        $poster = $this->manager->canvas(1080, 1600, '#ffffff');
        $boldFont = public_path('fonts/Montserrat-Bold.ttf');
        $regularFont = public_path('fonts/Montserrat-Regular.ttf');

        $this->drawBackground($poster);
        $this->addText($poster, "I'M COMING TO OPTIC EXPO,", 540, 72, $regularFont, 48, '#ffffff');
        $this->addText($poster, 'ARE YOU COMING?', 540, 137, $boldFont, 58, '#ffffff');

        $photoFrame = $this->manager->canvas(674, 674, self::BLUE);
        $photoFrame->mask($this->roundedMask(674, 674, 50));
        $poster->insert($photoFrame, 'top-left', 203, 193);

        $photo = $this->manager->make($photoPath)->orientate()->fit(650, 650);
        $photo->mask($this->roundedMask(650, 650, 44));
        $poster->insert($photo, 'top-left', 215, 205);

        $name = $this->limit(strtoupper((string) $visitor->name), 30);
        $company = $this->limit(strtoupper((string) $visitor->companyName), 35);
        $city = $this->limit(strtoupper((string) $visitor->city), 24);

        $this->addText($poster, 'PROUD VISITOR', 540, 910, $boldFont, 40, '#111111');
        $this->addText($poster, 'MR. ' . ($name ?: 'VALUED VISITOR'), 540, 965, $boldFont, 38, '#111111');

        $details = implode(', ', array_filter([$company, $city]));
        if ($details !== '') {
            $this->addText($poster, '[ ' . $details . ' ]', 540, 1027, $boldFont, 30, self::BLUE);
        }

        $this->addText($poster, 'SUPPORTED BY', 270, 1080, $boldFont, 16, '#111111');
        $this->addText($poster, 'ASSOCIATED WITH', 810, 1080, $boldFont, 16, '#111111');
        $this->insertContained($poster, public_path('assets/front/img/Optic-Expo-Asso.png'), 75, 1100, 390, 110);
        $this->insertContained($poster, public_path('assets/front/img/Optic-Expo-Arise.png'), 650, 1095, 320, 115);

        $poster->rectangle(0, 1232, 1080, 1340, function ($shape) {
            $shape->background(self::BLUE);
        });
        $this->addText($poster, 'REGISTER NOW  »  JOIN US!', 300, 1286, $boldFont, 29, '#ffffff');
        $this->addText($poster, 'www.opticexhibition.com', 795, 1286, $boldFont, 21, '#ffffff');

        $this->insertContained($poster, public_path('assets/front/img/optic-2024.png'), 70, 1370, 470, 155);
        $this->addText($poster, $this->eventDate(), 795, 1415, $boldFont, 31, '#111111');
        $this->addText($poster, 'AHMEDABAD', 795, 1470, $boldFont, 38, self::BLUE);
        $this->addText($poster, $this->eventVenue(), 540, 1560, $boldFont, 23, '#111111');

        return (string) $poster->encode('jpg', 94);
    }

    private function drawBackground(Image $poster): void
    {
        $poster->rectangle(0, 0, 1080, 470, function ($shape) {
            $shape->background(self::BLUE);
        });

        // The large white circles produce the curved transition from the reference artwork.
        $poster->circle(1500, 540, 1010, function ($shape) {
            $shape->background('#ffffff');
        });

        // A subtle spectacle pattern keeps the white area from looking empty.
        for ($y = 520; $y < 1540; $y += 210) {
            for ($x = 40 + (($y / 210) % 2 ? 90 : 0); $x < 1080; $x += 270) {
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
