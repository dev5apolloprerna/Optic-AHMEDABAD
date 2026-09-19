<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class VisitorPosterController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
            'photo'  => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Find visitor
        |--------------------------------------------------------------------------
        */

        $visitor = Visitor::where('mobile', $request->mobile)->first();

        if (!$visitor) {
            return back()
                ->withInput()
                ->with('error', 'Mobile number thi visitor information mali nathi.');
        }

        /*
        |--------------------------------------------------------------------------
        | Template
        |--------------------------------------------------------------------------
        */

        $template = Image::read(
            public_path('templates/optic-expo-template.jpg')
        );

        /*
        |--------------------------------------------------------------------------
        | Visitor Photo
        |--------------------------------------------------------------------------
        */

        $photo = Image::read(
            $request->file('photo')->getRealPath()
        );

        // Photo box size
        $photo->cover(590, 590);

        /*
        |--------------------------------------------------------------------------
        | Put photo into template
        |--------------------------------------------------------------------------
        */

        $template->place(
            $photo,
            'top-left',
            245,
            300
        );

        /*
        |--------------------------------------------------------------------------
        | Visitor Name
        |--------------------------------------------------------------------------
        */

        $template->text(
            strtoupper('MR. ' . $visitor->name),
            540,
            955,
            function ($font) {

                $font->filename(
                    public_path('fonts/Montserrat-Bold.ttf')
                );

                $font->size(44);
                $font->color('#111111');
                $font->align('center');
                $font->valign('middle');
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Company + City
        |--------------------------------------------------------------------------
        */

        $company = strtoupper(
            '[ ' . $visitor->company . ', ' . $visitor->city . ' ]'
        );

        $template->text(
            $company,
            540,
            1025,
            function ($font) {

                $font->filename(
                    public_path('fonts/Montserrat-Bold.ttf')
                );

                $font->size(38);
                $font->color('#3569AB');
                $font->align('center');
                $font->valign('middle');
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Save generated poster
        |--------------------------------------------------------------------------
        */

        $fileName =
            'visitor-' .
            $visitor->id .
            '-' .
            time() .
            '.jpg';

        $directory = public_path('generated-posters');

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $path = $directory . '/' . $fileName;

        $template->toJpeg(95)->save($path);

        /*
        |--------------------------------------------------------------------------
        | Download
        |--------------------------------------------------------------------------
        */

        return response()
            ->download($path, $fileName)
            ->deleteFileAfterSend(true);
    }
}
