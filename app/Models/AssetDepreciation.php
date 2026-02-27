<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class AssetDepreciation extends Model
{
    protected $fillable = [
    	'asset_id',
    	'depreciate_period',
    	'opening_value',
    	'depreciate_value',
    	'accumulate_value',
    	'closing_value',
    ];
}
