<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\AddressObservers;
use App\Observers\ClientAdditionalInfoObservers;
use App\Observers\MaterialAssetObservers;
use App\Observers\SourceIncomeObservers;

use App\Models\Address;
use App\Models\ClientAdditionalInfo;
use App\Models\MaterialAsset;
use App\Models\SourceIncome;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function boot()
    {
        Address::observe(AddressObservers::class);
        ClientAdditionalInfo::observe(ClientAdditionalInfoObservers::class);
        MaterialAsset::observe(MaterialAssetObservers::class);
        SourceIncome::observe(SourceIncomeObservers::class);
    }

    public function register()
    {
        $this->app->singleton('Helpers\APIDebts', function()
        {
            return \App\Helpers\APIDebts::getInstance();
        });
    }
}
