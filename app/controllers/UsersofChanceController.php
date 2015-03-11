<?php

class UsersofChanceController extends \BaseController {
    public function store() {
        $user = User::getUserFromToken();
        $data = Input::all();
        $idchance = $data['chances_id'];
        $iduser = $user->id;

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
            return $message;
        } else {
            UserofChance::create($data);
            $chance->capacity = $chance->capacity - 1;
            $chance->save();
            $message = json_encode(array('message', 'Chance taken successfully.'));
            return $message;
            //return Redirect::intended('/chanceslist/');
        }
    }
}
