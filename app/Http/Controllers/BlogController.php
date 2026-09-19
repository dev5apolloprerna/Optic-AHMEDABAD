<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Product;
use App\Models\BlogProducts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;

class BlogController extends Controller
{
  public function index(Request $request)
{
    $Blog = Blog::orderBy('blogId', 'desc')
        ->where([
            'iStatus' => 1,
            'isDelete' => 0
        ])
        ->paginate(25);

    return view('blog.index', compact('Blog'));
}


    public function createview(Request $request)
    {
        // try {
        

            return view('blog.add');
        // } catch (\Throwable $th) {
        //     // Rollback and return with Error
        //     DB::rollBack();
        //     return redirect()->back()->withInput()->with('error', $th->getMessage());
        // }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                
                'strTitle' => 'required',
                'strDescription' => 'required',
                'strPhoto' => 'required'
            ], [
                'category_id.required' => 'The category field is required.',
                'strTitle.required' => 'The title field is required.',
                'strDescription.required' => 'The description field is required.',
                'strPhoto.required' => 'The photo field is required.'
            ]);

            $imgName = '';

            if ($request->hasFile('strPhoto')) {
            
                $image = $request->file('strPhoto');
                $imgName = time().'_'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            
                // ELECTRICEXPO REAL PATH
                $destinationPath = '/home2/paintq3w/opticexhibition.com/Ahemedabad/blog';
            
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
            
                Image::make($image->getRealPath())
                    ->resize(540, 720, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save($destinationPath.'/'.$imgName);
            }



            $Data = array(
                
                'strTitle' => $request->strTitle,
                'strSlug' => Str::slug($request->strTitle),
                'strDescription' => $request->strDescription,
                'strPhoto' => $imgName,
                'metaTitle' => $request->metaTitle,
                'metaKeyword' => $request->metaKeyword,
                'metaDescription' => $request->metaDescription,
                'head' => $request->head,
                'body' => $request->body,
                'created_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip()
            );
            DB::table('blog')->insert($Data);

            return redirect()->route('blog.index')->with('success', 'Blog Created Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function editview(Request $request, $id)
    {
        // try {
            $data = Blog::where(['iStatus' => 1, 'isDelete' => 0, 'blogId' => $id])->first();
            

            return view('blog.edit', compact('data'));
        // } catch (\Throwable $th) {
        //     // Rollback and return with Error
        //     DB::rollBack();
        //     return redirect()->back()->withInput()->with('error', $th->getMessage());
        // }
    }

    public function update(Request $request, $id)
{
    try {

        $request->validate([
            'strTitle' => 'required',
            'strDescription' => 'required'
        ], [
            'strTitle.required' => 'The title field is required.',
            'strDescription.required' => 'The description field is required.'
        ]);

        // SAME PATH AS STORE
        $destinationPath = '/home2/paintq3w/opticexhibition.com/Ahemedabad/blog';

        $imgName = $request->hiddenPhoto; // keep old image by default

        if ($request->hasFile('strPhoto')) {

            $image = $request->file('strPhoto');
            $imgName = time().'_'.rand(1000,9999).'.'.$image->getClientOriginalExtension();

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Save new image
            Image::make($image->getRealPath())
                ->resize(540, 720, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($destinationPath.'/'.$imgName);

            // Delete old image
            if (!empty($request->hiddenPhoto)) {
                $oldImage = $destinationPath.'/'.$request->hiddenPhoto;
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
        }

        Blog::where('blogId', $id)->update([
            'strTitle' => $request->strTitle,
            'strSlug' => Str::slug($request->strTitle),
            'strDescription' => $request->strDescription,
            'strPhoto' => $imgName,
            'metaTitle' => $request->metaTitle,
            'metaKeyword' => $request->metaKeyword,
            'metaDescription' => $request->metaDescription,
            'head' => $request->head,
            'body' => $request->body,
            'updated_at' => now()
        ]);

        return redirect()->route('blog.index')->with('success', 'Blog Updated Successfully.');

    } catch (\Throwable $th) {

        return redirect()->back()->withInput()->with('error', $th->getMessage());
    }
}



   public function delete(Request $request)
{
    // try {

        $blog = Blog::where([
            'iStatus' => 1,
            'isDelete' => 0,
            'blogId' => $request->blogId
        ])->first();

        if (!$blog) {
            return back()->with('error', 'Blog not found.');
        }

        // ELECTRICEXPO REAL IMAGE PATH
        $imagePath = '/home2/paintq3w/opticexhibition.com/Ahemedabad/blog/' . $blog->strPhoto;

        // Delete image file if exists
        if (!empty($blog->strPhoto) && file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete record from database
        $blog->delete();

        return back()->with('success', 'Blog Deleted Successfully!');

    // } catch (\Throwable $th) {

    //     return redirect()->back()->withInput()->with('error', $th->getMessage());
    // }
}

}
