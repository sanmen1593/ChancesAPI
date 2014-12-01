<?php

class VehicleController extends \BaseController {

    public function index() {
        $user = User::getUserFromToken();
        $vehicle = Vehicle::where('users_id', '=', $user->id)->get();
        return array('vehicle' => $vehicle);
    }

    public function create() {
        return View::make('vehicles.create');
    }

    public function store() {
        $user = User::getUserFromToken();
        $vehicle = Input::all();
        $rules = array(
            'plate' => array('required', 'unique:vehicles', 'regex:/^[A-Za-z][A-Za-z][A-Za-z][0-9][0-9]([A-Za-z]|[0-9])/'),
            'color' => array('required'),
            'brand' => array('required'),
            'model' => array('required'),
            'capacity' => array('required', 'integer'),
            'type' => array('required', 'integer')
        );
        $messages = array(
            'required' => 'The :attribute field is required',
            'plate.unique:vehicles' => 'The plate is already register.',
            'plate.regex' => 'Your plate must be like de example: XXX000 or XXX00X'
        );
        $validate = Validator::make($vehicle, $rules, $messages);

        if ($validate->fails()) {
            return $validate->messages();
        } else {
            $vehicle['users_id'] = $user->id;
            $vehicle['status'] = true;
            Vehicle::create($vehicle);
            return json_encode($vehicle);
        }
    }

    public function show($id) {
        $vehicle = Vehicle::find($id);
        return array('vehicle' => $vehicle);
    }

    public function edit($id) {
        $vehicle = Vehicle::find($id)->toJson();
        return $vehicle;
    }

    public function update($id) {
        $user = User::getUserFromToken();
        $vehicle = Input::all();
        $rules = array(
            'plate' => array('required', 'unique:vehicles', 'regex:/^[A-Za-z][A-Za-z][A-Za-z][0-9][0-9]([A-Za-z]|[0-9])/'),
            'color' => array('required'),
            'brand' => array('required'),
            'model' => array('required'),
            'capacity' => array('required', 'integer'),
            'type' => array('required', 'integer')
        );
        $messages = array(
            'required' => 'The :attribute field is required',
            'plate.unique:vehicles' => 'The plate is already register.',
            'plate.regex' => 'Your plate must be like de example: XXX000 or XXX00X'
        );
        $validate = Validator::make($vehicle, $rules, $messages);
        if ($validate->passes()) {
            $vehicle2 = Vehicle::find($vehicle['id']);
            $vehicle2->plate = $vehicle['plate'];
            $vehicle2->color = $vehicle['color'];
            $vehicle2->brand = $vehicle['brand'];
            $vehicle2->model = $vehicle['model'];
            $vehicle2->capacity = $vehicle['capacity'];
            $vehicle2->type = $vehicle['type'];
            $vehicle2->save();
            return json_encode($vehicle);
        } else {
            return $validate->messages();
        }
    }

    public function destroy() {
        $datos = Input::all();
        $vehicle = Vehicle::find($datos['id']);
        $vehicle->status = 0;
        $vehicle->save();
        return Redirect::intended('/vehiclelist');
    }

}
