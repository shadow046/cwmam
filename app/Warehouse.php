<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $guarded = [];

    public function PrepareItems()
    {
        return $this->hasmany(PrepareItem::class);
    }
}
