<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\MaterialAsset;
use App\Utils\Controllers\ControllerModel;

/**
 * Criei a class ControllerModel que contem algumas functions basica para REST API
 */
class MaterialAssetController extends ControllerModel
{
    protected $modelName = MaterialAsset::class;
    protected $basicValidate = [
        'client_id'=>'required|numeric',
        'description' => 'required|string',
        'price' => 'required|numeric',
    ];

    protected $columnsEncrypted = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    
}
