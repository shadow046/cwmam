<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->hasmany(item::class);
    }
}
