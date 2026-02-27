<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class TargetData extends Model
{
    protected $fillable = [
    	'target_id',
    	'appraisal_id',
    	'data_details',
    	'file'
    ];

    public function Parents()
    {
    	return $this->belongsTo(AppraisalTarget::class,'target_id');
    }
}
