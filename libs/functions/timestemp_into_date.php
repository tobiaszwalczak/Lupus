<?php

function timestemp_into_date($timestemp)
{
	$date = implode(".", array_reverse(explode("-", array_shift(explode(" ", $timestemp)))));

	return $date;
}