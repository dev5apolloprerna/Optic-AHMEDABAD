<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExhibitBatch extends Model
{
    use HasFactory;
    public $table = 'exhibit_batch';
    protected $fillable = [
        'strCompanyName',
        'strCity',
        'strMemberName',
        'iMemberMobile',
        'iCompayId',
        'iEntryBy',
        'strEntryDate'
    ];
}
