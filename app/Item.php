<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function RequestedItems()
    {
        return $this->hasMany(RequestedItem::class);
    }

    public function PreparedItems()
    {
        return $this->hasMany(PreparedItem::class);
    }

}
