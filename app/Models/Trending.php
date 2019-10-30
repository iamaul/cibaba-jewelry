<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trending extends Model
{
    // protected $table = 'trendings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image'
    ];
}
