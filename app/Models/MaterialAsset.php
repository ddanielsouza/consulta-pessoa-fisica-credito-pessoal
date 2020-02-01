<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class MaterialAsset extends Model
{
    use \App\Utils\Helpers\ISOSerialization;

    protected $table = "material_assets";

    protected $fillable = [
        'id',
        'client_id',
        'description',
        'price'
    ];
}
