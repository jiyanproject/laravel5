<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use Uuid;

    protected $fillable = [
        'name',
    ];

    public $incrementing = false;

}