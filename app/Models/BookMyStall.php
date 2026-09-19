<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookMyStall extends Model
{
    use HasFactory;
    public $table = 'book_my_stall';
    protected $fillable = [
        'brochureId',
        'name',
        'companyName',
        'email',
        'mobile',
        'message',
        'city',
        'stall_size',
        'strEntryDate',
        'strIp',
        'created_at',
        'updated_at',
    ];
}
