<?php

namespace App\Observers;
use App\Models\MaterialAsset;
class MaterialAssetObservers
{
    public function cacheClear($id){
        $base = '/api/material-assets';
        \Cache::delete($base);
        \Cache::delete("$base/$id");
    }

    public function created(MaterialAsset $model)
    {
        \Cache::delete("/api/client-additional-infos/client/$model->client_id/score");
        $this->cacheClear($model->id);
    }

    public function updated(MaterialAsset $model)
    {
        \Cache::delete("/api/client-additional-infos/client/$model->client_id/score");
        $this->cacheClear($model->id);
    }

    public function saved(MaterialAsset $model)
    {
        $this->cacheClear($model->id);
    }

    public function deleted(MaterialAsset $model)
    {
        $this->cacheClear($model->id);
    }

    public function restored(MaterialAsset $model)
    {
        $this->cacheClear($model->id);
    }
    
}