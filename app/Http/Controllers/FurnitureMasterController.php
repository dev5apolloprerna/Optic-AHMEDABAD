<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FurnitureMaster;
use Illuminate\Support\Facades\DB;
use Image;

//8780478357

class FurnitureMasterController extends Controller
{
    public function index(Request $request)
    {
        try {
            $FurnitureName = $request->strFurnitureName;
            $Furniture = FurnitureMaster::orderBy('iFurnitureId', 'DESC')
                ->where(['iStatus' => 1, 'isDelete' => 0])
                ->when($request->strFurnitureName, fn ($query, $FurnitureName) => $query
                    ->where('furnituremaster.strFurnitureName', 'LIKE', '%' . $FurnitureName . '%'))
                ->paginate(25);

            return view('furnituremaster.index', compact('Furniture', 'FurnitureName'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $img = "";
            if ($request->hasFile('strPhoto')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('strPhoto');
                $imgName = time() . '.' . $image->getClientOriginalExtension();
                $imageoriginalName =  $image->getClientOriginalName();
                $destinationPath = $root . '/Furniture/thumb';
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $img = Image::make($image->getRealPath());
                $img->resize(540, 720, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $imgName);
                $destinationpath = $root . '/Furniture';
                $image->move($destinationpath, $imgName);
            }
            $Data = array(
                'strFurnitureName' => $request->strFurnitureName,
                'strPhoto' => $imgName,
                'strSize' => $request->strSize,
                'iRate' => $request->iRate,
                "strEntryDate" => date('Y-m-d H:i:s'),
                'strIP' => $request->ip()
            );
            DB::table('furnituremaster')->insert($Data);
            return redirect()->route('furnituremaster.index')->with('success', 'Furniture Created Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function editview(Request $request, $Id)
    {
        try {
            $data = FurnitureMaster::where(['iStatus' => 1, 'isDelete' => 0, 'iFurnitureId' => $Id])->first();

            echo json_encode($data);
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $imgName = "";
            if ($request->hasFile('strPhoto')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('strPhoto');
                $imgName = time() . '.' . $image->getClientOriginalExtension();
                $imageoriginalName =  $image->getClientOriginalName();
                $destinationpath = $root . '/Furniture/thumb/';
                // dd($destinationpath);
                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }
                $img = Image::make($image->getRealPath());
                $img->resize(540, 720, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationpath . '/' . $imgName);
                $destinationpath1 = $root . '/Furniture/';
                $image->move($destinationpath1, $imgName);
                $oldImg = $request->input('hiddenPhoto') ? $request->input('hiddenPhoto') : null;
                // dd($destinationpath . $oldImg);
                // dd($oldImg);
                if ($oldImg != null || $oldImg != "") {
                    // if (file_exists($destinationpath . $destinationpath1 . $oldImg)) {
                    unlink($destinationpath . $oldImg);
                    unlink($destinationpath1 . $oldImg);
                    // }
                }
            } else {
                $oldImg = $request->input('hiddenPhoto');
                $imgName = $oldImg;
            }

            $update = DB::table('furnituremaster')
                ->where(['iStatus' => 1, 'isDelete' => 0, 'iFurnitureId' => $request->iFurnitureId])
                ->update([
                    'strFurnitureName' => $request->strFurnitureName,
                    'strPhoto' => $imgName,
                    'strSize' => $request->strSize,
                    'iRate' => $request->iRate,
                    'strIP' => $request->ip()
                ]);

            return redirect()->route('furnituremaster.index')->with('success', 'Furniture Updated Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    public function delete(Request $request)
    {
        try {
            $delete = DB::table('furnituremaster')->where(['iStatus' => 1, 'isDelete' => 0, 'iFurnitureId' => $request->iFurnitureId])->first();
            // dd($delete);
            $root = $_SERVER['DOCUMENT_ROOT'];
            $destinationpath = $root . '/Furniture/';
            $destinationpath1 = $root . '/Furniture/thumb/';

            if ($delete->strPhoto) {
                unlink($destinationpath  . $delete->strPhoto);
                unlink($destinationpath1 . $delete->strPhoto);
            }

            DB::table('furnituremaster')->where(['iStatus' => 1, 'isDelete' => 0, 'iFurnitureId' => $request->iFurnitureId])->delete();

            return back()->with('success', 'Furniture Deleted Successfully!.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    public function deleteselected(Request $request)
    {
        try {
            $Data = 0;
            $data = array('iStatus' => 1, 'isDelete' => 0);
            
            foreach ($request->check_list as $id) {
                $furniture = FurnitureMaster::where('iFurnitureId', '=', $id)->where($data)->first();
    
                if ($furniture) {
                    $root = $_SERVER['DOCUMENT_ROOT'];
                    $destinationpath = $root . '/Furniture/';
                    $destinationpath1 = $root . '/Furniture/thumb/';
    
                    if ($furniture->strPhoto) {
                        if (file_exists($destinationpath . $furniture->strPhoto)) {
                            unlink($destinationpath . $furniture->strPhoto);
                        }
                        if (file_exists($destinationpath1 . $furniture->strPhoto)) {
                            unlink($destinationpath1 . $furniture->strPhoto);
                        }
                    }
    
                    $Data = FurnitureMaster::where('iFurnitureId', '=', $id)->where($data)->delete();
                }
            }
            
            echo $Data;
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
