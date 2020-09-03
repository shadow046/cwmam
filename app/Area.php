<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $guarded = [];

    public function branches()
    {
        return $this->hasmany(Branch::class);
    }

    public function users()
    {
        return $this->hasmany(User::class);
    }
}
