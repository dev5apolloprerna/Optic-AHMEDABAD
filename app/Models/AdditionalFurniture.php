<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalFurniture extends Model
{
    use HasFactory;
    public $table = 'additionalfurniture';
    protected $fillable = [
        'iCompayId',
        'iFurnitureId',
        'iQty',
        'iRate',
        'iAmount',
        'iEntryBy',
        'strEntryDate',
    ];
}
