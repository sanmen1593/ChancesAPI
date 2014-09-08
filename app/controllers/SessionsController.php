<?php

class SessionsController extends \BaseController {

    public function index() {
        
    }

    public function create() {
        if (Auth::check()) {
            return Redirect::intended('profile');
        } else {
            return View::make('sessions.create');
        }
    }

    public function store() {
        $input = Input::all();
        $attempt = Auth::attempt([
                    'email' => $input['email'],
                    'password' => $input['password']
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
            return Response::json(['mesage' => 'Correo y/o contraseña incorrecta. Intente de nuevo']);
        }
    }

    public function show($id) {
        
    }

    public function edit($id) {
        
    }

    public function update($id) {
        
    }

    public function destroy() {
        if (Auth::check()) {
            Auth::user()->update(['authentication_token' => null]);
            Auth::logout();
        } else {
            return Redirect::intended('login');
        }
    }

}
