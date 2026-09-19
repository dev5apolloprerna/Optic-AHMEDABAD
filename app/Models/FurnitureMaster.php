<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnitureMaster extends Model
{
    use HasFactory;
    public $table = 'furnituremaster';
    protected $fillable = [
        'strFurnitureName',
        'strPhoto',
        'strSize',
        'iRate',
        'strEntryDate'
    ];
}
