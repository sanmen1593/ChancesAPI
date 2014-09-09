<?php

class VehicleController extends \BaseController {

    public function index() {
        $vehicle = Vehicle::where('users_id', '=', Auth::user()->id)->get()->toJson();
        return $vehicle;
    }

    public function create() {
        return View::make('vehicles.create');
    }

    public function store() {
        $vehicle = Input::all();
        $vehicle['users_id'] = Auth::user()->id;
        $vehicle['status'] = true;
        Vehicle::create($vehicle);
        return json_encode($vehicle);
    }

    public function show($id) {
        $vehicle = Vehicle::find($id)->toJson();
        return $vehicle;
    }

    public function edit($id) {
        $vehicle = Vehicle::find($id)->toJson();
        return $vehicle;
    }

    public function update($id) {
        $vehicle = Input::all();
        $vehicle2 = Vehicle::find($vehicle['id']);
        $vehicle2->plate = $vehicle['plate'];
        $vehicle2->color = $vehicle['color'];
        $vehicle2->brand = $vehicle['brand'];
        $vehicle2->model = $vehicle['model'];
        $vehicle2->capacity = $vehicle['capacity'];
        $vehicle2->type = $vehicle['type'];
        $vehicle2->save();
        return json_encode($vehicle);
    }

    public function destroy() {
        $datos = Input::all();
        $vehicle = Vehicle::find($datos['id']);
        $vehicle->status = 0;
        $vehicle->save();
        return Redirect::intended('/vehiclelist');
    }

}
