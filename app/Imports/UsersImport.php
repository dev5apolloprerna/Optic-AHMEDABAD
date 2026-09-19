<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function rules(): array
    {
        return [
            'company_name' => 'required',
            'mobile' => 'required|unique:exhibitoruser,Mobile|digits:10',
            'stall_no' => 'required',
        ];
    }

    public function collection(Collection $rows)
    {
        try {
            foreach ($rows as $row) {

                $pass = "Solar" . substr($row['mobile'], -4);
                $hash = Hash::make($pass);

                $user = array(
                    "strCompany" => $row['company_name'],
                    "strContactPerson" => $row['contact_person'],
                    "Mobile" => $row['mobile'],
                    "strEmail" => $row['email'],
                    "strCity" => $row['city'],
                    "strStallNo" => $row['stall_no'],
                    "strStallSize" => $row['stall_size'],
                    'strEntryDate' => date('Y-m-d'),
                    "strPassword" => $hash,
                    "strPlainPassword" => $pass,
                );
                DB::table('exhibitoruser')->insertGetId($user);
            }

            return $user;
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
