<?php

namespace App\Observers;
use App\Models\Address;
class AddressObservers
{
    public function cacheClear($id){
        $base = '/api/adress';
        \Cache::delete($base);
        \Cache::delete("$base/$id");
    }

    public function created(Address $model)
    {
        $this->cacheClear($model->id);
    }

    public function updated(Address $model)
    {
        $this->cacheClear($model->id);
    }

    public function saved(Address $model)
    {
        $this->cacheClear($model->id);
    }

    public function deleted(Address $model)
    {
        $this->cacheClear($model->id);
    }

    public function restored(Address $model)
    {
        $this->cacheClear($model->id);
    }
    
}