<?php

namespace App\Http\Controllers;

use App\Models\ExhibitorUser;
use App\Models\ExhibitorVendor;
use App\Models\StallDesign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class ExhibitorServicesController extends Controller
{
    public function exhibitordetails(Request $request)
    {
        try {
            $CompanyName = $request->companyname;

            $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                ->where(['isDelete' => 0, 'iStatus' => 1])
                ->where('strFasciaName', '!=', '')
                ->when($request->companyname, fn ($query, $CompanyName) => $query
                    ->where('exhibitoruser.strCompany', 'LIKE', '%' . $CompanyName . '%'))
                ->paginate(25);
            return view('exhibitorservices.exhibitor_details', compact('Exhibitor', 'CompanyName'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function ParticipationLetterPDF(Request $request, $id)
    {
        try {
            $ParticipationLetter = ExhibitorUser::orderBy('id', 'desc')
                ->where(['exhibitoruser.isDelete' => 0, 'exhibitoruser.iStatus' => 1, "id" => $id])
                ->first();

            $pdf = PDF::loadView('ParticipationLetter_PDF', ['ParticipationLetter' => $ParticipationLetter]);

            return $pdf->stream('participation_letter.pdf');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function TransportationLetterPDF(Request $request, $id)
    {
        try {
            $TransportationLetter = ExhibitorUser::orderBy('id', 'desc')
                ->where(['exhibitoruser.isDelete' => 0, 'exhibitoruser.iStatus' => 1, "id" => $id])
                ->first();

            $pdf = PDF::loadView('TransportationLetter_PDF', ['TransportationLetter' => $TransportationLetter]);

            return $pdf->stream('transportation_letter.pdf');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitordetailsExcel(Request $request, $CompanyName = null)
    {
        try {
            if (!empty($CompanyName)) {
                $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                    ->where(['isDelete' => 0, 'iStatus' => 1])
                    ->where('strFasciaName', '!=', '')
                    ->when($CompanyName, fn ($query, $CompanyName) => $query
                        ->where('exhibitoruser.strCompany', 'LIKE', '%' . $CompanyName . '%'))
                    ->get();
            } else {
                $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                    ->where(['isDelete' => 0, 'iStatus' => 1])
                    ->where('strFasciaName', '!=', '')
                    ->get();
            }
            return view('exhibitorservices.exhibitor_details_excel', compact('Exhibitor', 'CompanyName'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitorlanyard(Request $request)
    {
        try {
            $CompanyName = $request->companyname;

            $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                ->where(['exhibitoruser.isDelete' => 0, 'exhibitoruser.iStatus' => 1])
                ->whereIn('id', [DB::raw("(select exhibit_batch.iCompayId  from `exhibit_batch` where `exhibit_batch`.iCompayId=exhibitoruser.id)")])
                ->when($request->companyname, fn ($query, $CompanyName) => $query
                    ->where('exhibitoruser.strCompany', 'LIKE', '%' . $CompanyName . '%'))
                ->paginate(25);

            return view('exhibitorservices.exhibitor_lanyard', compact('Exhibitor', 'CompanyName'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitorlanyardExcel(Request $request, $CompanyName = null)
    {
        try {
            if (!empty($CompanyName)) {
                $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                    ->where(['exhibitoruser.isDelete' => 0, 'exhibitoruser.iStatus' => 1])
                    ->whereIn('id', [DB::raw("(select exhibit_batch.iCompayId  from `exhibit_batch` where `exhibit_batch`.iCompayId=exhibitoruser.id)")])
                    ->when($CompanyName, fn ($query, $CompanyName) => $query
                        ->where('exhibitoruser.strCompany', 'LIKE', '%' . $CompanyName . '%'))
                    ->get();
            } else {
                $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                    ->where(['exhibitoruser.isDelete' => 0, 'exhibitoruser.iStatus' => 1])
                    ->whereIn('id', [DB::raw("(select exhibit_batch.iCompayId  from `exhibit_batch` where `exhibit_batch`.iCompayId=exhibitoruser.id)")])
                    ->get();
            }

            return view('exhibitorservices.exhibitor_lanyard_excel', compact('Exhibitor', 'CompanyName'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function stalldesign(Request $request)
    {
        try {
            $CompanyName = $request->companyname;

            $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                ->where(['exhibitoruser.isDelete' => 0, 'exhibitoruser.iStatus' => 1])
                ->whereIn('id', [DB::raw("(select exhibit_stall_desgin.iCompanyId  from `exhibit_stall_desgin` where `exhibit_stall_desgin`.iCompanyId=exhibitoruser.id)")])
                ->when($request->companyname, fn ($query, $CompanyName) => $query
                    ->where('exhibitoruser.strCompany', 'LIKE', '%' . $CompanyName . '%'))
                ->paginate(25);

            return view('exhibitorservices.stall_design', compact('Exhibitor', 'CompanyName'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function stalldesignExcel(Request $request, $CompanyName)
    {
        try {
            if (!empty($CompanyName)) {
                $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                    ->where(['exhibitoruser.isDelete' => 0, 'exhibitoruser.iStatus' => 1])
                    ->whereIn('id', [DB::raw("(select exhibit_stall_desgin.iCompanyId  from `exhibit_stall_desgin` where `exhibit_stall_desgin`.iCompanyId=exhibitoruser.id)")])
                    ->when($request->companyname, fn ($query, $CompanyName) => $query
                        ->where('exhibitoruser.strCompany', 'LIKE', '%' . $CompanyName . '%'))
                    ->get();
            } else {
                $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                    ->where(['exhibitoruser.isDelete' => 0, 'exhibitoruser.iStatus' => 1])
                    ->whereIn('id', [DB::raw("(select exhibit_stall_desgin.iCompanyId  from `exhibit_stall_desgin` where `exhibit_stall_desgin`.iCompanyId=exhibitoruser.id)")])
                    ->get();
            }

            return view('exhibitorservices.stall_design_excel', compact('Exhibitor', 'CompanyName'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function stalldesignPDF(Request $request, $id)
    {
        try {
            $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                ->where(['exhibitoruser.isDelete' => 0, 'exhibitoruser.iStatus' => 1, "id" => $id])
                ->whereIn('id', [DB::raw("(select exhibit_stall_desgin.iCompanyId  from `exhibit_stall_desgin` where `exhibit_stall_desgin`.iCompanyId=exhibitoruser.id)")])
                ->first();

            $pdf = PDF::loadView('stall_design_PDF', ['Exhibitor' => $Exhibitor, "id" => $id]);

            return $pdf->stream('stalldesign.pdf');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function additionalfurniture(Request $request)
    {
        try {
            $CompanyName = $request->companyname;

            $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                ->where(['exhibitoruser.isDelete' => 0, 'exhibitoruser.iStatus' => 1])
                ->whereIn('id', [DB::raw("(select additionalfurniture.iCompayId  from `additionalfurniture` where `additionalfurniture`.iCompayId=exhibitoruser.id)")])
                ->when($request->companyname, fn ($query, $CompanyName) => $query
                    ->where('exhibitoruser.strCompany', 'LIKE', '%' . $CompanyName . '%'))
                ->paginate(25);

            return view('exhibitorservices.additional_furniture', compact('Exhibitor', 'CompanyName'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function additionalfurniturePDF(Request $request, $id)
    {
        try {
            $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                ->where(['exhibitoruser.isDelete' => 0, 'exhibitoruser.iStatus' => 1, "id" => $id])
                ->whereIn('id', [DB::raw("(select additionalfurniture.iCompayId  from `additionalfurniture` where `additionalfurniture`.iCompayId=exhibitoruser.id)")])
                ->first();
            $pdf = PDF::loadView('additional_furniture_PDF', ['Exhibitor' => $Exhibitor]);

            return $pdf->stream('AdditionalFurniturePdf.pdf');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitorvendor(Request $request)
    {
        try {
            $Exhibitor = ExhibitorVendor::orderBy('iExhibitionVendor', 'desc')
                ->where(['isDelete' => 0, 'iStatus' => 1])
                ->paginate(25);
            $Count = ExhibitorVendor::orderBy('iExhibitionVendor', 'desc')
                ->where(['isDelete' => 0, 'iStatus' => 1])
                ->count();

            return view('exhibitorservices.exhibitor_vendor', compact('Exhibitor', 'Count'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitorvendorstore(Request $request)
    {
        try {
            $data = array(
                "strCompanyName" => $request->strCompanyName,
                "strContactPersonName" => $request->strContactPersonName,
                "iContactNo" => $request->iContactNo,
                "strService" => $request->strService,
                "strEntryDate" => date('Y-m-d H:i:s'),
                "strIP" => $request->ip(),
            );
            DB::table('exhibitionvendor')->insert($data);

            return back()->with('success', 'Exhibitor Vendor Created Successfully!.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitorvendoredit(Request $request, $id)
    {
        try {
            $Data = ExhibitorVendor::orderBy('iExhibitionVendor', 'desc')
                ->where(['isDelete' => 0, 'iStatus' => 1, 'iExhibitionVendor' => $id])
                ->first();
            echo json_encode($Data);
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitorvendorupdate(Request $request)
    {
        try {
            $Data = DB::table('exhibitionvendor')
                ->where(['iStatus' => 1, 'isDelete' => 0, 'iExhibitionVendor' => $request->iExhibitionVendor])
                ->update([
                    "strCompanyName" => $request->strCompanyName,
                    "strContactPersonName" => $request->strContactPersonName,
                    "iContactNo" => $request->iContactNo,
                    "strService" => $request->strService,
                    "strEntryDate" => date('Y-m-d H:i:s'),
                    "strIP" => $request->ip(),
                ]);
            return back()->with('success', 'Exhibitor Vendor Updated Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitorvendorExcel(Request $request, $CompanyName)
    {
        try {
            if (!empty($CompanyName)) {
                $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                    ->where(['exhibitoruser.isDelete' => 0, 'exhibitoruser.iStatus' => 1])
                    ->whereIn('id', [DB::raw("(select additionalfurniture.iCompayId  from `additionalfurniture` where `additionalfurniture`.iCompayId=exhibitoruser.id)")])
                    ->when($request->companyname, fn ($query, $CompanyName) => $query
                        ->where('exhibitoruser.strCompany', 'LIKE', '%' . $CompanyName . '%'))
                    ->get();
            } else {
                $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                    ->where(['exhibitoruser.isDelete' => 0, 'exhibitoruser.iStatus' => 1])
                    ->whereIn('id', [DB::raw("(select additionalfurniture.iCompayId  from `additionalfurniture` where `additionalfurniture`.iCompayId=exhibitoruser.id)")])
                    ->get();
            }

            return view('exhibitorservices.additional_furniture_excel', compact('Exhibitor', 'CompanyName'));
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitorvendordelete(Request $request, $id)
    {
        try {
            DB::table('exhibitionvendor')->where(['iStatus' => 1, 'isDelete' => 0, 'iExhibitionVendor' => $id])
                ->delete();

            return back()->with('success', 'Exhibitor Vendor Deleted Successfully!.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function exhibitorvendormobilecheck(Request $request)
    {
        try {
            $mobile = ExhibitorVendor::where(['isDelete' => 0, 'iStatus' => 1, 'iContactNo' => $request->mobile])->count();
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

    public function exhibitorvendormobilecheckedit(Request $request)
    {
        try {
            $mobile = ExhibitorVendor::where(['isDelete' => 0, 'iStatus' => 1, 'iContactNo' => $request->mobile])->count();
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

    public function isPaymentReceived(Request $request)
    {
        try {
            $ExhibitorUser = 0;
            if ($request->action == "PaymentReceived") {
                $data = array(
                    "isPaymentReceived" => '1'
                );
                $ExhibitorUser = ExhibitorUser::where("id", '=', $request->id)->update($data);
            } else {
                $data = array(
                    "isPaymentReceived" => '0'
                );
                $ExhibitorUser = ExhibitorUser::where("id", '=', $request->id)->update($data);
            }
            echo $ExhibitorUser ? 1 : 0;
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function noDue_LetterPDF(Request $request, $id)
    {
        try {
            $Exhibitor = ExhibitorUser::orderBy('strCompany', 'asc')
                ->where(['exhibitoruser.isDelete' => 0, 'exhibitoruser.iStatus' => 1, "id" => $id])
                ->first();
            //dd($Exhibitor);
            $pdf = PDF::loadView('noDue_LetterPDF', ['Data' => $Exhibitor]);

            return $pdf->stream('noDue_LetterPDF.pdf');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
