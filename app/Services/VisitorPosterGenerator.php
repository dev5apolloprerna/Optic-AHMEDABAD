<?php

namespace App\Services;

use App\Models\Visitor;
use Intervention\Image\ImageManager;

class VisitorPosterGenerator
{
    public function generate(Visitor $visitor, string $photoPath): string
    {
        $manager = new ImageManager(['driver' => config('image.driver', 'gd')]);
        $poster = $manager->canvas(1080, 1350, '#f7f9fc');

        $poster->rectangle(0, 0, 1080, 245, function ($shape) {
            $shape->background('#123b68');
        });
        $poster->rectangle(0, 1190, 1080, 1350, function ($shape) {
            $shape->background('#f59e0b');
        });
        $poster->rectangle(205, 276, 875, 946, function ($shape) {
            $shape->background('#ffffff');
            $shape->border(14, '#ffffff');
        });

        $photo = $manager->make($photoPath)->orientate()->fit(640, 640);
        $poster->insert($photo, 'top-left', 220, 291);

        $boldFont = public_path('fonts/Montserrat-Bold.ttf');
        $regularFont = public_path('fonts/Montserrat-Regular.ttf');

        $this->addText($poster, 'OPTIC EXHIBITION', 540, 82, $boldFont, 53, '#ffffff');
        $this->addText($poster, 'AHMEDABAD', 540, 158, $boldFont, 35, '#fbbf24');
        $this->addText($poster, 'PROUD TO VISIT', 540, 225, $regularFont, 21, '#dbeafe');

        $name = $this->limit(strtoupper((string) $visitor->name), 30);
        $company = $this->limit(strtoupper((string) $visitor->companyName), 38);
        $city = $this->limit(strtoupper((string) $visitor->city), 28);

        $this->addText($poster, $name ?: 'VALUED VISITOR', 540, 1010, $boldFont, 45, '#14213d');

        $details = implode('  •  ', array_filter([$company, $city]));
        if ($details !== '') {
            $this->addText($poster, $details, 540, 1083, $boldFont, 25, '#31669b');
        }

        $this->addText($poster, 'SEE YOU AT THE SHOW!', 540, 1260, $boldFont, 35, '#ffffff');
        $this->addText($poster, 'Create connections. Discover innovation.', 540, 1310, $regularFont, 18, '#fff7e6');

        return (string) $poster->encode('jpg', 92);
    }

    private function addText($image, string $text, int $x, int $y, string $font, int $size, string $color): void
    {
        $image->text($text, $x, $y, function ($fontStyle) use ($font, $size, $color) {
            $fontStyle->file($font);
            $fontStyle->size($size);
            $fontStyle->color($color);
            $fontStyle->align('center');
            $fontStyle->valign('middle');
        });
    }

    private function limit(string $value, int $length): string
    {
        $value = trim($value);

        return mb_strlen($value) > $length
            ? mb_substr($value, 0, $length - 1).'…'
            : $value;
    }
}