<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ClientAdditionalInfo;
use App\Utils\Controllers\ControllerModel;

/**
 * Criei a class ControllerModel que contem algumas functions basica para REST API
 */
class ClientAdditionalInfoController extends ControllerModel
{
    protected $modelName = ClientAdditionalInfo::class;
    protected $basicValidate = [
        'client_id'=>'required|numeric',
        'birthday' => 'required|date',
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
