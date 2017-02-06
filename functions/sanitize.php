<?php

require_once 'classes/htmLawed.php';


function escape($string){

	// return $string = htmLawed::hl($string);
	// echo htmlentities($string, ENT_QUOTES, 'UTF-8');
	return htmlentities($string, ENT_QUOTES, 'UTF-8');
}