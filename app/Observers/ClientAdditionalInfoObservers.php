<?php

namespace App\Observers;
use App\Models\ClientAdditionalInfo;
class ClientAdditionalInfoObservers
{
    public function cacheClear($id){
        $base = '/api/client-additional-infos';
        \Cache::delete($base);
        \Cache::delete("$base/$id");
    }

    public function created(ClientAdditionalInfo $model)
    {
        $this->cacheClear($model->id);
    }

    public function updated(ClientAdditionalInfo $model)
    {
        $this->cacheClear($model->id);
    }

    public function saved(ClientAdditionalInfo $model)
    {
        $this->cacheClear($model->id);
    }

    public function deleted(ClientAdditionalInfo $model)
    {
        $this->cacheClear($model->id);
    }

    public function restored(ClientAdditionalInfo $model)
    {
        $this->cacheClear($model->id);
    }
    
}