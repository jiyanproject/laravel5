<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    protected $fillable = [
    	'category_id',
        'content_id',
    	'title',
    	'content',
        'file',
    	'created_by',
    ];

    public function Author()
    {
    	return $this->belongsTo(Employee::class,'created_by');
    }
}
