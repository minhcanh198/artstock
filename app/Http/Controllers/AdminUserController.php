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

class AdminUserController extends Controller {

	use Traits\userTraits;

	 protected function validator(array $data, $id = null) {

    	Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

			return Validator::make($data, [
	        	'email'     => 'required|email|max:255|unique:users,id,'.$id,
	        ]);

    }

	 /**
   * Display a listing of the resource.
   *
   * @return Response
   */
	 public function index() {

		$query = request()->get('q');

		$types = Types::where('mode','=','on')->get();

		if( $query != '' && strlen( $query ) > 2 ) {
		 	$data = User::where('name', 'LIKE', '%'.$query.'%')
			->orWhere('username', 'LIKE', '%'.$query.'%')
		 	->orderBy('id','desc')->paginate(20);
		 } else {
			 $data = User::orderBy('id','desc')->paginate(20);

		 }

    	return view('admin.members', ['data' => $data,'query' => $query, 'types' => $types]);
	 }

	/**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
	public function edit($id) {

		$types = Types::where('mode','=','on')->get();
		$data = User::findOrFail($id);

		if( $data->id == 1 || $data->id == Auth::user()->id ) {
			\Session::flash('info_message', trans('admin.user_no_edit'));
			return redirect('panel/admin/members');
		}
    	return view('admin.edit-member', compact('data', 'types'));

	}//<--- End Method

	/**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
	public function update($id, Request $request) {

		$user = User::findOrFail($id);

		$input = $request->all();

	   	$validator = $this->validator($input, $id);

		 if ($validator->fails()) {
	      return redirect()->back()
						 ->withErrors($validator)
						 ->withInput();
					 }

				 if( $request->status == 'suspended' ) {
					 $this->userSuspended($id);
				 }

    $user->fill($input)->save();

    \Session::flash('success_message', trans('admin.success_update'));

    return redirect('panel/admin/members');

	}//<--- End Method


	/**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */

	public function destroy($id){

	 $user = User::findOrFail($id);

	 if( $user->id == 1 || $user->id == Auth::user()->id ) {
	 	return redirect('panel/admin/members');
		exit;
	 }

	 $this->deleteUser($id);

      return redirect('panel/admin/members');

	}//<--- End Method

	public function userSuspended($id) {

		// Collections
	$collections = Collections::where('user_id', '=', $id)->get();

	if( isset( $collections ) ){
		foreach($collections as $collection){

			// Collections
		$collectionsImages = CollectionsImages::where('images_id', '=', $collection->id)->get();
		 if( isset( $collectionsImages ) ){
				foreach($collectionsImages as $collectionsImage){
					$collectionsImage->delete();
				}
			}
   $collection->delete();
		}
	}

	// Comments Delete
	$comments = Comments::where('user_id', '=', $id)->get();

	if( isset( $comments ) ){
		foreach($comments as $comment){
			$comment->delete();
		}
	}

	// Replies
	$replies = Replies::where('user_id', '=', $id)->get();

	if( isset( $replies ) ){
		foreach($replies as $replie){
			$replies->delete();
		}
	}

	// Likes
	$likes = Like::where('user_id', '=', $id)->get();
	if( isset( $likes ) ){
		foreach($likes as $like){
			$like->delete();
		}
	}

	// Downloads
	$downloads = Downloads::where('user_id', '=', $id)->get();
	if( isset( $downloads ) ){
		foreach($downloads as $download){
			$download->delete();
		}
	}

	// Followers
	$followers = Followers::where( 'follower', $id )->orwhere('following',$id)->get();
	if( isset( $followers ) ){
		foreach($followers as $follower){
			$follower->delete();
		}
	}

	// Delete Notification
	$notifications = Notifications::where('author',$id)
	->orWhere('destination', $id)
	->get();

	if(  isset( $notifications ) ){
		foreach($notifications as $notification){
			$notification->delete();
		}
	}

	// Images Reported
	$images_reporteds = ImagesReported::where('user_id', '=', $id)->get();

	if(  isset( $images_reporteds ) ){
		foreach ($images_reporteds as $images_reported ) {
				$images_reported->delete();
			}// End
	}

	// Images
    $images = Images::where('user_id', '=', $id)->get();

	if(isset( $images )) {
		foreach($images as $image) {

			// Collections Images
		$collectionsImagesUsers = CollectionsImages::where('images_id', '=', $image->id)->get();
		 if( isset( $collectionsImagesUsers ) ) {
				foreach($collectionsImagesUsers as $collectionsImagesUser){
					$collectionsImagesUser->delete();
				}
			}

			//<---- ALL RESOLUTIONS IMAGES
			$stocks = Stock::where('images_id', '=', $image->id)->get();

			foreach($stocks as $stock){

				$stock_path = 'public/uploads/'.$stock->type.'/'.$stock->name;

				// Delete Stock
				if ( \File::exists($stock_path) ) {
					\File::delete($stock_path);
				}//<--- IF FILE EXISTS

				$stock->delete();
			}

			$preview_image = 'public/uploads/preview/'.$image->preview;
			$thumbnail     = 'public/uploads/thumbnail/'.$image->thumbnail;

			// Delete preview
			if ( \File::exists($preview_image) ) {
				\File::delete($preview_image);
			}//<--- IF FILE EXISTS

			// Delete thumbnail
			if ( \File::exists($thumbnail) ) {
				\File::delete($thumbnail);
			}//<--- IF FILE EXISTS

			$image->delete();
		}
	}// End

	// User Reported
	$users_reporteds = UsersReported::where('user_id', '=', $id)->orWhere('id_reported', '=', $id)->get();

	if(  isset( $users_reporteds ) ){
		foreach ($users_reporteds as $users_reported ) {
				$users_reported->delete();
			}// End
	}

	}


}
