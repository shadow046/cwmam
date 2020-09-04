<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->hasmany(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

}
 