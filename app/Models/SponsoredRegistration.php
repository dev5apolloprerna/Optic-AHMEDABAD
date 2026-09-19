<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsoredRegistration extends Model
{
    use HasFactory;
    public $table = 'sponser_registration';
    protected $fillable = [
        'interest',
        'name',
        'mobile',
        'email',
        'designation',
        'companyName',
        'state',
        'country',
        'message',
        'city',
        'strIp',
        'strEntryDate',
        'isDelete',
    ];
}
