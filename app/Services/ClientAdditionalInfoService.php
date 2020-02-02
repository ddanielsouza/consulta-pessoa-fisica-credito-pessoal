<?php

namespace App\Services;
use App\Models\ClientAdditionalInfo;
use App\Models\MaterialAsset;
use App\Models\SourceIncome;
use App\Models\ScoreSettingAge;
use App\Models\ScoreSettingMaterialAssets;
use App\Models\ScoreSettingSourceIncome;
use DateTime;
class ClientAdditionalInfoService
{
    /**
     * @param int $idClient
     * @return int
     */
    public function calcScoreByIdClient($idClient){
        $settingsAge =  ScoreSettingAge::get();
        $settingMateriaAsset = ScoreSettingMaterialAssets::first();
        $settingSourceIncome = ScoreSettingSourceIncome::first();
        $clientAdditionalInfo = ClientAdditionalInfo::where('client_id', $idClient)->first();
        $materialAssetsPrice = MaterialAsset::select([\DB::raw('SUM(price) as price')])
            ->where('client_id', $idClient)
            ->first()
            ->price;

        $sourceIncomeAmounts = SourceIncome::select([\DB::raw('SUM(amounts) as amounts')])
            ->where('client_id', $idClient)
            ->first()
            ->amounts;
        
        $score = 0;

        if(!empty($clientAdditionalInfo)){
            $currentDate = new DateTime();
            $interval = $clientAdditionalInfo->birthday->diff($currentDate);
            $currentAge = $interval->y;
            
            foreach($settingsAge as $setting){
                if($setting->startAge >= $currentAge && $setting->endAge <= $currentAge){
                    $score += $setting->score;
                }
            }
        }

        
        $score += $materialAssetsPrice > 0 ? 
            ceil(($materialAssetsPrice / $settingMateriaAsset->price) * $settingMateriaAsset->score): 0;

        $score += $sourceIncomeAmounts > 0 ? 
            ceil(($sourceIncomeAmounts / $settingSourceIncome->price) * $settingSourceIncome->score): 0;
            
        return $score > 1000 ? 1000 : $score;
    }
}