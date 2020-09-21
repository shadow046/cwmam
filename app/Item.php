<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

}
