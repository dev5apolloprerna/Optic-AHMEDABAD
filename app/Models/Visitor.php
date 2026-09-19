<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $table = 'visiter'; // ✅ Correct property name
    protected $primaryKey = 'visiterId'; // ✅ Correct for custom primary key
    public $incrementing = true; // ✅ Ensures auto-increment behavior
    protected $keyType = 'int';

    protected $fillable = [
        'visiterId',
        'earthconId',
        'Entry_by',
        'employee_enter_by',
        'name',
        'companyName',
        'email',
        'mobile',
        'state',
        'city',
        'visitDate',
        'timeSlot',
        'interested',
        'visitRefId',
        'strEntryDate',
        'strIp',
        'isDelete',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'employee_enter_by');
    }
}
