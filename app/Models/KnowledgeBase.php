<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class KnowledgeBase extends Model
{
    protected $fillable = [
    	'category_id',
    	'title',
    	'content',
    	'file',
    	'created_by',
    ];

    public function Author()
    {
    	return $this->belongsTo(User::class,'created_by');
    }

    public function Categories()
    {
        return $this->belongsTo(DocumentCategory::class,'category_id');
    }
}
