<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class ScoreSettingSourceIncome extends Model
{
    use \App\Utils\Helpers\ISOSerialization;
    protected $table = "score_setting_source_income";
    protected $fillable = [
        'id',
        'price',
        'score'
    ];
}
