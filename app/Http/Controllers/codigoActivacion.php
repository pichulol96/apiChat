<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class codigoActivacion extends Controller
{
    //
    public function generarCodigo($longitud)
    {
    	$key = '';
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
		$max = strlen($pattern)-1;
		for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
		return $key;
    }
   
 
}
