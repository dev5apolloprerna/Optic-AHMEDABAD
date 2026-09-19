<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StallDesign extends Model
{
    use HasFactory;
    public $table = 'exhibit_stall_desgin';
    protected $fillable = [
        'iCompanyId',
        'strVendorCompanyName',
        'strVendorContactPersonName',
        'strVendorName',
        'strVendorAddress',
        'strVendorCity',
        'strVendorState',
        'strVendorCountry',
        'iVendorTelephone',
        'iVendorMobile',
        'strVendorEmail',
        'strVendorWebsite',
        'iEntryBy',
        'strEntryDate',
    ];
}
