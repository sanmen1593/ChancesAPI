<?php

class SessionsController extends \BaseController {

    public function index() {
        
    }

    public function create() {
            return View::make('sessions.create');
    }

    public function store() {
        $input = Input::all();
        
        if(is_array($input)){
            $email = $input['email'];
            $password = $input['password'];
        }else{
            $email = $input.email;
            $password = $input.password;
        }
        $attempt = Auth::attempt([
                    'email' => , $email,
                    'password' => $password
        ]);
        if ($attempt) {
            while (true) {
                $token = Crypt::encrypt(str_random(15));
                $user = User::where('authentication_token', '=', $token)->get();
                if ($user->count() > 0) {
                    continue;
                } else {
                    break;
                }
            }
            Auth::user()->update(['authentication_token' => $token]);
            return Response::json(['auth_token' => $token]);
        } else {
            Response::make('Correo y/o contraseña incorrecta. Intente de nuevo', 401);
        }
    }

    public function show($id) {
        
    }

    public function edit($id) {
        
    }

    public function update($id) {
        
    }

    public function destroy() {
        $user = User::getUserFromToken();
        if ($user != null) {
            $user->update(['authentication_token' => '']);
            return Response::make('Sesión cerrada correctamente', 200);
        } else {
            return Redirect::make('No estás registrado', 401);
        }
    }

}
