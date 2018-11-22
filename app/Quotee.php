<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotee extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }
}
