<?php

namespace Tests\Feature;

use App\Services\VisitorPosterGenerator;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use ReflectionMethod;
use ReflectionProperty;
use Tests\TestCase;

class VisitorPosterTest extends TestCase
{
    public function test_poster_form_is_available(): void
    {
        $this->get(route('visitor-poster.index'))
            ->assertOk()
            ->assertSee('Create your visitor poster')
            ->assertSee('enctype="multipart/form-data"', false);
    }

    public function test_mobile_and_photo_are_required(): void
    {
        $this->from(route('visitor-poster.index'))
            ->post(route('visitor-poster.generate'))
            ->assertRedirect(route('visitor-poster.index'))
            ->assertSessionHasErrors(['mobile', 'photo']);
    }

    public function test_invalid_mobile_and_file_are_rejected(): void
    {
        $file = UploadedFile::fake()->create('not-an-image.pdf', 20, 'application/pdf');

        $this->from(route('visitor-poster.index'))
            ->post(route('visitor-poster.generate'), [
                'mobile' => '123',
                'photo' => $file,
            ])
            ->assertRedirect(route('visitor-poster.index'))
            ->assertSessionHasErrors(['mobile', 'photo']);
    }

    public function test_poster_qr_uses_the_ahmedabad_registration_link(): void
    {
        $method = new ReflectionMethod(VisitorPosterGenerator::class, 'registrationUrl');
        $method->setAccessible(true);

        $this->assertSame(
            'https://opticexhibition.com/Ahmedabad/visitor_registration',
            $method->invoke(new VisitorPosterGenerator())
        );
    }
    
    public function test_poster_assets_can_be_loaded_from_the_web_document_root(): void
    {
        $documentRoot = sys_get_temp_dir().'/visitor-poster-'.uniqid('', true);
        $fontPath = $documentRoot.'/Ahmedabad/fonts/Montserrat-Bold.ttf';
        mkdir(dirname($fontPath), 0777, true);
        file_put_contents($fontPath, 'font');

        $originalDocumentRoot = $_SERVER['DOCUMENT_ROOT'] ?? null;
        $_SERVER['DOCUMENT_ROOT'] = $documentRoot;

        try {
            $method = new ReflectionMethod(VisitorPosterGenerator::class, 'assetPath');
            $method->setAccessible(true);

            $this->assertSame(
                $fontPath,
                $method->invoke(new VisitorPosterGenerator(), 'Ahmedabad/fonts/Montserrat-Bold.ttf')
            );
        } finally {
            if ($originalDocumentRoot === null) {
                unset($_SERVER['DOCUMENT_ROOT']);
            } else {
                $_SERVER['DOCUMENT_ROOT'] = $originalDocumentRoot;
            }

            unlink($fontPath);
            rmdir(dirname($fontPath));
            rmdir(dirname(dirname($fontPath)));
            rmdir($documentRoot);
        }
    }
    
    public function test_blue_header_curve_bows_down_behind_the_portrait(): void
    {
        $generator = new VisitorPosterGenerator();
        $manager = new ImageManager(['driver' => 'gd']);
        $poster = $manager->canvas(900, 1600, '#ffffff');

        $managerProperty = new ReflectionProperty(VisitorPosterGenerator::class, 'manager');
        $managerProperty->setAccessible(true);
        $managerProperty->setValue($generator, $manager);

        $method = new ReflectionMethod(VisitorPosterGenerator::class, 'drawBackground');
        $method->setAccessible(true);
        $method->invoke($generator, $poster);

        $this->assertSame([55, 108, 175], array_slice($poster->pickColor(450, 450, 'array'), 0, 3));
        $this->assertSame([255, 255, 255], array_slice($poster->pickColor(20, 450, 'array'), 0, 3));
        $this->assertSame([55, 108, 175], array_slice($poster->pickColor(20, 360, 'array'), 0, 3));
    }
}
