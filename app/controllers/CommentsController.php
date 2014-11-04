<?php

class CommentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /comments
	 *
	 * @return Response
	 */
	public function index()
	{
            return Comment::all()->toJson();
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /comments/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /comments
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$rules = array(
			'users_id' => 'required',
			'chances_id' => 'required',
			'text' => 'required|max:140'
		);
		$messages = array(
			'required' => 'The :attribute is required',
			'max' => 'The :attribute max length must be 140'
		);
		$validate = Validator::make($date, $rules, $messages);
		if($validate->passes()){
            $data['users_id'] = Auth::user()->id;
            Comment::create($data);
            return json_encode(array('message' => 'Commented!'));
        }
	}

	/*
	$table->integer('chances_id')->unsigned();
            $table->foreign('chances_id')->references('id')->on('chances');
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');
            $table->string('text','140');
    */

	/**
	 * Display the specified resource.
	 * GET /comments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /comments/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /comments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /comments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}