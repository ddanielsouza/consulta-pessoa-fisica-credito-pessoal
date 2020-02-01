<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class SourceIncome extends Model
{
    use \App\Utils\Helpers\ISOSerialization;

    protected $table = "source_income";

    protected $fillable = [
        'id',
        'client_id',
        'description',
        'amounts'
    ];
}
