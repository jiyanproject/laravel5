<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class AssetManagements extends Model
{
    use Uuid;

    protected $fillable = [
    	'name',
        'asset_code',
    	'category_name',
    	'purchase_date',
        'warranty_expire',
    	'purchase_price',
        'purchase_from',
        'depreciation_start',
    	'estimate_time',
    	'residual_value',
        'method_id',
    	'status_id',
    ];

    public $incrementing = false;

    public function Categories()
    {
    	return $this->belongsTo(AssetCategory::class,'category_name','id');
    }

    public function Statuses()
    {
        return $this->belongsTo(Status::class,'status_id');
    }

    public function Child()
    {
        return $this->hasMany(AssetDepreciation::class,'asset_id');
    }
}
