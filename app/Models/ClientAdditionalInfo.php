<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class ClientAdditionalInfo extends Model
{
    use \App\Utils\Helpers\ISOSerialization;

    protected $table = "client_additional_infos";

    protected $fillable = [
        'id',
        'client_id',
        'birthday',
    ];

    protected $casts = [
        'birthday' => 'datetime'
    ];

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = is_string($value) ? new DateTime($value) : $value; 
    }
}
