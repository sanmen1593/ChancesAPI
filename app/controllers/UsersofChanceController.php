<?php

class UsersofChanceController extends \BaseController {

    public function index() {
        
    }

    public function create() {

    }

    public function store() {
        $data = Input::all();
        $idchance = $data['chances_id'];
        $iduser = Auth::user()->id;

        $data['users_id'] = $iduser;
        $chance = Chance::find($idchance);

        $userofchances = UserofChance::where('chances_id', '=', $idchance)->where('users_id', '=', $iduser)->get();
        if (empty($userofchances)) {
            $message = json_encode(array('message', 'You have already taken this chance'));
            return $message;
        }
        $vehicle = Vehicle::find($chance->vehicles_id);
        if ($vehicle->users_id == $iduser) {
            $message = json_encode(array('message', 'You created this chance'));
        } else {
            UserofChance::create($data);
            $chance->capacity = $chance->capacity - 1;
            $chance->save();
            return Redirect::intended('/chanceslist/');
        }
    }

    public function show($id) {
        
    }

    public function edit($id) {
        
    }

    public function update($id) {
        
    }

    public function destroy($id) {
        
    }

}
