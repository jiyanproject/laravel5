<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class AppraisalData extends Model
{
    protected $fillable = [
    	'appraisal_id',
    	'indicator',
    	'target',
    	'weight',
    	'files',
    ];

    public function Appraisal()
    {
    	return $this->belongsTo(EmployeeAppraisal::class,'appraisal_id');
    }

    public function Target()
    {
        return $this->hasMany(AppraisalTarget::class,'data_id','id');
    }

    public function Expects()
    {
        return $this->hasMany(AppraisalComment::class,'data_id');
    }
}
