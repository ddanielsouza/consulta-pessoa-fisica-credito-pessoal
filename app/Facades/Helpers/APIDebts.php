<?php
namespace App\Facades\Helpers;
use Illuminate\Support\Facades\Facade;

class APIDebts extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Helpers\APIDebts::class; 
    }
}
