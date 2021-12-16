<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Models\User;
use App\Models\Types;
use App\Models\Collections;
use App\Models\UsersReported;
use App\Models\Stock;
use App\Models\Images;
use App\Models\ImagesReported;
use App\Models\Notifications;
use App\Models\Followers;
use App\Models\Downloads;
use App\Models\Like;
use App\Models\Replies;
use App\Models\Comments;
use App\Models\CollectionsImages;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminUserTypeController extends Controller {

	

    protected function validator(array $data, $id = null) {

    	Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

			return Validator::make($data, [
	        	'type_name'     => 'required|max:255|unique:types,types_id,'.$id,
	        ]);

    }

	 /**
   * Display a listing of the resource.
   *
   * @return Response
   */
	 public function index() {

		$query = request()->get('q');

		if( $query != '' && strlen( $query ) > 2 ) {
		 	$data = Types::where('type_name', 'LIKE', '%'.$query.'%')
		 	->orderBy('types_id','desc')->paginate(20);
		 } else {
		 	$data = Types::orderBy('types_id','desc')->paginate(20);
		 }

    	return view('admin.member_types', ['data' => $data,'query' => $query]);
     }
     

     /** 
     * Show the form for creating a new resource. 
     * @return \Illuminate\Http\Response 
       
    */  
    public function create()  
    {  
            
        return view('admin.add-member_types');
        
    }  

    /** 
     * Store a newly created resource in storage. 
     * 
     * @param  \Illuminate\Http\Request   $request 
     * @return \Illuminate\Http\Response 
     */  
    public function store(Request $request)  
    {  

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'type_name'        => 'required|unique:types'
        );

		$this->validate($request, $rules);

		// dd($request);

		$sql              = New Types();
		$sql->type_name        = trim($request->type_name);
		$sql->mode       = $request->mode;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_member_type'));

    	return redirect('panel/admin/member_types');
        
    } 

	/**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
	public function edit($id) {

		$data = Types::findOrFail($id);

    	return view('admin.edit-member_types')->withData($data);

	}//<--- End Method

	/**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
	public function update($id, Request $request) {

		$type  = Types::find( $request->id );

	    if( !isset($type) ) {
			return redirect('panel/admin/member_types');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'type_name'        => 'required'
	     );

		$this->validate($request, $rules);

		// UPDATE Member Types
		$type->type_name        = $request->type_name;
		$type->mode        = $request->mode;
		$type->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/member_types');

	}//<--- End Method

	/**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */

	public function destroy($id){

	 $type = Types::findOrFail($id);

	 $type->delete();

      return redirect('panel/admin/member_types');

	}//<--- End Method

	


}
