<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class ScoreSettingMaterialAssets extends Model
{
    use \App\Utils\Helpers\ISOSerialization;

    protected $table = "score_setting_material_assets";

    protected $fillable = [
        'id',
        'price',
        'score',
    ];
}
