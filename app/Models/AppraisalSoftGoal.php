<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class AppraisalSoftGoal extends Model
{
    protected $fillable = [
    	'appraisal_id',
    	'competency',
    	'notes',
    ];

    public function Competent()
    {
    	return $this->belongsTo(Status::class,'competency');
    }
}
