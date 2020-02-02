<?php
namespace App\Facades\Services;
use Illuminate\Support\Facades\Facade;

class ClientAdditionalInfoService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \App\Services\ClientAdditionalInfoService::class; 
    }
}
