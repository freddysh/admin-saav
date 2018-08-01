<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    protected $guard='admin';
    public function store(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');
        $this->validate($request,['email'=>'required','password'=>'required']);
        if(auth()->guard($this->guard)->attempt($request->only(['email','password']))){
            $usuario=User::where('email',$email)->get();
//            $usuario=User::where('email',$email)->where('password',bcrypt($password))->get();

            $usuario1=null;
            foreach ($usuario as $usuario_){
                $usuario1=$usuario_;
            }
//            dd($usuario);
            if($usuario1->tipo_user=='admin')
                return redirect()->route('index_path');
            if($usuario1->tipo_user=='ventas')
                return redirect()->route('index_path');
            if($usuario1->tipo_user=='contabilidad')
                return redirect()->route('contabilidad_index_path');
            if($usuario1->tipo_user=='reservas')
                return redirect()->route('book_path');

        }
        else{
            return redirect()->route('inicio_path')
                ->withErrors(['No encontramos al usuario'])
                ->withInput();
        }
    }
    public function destroy(){
        auth()->guard('admin')->logout();
        return redirect()->route('inicio_path');
    }
//    public function dashboard(){
//        return view('admin_auth_index_path');
//    }
}
