<?php

class UserController extends \BaseController {

    public function index() {
        $user = User::getUserFromToken();
        return array('user' => $user);
    }

    public function create() {
        
    }

    public function store() {

        $post_data = Input::all();
        $rules = array(
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email|confirmed',
            'email_confirmation' => 'required',
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
            return Response::make('Registro exitoso', 200);
        } else {
            return $validate->messages();
        }
    }

    public function show($id) {
        $user = User::getUserFromToken();
        $user2 = User::find($id);
        if ($user2 == null) {
            return json_encode(array('message' => 'El usuario no existe.'));
        } else if ($user2->id == $user->id) {
            return $user->toJson();
        } else {
            return $user2->toJson();
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
            'email' => 'required|email|unique:users,email|confirmed',
            'email_confirmation' => 'required',
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
            return Response::make('Usuario actualizado correctamente.', 200);
        } else {
            return $validate->messages();
        }
    }

    public function destroy($id) {
        
    }

}
