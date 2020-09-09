<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Area extends Model
{
    use LogsActivity;
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
