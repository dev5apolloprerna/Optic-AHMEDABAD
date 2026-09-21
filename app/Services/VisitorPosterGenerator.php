<?php

namespace App\Services;

use App\Models\Visitor;
use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Encoder\Encoder;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class VisitorPosterGenerator
{
    private const BLUE = '#376caf';
    private const POSTER_WIDTH = 900;
    private const QR_BORDER = 7;
    private const QR_SIZE = 190;

    /** @var ImageManager */
    private $manager;

    public function generate(Visitor $visitor, string $photoPath): string
    {
        $this->manager = new ImageManager(['driver' => config('image.driver', 'gd')]);
        // Match the supplied artwork's 9:16 portrait size exactly.
        // $poster = $this->manager->canvas(self::POSTER_WIDTH, 1600, '#ffffff');
        // $boldFont = 'https://opticexhibition.com/Ahmedabad/fonts/Montserrat-Bold.ttf';
        // $regularFont = 'https://opticexhibition.com/Ahmedabad/fonts/Montserrat-Regular.ttf';
        $poster = $this->manager->canvas(self::POSTER_WIDTH, 1600, '#ffffff');
        // cPanel deployments may expose the contents of /public directly from the
        // project root. Resolve assets here so this cannot become an undefined
        // method when a single service file is deployed through File Manager.
        $assetPath = static function (string $relativePath): string {
            foreach ([public_path($relativePath), base_path($relativePath)] as $candidate) {
                if (is_file($candidate) && is_readable($candidate)) {
                    return $candidate;
                }
            }

            throw new \RuntimeException('Poster asset is missing or unreadable: '.$relativePath);
        };
        $boldFont = $assetPath('Ahmedabad/fonts/Montserrat-Bold.ttf');
        $regularFont = $assetPath('Ahmedabad/fonts/Montserrat-Regular.ttf');

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
        $this->addText($poster,  ($name ?: 'VALUED VISITOR'), 450, 943, $boldFont, 35, '#111111');

        $details = implode(', ', array_filter([$company, $city]));
        if ($details !== '') {
            $this->addText($poster, '[ ' . $details . ' ]', 450, 1000, $boldFont, 28, self::BLUE);
        }

        $this->addText($poster, 'SUPPORTED BY', 235, 1040, $boldFont, 15, '#111111');
        $this->addText($poster, 'CO-SPONSORED BY', 680, 1040, $boldFont, 15, '#111111');
        // Keep both sponsor marks above the QR area (which starts at y=1170).
        $this->insertContained($poster, $assetPath('assets/front/img/Optic-Expo-Asso.png'), 45, 1055, 380, 105);
        $this->insertContained($poster, $assetPath('assets/front/img/Optic-Expo-Arise.png'), 570, 1050, 275, 110);

        $poster->rectangle(0, 1218, 900, 1305, function ($shape) {
            $shape->background(self::BLUE);
        });
        $this->addText($poster, '» REGISTER AND JOIN ME!', 155, 1262, $boldFont, 22, '#ffffff');
        $this->addText($poster, '
        www.opticexhibition.com', 680, 1262, $boldFont, 18, '#ffffff');
        $this->insertRegistrationQrCode(
            $poster,
            (int) ((self::POSTER_WIDTH - self::QR_SIZE) / 2),
            1170,
            self::QR_SIZE
        );

        $this->insertContained($poster, $assetPath('assets/front/img/optic-2024.png'), 35, 1360, 485, 160);
        $this->addText($poster, $this->eventDate(), 700, 1408, $boldFont, 25, '#111111');
        $this->addText($poster, 'AHMEDABAD', 700, 1462, $boldFont, 31, self::BLUE);
        $this->addText($poster, $this->eventVenue(), 450, 1560, $boldFont, 21, '#111111');

        return (string) $poster->encode('jpg', 94);
    }

    private function drawBackground(Image $poster): void
    {
        $poster->rectangle(0, 0, 900, 280, function ($shape) {
            $shape->background(self::BLUE);
        });

        // Extend the blue header with a wide ellipse so its lower edge bows down
        // behind the portrait, matching the symmetrical curve in the artwork.
        $poster->ellipse(1100, 400, 450, 280, function ($shape) {
            $shape->background(self::BLUE);
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

    private function insertRegistrationQrCode(Image $poster, int $x, int $y, int $size): void
    {
        // This is a call-to-action QR, not the visitor's registration-counter QR.
        // Generate it while composing the poster so it can never disappear because
        // an attendee-specific QR file is absent or stored in another public path.
        // Draw the reference artwork's blue frame outside the QR bounds. The QR
        // itself still fills the complete requested square without inner padding.
        $poster->rectangle(
            $x - self::QR_BORDER,
            $y - self::QR_BORDER,
            $x + $size + self::QR_BORDER - 1,
            $y + $size + self::QR_BORDER - 1,
            function ($shape) {
                $shape->background(self::BLUE);
            }
        );
        $poster->rectangle($x, $y, $x + $size - 1, $y + $size - 1, function ($shape) {
            $shape->background('#ffffff');
            // $shape->border(6, self::BLUE);
        });

        // Drawing BaconQrCode's matrix with Intervention keeps this compatible
        // with the application's GD driver; the PNG backend requires Imagick.
        $matrix = Encoder::encode(
            $this->registrationUrl(),
            ErrorCorrectionLevel::M(),
            'UTF-8'
        )->getMatrix();
        $matrixWidth = $matrix->getWidth();

        for ($row = 0; $row < $matrix->getHeight(); $row++) {
            for ($column = 0; $column < $matrix->getWidth(); $column++) {
                if ($matrix->get($column, $row) !== 1) {
                    continue;
                }

                // Map the matrix directly to the requested square: no border or
                // extra quiet-zone padding is added around the generated QR.
                $left = $x + (int) floor(($column * $size) / $matrixWidth);
                $top = $y + (int) floor(($row * $size) / $matrixWidth);
                $right = $x + (int) floor((($column + 1) * $size) / $matrixWidth) - 1;
                $bottom = $y + (int) floor((($row + 1) * $size) / $matrixWidth) - 1;
                $poster->rectangle($left, $top, $right, $bottom, function ($shape) {
                    $shape->background('#000000');
                });
            }
        }
    }

    private function registrationUrl(): string
    {
        return (string) (config('app.visitor_registration_url')
            ?: 'https://opticexhibition.com/Ahmedabad/visitor_registration');
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
