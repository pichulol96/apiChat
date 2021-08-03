<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\detallemensaje;
use DB;

class chat extends Controller
{

  public function __construct() 
   {
    
   }

   public function get_chat(Request $request)
   {
   	   //return $request->all();
   	    $user1=$request->get("usuario1");
   	    $user2= $request->get("usuario2");

   	     
       $chat=DB::select("call chat_usuarios ($user2,$user1)");
       return $chat;
   }

   public function insertar_chat(Request $request)
   { 
      date_default_timezone_set('America/Mexico_City');
      $fecha=date("Y-m-d");/////Actual///
      $hora = date("H:i:s"); 
      $mensaje=$request->get("mensaje");
      $user1=$request->get("usuario1");
      $user2=$request->get("usuario2");
 
      if($request->get('idchat'))
      { 
        //aqui inserta en el chat que existe de los 2 usuarios
        $idChat=$request->get('idchat');
        $insertChat=detallemensaje::create([
          'hora'=>$hora,
          'fecha'=>$fecha,
          'mensaje'=>$mensaje,
          'usuario'=>$user1,
          'id_mensaje'=>$idChat,
        ]);
        //return json_encode($insertChat);
        $success=event(new \App\Events\mensajes( json_encode($request->all())));
        
      }
      else
      {
        //aqui crea primeor el chat de y luego inserta el mensaje
        $insertChat=DB::select("call mensaje_chat ($user1,$user2,'$hora','$fecha','$mensaje')");
        //return json_encode($insertChat);
        $success=event(new \App\Events\mensajes( json_encode($request->all())));
      }  
   	  
   }
}
