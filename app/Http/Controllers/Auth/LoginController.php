<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'inicio';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return 'usuario';
    }
    /**
     * Verifica si el usuario tiene un estado activo para relalizar el login
     */
    protected function authenticated(Request $request, $user)
    {
        if($user->estado=='A'){
             $this->redirectPath();
        }else{
            $this->logout($request);
            $this->usuarioDesactivado($request);
        }
    }
    /**
     * mensaje de usuario desactivado
     */
    public function usuarioDesactivado(Request $request){
        throw ValidationException::withMessages([
                $this->username() => 'El usuario ingresado no tiene permitido iniciar sesión',
            ]);
       }
    //sobre escribe el metodo logout para redireccionar al login y no al home
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/login');
    }

}
