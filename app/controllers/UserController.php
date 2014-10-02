<?php

class UserController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $post_data = Input::all();
        Mail::send('emails.welcome', $data = array('post_data' => $post_data), function($message) {
            $data = Input::all();
            $data['password'] = Hash::make($data['password']);
            $data['status'] = true;
            User::create($data);
            $message->to($data['email'], $data['name'])->subject('Welcome to ChancerosUTB!');
        });
        return json_encode(array('message' => 'Registro éxitoso'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $user = User::find($id);
        if ($user == null) {
            return json_encode(array('message' => 'El usuario no existe.'));
        }else if($user->id== Auth::user()->id){
            return Auth::user()->toJson();
        }else{
            return $user->toJson();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $user = User::find($id);
        return View::make('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $user = Input::all();
        $user2 = User::find($user['id']);
        $user2->name = $user['name'];
        $user2->lastname = $user['lastname'];
        $user2->email = $user['email'];
        $user2->password = $user['password'];
        $user2->save();
        return json_encode(array('message'=>'Usuario actualizado correctamente.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
