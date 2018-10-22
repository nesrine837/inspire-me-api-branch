<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public function quotee()
    {
        return $this->belongsTo(Quotee::class, 'quotee_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
