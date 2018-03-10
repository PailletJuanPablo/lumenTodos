<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;
class UsersAuthController extends Controller
{

    private $salt;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->salt="userloginregister";

    }
    public function authenticate(Request $request)
    {
        if ($request->has('usuario') && $request->has('pass')) {
            $user = User:: where("usuario", "=", $request->input('usuario'))
                          ->where("pass", "=", sha1($this->salt.$request->input('pass')))
                          ->first();
            if ($user) {
              $token=str_random(60);
              $user->api_token=$token;
              $user->save();
              return $user->api_token;
            } else {
              return "Usuario / Contraseña Incorrectos！";
            }
          } else {
            return "Ingrese datos necesarios";
          }
    }

    public function register(Request $request){
        if ($request->has('usuario') && $request->has('pass') && $request->has('email')) {
          $user = new User;
          $user->usuario=$request->input('usuario');
          $user->pass=sha1($this->salt.$request->input('pass'));
          $user->email=$request->input('email');
          $user->api_token=str_random(60);
          if($user->save()){
            return response(['Mensaje'=>'Usuario Guardado!', 'Datos de usuario' => $user],200);
          } else {
            return "NO se pudo registrar";
          }
        } else {
          return "Ingrese los datos correctamente";
        }
      }

      public function info(){
        return Auth::user();
      }

    //
}
