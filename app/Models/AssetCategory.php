<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class AssetCategory extends Model
{
    use Uuid;

    protected $fillable = [
    	'category_name',
    	'chart_of_account_id',
        'depreciation_account_id',
    ];

    public $incrementing = false;

    public function Coas()
    {
    	return $this->belongsTo(ChartOfAccount::class,'chart_of_account_id');
    }

    public function Depreciates()
    {
        return $this->belongsTo(ChartOfAccount::class,'depreciation_account_id');
    }
}
