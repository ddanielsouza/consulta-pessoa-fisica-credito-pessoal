<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ClientAdditionalInfo;
use App\Utils\Controllers\ControllerModel;
use App\Facades\Services\ClientAdditionalInfoService;


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


    public function score($idClient){
        try{
            $score = ClientAdditionalInfoService::calcScoreByIdClient($idClient);
            return response()->json([
                'success' => true,
                'data' => $score,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Error interno!',
                'error' => [$e->getMessage()]
            ], 500);
        }
    }
}
