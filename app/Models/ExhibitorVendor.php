<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExhibitorVendor extends Model
{
    use HasFactory;
    public $table = 'exhibitionvendor';
    protected $fillable = [
        'strCompanyName',
        'strContactPersonName',
        'iContactNo',
        'strService',
        'strEntryDate',
        'strIP',
    ];
}
