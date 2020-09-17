<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Branch extends Model
{
    use LogsActivity;
    protected $guarded = [];

    public function users()
    {
        return $this->hasmany(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function items()
    {
        return $this->hasmany(Item::class);
    }
}
 