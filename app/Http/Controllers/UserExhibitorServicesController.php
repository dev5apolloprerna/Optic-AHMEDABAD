<?php

namespace App\Http\Controllers;

use App\Models\ExhibitorUser;
use App\Models\ExhibitorVendor;
use App\Models\AdditionalFurniture;
use App\Models\ExhibitBatch;
use App\Models\FurnitureMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;


class UserExhibitorServicesController extends Controller
{
    public function exhibitordetails(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                $session = Session::get('ExhibitorUserId');
                $Data = ExhibitorUser::where(['isDelete' => 0, 'id' => $session])->first();
                //dd($Data);
                return view('ExhibitorUserFiles.exhibitorservices.exhibitor_details', compact('Data'));
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitordetailsstore(Request $request)
    {
        try {
            $session = Session::get('ExhibitorUserId');

            $update = DB::table('exhibitoruser')
                ->where([ 'isDelete' => 0, 'id' => $session])
                ->update([
                    "strFasciaName" => strtoupper($request->strFasciaName),
                    "strParticipantCertificateName" => strtoupper($request->strParticipantCertificateName),
                    "txtGSTIN" => strtoupper($request->txtGSTIN), //33AAACB8772D1ZV
                    "strEntryDate" => date('Y-m-d'),
                    "iInviteesRequired" => $request->iInviteesRequired,
                    "updated_at" => now(),
                    "strIP" => $request->ip()
                ]);

            return back()->with('success', 'Updated Successfully');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitorlanyard(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                $session = Session::get('ExhibitorUserId');
                $sessiondata = ExhibitorUser::where([ 'isDelete' => 0, 'id' => $session])->first();
                $datas = ExhibitBatch::orderBy('iExhibitBatchId', 'asc')
                    ->where(['isDelete' => 0,  'iCompayId' => $session])
                    ->get();
                $count = ExhibitBatch::orderBy('iExhibitBatchId', 'asc')
                    ->where(['isDelete' => 0,  'iCompayId' => $session])
                    ->count();

                return view('ExhibitorUserFiles.exhibitorservices.exhibitor_lanyard', compact('datas', 'count', 'sessiondata'));
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitorlanyardstore(Request $request)
    {
        try {
            $session = Session::get('ExhibitorUserId');
            for ($iCounter = 0; $iCounter < count($request->strMemberName); $iCounter++) {
                $data = array(
                    "strCompanyName" => ucwords($request->strCompanyName),
                    "strCity" => $request->strCity,
                    "strCompanyBrandNameOnLanyard" => $request->strCompanyBrandNameOnLanyard,
                    "strMemberName" => strtoupper($request->strMemberName[$iCounter]),
                    "iMemberMobile" => $request->iMemberMobile[$iCounter],
                    "iCompayId" => $session,
                    "iEntryBy" => $session,
                    "strEntryDate" => date('d-m-Y H:i:s'),
                    "strIP" => $request->ip()
                );
                DB::table('exhibit_batch')->insert($data);
            }

            return back()->with('success', 'Created Successfully');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitorlanyarddelete(Request $request)
    {
        try {
            DB::table('exhibit_batch')->where([ 'isDelete' => 0, 'iExhibitBatchId' => $request->iExhibitBatchId])->delete();

            return back()->with('success', 'Deleted Successfully!.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function ParticipationLetter(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                $session = Session::get('ExhibitorUserId');
                $data = ExhibitorUser::where([ 'isDelete' => 0, 'id' => $session])->first();

                $pdf = PDF::loadView('ExhibitorUserFiles.exhibitorservices.ParticipationLetter_PDF', ['data' => $data]);

                return $pdf->stream('participation_letter.pdf');
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function TransportationLetter(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                $session = Session::get('ExhibitorUserId');
                $data = ExhibitorUser::where([ 'isDelete' => 0, 'id' => $session])->first();

                $pdf = PDF::loadView('ExhibitorUserFiles.exhibitorservices.Transportation_Letter', ['data' => $data]);

                return $pdf->stream('Transportation_Letter.pdf');
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function ExhibitionVendor(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                $session = Session::get('ExhibitorUserId');
                $data = ExhibitorVendor::orderBy('iExhibitionVendor', 'desc')
                    ->where(['isDelete' => 0])
                    ->paginate(25);
                $count = ExhibitorVendor::orderBy('iExhibitionVendor', 'desc')
                    ->where(['isDelete' => 0])
                    ->count();

                return view('ExhibitorUserFiles.exhibitorservices.exhibitor_vendor', compact('data', 'count'));
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function AdditionalFurniture(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                $session = Session::get('ExhibitorUserId');
                $datas = AdditionalFurniture::orderBy('iAdditionalFurnitureId', 'desc')
                    ->where(['additionalfurniture.iStatus' => 1, 'additionalfurniture.isDelete' => 0, 'additionalfurniture.iCompayId' => $session])
                    ->join('furnituremaster', 'additionalfurniture.iFurnitureId', '=', 'furnituremaster.iFurnitureId')
                    ->paginate(25);
                $count = AdditionalFurniture::orderBy('iAdditionalFurnitureId', 'desc')
                    ->where(['additionalfurniture.iStatus' => 1, 'additionalfurniture.isDelete' => 0, 'additionalfurniture.iCompayId' => $session])
                    ->join('furnituremaster', 'additionalfurniture.iFurnitureId', '=', 'furnituremaster.iFurnitureId')
                    ->count();

                return view('ExhibitorUserFiles.exhibitorservices.additional_furniture', compact('datas', 'count'));
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function AdditionalFurnituredelete(Request $request)
    {
        try {
            DB::table('additionalfurniture')->where([ 'isDelete' => 0, 'iAdditionalFurnitureId' => $request->iAdditionalFurnitureId])->delete();

            return back()->with('success', 'Deleted Successfully!.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function AdditionalFurnitureList(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                $session = Session::get('ExhibitorUserId');
                $Furniture = FurnitureMaster::orderBy('iFurnitureId', 'DESC')
                    ->where([ 'isDelete' => 0])
                    ->paginate(25);
                $count = FurnitureMaster::orderBy('iFurnitureId', 'DESC')
                    ->where([ 'isDelete' => 0])
                    ->count();

                return view('ExhibitorUserFiles.exhibitorservices.additional_furniture_list', compact('Furniture', 'count'));
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function AdditionalFurnitureListStore(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                $session = Session::get('ExhibitorUserId');

                foreach ($request->iFurnitureId as $iFurnitureId) {
                    $qty = "iQty_" . $iFurnitureId;
                    $iAmount = "iAmount_" . $iFurnitureId;
                    $iRate = "iRate_" . $iFurnitureId;
                    if (($request->$iAmount != "" || $request->$iAmount == "0") && ($request->$qty != "" || $request->$qty == "0")) {

                        $delete = DB::table('additionalfurniture')->where([ 'isDelete' => 0, 'iFurnitureId' => $iFurnitureId, 'iCompayId' => $session])->delete();

                        $data = array(
                            "iCompayId" => $session,
                            "iFurnitureId" => $iFurnitureId,
                            "iQty" => $request->$qty,
                            "iRate" => $request->$iRate,
                            "iAmount" => $request->$iAmount,
                            "iEntryBy" => $session,
                            "strEntryDate" => date('d-m-Y H:i:s'),
                            "strIP" => $_SERVER['REMOTE_ADDR']
                        );
                        DB::table('additionalfurniture')->insert($data);
                    }
                }

                return back()->with('success', 'Updated Successfully.');
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function NoDueLetterPDF(Request $request)
    {
        try {
            if ($request->session()->get('ExhibitorUserId') != "") {
                $session = Session::get('ExhibitorUserId');
                $Data = ExhibitorUser::where([ 'isDelete' => 0, 'id' => $session])->first();

                $pdf = PDF::loadView('ExhibitorUserFiles.exhibitorservices.no_due', ['Data' => $Data]);

                return $pdf->stream('no_due.pdf');
            } else {
                return redirect()->route('FrontExhibitor_Login')->with('error', 'Invalid Mobile or Password');
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitorlanyardmobilecheck(Request $request)
    {
        try {
            $mobile = ExhibitBatch::where(['isDelete' => 0,  'iMemberMobile' => $request->mobile])->count();
            if ($mobile > 0) {
                echo 1;
            } else {
                echo 0;
            }
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
