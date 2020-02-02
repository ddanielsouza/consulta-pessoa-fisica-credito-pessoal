<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ClientAdditionalInfo;
use App\Models\MaterialAsset;
use App\Models\Address;
use App\Models\ScoreSettingAge;
use App\Models\ScoreSettingMaterialAssets;
use App\Models\ScoreSettingSourceIncome;
use App\Models\SourceIncome;

class InsertPayloads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ScoreSettingAge::create([
            'startAge' => 0,
            'endAge' => 17,
            'score' => 0
        ]);

        ScoreSettingAge::create([
            'startAge' => 18,
            'endAge' => 24,
            'score' => 100
        ]);

        ScoreSettingAge::create([
            'startAge' => 25,
            'endAge' => 49,
            'score' => 150
        ]); 

        ScoreSettingAge::create([
            'startAge' => 50,
            'endAge' => 70,
            'score' => 100
        ]); 

        ScoreSettingAge::create([
            'startAge' => 71,
            'endAge' => 1000,
            'score' => 10
        ]); 

        ScoreSettingMaterialAssets::create([
            'price' => 10000,
            'score' => 100,
        ]);

        ScoreSettingSourceIncome::create([
            'price' => 1000,
            'score' => 100,
        ]);
        
        $materialAssets = ["Carro", "Imovel", "Moto", "lote"];
        $sourceIncomes = ["Salario", "Aluguel"];

        for($i = 1; $i <= 1000; $i ++){
            $cdi = new ClientAdditionalInfo();
            $cdi->client_id = $i;
            $cdi->birthday = new \DateTime(rand(1950, 2010).'-'.rand(1, 12). '-'. rand(1,28));
            $cdi->save();
            for($x = 0; $x < rand(0, 5); $x++){
                $ma = new MaterialAsset();
                $ma->description = $materialAssets[array_rand($materialAssets)];
                $ma->client_id = $i;
                $ma->price = rand(1000, 100000);
                $ma->save();

                $address = new Address();
                $address->material_asset_id = $ma->id;
                $address->cod_ibge = '5208707';
                $address->dctZipCode = '74840060';
                $address->dctStreetAddress = 'Avenida Arumã';
                $address->dctComplement = " ";
                $address->dctNeighborhood = 'Parque Amazônia';
                $address->save();
            }

            $age = $cdi->birthday->diff(new \DateTime())->y;
            if($age >= 18){
                for($x = 0; $x < rand(0, 3); $x++){
                    $sc = new SourceIncome();
                    $sc->client_id = $cdi->client_id;
                    $sc->description = $sourceIncomes[array_rand($sourceIncomes)];
                    $sc->amounts = rand(800, 20000);
                    $sc->save();
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
