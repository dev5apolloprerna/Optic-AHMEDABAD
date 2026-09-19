<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloorPlan extends Model
{
    use HasFactory;
    public $table = 'floor_plan';
    protected $fillable = [
        'id',
        'name',
        'companyName',
        'email',
        'mobile',
        'strEntryDate',
        'strIp',
        'created_at',
        'updated_at',
    ];
}
