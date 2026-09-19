<?php

namespace Tests\Feature;

use App\Services\VisitorPosterGenerator;
use Illuminate\Http\UploadedFile;
use ReflectionMethod;
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
}
