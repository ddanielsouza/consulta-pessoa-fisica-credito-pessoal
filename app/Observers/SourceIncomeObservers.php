<?php

namespace App\Observers;
use App\Models\SourceIncome;
class SourceIncomeObservers
{
    public function cacheClear($id){
        $base = '/api/source-income';
        \Cache::delete($base);
        \Cache::delete("$base/$id");
    }

    public function created(SourceIncome $model)
    {
        $this->cacheClear($model->id);
    }

    public function updated(SourceIncome $model)
    {
        $this->cacheClear($model->id);
    }

    public function saved(SourceIncome $model)
    {
        $this->cacheClear($model->id);
    }

    public function deleted(SourceIncome $model)
    {
        $this->cacheClear($model->id);
    }

    public function restored(SourceIncome $model)
    {
        $this->cacheClear($model->id);
    }
}