<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class url extends Model
{
    public $timestamps = false;

    protected $fillable= ['url', 'shortened'];
}
