<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class AppraisalAdditionalRole extends Model
{
    protected $fillable = [
    	'appraisal_id',
    	'task',
    	'details',
    ];
}
