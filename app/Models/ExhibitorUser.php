<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;

class ExhibitorUser extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'exhibitoruser';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'strCompany',
        'strLanyardName',
        'Mobile',
        'strPassword',
        'strSalt',
        'strEmail',
        'strCity',
        'strContactPerson',
        'strStallNo',
        'strStallSize',
        'strFasciaName',
        'strParticipantCertificateName',
        'txtGSTIN',
        'iInviteesRequired',
        'strAddress',
        'isPaymentReceived',
        'strPlainPassword',
        'strEntryDate',
        'isDelete',
        'iStatus',
        'strIP',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'strPassword',
        'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key-value array, containing any custom claims to be added to JWT.
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    // Make sure password hashing works if using strPassword
    public function setPasswordAttribute($password)
    {
        $this->attributes['strPassword'] = bcrypt($password);
    }
}
