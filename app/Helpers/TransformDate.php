<?php

namespace iteos\Helpers;
use Carbon\Carbon;

class TransformDate

{
	public function transformDate($value, $format = 'Y-m-d')
	{
	    try {
	        return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
	    } catch (\ErrorException $e) {
	        return \Carbon\Carbon::createFromFormat($format, $value);
	    }
	}

}