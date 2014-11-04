<?php

use Carbon\Carbon;

class ChanceController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $chances = Chance::where('date', '>=', new DateTime('today'))->get(); //->toJson();
//        return $chances;
        return View::make('chances.chanceslist', compact('chances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $vehicles = Vehicle::where('users_id', '=', Auth::user()->id)->get();
        if ($vehicles->count() > 0) {
            return View::make('chances.create', compact('vehicles'));
        } else {
            return View::make('vehicles.create')->withErrors('You must add a vehicle to create a Chance');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $chance = Input::all();
        $rules = array(
            'fee' => 'required',
            'date' => 'required',
            'hour' => 'required',
            'destination' => 'required',
            'departure' => 'required',
            'capacity' => 'required|integer',
            'comments' => 'required',
            'route' => 'required|integer|min:1|max:4', // 1. Avenida 2. Mamonal 3. Bosque 4. Otros
            'vehicles_id' => 'required|integer'
        );

        $messages = array(
            'required' => 'The :attribute is required.',
            'integer' => 'The :attribute must be a integer'
        );
        $validate = Validator::make($chance, $rules, $messages);
        if ($validate->passes()) {
            $chance['users_id'] = Auth::user()->id;
            Chance::create($chance);
            return json_encode(array('message' => 'Chance created.'));
        }else{
            return $validate->messages();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $chance = Chance::find($id);
        return View::make('chances.showchance', compact('chance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
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
