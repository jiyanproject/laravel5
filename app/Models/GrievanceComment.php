<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class GrievanceComment extends Model
{
    protected $fillable = [
    	'grievance_id',
    	'comment',
    	'comment_by',
    ];

    public function Parent()
    {
    	return $this->belongsTo(EmployeeGrievance::class,'grievance_id');
    }

    public function Responder()
    {
    	return $this->belongsTo(Employee::class,'comment_by');
    }
}
