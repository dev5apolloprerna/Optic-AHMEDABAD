<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Services\VisitorPosterGenerator;
use Illuminate\Http\Request;

class VisitorPosterController extends Controller
{
    public function index()
    {
        return view('visitor-poster.index');
    }

    public function generate(Request $request, VisitorPosterGenerator $posterGenerator)
    {
        $validated = $request->validate([
            'mobile' => ['required', 'digits:10'],
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ], [
            'mobile.digits' => 'Please enter a valid 10 digit mobile number.',
            'photo.image' => 'Please upload a valid image.',
            'photo.mimes' => 'The photo must be a JPG or PNG image.',
            'photo.max' => 'The photo must not be larger than 5 MB.',
        ]);

        $visitor = Visitor::query()
            ->where('mobile', $validated['mobile'])
            ->where('isDelete', 0)
            ->first();

        if (!$visitor) {
            return back()
                ->withInput($request->except('photo'))
                ->with('error', 'No visitor information was found for this mobile number.');
        }

        $image = $posterGenerator->generate(
            $visitor,
            $request->file('photo')->getRealPath()
        );

        return response($image, 200, [
            'Content-Type' => 'image/jpeg',
            'Content-Disposition' => 'attachment; filename="visitor-poster-'.$visitor->getKey().'.jpg"',
            'Content-Length' => strlen($image),
            'Cache-Control' => 'private, no-store, max-age=0',
        ]);
    }
}
