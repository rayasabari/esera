<?php
namespace App\Helpers;
use Carbon\Carbon;
class Tanggal
{
	public static function indo($tgl, $format)
	{
		$dt = new Carbon($tgl);
		setlocale(LC_TIME, 'IND');
		// %d %B %Y %H:%M:%S
		return $dt->formatLocalized($format);
	}

}