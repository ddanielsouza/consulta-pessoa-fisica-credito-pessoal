<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class ScoreSettingAge extends Model
{
    use \App\Utils\Helpers\ISOSerialization;

    protected $table = "score_setting_age";

    protected $fillable = [
        'id',
        'startAge',
        'endAge',
        'score'
    ];
}
