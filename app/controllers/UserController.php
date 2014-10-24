<?php

class UserController extends \BaseController {

    public function index() {
        
    }

    public function create() {
        
    }

    public function store() {
        $post_data = Input::all();
        $rules = array(
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'email_confirmation' => 'required|confirmed',
            'password' => 'required'
        );
        $messages = array(
            'required' => 'The :attribute field is required',
            'email' => 'The :attribute must be a valid email.',
            'email.unique' => 'The email is already registered.',
            'confirmed' => 'The :attribute have to be equal.'
        );
        $validate = Validator::make($post_data, $rules, $messages);
        if ($validate->passes()) {
            Mail::send('emails.welcome', $data = array('post_data' => $post_data), function($message) {
                $data = Input::all();
                $data['password'] = Hash::make($data['password']);
                $data['status'] = true;
                User::create($data);
                $message->to($data['email'], $data['name'])->subject('Welcome to ChancerosUTB!');
            });
            return json_encode(array('message' => 'Registro éxitoso'));
        } else {
            return $validate->messages();
        }
    }

    public function show($id) {
        $user = User::find($id);
        if ($user == null) {
            return json_encode(array('message' => 'El usuario no existe.'));
        } else if ($user->id == Auth::user()->id) {
            return Auth::user()->toJson();
        } else {
            return $user->toJson();
        }
    }

    public function edit($id) {
        $user = User::find($id);
        return View::make('users.edit')->with('user', $user);
    }

    public function update($id) {
        $user = Input::all();
        $rules = array(
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'email_confirmation' => 'required|confirmed',
            'password' => 'required'
        );
        $messages = array(
            'required' => 'The :attribute field is required',
            'email' => 'The :attribute must be a valid email.',
            'email.unique' => 'The email is already registered.',
            'confirmed' => 'The :attribute have to be equal.'
        );
        $validate = Validator::make($post_data, $rules, $messages);
        if ($validate->passes()) {
            $user2 = User::find($user['id']);
            $user2->name = $user['name'];
            $user2->lastname = $user['lastname'];
            $user2->email = $user['email'];
            $user2->password = $user['password'];
            $user2->save();
            return json_encode(array('message' => 'Usuario actualizado correctamente.'));
        } else {
            return $validate->messages();
        }
    }

    public function destroy($id) {
        
    }

}
