<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use\App\Http\Controllers\codigoActivacion;
use\App\Mail\activarUsuario;
use Illuminate\Support\Facades\Mail;

class usuario extends Controller
{
    public function __construct()
    {
    	
    } 

    public function registro_usuario(Request $request)
    {
        
      //return json_encode($request->get("name"));
    	$false=User::where('correo','=',$request->get("email"))->get();
    	if($false!="[]")
    	{
    		return json_encode(0);
    	}

    	$codigo=new codigoActivacion;
      $activar=$codigo->generarCodigo(6); //se guarda el codigo en la variablle activar
      session(['codigo' => $activar]);//se guarda el codigo en una variable de session
    	$exito=User::create([
            'correo' => $request->get("email"),
            'contrasena' => Hash::make($request->get("password")),
            'nombre_completo' =>$request->get("name"),
            'apellidos' =>$request->get("lastName"),
            'codigo' =>$activar,
            'activado' =>0,
            'img'=>"sinfoto",  
            'estado'=>'inactivo',
      ]);
    	 if($exito)
    	 {
    	   //return json_encode(1);
    	   $correo= new activarUsuario; //instancia donde van datos del correro
	       $correoUsiaro=$request->get("email");//persona a quien se le envia el correo
	       Mail::to($correoUsiaro)->send($correo);
	       return json_encode(1);
    	 }
    }

    public function activar_usuario($codigo)
    {
       $resul=User::where("codigo", $codigo)
        ->update(["activado" => "1"]);
        if($resul!="[]")
        {
        	return "Usuario Activado, Ya puede iniciar session en su cuenta de chatLaravel";
        }
    }

    public function login_usuario(Request $request)
    {  
       $user=User::where('correo','=',$request->get("user"))->get();
       $row=count($user);
       if($row==0)
       {
         return json_encode("usuario incorrecto");
       }
       else
       {
           foreach ($user as $key => $value) 
            {
               $passIncriptada=$value['contrasena'];
            }
           
           if (Hash::check($request->get("password"), $passIncriptada)) 
            {
                //$mensaje="Usuario conectado";
              $resul=User::where("correo", $request->get("user"))
              ->update(["estado" => "activo"]);
              $success=event(new \App\Events\usuariosConctados( json_encode($user)));
              return json_encode($user);
            }

            else
            {
              return json_encode("password incorrecta"); 
            }
        }
    }

    public function logaut_usuario(Request $request)
    {
      foreach ($request->all() as $key => $value) {
       $id=$value['idusuario'];
      }

      $resul=User::where("idusuario", $id)
        ->update(["estado" => "inactivo"]);
        if($resul!="[]")
        {
          $success=event(new \App\Events\usuariosConctados( json_encode($request->all())));
          return json_encode(1);
        }
        else
        {
          return json_encode(0);
        }
    }



    public function get_users()
    {
      $users=User::where('estado','=','activo')->get();
      return json_encode($users);
    }

    public function cambiar_foto(Request $request)
    {
      $imagen= $request->file('files');
      $idUser= $request->get('user');
      $nombre= time().'.'.$imagen->getClientOriginalExtension();
      $resul=User::where("idusuario", $idUser)
        ->update(["img" => "$nombre"]);
      $destino= public_path('img');
      $imagen->move($destino,$nombre);
      $datos=($this->datos_user($idUser));
      return json_encode($datos);
      
    }

    public function datos_user($id)
    {
      $user=User::where('idusuario','=',$id)->get();
      return $user;
    }
}
