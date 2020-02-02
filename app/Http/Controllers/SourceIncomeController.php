<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SourceIncome;
use App\Utils\Controllers\ControllerModel;

class SourceIncomeController extends ControllerModel
{
    protected $modelName = SourceIncome::class;
    protected $basicValidate = [
        'client_id'=>'required|numeric',
        'description' => 'required|string',
        'amounts' => 'required|numeric',
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
