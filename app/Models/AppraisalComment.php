<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class AppraisalComment extends Model
{
    protected $fillable = [
    	'appraisal_id',
    	'comment_by',
    	'comments',
    ];

    public function Employees()
    {
    	return $this->belongsTo(Employee::class,'comment_by');
    }
}
