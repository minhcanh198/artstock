<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AdminSettings;
use App\Models\HomePageSettings;
use App\Models\AboutPageSettings;
use App\Models\LicensePageSettings;
use App\Models\FaqPageSettings;
use App\Models\Booking;
use App\Models\BookingCalendar;
use App\Models\ImprintPageSettings;
use App\Models\PrivacyPolicyPageSettings;
use App\Models\DestinationPageSettings;
use App\Models\SuggestCityPageSettings;
use App\Models\TermsPageSettings;
use App\Models\Notifications;
use App\Models\Categories;
use App\Models\FaqCategories;
use App\Models\Faq;
use App\Models\Continents;
use App\Models\NewCountries;
use App\Models\Country;
use App\Models\State;
use App\Models\Routes;
use App\Models\RequestSuggestCountryCity;
use App\Models\UsersReported;
use App\Models\ImagesReported;
use App\Models\Images;
use App\Models\Stock;
use App\Models\CollectionsImages;
use App\Helper;
use App\Models\Cities;
use App\Models\PhotoshootType;
use App\Models\TimeDay;
use App\Models\TripReason;
use App\Models\Package;
use App\Models\PreferredStylePhoto;
use App\Models\LevelOfDirection;
use App\Models\PaymentGateways;
use App\Models\Types;

use App\Models\MusicType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;
use Image;

use App\Models\Purchases;
use App\Models\Deposits;
use App\Models\Withdrawals;
use Mail;
use File;

class AdminController extends Controller {

	public function __construct(AdminSettings $settings) {
		$this->settings = $settings::first();
	}
	// START
	public function admin() {

		return view('admin.dashboard');

	}//<--- END METHOD

	// START
	public function faq() {

		$data      = Faq::get();

		return view('admin.faq')->withData($data);

	}//<--- END METHOD

	public function addFaq() {

		$data      = FaqCategories::get();
		return view('admin.add-faq')->withData($data);

	}//<--- END METHOD

	public function storeFaq(Request $request) {



		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'question'        => 'required',
			'answer'        => 'required',
			'faq_category' => 'required',
        );

		$this->validate($request, $rules);

		$sql              = New Faq();
		$sql->faq_question        = trim($request->question);
		$sql->faq_answer        = trim($request->answer);
		$sql->faq_category_id = trim($request->faq_category);
		
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_category'));

    	return redirect('panel/admin/faq');

	}//<--- END METHOD

	public function editFaq($id) {

		$faq        = Faq::find( $id );
		$data      = FaqCategories::get();

		// return view('admin.edit-faq')->with('faq',$faq);
		return view('admin.edit-faq', compact('faq', 'data'));
	

	}//<--- END METHOD

	public function updateFaq( Request $request ) {


		$faq  = Faq::find( $request->id );
		

	    if( !isset($faq) ) {
			return redirect('panel/admin/faq');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'question'        => 'required',
			'answer'        => 'required',
			'faq_category' => 'required',
	     );

		$this->validate($request, $rules);

		

		// UPDATE CATEGORY
		$faq->faq_question        = $request->question;
		$faq->faq_answer        = $request->answer;
		$faq->faq_category_id = $request->faq_category;
		$faq->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/faq');

	}//<--- END METHOD

	public function deleteFaq($id){

		$faq        = Faq::find( $id );
		

		if( !isset($faq) || $faq->id == 1 ) {
			return redirect('panel/admin/faq');
		} else {

			// Delete Category
			$faq->delete();

			return redirect('panel/admin/faq');
		}
	}//<--- END METHOD

	// START
	public function faqCategories() {

		$data      = FaqCategories::orderBy('name')->get();

		return view('admin.faq_categories')->withData($data);

	}//<--- END METHOD

	public function addFaqCategories() {

		$data      = FaqCategories::orderBy('name')->get();
		return view('admin.add-faq-categories')->withData($data);

	}//<--- END METHOD

	public function storeFaqCategories(Request $request) {

		$temp            = 'public/temp/'; // Temp
	  $path            = 'public/img-faq-category/'; // Path General

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'name'        => 'required',
	        'slug'        => 'required|ascii_only|unique:categories',
	        'thumbnail'   => 'mimes:jpg,gif,png,jpe,jpeg|dimensions:min_width=457,min_height=359',
        );

		$this->validate($request, $rules);

		if( $request->hasFile('thumbnail') )	{

		$extension              = $request->file('thumbnail')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('thumbnail')->getMimeType();
		$sizeFile                 = $request->file('thumbnail')->getSize();
		$thumbnail              = $request->slug.'-'.str_random(32).'.'.$extension;

		if( $request->file('thumbnail')->move($temp, $thumbnail) ) {

			$image = Image::make($temp.$thumbnail);

			if(  $image->width() == 457 && $image->height() == 359 ) {

					\File::copy($temp.$thumbnail, $path.$thumbnail);
					\File::delete($temp.$thumbnail);

			} else {
				$image->fit(457, 359)->save($temp.$thumbnail);

				\File::copy($temp.$thumbnail, $path.$thumbnail);
				\File::delete($temp.$thumbnail);
			}

			}// End File
		} // HasFile

		else {
			$thumbnail = '';
		}

		$sql              = New FaqCategories();
		$sql->name        = trim($request->name);
		$sql->slug        = strtolower($request->slug);
		$sql->thumbnail = $thumbnail;
		$sql->mode        = $request->mode;
		if($request->parent_id == "yes"){
			$sql->parent_id 	= $request->parent_category;
		}else{

			$sql->parent_id 	= '0';
		}
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_category'));

    	return redirect('panel/admin/faq-categories');

	}//<--- END METHOD

	public function editFaqCategories($id) {

		$categories        = FaqCategories::find( $id );
		$data      = FaqCategories::orderBy('name')->get();

		// return view('admin.edit-faq-categories')->with('categories',$categories);
		return view('admin.edit-faq-categories',compact('categories','data'));

	}//<--- END METHOD

	public function updateFaqCategories( Request $request ) {


		$categories  = FaqCategories::find( $request->id );
		$temp            = 'public/temp/'; // Temp
	    $path            = 'public/img-faq-category/'; // Path General

	    if( !isset($categories) ) {
			return redirect('panel/admin/faq-categories');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'name'        => 'required',
	        'slug'        => 'required|ascii_only|unique:categories,slug,'.$request->id,
	        'thumbnail'   => 'mimes:jpg,gif,png,jpe,jpeg|dimensions:min_width=457,min_height=359',
	     );

		$this->validate($request, $rules);

		if( $request->hasFile('thumbnail') )	{

		$extension              = $request->file('thumbnail')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('thumbnail')->getMimeType();
		$sizeFile                 = $request->file('thumbnail')->getSize();
		$thumbnail              = $request->slug.'-'.str_random(32).'.'.$extension;

		if( $request->file('thumbnail')->move($temp, $thumbnail) ) {

			$image = Image::make($temp.$thumbnail);

			if(  $image->width() == 457 && $image->height() == 359 ) {

					\File::copy($temp.$thumbnail, $path.$thumbnail);
					\File::delete($temp.$thumbnail);

			} else {
				$image->fit(457, 359)->save($temp.$thumbnail);

				\File::copy($temp.$thumbnail, $path.$thumbnail);
				\File::delete($temp.$thumbnail);
			}

			// Delete Old Image
			\File::delete($path.$categories->thumbnail);

			}// End File
		} // HasFile
		else {
			$thumbnail = $categories->image;
		}

		// UPDATE CATEGORY
		$categories->name        = $request->name;
		$categories->slug        = strtolower($request->slug);
		$categories->thumbnail  = $thumbnail;
		$categories->mode        = $request->mode;
		if($request->parent_id == "yes"){
			$categories->parent_id 	= $request->parent_category;
		}else{

			$categories->parent_id 	= '0';
		}
		$categories->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/faq-categories');

	}//<--- END METHOD

	public function deleteFaqCategories($id){

		$categories        = FaqCategories::find( $id );
		$thumbnail          = 'public/img-faq-category/'.$categories->thumbnail; // Path General

		if( !isset($categories) || $categories->id == 1 ) {
			return redirect('panel/admin/faq-categories');
		} else {

			$images_category   = Images::where('categories_id',$id)->get();

			// Delete Category
			$categories->delete();

			// Delete Thumbnail
			if ( \File::exists($thumbnail) ) {
				\File::delete($thumbnail);
			}//<--- IF FILE EXISTS

			//Update Categories Images
			if( isset( $images_category ) ) {
				foreach ($images_category as $key ) {
					$key->categories_id = 1;
					$key->save();
				}
			}

			return redirect('panel/admin/faq-categories');
		}
	}//<--- END METHOD


	// START
	public function continent() {

		$data      = Continents::get();

		return view('admin.continents')->withData($data);

	}//<--- END METHOD

	public function addContinent() {

		return view('admin.add-continents');

	}//<--- END METHOD

	public function storeContinent(Request $request) {



		Validator::extend('ascii_only', function($attribute, $value, $parameters){
			return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
			'continent_name'        => 'required',
		);

		$this->validate($request, $rules);

		$sql              = New Continents();
		$sql->continent_name        = trim($request->continent_name);		
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_continent'));

		return redirect('panel/admin/destinations/continents');

	}//<--- END METHOD

	public function editContinent($id) {

		$continent        = Continents::find( $id );
		// dd($continent->country());
		return view('admin.edit-continents', compact('continent'));
	

	}//<--- END METHOD

	public function updateContinent( Request $request ) {


		$continent  = Continents::find( $request->id );
		

		if( !isset($continent) ) {
			return redirect('panel/admin/destinations/continents');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
			return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
			'continent_name'        => 'required',
			);

		$this->validate($request, $rules);

	
		// UPDATE CATEGORY
		$continent->continent_name        = $request->continent_name;
		$continent->is_active = $request->continent_status;
		$continent->save();

		\Session::flash('success_message', trans('misc.success_update'));

		return redirect('panel/admin/destinations/continents');

	}//<--- END METHOD

	public function deleteContinent($id){

		$continent        = Continents::find( $id );
		

		if( !isset($continent) || $continent->id == 1 ) {
			return redirect('panel/admin/destinations/continents');
		} else {

			// Delete Category
			$continent->delete();

			return redirect('panel/admin/destinations/continents');
		}
	}//<--- END METHOD

	// START
	public function country() {

// 		$data      = Country::select('country.*','continents.continent_name')->join('continents', 'continents.id','=','country.continent_id')->get();
		$data      = \DB::table('new_countries')->select('new_countries.*')->get();

		// dd($data);

		return view('admin.country')->withData($data);

	}//<--- END METHOD


	public function addCountry() {

		$continentsData = Continents::get();

		return view('admin.add-country', compact('continentsData'));

	}//<--- END METHOD

	public function storeCountry(Request $request) {



		Validator::extend('ascii_only', function($attribute, $value, $parameters){
			return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
			'country_name'        => 'required',
			'continent_id'        => 'required',
		);

		$this->validate($request, $rules);

// 		$sql              = New Country();
		$sql              = New NewCountries();
// 		$sql->country_name        = trim($request->country_name);		
		$sql->name        = trim($request->country_name);		
		$sql->continent_id        = trim($request->continent_id);		
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_country'));

		return redirect('panel/admin/destinations/countries');

	}//<--- END METHOD

	public function editCountry($id) {

// 		$country        = Country::find( $id );
		$country        = NewCountries::find( $id );
		// dd($country->continents());
		$continentsData = Continents::get();
		return view('admin.edit-country', compact('country', 'continentsData'));
	

	}//<--- END METHOD

	public function updateCountry( Request $request ) {


// 		$country  = Country::find( $request->id );
		$country  = NewCountries::find( $request->id );
		

		if( !isset($country) ) {
			return redirect('panel/admin/destinations/countries');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
			return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
			'country_name'        => 'required',
			'continent_id'        => 'required',
		);

		$this->validate($request, $rules);

	
		// UPDATE CATEGORY
// 		$country->country_name        = $request->country_name;
		$country->name        = $request->country_name;
		$country->continent_id        = $request->continent_id;
		$country->is_active			  = $request->country_status;
		$country->save();

		\Session::flash('success_message', trans('misc.success_update'));

		return redirect('panel/admin/destinations/countries');

	}//<--- END METHOD

	public function deleteCountry($id){

// 		$country        = Country::find( $id );
		$country        = NewCountries::find( $id );
		

		if( !isset($country) || $country->id == 1 ) {
			return redirect('panel/admin/destinations/countries');
		} else {

			// Delete Category
			$country->delete();

			return redirect('panel/admin/destinations/countries');
		}
	}//<--- END METHOD

	// START
	public function state() {

		$data      = State::select('state.*','country.country_name')->join('country', 'country.id','=','state.country_id')->get();

		// dd($data);

		return view('admin.state')->withData($data);

	}//<--- END METHOD


	public function addState() {

		$countryData = Country::get();

		return view('admin.add-state', compact('countryData'));

	}//<--- END METHOD

	public function storeState(Request $request) {



		Validator::extend('ascii_only', function($attribute, $value, $parameters){
			return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
			'state_name'        => 'required',
			'country_id'        => 'required',
		);

		$this->validate($request, $rules);

		$sql              = New State();
		$sql->state_name        = trim($request->state_name);		
		$sql->country_id        = trim($request->country_id);		
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_state'));

		return redirect('panel/admin/destinations/states');

	}//<--- END METHOD

	public function editState($id) {

		$state        = State::find( $id );
		// dd($country->continents());
		$countryData = Country::get();
		return view('admin.edit-state', compact('state', 'countryData'));
	

	}//<--- END METHOD

	public function updateState( Request $request ) {


		$state  = State::find( $request->id );
		

		if( !isset($state) ) {
			return redirect('panel/admin/destinations/states');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
			return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
			'state_name'        => 'required',
			'country_id'        => 'required',
		);

		$this->validate($request, $rules);

	
		// UPDATE CATEGORY
		$state->state_name        = $request->state_name;
		$state->country_id        = $request->country_id;
		$state->is_active			  = $request->state_status;
		$state->save();

		\Session::flash('success_message', trans('misc.success_update'));

		return redirect('panel/admin/destinations/states');

	}//<--- END METHOD

	public function deleteState($id){

		$state        = State::find( $id );
		

		if( !isset($state) || $state->id == 1 ) {
			return redirect('panel/admin/destinations/states');
		} else {

			// Delete Category
			$state->delete();

			return redirect('panel/admin/destinations/states');
		}
	}//<--- END METHOD

	public function getCountryByContinentId($continentId)
	{
		$getCountries = Country::where('continent_id','=', $continentId)->get();

		echo json_encode($getCountries);
	}

	public function getStateByCountryId($countryId)
	{
		$getStates = State::where('country_id','=', $countryId)->get();

		echo json_encode($getStates);
	}
	
	public function getCityByStateId($stateId)
	{
		$getCities = Cities::where('state_id','=', $stateId)->get();

		echo json_encode($getCities);
	}

	// START
	public function cities() {

		// $data      = Cities::select('cities.*','country.country_name','state.state_name')->join('country','country.id','=','cities.country_id')->join('state', 'state.id','=', 'cities.state_id')->get();
		$data      = Cities::select('cities.*','country.country_name')->join('country','country.id','=','cities.country_id')->get();
		

		return view('admin.city')->withData($data);

	}//<--- END METHOD

	public function addCities() {

		$continentData = Continents::get();
		$countryData = Country::get();
		$stateData = State::get();

		return view('admin.add-city', compact('continentData','countryData','stateData'));

	}//<--- END METHOD

	public static function slugify($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, '-');

		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);

		// lowercase
		$text = strtolower($text);

		if (empty($text)) {
			return 'n-a';
		}

		return $text;
	}

	public function storeCities(Request $request) {

	  $temp            = 'public/temp/'; // Temp
	  $path            = 'public/img-city/'; // Path General

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'city_name'        => 'required',
	        'continent_id'        => 'required',
	        'country_id'        => 'required',
			// 'state_id'        => 'required',
			'city_description'        => 'required',
        );

		$this->validate($request, $rules);

		//======= City Image
		if( $request->hasFile('city_img') )	{
			$city_name = $request->city_name;
			$cityImageName = str_replace(' ', '', $city_name);
			$extension = $request->file('city_img')->getClientOriginalExtension();
			$file      = $cityImageName.'.'.$extension;

			if($request->file('city_img')->move($temp, $file) ) {
				\File::copy($temp.$file, $path.$file);
				\File::delete($temp.$file);
			}// End File
		} // HasFile

		$slug = $this->slugify($request->city_name);

		$sql              	= New Cities();
		$sql->city_name   	= trim($request->city_name);
		$sql->city_slug 			= $slug;
		$sql->continent_id  = $request->continent_id;
		$sql->country_id  	= $request->country_id;
		// $sql->state_id    = $request->state_id;
		$sql->description 	= $request->city_description;
		if($request->hasFile('city_img')){
		$sql->city_img    	= $file;
		}
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_city'));

    	return redirect('panel/admin/destinations/cities');

	}//<--- END METHOD

	public function editCities($id) {

		$cities        = Cities::find( $id );
		$country       = Country::get();
		$continent       = Continents::get();
		$state       = State::get();

		return view('admin.edit-cities',compact('cities','continent','country','state'));

	}//<--- END METHOD

	public function updateCities( Request $request ) {


		$cities  = Cities::find( $request->id );
		// dd($cities);
		$temp            = 'public/temp/'; // Temp
	    $path            = 'public/img-city/'; // Path General

	    if( !isset($cities) ) {
			return redirect('panel/admin/destinations/cities');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'city_name'        => 'required',
	        'continent_id'        => 'required',
	        'country_id'        => 'required',
	        // 'state_id'        => 'required',
	        'city_description'        => 'required',
	        // 'thumbnail'   => 'mimes:jpg,gif,png,jpe,jpeg|dimensions:min_width=457,min_height=359',
	     );

		$this->validate($request, $rules);

		//======= City Image
		if( $request->hasFile('city_img') )	{
			$city_name = $request->city_name;
			$cityImageName = str_replace(' ', '', $city_name);
			$extension = $request->file('city_img')->getClientOriginalExtension();
			$file      = $cityImageName.'.'.$extension;

			if($request->file('city_img')->move($temp, $file) ) {
				\File::copy($temp.$file, $path.$file);
				\File::delete($temp.$file);
			}// End File
		} // HasFile

		$slug = $this->slugify($request->city_name);

		// UPDATE CATEGORY
		$cities->city_name   = $request->city_name;
		$cities->city_slug 			= $slug;
		$cities->continent_id  = $request->continent_id;
		$cities->country_id  = $request->country_id;
		// $cities->state_id    = $request->state_id;
		$cities->description = $request->city_description;
		if($request->hasFile('city_img')){

			$cities->city_img    = $file;
		}
		$cities->is_active   = $request->city_status;
		$cities->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/destinations/cities');

	}//<--- END METHOD

	public function deleteCities($id){

		$cities        = Cities::find( $id );
		$thumbnail          = 'public/img-city/'.$cities->city_img; // Path General

		// if( !isset($cities) || $cities->id == 1 ) {
		if(!isset($cities)) {
			return redirect('panel/admin/destinations/cities');
		} else {

			// Delete Category
			$cities->delete();

			// Delete City Image
			if ( \File::exists($thumbnail) ) {
				\File::delete($thumbnail);
			}

			return redirect('panel/admin/destinations/cities');
		}
	}//<--- END METHOD

	// START
	public function routes() {

		$data      = Routes::select('routes.*','country.country_name','state.state_name','cities.city_name')->join('country','country.id','=','routes.country_id')->join('state', 'state.id','=', 'routes.state_id')->join('cities', 'cities.id','=', 'routes.city_id')->get();
		// $data      = State::select('state.*','country.country_name')->join('country', 'country.id','=','state.country_id')->get();
		

		return view('admin.route')->withData($data);

	}//<--- END METHOD

	public function addRoutes() {

		$countryData = Country::get();
		$stateData = State::get();
		$cityData = Cities::get();

		return view('admin.add-route', compact('countryData','stateData', 'cityData'));

	}//<--- END METHOD

	public function storeRoutes(Request $request) {

	  $temp            = 'public/temp/'; // Temp
	  $path            = 'public/img-route/'; // Path General

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'route_name'        => 'required',
	        'country_id'        => 'required',
	        'state_id'        => 'required',
			'city_id'        => 'required',
			'route_description'        => 'required',
        );

		$this->validate($request, $rules);

		//======= City Image
		if( $request->hasFile('route_img') )	{
			$route_name = $request->route_name;
			$routeImageName = str_replace(' ', '', $route_name);
			$extension = $request->file('route_img')->getClientOriginalExtension();
			$file      = $routeImageName.'.'.$extension;

			if($request->file('route_img')->move($temp, $file) ) {
				\File::copy($temp.$file, $path.$file);
				\File::delete($temp.$file);
			}// End File
		} // HasFile

		$slug = $this->slugify($request->route_name);

		$sql              	= New Routes();
		$sql->route_name   	= trim($request->route_name);
		$sql->route_slug	= $slug;
		$sql->route_tagline	= $request->route_tagline;
		$sql->country_id  	= $request->country_id;
		$sql->state_id    	= $request->state_id;
		$sql->city_id    	= $request->city_id;
		$sql->description 	= $request->route_description;
		if($request->hasFile('route_img')){
			$sql->route_img    = $file;
		}
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_route'));

    	return redirect('panel/admin/destinations/routes');

	}//<--- END METHOD

	public function editRoutes($id) {

		$routes        = Routes::find( $id );
		$country       = Country::get();
		$state       = State::get();
		$city       = Cities::get();

		return view('admin.edit-route',compact('routes','country','state','city'));

	}//<--- END METHOD

	public function updateRoutes( Request $request ) {


		$routes  = Routes::find( $request->id );
		// dd($cities);
		$temp            = 'public/temp/'; // Temp
	    $path            = 'public/img-route/'; // Path General

	    if( !isset($routes) ) {
			return redirect('panel/admin/destinations/routes');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'route_name'        => 'required',
	        'country_id'        => 'required',
	        'state_id'        => 'required',
	        'city_id'        => 'required',
	        'route_description'        => 'required',
	        // 'thumbnail'   => 'mimes:jpg,gif,png,jpe,jpeg|dimensions:min_width=457,min_height=359',
	     );

		$this->validate($request, $rules);

		//======= City Image
		if( $request->hasFile('route_img') )	{
			$route_name = $request->route_name;
			$routeImageName = str_replace(' ', '', $route_name);
			$extension = $request->file('route_img')->getClientOriginalExtension();
			$file      = $routeImageName.'.'.$extension;

			if($request->file('route_img')->move($temp, $file) ) {
				\File::copy($temp.$file, $path.$file);
				\File::delete($temp.$file);
			}// End File
		} // HasFile

		$slug = $this->slugify($request->route_name);

		// UPDATE CATEGORY
		$routes->route_name   = $request->route_name;
		$routes->route_slug   = $slug;
		$routes->route_tagline   = $request->route_tagline;
		$routes->country_id  = $request->country_id;
		$routes->state_id    = $request->state_id;
		$routes->city_id    = $request->city_id;
		$routes->description = $request->route_description;
		if($request->hasFile('route_img')){

			$routes->route_img    = $file;
		}
		$routes->is_active   = $request->route_status;
		$routes->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/destinations/routes');

	}//<--- END METHOD

	public function deleteRoutes($id){

		$routes        = Routes::find( $id );
		$thumbnail          = 'public/img-route/'.$routes->route_img; // Path General

		// if( !isset($cities) || $cities->id == 1 ) {
		if(!isset($routes)) {
			return redirect('panel/admin/destinations/routes');
		} else {

			// Delete Category
			$routes->delete();

			// Delete City Image
			if ( \File::exists($thumbnail) ) {
				\File::delete($thumbnail);
			}

			return redirect('panel/admin/destinations/routes');
		}
	}//<--- END METHOD


	// START
	public function categories() {

		$data      = Categories::where('parent_id','=', '0')->orderBy('name')->get();

		return view('admin.categories')->withData($data);

	}//<--- END METHOD

	public function addCategories() {

		$typeData  = Types::orderBy('type_name')->get();

		return view('admin.add-categories', compact('typeData'));

	}//<--- END METHOD

	public function storeCategories(Request $request) {

		$temp            = 'public/temp/'; // Temp
	  $path            = 'public/img-category/'; // Path General

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'name'        => 'required',
	        'slug'        => 'required|ascii_only|unique:categories',
	        'thumbnail'   => 'mimes:jpg,gif,png,jpe,jpeg|dimensions:min_width=457,min_height=359',
        );

		$this->validate($request, $rules);

		if( $request->hasFile('thumbnail') )	{

		$extension              = $request->file('thumbnail')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('thumbnail')->getMimeType();
		$sizeFile                 = $request->file('thumbnail')->getSize();
		$thumbnail              = $request->slug.'-'.str_random(32).'.'.$extension;

		if( $request->file('thumbnail')->move($temp, $thumbnail) ) {

			$image = Image::make($temp.$thumbnail);

			if(  $image->width() == 457 && $image->height() == 359 ) {

					\File::copy($temp.$thumbnail, $path.$thumbnail);
					\File::delete($temp.$thumbnail);

			} else {
				$image->fit(457, 359)->save($temp.$thumbnail);

				\File::copy($temp.$thumbnail, $path.$thumbnail);
				\File::delete($temp.$thumbnail);
			}

			}// End File
		} // HasFile

		else {
			$thumbnail = '';
		}

		$sql              = New Categories();
		$sql->name        = trim($request->name);
		$sql->icon_text   = $request->icon_text;
		$sql->slug        = strtolower($request->slug);
		$sql->thumbnail	  = $thumbnail;
		$sql->mode        = $request->mode;
		$sql->link_with   = $request->link_with;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_category'));

    	return redirect('panel/admin/categories');

	}//<--- END METHOD

	public function editCategories($id) {

		$categories        = Categories::find( $id );

		$typeData  = Types::orderBy('type_name')->get();

		return view('admin.edit-categories', compact('categories', 'typeData'));

	}//<--- END METHOD

	public function updateCategories( Request $request ) {


		$categories  = Categories::find( $request->id );
		$temp            = 'public/temp/'; // Temp
	    $path            = 'public/img-category/'; // Path General

	    if( !isset($categories) ) {
			return redirect('panel/admin/categories');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'name'        => 'required',
	        'slug'        => 'required|ascii_only|unique:categories,slug,'.$request->id,
	        'thumbnail'   => 'mimes:jpg,gif,png,jpe,jpeg|dimensions:min_width=457,min_height=359',
	     );

		$this->validate($request, $rules);

		if( $request->hasFile('thumbnail') )	{

		$extension              = $request->file('thumbnail')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('thumbnail')->getMimeType();
		$sizeFile                 = $request->file('thumbnail')->getSize();
		$thumbnail              = $request->slug.'-'.str_random(32).'.'.$extension;

		if( $request->file('thumbnail')->move($temp, $thumbnail) ) {

			$image = Image::make($temp.$thumbnail);

			if(  $image->width() == 457 && $image->height() == 359 ) {

					\File::copy($temp.$thumbnail, $path.$thumbnail);
					\File::delete($temp.$thumbnail);

			} else {
				$image->fit(457, 359)->save($temp.$thumbnail);

				\File::copy($temp.$thumbnail, $path.$thumbnail);
				\File::delete($temp.$thumbnail);
			}

			// Delete Old Image
			\File::delete($path.$categories->thumbnail);

			}// End File
		} // HasFile
		else {
			$thumbnail = $categories->image;
		}

		// UPDATE CATEGORY
		$categories->name        = $request->name;
		$categories->icon_text   = $request->icon_text;
		$categories->slug        = strtolower($request->slug);
		$categories->thumbnail   = $thumbnail;
		$categories->mode        = $request->mode;
		$categories->link_with   = $request->link_with;
		$categories->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/categories');

	}//<--- END METHOD

	public function deleteCategories($id){

		$categories        = Categories::find( $id );
		$thumbnail          = 'public/img-category/'.$categories->thumbnail; // Path General

		if( !isset($categories) || $categories->id == 1 ) {
			return redirect('panel/admin/categories');
		} else {

			$images_category   = Images::where('categories_id',$id)->get();

			// Delete Category
			$categories->delete();

			// Delete Thumbnail
			if ( \File::exists($thumbnail) ) {
				\File::delete($thumbnail);
			}//<--- IF FILE EXISTS

			//Update Categories Images
			if( isset( $images_category ) ) {
				foreach ($images_category as $key ) {
					$key->categories_id = 1;
					$key->save();
				}
			}

			return redirect('panel/admin/categories');
		}
	}//<--- END METHOD

	// START
	public function subCategories() {

		$data      = Categories::where('parent_id','!=', '0')->orderBy('name')->get();

		return view('admin.sub-categories')->withData($data);

	}//<--- END METHOD

	public function addSubCategories() {

		$parentData = Categories::where('parent_id','=', '0')->orderBy('name')->get();

		return view('admin.add-sub-categories', compact('parentData'));

	}//<--- END METHOD

	public function storeSubCategories(Request $request) {

		$temp            = 'public/temp/'; // Temp
	  	$path            = 'public/img-sub-category/'; // Path General

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'name'        => 'required',
	        'slug'        => 'required|ascii_only|unique:categories',
	        'thumbnail'   => 'mimes:jpg,gif,png,jpe,jpeg|dimensions:min_width=457,min_height=359',
        );

		$this->validate($request, $rules);

		if( $request->hasFile('thumbnail') )	{

		$extension              = $request->file('thumbnail')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('thumbnail')->getMimeType();
		$sizeFile                 = $request->file('thumbnail')->getSize();
		$thumbnail              = $request->slug.'-'.str_random(32).'.'.$extension;

		if( $request->file('thumbnail')->move($temp, $thumbnail) ) {

			$image = Image::make($temp.$thumbnail);

			if(  $image->width() == 457 && $image->height() == 359 ) {

					\File::copy($temp.$thumbnail, $path.$thumbnail);
					\File::delete($temp.$thumbnail);

			} else {
				$image->fit(457, 359)->save($temp.$thumbnail);

				\File::copy($temp.$thumbnail, $path.$thumbnail);
				\File::delete($temp.$thumbnail);
			}

			}// End File
		} // HasFile

		else {
			$thumbnail = '';
		}

		$sql              = New Categories();
		$sql->name        = trim($request->name);
		$sql->slug        = strtolower($request->slug);
		$sql->thumbnail	  = $thumbnail;
		$sql->mode        = $request->mode;
		$sql->link_with   = $request->link_with;
		$sql->parent_id   = $request->parent_cate;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_category'));

    	return redirect('panel/admin/sub-categories');

	}//<--- END METHOD

	public function editSubCategories($id) {

		$subCategories        = Categories::find( $id );
		$parentData = Categories::where('parent_id','=', '0')->orderBy('name')->get();

		return view('admin.edit-sub-categories', compact('subCategories', 'parentData'));

	}//<--- END METHOD

	public function updateSubCategories( Request $request ) {


		$subCategories  = Categories::find( $request->id );
		$temp            = 'public/temp/'; // Temp
	    $path            = 'public/img-sub-category/'; // Path General

	    if( !isset($subCategories) ) {
			return redirect('panel/admin/sub-categories');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'name'        => 'required',
	        'slug'        => 'required|ascii_only|unique:categories,slug,'.$request->id,
	        'thumbnail'   => 'mimes:jpg,gif,png,jpe,jpeg|dimensions:min_width=457,min_height=359',
	     );

		$this->validate($request, $rules);

		if( $request->hasFile('thumbnail') )	{

		$extension              = $request->file('thumbnail')->getClientOriginalExtension();
		$type_mime_shot   = $request->file('thumbnail')->getMimeType();
		$sizeFile                 = $request->file('thumbnail')->getSize();
		$thumbnail              = $request->slug.'-'.str_random(32).'.'.$extension;

		if( $request->file('thumbnail')->move($temp, $thumbnail) ) {

			$image = Image::make($temp.$thumbnail);

			if(  $image->width() == 457 && $image->height() == 359 ) {

					\File::copy($temp.$thumbnail, $path.$thumbnail);
					\File::delete($temp.$thumbnail);

			} else {
				$image->fit(457, 359)->save($temp.$thumbnail);

				\File::copy($temp.$thumbnail, $path.$thumbnail);
				\File::delete($temp.$thumbnail);
			}

			// Delete Old Image
			\File::delete($path.$subCategories->thumbnail);

			}// End File
		} // HasFile
		else {
			$thumbnail = $subCategories->image;
		}

		// UPDATE CATEGORY
		$subCategories->name        = $request->name;
		$subCategories->slug        = strtolower($request->slug);
		$subCategories->thumbnail   = $thumbnail;
		$subCategories->mode        = $request->mode;
		$subCategories->link_with   = $request->link_with;
		$subCategories->parent_id   = $request->parent_cate;
		$subCategories->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/sub-categories');

	}//<--- END METHOD

	public function deleteSubCategories($id){

		$subCategories        = Categories::find( $id );
		$thumbnail          = 'public/img-sub-category/'.$subCategories->thumbnail; // Path General

		if( !isset($subCategories) || $subCategories->id == 1 ) {
			return redirect('panel/admin/subCategories');
		} else {

			$images_sub_category   = Images::where('categories_id',$id)->get();

			// Delete Category
			$subCategories->delete();

			// Delete Thumbnail
			if ( \File::exists($thumbnail) ) {
				\File::delete($thumbnail);
			}//<--- IF FILE EXISTS

			//Update Categories Images
			if( isset( $images_sub_category ) ) {
				foreach ($images_sub_category as $key ) {
					$key->categories_id = 1;
					$key->save();
				}
			}

			return redirect('panel/admin/sub-categories');
		}
	}//<--- END METHOD

	public function settings() {

		return view('admin.settings');

	}//<--- END METHOD

	public function saveSettings(Request $request) {

		Validator::extend('sell_option_validate', function($attribute, $value, $parameters) {
			// Count images for sale
			$imagesForSale = Images::where('item_for_sale', 'sale')->where('status', 'active')->count();

			if($value == 'off' && $imagesForSale > 0) {
				return false;
			}

			return true;

		});

		$messages = [
			'sell_option.sell_option_validate' => trans('misc.sell_option_validate')
		];

		$rules = array(
          'title'            => 'required',
	        'welcome_text' 	   => 'required',
	        'welcome_subtitle' => 'required',
	        'keywords'         => 'required',
	        'description'      => 'required',
	        'email_no_reply'   => 'required',
	        'email_admin'      => 'required',
					'link_terms'      => 'required|url',
					'link_privacy'      => 'required|url',
					'link_license'      => 'url',
					'sell_option' => 'sell_option_validate'
        );

		$this->validate($request, $rules, $messages);



		$sql                      = AdminSettings::first();
		$sql->title               = $request->title;
		$sql->welcome_text        = $request->welcome_text;
		$sql->welcome_subtitle    = $request->welcome_subtitle;
		$sql->keywords            = $request->keywords;
		$sql->description         = $request->description;
		$sql->email_no_reply      = $request->email_no_reply;
		$sql->email_admin         = $request->email_admin;
		$sql->link_terms         = $request->link_terms;
		$sql->link_privacy         = $request->link_privacy;
		$sql->link_license         = $request->link_license;
		$sql->captcha             = $request->captcha;
		$sql->registration_active = $request->registration_active;
		$sql->email_verification  = $request->email_verification;
		$sql->facebook_login  = $request->facebook_login;
		$sql->twitter_login = $request->twitter_login;
		$sql->google_ads_index    = $request->google_ads_index;
		$sql->sell_option    = $request->sell_option;
		$sql->show_images_index    = $request->show_images_index;
		$sql->show_watermark    = $request->show_watermark;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_update'));

    	return redirect('panel/admin/settings');

	}//<--- END METHOD

	public function settingsLimits() {

		return view('admin.limits');

	}//<--- END METHOD

	public function saveSettingsLimits(Request $request) {


		$sql                      = AdminSettings::first();
		$sql->result_request      = $request->result_request;
		$sql->limit_upload_user   = $request->limit_upload_user;
		$sql->message_length      = $request->message_length;
		$sql->comment_length      = $request->comment_length;
		$sql->file_size_allowed   = $request->file_size_allowed;
		$sql->auto_approve_images = $request->auto_approve_images;
		$sql->downloads           = $request->downloads;
		$sql->tags_limit          = $request->tags_limit;
		$sql->description_length  = $request->description_length;
		$sql->min_width_height_image = $request->min_width_height_image;
		$sql->file_size_allowed_vector   = $request->file_size_allowed_vector;

		$sql->save();

		\Session::flash('success_message', trans('admin.success_update'));

    	return redirect('panel/admin/settings/limits');

	}//<--- END METHOD

	public function members_reported() {

		$data = UsersReported::orderBy('id','DESC')->get();

		return view('admin.members_reported')->withData($data);

	}//<--- END METHOD

	public function delete_members_reported(Request $request) {

		$report = UsersReported::find($request->id);

		if( isset( $report ) ) {
			$report->delete();
		}

		return redirect('panel/admin/members-reported');

	}//<--- END METHOD

	public function images_reported() {

		$data = ImagesReported::orderBy('id','DESC')->get();

		//dd($data);

		return view('admin.images_reported')->withData($data);

	}//<--- END METHOD

	public function delete_images_reported(Request $request) {

		$report = ImagesReported::find($request->id);

		if( isset( $report ) ) {
			$report->delete();
		}

		return redirect('panel/admin/images-reported');

	}//<--- END METHOD

	public function videos() {

		$query = request()->get('q');
		$sort = request()->get('sort');
		$pagination = 15;

		$data = Images::where('is_type','=','video')->orderBy('id','desc')->paginate($pagination);

		// Search
		if( isset( $query ) ) {
		 	$data = Images::where('title', 'LIKE', '%'.$query.'%')
			->orWhere('tags', 'LIKE', '%'.$query.'%')
			->where('is_type','=','video')
		 	->orderBy('id','desc')->paginate($pagination);
		 }

		// Sort
		if( isset( $sort ) && $sort == 'title' ) {
			$data = Images::where('is_type','=','video')->orderBy('title','asc')->paginate($pagination);
		}

		if( isset( $sort ) && $sort == 'pending' ) {
			$data = Images::where('is_type','=','video')->where('status','pending')->paginate($pagination);
		}

		if( isset( $sort ) && $sort == 'downloads' ) {
			$data = Images::join('downloads', 'images.id', '=', 'downloads.images_id')
					->where('is_type','=','video')
					->groupBy('downloads.images_id')
					->orderBy( \DB::raw('COUNT(downloads.images_id)'), 'desc' )
					->select('images.*')
					->paginate( $pagination );
		}

		if( isset( $sort ) && $sort == 'likes' ) {
			$data = Images::join('likes', function($join){
				$join->on('likes.images_id', '=', 'images.id')->where('likes.status', '=', '1' );
			})
					->where('is_type','=','video')
					->groupBy('likes.images_id')
					->orderBy( \DB::raw('COUNT(likes.images_id)'), 'desc' )
					->select('images.*')
					->paginate( $pagination );
		}

		return view('admin.videos', ['data' => $data,'query' => $query, 'sort' => $sort ]);
	}//<--- End Method

	public function delete_video(Request $request) {

		//<<<<---------------------------------------------

		$image = Images::find($request->id);

		// Delete Notification
		$notifications = Notifications::where('destination',$request->id)
			->where('type', '2')
			->orWhere('destination',$request->id)
			->where('type', '3')
			->orWhere('destination',$request->id)
			->where('type', '6')
			->get();

		if(  isset( $notifications ) ){
			foreach($notifications as $notification){
				$notification->delete();
			}
		}

		// Collections Images
	$collectionsImages = CollectionsImages::where('images_id', '=', $request->id)->get();
	 if( isset( $collectionsImages ) ){
			foreach($collectionsImages as $collectionsImage){
				$collectionsImage->delete();
			}
		}

		// Images Reported
		$imagesReporteds = ImagesReported::where('image_id', '=', $request->id)->get();
		 if( isset( $imagesReporteds ) ){
				foreach($imagesReporteds as $imagesReported){
					$imagesReported->delete();
				}
			}

		//<---- ALL RESOLUTIONS IMAGES
		$stocks = Stock::where('images_id', '=', $request->id)->get();

		foreach($stocks as $stock){

			$stock_path = 'public/uploads/'.$stock->type.'/'.$stock->name;
			$stock_pathVector = 'public/uploads/files/'.$stock->name;

			// Delete Stock
			if ( \File::exists($stock_path) ) {
				\File::delete($stock_path);
			}//<--- IF FILE EXISTS

			// Delete Stock Vector
			if ( \File::exists($stock_pathVector) ) {
				\File::delete($stock_pathVector);
			}//<--- IF FILE EXISTS

			$stock->delete();

		}//<--- End foreach

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

		return redirect('panel/admin/videos');

	}//<--- End Method

	public function edit_video($id) {

		$data = Images::findOrFail($id);

		return view('admin.edit-video', ['data' => $data ]);

	}//<--- End Method

	public function update_video(Request $request) {

		$sql = Images::find($request->id);

		 $rules = array(
            'title'       => 'required|min:3|max:50',
            'description' => 'min:2|max:'.$this->settings->description_length.'',
	        'tags'        => 'required',

        );

		if( $request->featured == 'yes' && $sql->featured == 'no' ) {
			$featuredDate = \Carbon\Carbon::now();
		} elseif( $request->featured == 'yes' && $sql->featured == 'yes' ) {
			$featuredDate = $sql->featured_date;
		} else {
			$featuredDate = '';
		}

		$this->validate($request, $rules);

	    $sql->title         = $request->title;
		$sql->description   = $request->description;
		$sql->tags          = $request->tags;
		$sql->categories_id = $request->categories_id;
		$sql->status        = $request->status;
		$sql->featured      = $request->featured;
		$sql->featured_date = $featuredDate;


		$sql->save();

	    \Session::flash('success_message', trans('admin.success_update'));

	    return redirect('panel/admin/videos');
	}//<--- End Method

	public function images() {

		$query = request()->get('q');
		$sort = request()->get('sort');
		$pagination = 15;

		$data = Images::orderBy('id','desc')->paginate($pagination);

		// Search
		if( isset( $query ) ) {
		 	$data = Images::where('title', 'LIKE', '%'.$query.'%')
			->orWhere('tags', 'LIKE', '%'.$query.'%')
		 	->orderBy('id','desc')->paginate($pagination);
		 }

		// Sort
		if( isset( $sort ) && $sort == 'title' ) {
			$data = Images::orderBy('title','asc')->paginate($pagination);
		}

		if( isset( $sort ) && $sort == 'pending' ) {
			$data = Images::where('status','pending')->paginate($pagination);
		}

		if( isset( $sort ) && $sort == 'downloads' ) {
			$data = Images::join('downloads', 'images.id', '=', 'downloads.images_id')
					->groupBy('downloads.images_id')
					->orderBy( \DB::raw('COUNT(downloads.images_id)'), 'desc' )
					->select('images.*')
					->paginate( $pagination );
		}

		if( isset( $sort ) && $sort == 'likes' ) {
			$data = Images::join('likes', function($join){
				$join->on('likes.images_id', '=', 'images.id')->where('likes.status', '=', '1' );
			})
					->groupBy('likes.images_id')
					->orderBy( \DB::raw('COUNT(likes.images_id)'), 'desc' )
					->select('images.*')
					->paginate( $pagination );
		}

		return view('admin.images', ['data' => $data,'query' => $query, 'sort' => $sort ]);
	}//<--- End Method

	public function delete_image(Request $request) {

		//<<<<---------------------------------------------

		$image = Images::find($request->id);

		// Delete Notification
		$notifications = Notifications::where('destination',$request->id)
			->where('type', '2')
			->orWhere('destination',$request->id)
			->where('type', '3')
			->orWhere('destination',$request->id)
			->where('type', '6')
			->get();

		if(  isset( $notifications ) ){
			foreach($notifications as $notification){
				$notification->delete();
			}
		}

		// Collections Images
		$collectionsImages = CollectionsImages::where('images_id', '=', $request->id)->get();
		if( isset( $collectionsImages ) ){
			foreach($collectionsImages as $collectionsImage){
				$collectionsImage->delete();
			}
		}

		// Images Reported
		$imagesReporteds = ImagesReported::where('image_id', '=', $request->id)->get();
		 if( isset( $imagesReporteds ) ){
				foreach($imagesReporteds as $imagesReported){
					$imagesReported->delete();
				}
			}

		//<---- ALL RESOLUTIONS IMAGES
		$stocks = Stock::where('images_id', '=', $request->id)->get();

		foreach($stocks as $stock){

			$stock_path = 'public/uploads/'.$stock->type.'/'.$stock->name;
			$stock_pathVector = 'public/uploads/files/'.$stock->name;

			// Delete Stock
			if ( \File::exists($stock_path) ) {
				\File::delete($stock_path);
			}//<--- IF FILE EXISTS

			// Delete Stock Vector
			if ( \File::exists($stock_pathVector) ) {
				\File::delete($stock_pathVector);
			}//<--- IF FILE EXISTS

			$stock->delete();

		}//<--- End foreach

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

		return redirect('panel/admin/images');

	}//<--- End Method

	public function edit_image($id) {

		$data = Images::findOrFail($id);

		return view('admin.edit-image', ['data' => $data ]);

	}//<--- End Method

	public function update_image(Request $request) {

		$sql = Images::find($request->id);

		 $rules = array(
            'title'       => 'required|min:3|max:50',
            'description' => 'min:2|max:'.$this->settings->description_length.'',
	        'tags'        => 'required',

        );

		if( $request->featured == 'yes' && $sql->featured == 'no' ) {
			$featuredDate = \Carbon\Carbon::now();
		} elseif( $request->featured == 'yes' && $sql->featured == 'yes' ) {
			$featuredDate = $sql->featured_date;
		} else {
			$featuredDate = '';
		}

		$this->validate($request, $rules);

	    $sql->title         = $request->title;
		$sql->description   = $request->description;
		$sql->tags          = $request->tags;
		$sql->categories_id = $request->categories_id;
		$sql->status        = $request->status;
		$sql->featured      = $request->featured;
		$sql->featured_date = $featuredDate;


		$sql->save();

	    \Session::flash('success_message', trans('admin.success_update'));

	    return redirect('panel/admin/images');
	}//<--- End Method

	public function profiles_social(){
		return view('admin.profiles-social');
	}//<--- End Method

	public function update_profiles_social(Request $request) {

		$sql = AdminSettings::find(1);

		$rules = array(
            'twitter'    => 'url',
            'facebook'   => 'url',
            'linkedin'   => 'url',
			'instagram'  => 'url',
			'pinterest'  => 'url',
			'youtube'  => 'url',

		);
		

		$this->validate($request, $rules);

	    $sql->twitter       = $request->twitter;
			$sql->facebook      = $request->facebook;
			$sql->linkedin      = $request->linkedin;
			$sql->instagram     = $request->instagram;
			$sql->instagram     = $request->instagram;
			$sql->pinterest     = $request->pinterest;
			$sql->youtube     = $request->youtube;

		$sql->save();

	    \Session::flash('success_message', trans('admin.success_update'));

	    return redirect('panel/admin/profiles-social');
	}//<--- End Method

	public function google()
	{
		return view('admin.google');
	}//<--- END METHOD

	public function update_google(Request $request)
	{
		$sql = AdminSettings::first();

			$sql->google_adsense_index   = $request->google_adsense_index;
	    $sql->google_adsense   = $request->google_adsense;
		  $sql->google_analytics = $request->google_analytics;

		$sql->save();

	    \Session::flash('success_message', trans('admin.success_update'));

	    return redirect('panel/admin/google');
	}//<--- End Method

	//<-- Start Method Booking Calendar
	public function bookingCalendar()
	{
		$calendarPageSettings = BookingCalendar::first();
		return view('admin.booking_calendar',compact('calendarPageSettings'));
	}//<-- End Method Booking Calendar

	//<-- Start Method Booking Calendar Store
	public function bookingCalendarStore(Request $request)
	{

		$query = BookingCalendar::first();
		$query->calendar_question = $request->calendar_question;
		$query->calendar_paragraph = $request->calendar_paragraph;
		$query->calendar_important_note = $request->calendar_important_note;
		$query->calendar_last_minute_header = $request->calendar_last_minute_header;
		$query->calendar_last_minute_content = $request->calendar_last_minute_content;
		$query->save();

		\Session::flash('success_message', trans('admin.success_update'));

		return redirect('panel/admin/booking-calendar');

	}//<--- End Method Booking Calendar Store

	public function theme()
	{
		return view('admin.theme');

	}//<--- End method

	public function themeStore(Request $request) {

		$temp  = 'public/temp/'; // Temp
	  $path  = 'public/img/'; // Path

		$rules = array(
          'logo'   => 'mimes:png,svg',
					'favicon'   => 'mimes:png',
					'index_image_top'   => 'mimes:jpg,jpeg',
					'index_image_bottom'   => 'mimes:jpg,jpeg',
        );

		$this->validate($request, $rules);

		//======= LOGO
		if( $request->hasFile('logo') )	{

			$extension = $request->file('logo')->getClientOriginalExtension();
			$file      = 'logo.'.$extension;

			if($request->file('logo')->move($temp, $file) ) {
				\File::copy($temp.$file, $path.$file);
				\File::delete($temp.$file);
			}// End File
		} // HasFile

		//======== FAVICON
		if($request->hasFile('favicon') )	{

			$extension  = $request->file('favicon')->getClientOriginalExtension();
			$file       = 'favicon.'.$extension;

			if( $request->file('favicon')->move($temp, $file) ) {
				\File::copy($temp.$file, $path.$file);
				\File::delete($temp.$file);
				}// End File
		} // HasFile

		//======= FOOTER LOGO
		if( $request->hasFile('footer_logo') )	{

			$extension = $request->file('footer_logo')->getClientOriginalExtension();
			$file      = 'footer_logo.'.$extension;

			if($request->file('footer_logo')->move($temp, $file) ) {
				\File::copy($temp.$file, $path.$file);
				\File::delete($temp.$file);
			}// End File
		} // HasFile

		//======== index_image_top
		// if($request->hasFile('index_image_top') )	{

		// 	$extension  = $request->file('index_image_top')->getClientOriginalExtension();
		// 	$file       = 'header_index.'.$extension;

		// 	if( $request->file('index_image_top')->move($temp, $file) ) {
		// 		\File::copy($temp.$file, $path.$file);
		// 		\File::delete($temp.$file);
		// 	}// End File
		// } // HasFile

		//======== index_image_bottom
		// if($request->hasFile('index_image_bottom') )	{

		// 	$extension  = $request->file('index_image_bottom')->getClientOriginalExtension();
		// 	$file       = 'cover.'.$extension;

		// 	if( $request->file('index_image_bottom')->move($temp, $file) ) {
		// 		\File::copy($temp.$file, $path.$file);
		// 		\File::delete($temp.$file);
		// 	}// End File
		// } // HasFile


		\Artisan::call('cache:clear');

		return redirect('panel/admin/theme')
			 ->with('success_message', trans('misc.success_update'));

	}//<--- End method

	public function payments(){
		return view('admin.payments-settings');
	}//<--- End Method

	public function savePayments(Request $request) {

		$sql = AdminSettings::first();

		$rules = [
						'currency_code' => 'required|alpha',
						'currency_symbol' => 'required',
        ];

		$this->validate($request, $rules);

		$sql->currency_symbol  = $request->currency_symbol;
		$sql->currency_code    = strtoupper($request->currency_code);
		$sql->currency_position    = $request->currency_position;
		$sql->min_sale_amount   = $request->min_sale_amount;
		$sql->max_sale_amount   = $request->max_sale_amount;
		$sql->min_deposits_amount   = $request->min_deposits_amount;
		$sql->max_deposits_amount   = $request->max_deposits_amount;
		$sql->fee_commission        = $request->fee_commission;
		$sql->amount_min_withdrawal    = $request->amount_min_withdrawal;
		$sql->decimal_format = $request->decimal_format;

		$sql->save();

	    \Session::flash('success_message', trans('admin.success_update'));

	    return redirect('panel/admin/payments');
	}//<--- End Method

	public function purchases(){

		$data = Purchases::orderBy('id', 'desc')->paginate(30);

		return view('admin.purchases')->withData($data);
	}//<--- End Method

	public function deposits(){

		$data = Deposits::orderBy('id', 'desc')->paginate(30);

		return view('admin.deposits')->withData($data);
	}//<--- End Method

	public function withdrawals(){

		$data = Withdrawals::orderBy('id','DESC')->paginate(50);
		return view('admin.withdrawals', ['data' => $data, 'settings' => $this->settings]);
	}//<--- End Method

	public function withdrawalsView($id){
		$data = Withdrawals::findOrFail($id);
		return view('admin.withdrawal-view', ['data' => $data, 'settings' => $this->settings]);
	}//<--- End Method

	public function withdrawalsPaid(Request $request)
	{

		$data = Withdrawals::findOrFail($request->id);

		// Set Withdrawal as Paid
		$data->status    = 'paid';
		$data->date_paid = \Carbon\Carbon::now();
		$data->save();

		$user = $data->user();

		// Set Balance a zero
		$user->balance = 0;
		$user->save();

		//<------ Send Email to User ---------->>>
		$amount       = Helper::amountFormatDecimal($data->amount).' '.$this->settings->currency_code;
		$sender       = $this->settings->email_no_reply;
	  $titleSite    = $this->settings->title;
		$fullNameUser = $user->name ? $user->name : $user->username;
		$_emailUser   = $user->email;

		Mail::send('emails.withdrawal-processed', array(
					'amount'     => $amount,
					'fullname'   => $fullNameUser
		),
			function($message) use ( $sender, $fullNameUser, $titleSite, $_emailUser)
				{
				    $message->from($sender, $titleSite)
									  ->to($_emailUser, $fullNameUser)
										->subject( trans('misc.withdrawal_processed').' - '.$titleSite );
				});
			//<------ Send Email to User ---------->>>

		return redirect('panel/admin/withdrawals');

	}//<--- End Method

	public function paymentsGateways($id) {

		$data = PaymentGateways::findOrFail($id);
		$name = ucfirst($data->name);

		return view('admin.'.str_slug($name).'-settings')->withData($data);
	}//<--- End Method

	public function savePaymentsGateways($id, Request $request) {

		$data = PaymentGateways::findOrFail($id);

		$input = $request->all();

		$this->validate($request, [
            'email'    => 'email',
        ]);

		$data->fill($input)->save();

		\Session::flash('success_message', trans('admin.success_update'));

    return back();
	}//<--- End Method

	// Cms SITE CONTENT
	public function homePageSettings() {

		$homePageSettings = HomePageSettings::first();
		// dd($homePageSettings);

		return view('admin.home-page',compact('homePageSettings'));

	}//<--- END METHOD

	public function saveHomePageSettings(Request $request){
		$postData = $request->all();
		// dd($postData);

		//Header
		$headerHeading = $postData['header_heading'];
		$headerDescription = $postData['header_description'];
		
		//Section1
		$section1Heading = $postData['section1_heading'];
		$section1Description = $postData['section1_description'];
		$section1ButtonText = $postData['section1_button_text'];
		$section1ButtonLink = $postData['section1_button_link'];

		//Section1
		$section2Heading = $postData['section2_heading'];
		$section2Description = $postData['section2_description'];
		$section2ButtonText = $postData['section2_button_text'];
		$section2ButtonLink = $postData['section2_button_link'];

		//Section3
		$section3Heading = $postData['section3_heading'];
		$section3Description = $postData['section3_description'];
		$section3ButtonText = $postData['section3_button_text'];
		$section3ButtonLink = $postData['section3_button_link'];

		//Section4
		$section4Heading = $postData['section4_heading'];
		$section4Description = $postData['section4_description'];
		$section4ButtonText = $postData['section4_button_text'];
		$section4ButtonLink = $postData['section4_button_link'];

		// //Footer1
		// $footer1Heading = $postData['footer1_heading'];
		// $footer1Description = $postData['footer1_description'];
		// $footer1ButtonText = $postData['footer1_button_text'];
		// $footer1ButtonLink = $postData['footer1_button_link'];

		// //Footer2
		// $footer2Heading = $postData['footer2_heading'];
		// $footer2Description = $postData['footer2_description'];
		// $footer2ButtonText = $postData['footer2_button_text'];
		// $footer2ButtonLink = $postData['footer2_button_link'];

		$homePageSettings = HomePageSettings::first();

		//Header Updating
		$homePageSettings->header_heading   = $headerHeading;
		$homePageSettings->header_description   = $headerDescription;
		
		//Header Main Image 
		if($request->hasFile('header_main_image')){	
			$headerMainImage = $postData['header_main_image'];
			$mainImageName = 'header_main_image_'.time().'.'.$headerMainImage->getClientOriginalExtension();
		
			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'home_page/header_assets/';
			$destinationPath = public_path($Path);
		
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $headerMainImage->move($destinationPath, $mainImageName);
				if($saveFile){
					$homePageSettings->header_main_image = $mainImageName;
				}
			}else{
				$saveFile = $headerMainImage->move($destinationPath, $mainImageName);
				if($saveFile){
					$homePageSettings->header_main_image = $mainImageName;
				}
			}
		}

		//Header Image
		// if($request->hasFile('header_image')){	
		// 	$headerImage = $postData['header_image'];
		// 	$imageName = 'header_image_'.time().'.'.$headerImage->getClientOriginalExtension();

		// 	// $destinationPath = url('/').'/public/home_page/header_assets/';
		// 	$Path = 'home_page/header_assets/';
		// 	$destinationPath = public_path($Path);
			
		// 	if (!file_exists($destinationPath)) {
		// 		// path does not exist
		// 		$saveFile = $headerImage->move($destinationPath, $imageName);
		// 		if($saveFile){
		// 			$homePageSettings->header_image = $imageName;
		// 		}
		// 	}else{
		// 		$saveFile = $headerImage->move($destinationPath, $imageName);
		// 		if($saveFile){
		// 			$homePageSettings->header_image = $imageName;
		// 		}
		// 	}
		// }

		//Section1 Updating
		$homePageSettings->section1_heading   = $section1Heading;
		$homePageSettings->section1_description   = $section1Description;
		$homePageSettings->section1_button_text   = $section1ButtonText;
		$homePageSettings->section1_button_link   = $section1ButtonLink;

		//Section1 Image
		if($request->hasFile('section1_image')){	
			$section1Image = $postData['section1_image'];
			$imageName = 'section1_image_'.time().'.'.$section1Image->getClientOriginalExtension();

			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'home_page/sections_assets/';
			$destinationPath = public_path($Path);
			
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $section1Image->move($destinationPath, $imageName);
				if($saveFile){
					$homePageSettings->section1_image = $imageName;
				}
			}else{
				$saveFile = $section1Image->move($destinationPath, $imageName);
				if($saveFile){
					$homePageSettings->section1_image = $imageName;
				}
			}
		}

		//Section2 Updating
		$homePageSettings->section2_heading   = $section2Heading;
		$homePageSettings->section2_description   = $section2Description;
		$homePageSettings->section2_button_text   = $section2ButtonText;
		$homePageSettings->section2_button_link   = $section2ButtonLink;

		//Section2 Image
		if($request->hasFile('section2_image')){	
			$section2Image = $postData['section2_image'];
			$imageName = 'section2_image_'.time().'.'.$section2Image->getClientOriginalExtension();

			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'home_page/sections_assets/';
			$destinationPath = public_path($Path);
			
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $section2Image->move($destinationPath, $imageName);
				if($saveFile){
					$homePageSettings->section2_image = $imageName;
				}
			}else{
				$saveFile = $section2Image->move($destinationPath, $imageName);
				if($saveFile){
					$homePageSettings->section2_image = $imageName;
				}
			}
		}

		//Section3 Updating
		$homePageSettings->section3_heading   = $section3Heading;
		$homePageSettings->section3_description   = $section3Description;
		$homePageSettings->section3_button_text   = $section3ButtonText;
		$homePageSettings->section3_button_link   = $section3ButtonLink;

		//Section3 Image
		if($request->hasFile('section3_image')){	
			$section3Image = $postData['section3_image'];
			$imageName = 'section3_image_'.time().'.'.$section3Image->getClientOriginalExtension();

			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'home_page/sections_assets/';
			$destinationPath = public_path($Path);
			
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $section3Image->move($destinationPath, $imageName);
				if($saveFile){
					$homePageSettings->section3_image = $imageName;
				}
			}else{
				$saveFile = $section3Image->move($destinationPath, $imageName);
				if($saveFile){
					$homePageSettings->section3_image = $imageName;
				}
			}
		}

		//Section4 Updating
		$homePageSettings->section4_heading   = $section4Heading;
		$homePageSettings->section4_description   = $section4Description;
		$homePageSettings->section4_button_text   = $section4ButtonText;
		$homePageSettings->section4_button_link   = $section4ButtonLink;

		//Section4 Image
		if($request->hasFile('section4_image')){	
			$section4Image = $postData['section4_image'];
			$imageName = 'section4_image_'.time().'.'.$section4Image->getClientOriginalExtension();

			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'home_page/sections_assets/';
			$destinationPath = public_path($Path);
			
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $section4Image->move($destinationPath, $imageName);
				if($saveFile){
					$homePageSettings->section4_image = $imageName;
				}
			}else{
				$saveFile = $section4Image->move($destinationPath, $imageName);
				if($saveFile){
					$homePageSettings->section4_image = $imageName;
				}
			}
		}


		// //Footer1 Updating
		// $homePageSettings->footer1_heading   = $footer1Heading;
		// $homePageSettings->footer1_description   = $footer1Description;
		// $homePageSettings->footer1_button_text   = $footer1ButtonText;
		// $homePageSettings->footer1_button_link   = $footer1ButtonLink;

		// //Footer1 Image
		// if($request->hasFile('footer1_image')){	
		// 	$footer1Image = $postData['footer1_image'];
		// 	$imageName = 'footer1_image_'.time().'.'.$footer1Image->getClientOriginalExtension();

		// 	// $destinationPath = url('/').'/public/home_page/header_assets/';
		// 	$Path = 'home_page/footer_assets/';
		// 	$destinationPath = public_path($Path);
			
		// 	if (!file_exists($destinationPath)) {
		// 		// path does not exist
		// 		$saveFile = $footer1Image->move($destinationPath, $imageName);
		// 		if($saveFile){
		// 			$homePageSettings->footer1_image = $imageName;
		// 		}
		// 	}else{
		// 		$saveFile = $footer1Image->move($destinationPath, $imageName);
		// 		if($saveFile){
		// 			$homePageSettings->footer1_image = $imageName;
		// 		}
		// 	}
		// }

		// //Footer2 Updating
		// $homePageSettings->footer2_heading   = $footer2Heading;
		// $homePageSettings->footer2_description   = $footer2Description;
		// $homePageSettings->footer2_button_text   = $footer2ButtonText;
		// $homePageSettings->footer2_button_link   = $footer2ButtonLink;

		// //Footer2 Image
		// if($request->hasFile('footer2_image')){	
		// 	$footer2Image = $postData['footer2_image'];
		// 	$imageName = 'footer2_image_'.time().'.'.$footer2Image->getClientOriginalExtension();

		// 	// $destinationPath = url('/').'/public/home_page/header_assets/';
		// 	$Path = 'home_page/footer_assets/';
		// 	$destinationPath = public_path($Path);
			
		// 	if (!file_exists($destinationPath)) {
		// 		// path does not exist
		// 		$saveFile = $footer2Image->move($destinationPath, $imageName);
		// 		if($saveFile){
		// 			$homePageSettings->footer2_image = $imageName;
		// 		}
		// 	}else{
		// 		$saveFile = $footer2Image->move($destinationPath, $imageName);
		// 		if($saveFile){
		// 			$homePageSettings->footer2_image = $imageName;
		// 		}
		// 	}
		// }
		

			
			

		$homePageSettings->save();

		\Session::flash('success_message', trans('admin.success_update'));

		return redirect('panel/admin/home-page-settings');
		

	}

	public function aboutPageSettings() {

		$aboutPageSettings = AboutPageSettings::first();
		// dd($homePageSettings);

		return view('admin.about-page',compact('aboutPageSettings'));

	}//<--- END METHOD

	public function saveAboutPageSettings(Request $request){
		$postData = $request->all();
		// dd($postData);

		//Header
		$headerHeading = $postData['header_heading'];
		$headerDescription = $postData['header_description'];
		$sectionHeader1 = $postData['section_header_1'];
		$sectionDescription1 = $postData['section_description_1'];
		$sectionHeader2 = $postData['section_header_2'];
		$sectionDescription2 = $postData['section_description_2'];
		$sectionHeader3 = $postData['section_header_3'];
		$sectionDescription3 = $postData['section_description_3'];
		$sectionHeader4 = $postData['section_header_4'];
		$sectionDescription4 = $postData['section_description_4'];
		$sectionHeader5 = $postData['section_header_5'];
		$sectionDescription5 = $postData['section_description_5'];
		
		// $aboutContent = $postData['content'];
	

		$aboutPageSettings = AboutPageSettings::first();

		//Header Updating
		$aboutPageSettings->header_heading   = $headerHeading;
		$aboutPageSettings->header_description   = $headerDescription;
		$aboutPageSettings->section_header_1   = $sectionHeader1;
		$aboutPageSettings->section_description_1   = $sectionDescription1;
		$aboutPageSettings->section_header_2   = $sectionHeader2;
		$aboutPageSettings->section_description_2   = $sectionDescription2;
		$aboutPageSettings->section_header_3   = $sectionHeader3;
		$aboutPageSettings->section_description_3   = $sectionDescription3;
		$aboutPageSettings->section_header_4   = $sectionHeader4;
		$aboutPageSettings->section_description_4   = $sectionDescription4;
		$aboutPageSettings->section_header_5   = $sectionHeader5;
		$aboutPageSettings->section_description_5   = $sectionDescription5;
		
		// $aboutPageSettings->content   = $aboutContent;
		
		//Header Main Image 
		if($request->hasFile('header_main_image')){	
			$headerMainImage = $postData['header_main_image'];
			$mainImageName = 'header_main_image_'.time().'.'.$headerMainImage->getClientOriginalExtension();
		
			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'about_page/header_assets/';
			$destinationPath = public_path($Path);
		
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $headerMainImage->move($destinationPath, $mainImageName);
				if($saveFile){
					$aboutPageSettings->header_main_image = $mainImageName;
				}
			}else{
				$saveFile = $headerMainImage->move($destinationPath, $mainImageName);
				if($saveFile){
					$aboutPageSettings->header_main_image = $mainImageName;
				}
			}
		}			
			

		$aboutPageSettings->save();

		\Session::flash('success_message', trans('admin.success_update'));

		return redirect('panel/admin/about-page-settings');
		

	}

	public function licensePageSettings() {

		$licensePageSettings = LicensePageSettings::first();
		// dd($licensePageSettings);

		return view('admin.license-page',compact('licensePageSettings'));

	}//<--- END METHOD

	public function saveLicensePageSettings(Request $request)
	{
		$postData = $request->all();
		//Header
		$headerHeading = $postData['header_heading'];
		$headerDescription = $postData['header_description'];
		$sectionHeader1 = $postData['section_1_heading'];
		$sectionDescription1 = $postData['section_1_description'];
		$sectionContent1 = $postData['section_1_content'];
		$sectionHeader2 = $postData['section_2_heading'];
		$sectionDescription2 = $postData['section_2_description'];
		$sectionContent2Header1 = $postData['section_2_content_1_header'];
		$sectionContent2Header2 = $postData['section_2_content_2_header'];
		$sectionContent2Header3 = $postData['section_2_content_3_header'];
		$sectionContent2Header4 = $postData['section_2_content_4_header'];
		$sectionContent2Description1 = $postData['section_2_content_1_description'];
		$sectionContent2Description2 = $postData['section_2_content_2_description'];
		$sectionContent2Description3 = $postData['section_2_content_3_description'];
		$sectionContent2Description4 = $postData['section_2_content_4_description'];
		$sectionHeader3 = $postData['section_3_heading'];
		$sectionDescription3 = $postData['section_3_description'];
		$sectionContent3 = $postData['section_3_content'];
		
		// $aboutContent = $postData['content'];
	
		// var_dump($sectionContent2Description1);
		// die;
		$licensePageSettings = LicensePageSettings::first();

		//Header Updating
		$licensePageSettings->header_heading   = $headerHeading;
		$licensePageSettings->header_description   = $headerDescription;
		$licensePageSettings->section_1_heading   = $sectionHeader1;
		$licensePageSettings->section_1_description   = $sectionDescription1;
		$licensePageSettings->section_1_content   = $sectionContent1;
		$licensePageSettings->section_2_heading  = $sectionHeader2;
		$licensePageSettings->section_2_description   = $sectionDescription2;
		$licensePageSettings->section_2_content_1_header   = $sectionContent2Header1;
		$licensePageSettings->section_2_content_2_header   = $sectionContent2Header2;
		$licensePageSettings->section_2_content_3_header   = $sectionContent2Header3;
		$licensePageSettings->section_2_content_4_header   = $sectionContent2Header4;
		$licensePageSettings->section_2_content_1_description   = $sectionContent2Description1;
		$licensePageSettings->section_2_content_2_description   = $sectionContent2Description2;
		$licensePageSettings->section_2_content_3_description   = $sectionContent2Description3;
		$licensePageSettings->section_2_content_4_description   = $sectionContent2Description4;
		$licensePageSettings->section_3_heading   = $sectionHeader3;
		$licensePageSettings->section_3_description   = $sectionDescription3;
		$licensePageSettings->section_3_content   = $sectionContent3;
		
		// $licensePageSettings->content   = $aboutContent;
		
		//Header Main Image 
		if($request->hasFile('header_main_image')){	
			$headerMainImage = $postData['header_main_image'];
			$mainImageName = 'header_main_image_'.time().'.'.$headerMainImage->getClientOriginalExtension();
		
			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'license_page/header_assets/';
			$destinationPath = public_path($Path);
		
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $headerMainImage->move($destinationPath, $mainImageName);
				if($saveFile){
					$licensePageSettings->header_main_image = $mainImageName;
				}
			}else{
				$saveFile = $headerMainImage->move($destinationPath, $mainImageName);
				if($saveFile){
					$licensePageSettings->header_main_image = $mainImageName;
				}
			}
		}		
		
		//Section_2_content_1_image
		if($request->hasFile('section_2_content_1_image')){	
			$Section2Content1Image = $postData['section_2_content_1_image'];
			$Section2Content1ImageName = 'section_2_content_1_image_'.time().'.'.$Section2Content1Image->getClientOriginalExtension();
		
			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'license_page/section_2_content/';
			$destinationPath = public_path($Path);
		
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $Section2Content1Image->move($destinationPath, $Section2Content1ImageName);
				if($saveFile){
					$licensePageSettings->section_2_content_1_image = $Section2Content1ImageName;
				}
			}else{
				$saveFile = $Section2Content1Image->move($destinationPath, $Section2Content1ImageName);
				if($saveFile){
					$licensePageSettings->section_2_content_1_image = $Section2Content1ImageName;
				}
			}
		}
		
		//Section_2_content_2_image
		if($request->hasFile('section_2_content_2_image')){	
			$Section2Content2Image = $postData['section_2_content_2_image'];
			$Section2Content2ImageName = 'section_2_content_2_image_'.time().'.'.$Section2Content2Image->getClientOriginalExtension();
		
			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'license_page/section_2_content/';
			$destinationPath = public_path($Path);
		
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $Section2Content2Image->move($destinationPath, $Section2Content2ImageName);
				if($saveFile){
					$licensePageSettings->section_2_content_2_image = $Section2Content2ImageName;
				}
			}else{
				$saveFile = $Section2Content2Image->move($destinationPath, $Section2Content2ImageName);
				if($saveFile){
					$licensePageSettings->section_2_content_2_image = $Section2Content2ImageName;
				}
			}
		}

		//Section_2_content_3_image
		if($request->hasFile('section_2_content_3_image')){	
			$Section2Content3Image = $postData['section_2_content_3_image'];
			$Section2Content3ImageName = 'section_2_content_3_image_'.time().'.'.$Section2Content3Image->getClientOriginalExtension();
		
			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'license_page/section_2_content/';
			$destinationPath = public_path($Path);
		
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $Section2Content3Image->move($destinationPath, $Section2Content3ImageName);
				if($saveFile){
					$licensePageSettings->section_2_content_3_image = $Section2Content3ImageName;
				}
			}else{
				$saveFile = $Section2Content3Image->move($destinationPath, $Section2Content3ImageName);
				if($saveFile){
					$licensePageSettings->section_2_content_3_image = $Section2Content3ImageName;
				}
			}
		}

		//Section_2_content_4_image
		if($request->hasFile('section_2_content_4_image')){	
			$Section2Content4Image = $postData['section_2_content_4_image'];
			$Section2Content4ImageName = 'section_2_content_4_image_'.time().'.'.$Section2Content4Image->getClientOriginalExtension();
		
			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'license_page/section_2_content/';
			$destinationPath = public_path($Path);
		
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $Section2Content4Image->move($destinationPath, $Section2Content4ImageName);
				if($saveFile){
					$licensePageSettings->section_2_content_4_image = $Section2Content4ImageName;
				}
			}else{
				$saveFile = $Section2Content4Image->move($destinationPath, $Section2Content4ImageName);
				if($saveFile){
					$licensePageSettings->section_2_content_4_image = $Section2Content4ImageName;
				}
			}
		}
			
		$licensePageSettings->save();

		\Session::flash('success_message', trans('admin.success_update'));

		return redirect('panel/admin/license-page-settings');
		

	}

	public function imprintPageSettings() {

		$imprintPageSettings = ImprintPageSettings::first();
		// dd($imprintPageSettings);

		return view('admin.imprint-page',compact('imprintPageSettings'));

	}//<--- END METHOD

	public function saveImprintPageSettings(Request $request)
	{
		$postData = $request->all();
		//Content
		$imprintContent = $postData['content'];
		
		$imprintPageSettings = ImprintPageSettings::first();

		//Content Updating
		$imprintPageSettings->content   = $imprintContent;
	
			
		$imprintPageSettings->save();

		\Session::flash('success_message', trans('admin.success_update'));

		return redirect('panel/admin/imprint-page-settings');
		

	}

	public function privacyPolicyPageSettings() {

		$privacyPolicyPageSettings = PrivacyPolicyPageSettings::first();
		// dd($imprintPageSettings);

		return view('admin.privacy-policy-page',compact('privacyPolicyPageSettings'));

	}//<--- END METHOD

	public function savePrivacyPolicyPageSettings(Request $request)
	{
		$postData = $request->all();
		//Content
		$privacyPolicyContent = $postData['content'];
		
		$privacyPolicyPageSettings = PrivacyPolicyPageSettings::first();

		//Content Updating
		$privacyPolicyPageSettings->content   = $privacyPolicyContent;
	
			
		$privacyPolicyPageSettings->save();

		\Session::flash('success_message', trans('admin.success_update'));

		return redirect('panel/admin/privacy-policy-page-settings');
		

	}

	public function termsPageSettings() {

		$termsPageSettings = TermsPageSettings::first();
		// dd($imprintPageSettings);

		return view('admin.terms-page',compact('termsPageSettings'));

	}//<--- END METHOD

	public function saveTermsPageSettings(Request $request)
	{
		$postData = $request->all();
		//Content
		$termsContent = $postData['content'];
		
		$termsPageSettings = TermsPageSettings::first();

		//Content Updating
		$termsPageSettings->content   = $termsContent;
	
			
		$termsPageSettings->save();

		\Session::flash('success_message', trans('admin.success_update'));

		return redirect('panel/admin/terms-page-settings');
		

	}

	public function destinationPageSettings() {

		$destinationPageSettings = DestinationPageSettings::first();
		// dd($destinationPageSettings);

		return view('admin.destination-page',compact('destinationPageSettings'));

	}//<--- END METHOD

	public function saveDestinationPageSettings(Request $request){
		$postData = $request->all();
		// dd($postData);

		//Header
		$title = $postData['title'];
		$headerHeading = $postData['header_heading'];
		$headerDescription = $postData['header_description'];
		$firstSectionHeading = $postData['first_section_heading'];
		$secondSectionHeading = $postData['second_section_heading'];
		$secondSectionContent = $postData['second_section_content'];
		$thirdSectionContent = $postData['third_section_content'];
		$thirdSectionButtonText = $postData['third_section_button_text'];
		
		
		// $aboutContent = $postData['content'];
	

		$destinationPageSettings = DestinationPageSettings::first();

		//Header Updating
		$destinationPageSettings->title  = $title;
		$destinationPageSettings->header_heading   = $headerHeading;
		$destinationPageSettings->header_description   = $headerDescription;
		$destinationPageSettings->first_section_header   = $firstSectionHeading;
		$destinationPageSettings->second_section_header   = $secondSectionHeading;
		$destinationPageSettings->second_section_content   = $secondSectionContent;
		$destinationPageSettings->third_section_content   = $thirdSectionContent;
		$destinationPageSettings->third_section_button_text   = $thirdSectionButtonText;
		
		// $aboutPageSettings->content   = $aboutContent;
		
		//Header Main Image 
		if($request->hasFile('header_main_image')){	
			$headerMainImage = $postData['header_main_image'];
			$mainImageName = 'header_main_image_'.time().'.'.$headerMainImage->getClientOriginalExtension();
		
			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'destination_page/assets/';
			$destinationPath = public_path($Path);
		
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $headerMainImage->move($destinationPath, $mainImageName);
				if($saveFile){
					$destinationPageSettings->header_main_image = $mainImageName;
				}
			}else{
				$saveFile = $headerMainImage->move($destinationPath, $mainImageName);
				if($saveFile){
					$destinationPageSettings->header_main_image = $mainImageName;
				}
			}
		}		
		
		//Third Section Main Image 
		if($request->hasFile('third_section_main_image')){	
			$thirdSectionMainImage = $postData['third_section_main_image'];
			$mainImageName = 'third_section_main_image_'.time().'.'.$thirdSectionMainImage->getClientOriginalExtension();
		
			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'destination_page/assets/';
			$destinationPath = public_path($Path);
		
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $thirdSectionMainImage->move($destinationPath, $mainImageName);
				if($saveFile){
					$destinationPageSettings->third_section_main_image = $mainImageName;
				}
			}else{
				$saveFile = $thirdSectionMainImage->move($destinationPath, $mainImageName);
				if($saveFile){
					$destinationPageSettings->third_section_main_image = $mainImageName;
				}
			}
		}
			

		$destinationPageSettings->save();

		\Session::flash('success_message', trans('admin.success_update'));

		return redirect('panel/admin/destination-page-settings');
		

	}

	public function suggestCityPageSettings() {

		$suggestCityPageSettings = SuggestCityPageSettings::first();
		// dd($destinationPageSettings);

		return view('admin.suggest-city-page',compact('suggestCityPageSettings'));

	}//<--- END METHOD

	public function saveSuggestCityPageSettings(Request $request){
		$postData = $request->all();
		// dd($postData);

		//Header
		$requestHeading	= $postData['request_heading'];
		$requestMessage = $postData['request_message'];
		
		
		// $aboutContent = $postData['content'];
	

		$suggestCityPageSettings = SuggestCityPageSettings::first();

		//Header Updating
		$suggestCityPageSettings->request_heading	=	$requestHeading;
		$suggestCityPageSettings->request_message   = 	$requestMessage;
		
		//Header Main Image 
		if($request->hasFile('request_background_img')){	
			$headerMainImage = $postData['request_background_img'];
			$mainImageName = 'request_background_img'.time().'.'.$headerMainImage->getClientOriginalExtension();
		
			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'suggest_a_city/assets/';
			$destinationPath = public_path($Path);
		
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $headerMainImage->move($destinationPath, $mainImageName);
				if($saveFile){
					$suggestCityPageSettings->request_background_img = $mainImageName;
				}
			}else{
				$saveFile = $headerMainImage->move($destinationPath, $mainImageName);
				if($saveFile){
					$suggestCityPageSettings->request_background_img = $mainImageName;
				}
			}
		}		

		//request_thankyou_background_img 
		if($request->hasFile('request_thankyou_background_img')){	
			$thankyouBackgroundImg = $postData['request_thankyou_background_img'];
			$mainImageName = 'request_thankyou_background_img'.time().'.'.$thankyouBackgroundImg->getClientOriginalExtension();
		
			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'suggest_a_city/assets/';
			$destinationPath = public_path($Path);
		
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $thankyouBackgroundImg->move($destinationPath, $mainImageName);
				if($saveFile){
					$suggestCityPageSettings->request_thankyou_background_img = $mainImageName;
				}
			}else{
				$saveFile = $thankyouBackgroundImg->move($destinationPath, $mainImageName);
				if($saveFile){
					$suggestCityPageSettings->request_thankyou_background_img = $mainImageName;
				}
			}
		}		
		
		
			

		$suggestCityPageSettings->save();

		\Session::flash('success_message', trans('admin.success_update'));

		return redirect('panel/admin/suggest-city-page-settings');
		

	}

	public function faqPageSettings() {

		$faqPageSettings = FaqPageSettings::first();
		// dd($faqPageSettings);

		return view('admin.faq-page',compact('faqPageSettings'));

	}//<--- END METHOD

	public function saveFaqPageSettings(Request $request)
	{
		$postData = $request->all();
		//Header
		$headerHeading = $postData['header_heading'];
		$headerDescription = $postData['header_description'];
		
		
		// $aboutContent = $postData['content'];
	
		// var_dump($sectionContent2Description1);
		// die;
		$faqPageSettings = FaqPageSettings::first();

		//Header Updating
		$faqPageSettings->header_heading   = $headerHeading;
		$faqPageSettings->header_description   = $headerDescription;
	
		
		// $faqPageSettings->content   = $aboutContent;
		
		//Header Main Image 
		if($request->hasFile('header_main_image')){	
			$headerMainImage = $postData['header_main_image'];
			$mainImageName = 'header_main_image_'.time().'.'.$headerMainImage->getClientOriginalExtension();
		
			// $destinationPath = url('/').'/public/home_page/header_assets/';
			$Path = 'faq_page/header_assets/';
			$destinationPath = public_path($Path);
		
			if (!file_exists($destinationPath)) {
				// path does not exist
				$saveFile = $headerMainImage->move($destinationPath, $mainImageName);
				if($saveFile){
					$faqPageSettings->header_main_image = $mainImageName;
				}
			}else{
				$saveFile = $headerMainImage->move($destinationPath, $mainImageName);
				if($saveFile){
					$faqPageSettings->header_main_image = $mainImageName;
				}
			}
		}		
		
		
			
		$faqPageSettings->save();

		\Session::flash('success_message', trans('admin.success_update'));

		return redirect('panel/admin/faq-page-settings');
		

	}

	public function requestSuggestCountryCity()
	{
		$getRequestsSuggestCountryCity = RequestSuggestCountryCity::get();
		// dd($getRequestsSuggestCountryCity);

		// return redirect('admin.request-suggest-country-city-list', compact('getRequestsSuggestCountryCity'));
		return view('admin.request-suggest-country-city-list', compact('getRequestsSuggestCountryCity'));
	}

	// START
	public function photoshootType() {

		// $data      = Cities::select('cities.*','country.country_name','state.state_name')->join('country','country.id','=','cities.country_id')->join('state', 'state.id','=', 'cities.state_id')->get();
		$data      = PhotoshootType::get();
		

		return view('admin.photoshoot-type')->withData($data);

	}//<--- END METHOD

	public function addPhotoshootType() {

		$getUserTypes = Types::orderBy('type_name')->get();

		return view('admin.add-photoshoot-type', compact('getUserTypes'));

	}//<--- END METHOD

	public function storePhotoshootType(Request $request) {

	  $temp            = 'public/temp/'; // Temp
	  $path            = 'public/img-photoshoot_type/'; // Path General

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'photoshoot_name'        => 'required'
        );

		$this->validate($request, $rules);

		//======= City Image
		if( $request->hasFile('photoshoot_icon_img') )	{
			$photoshoot_name 		= $request->photoshoot_name;
			$photoshootImageName 	= str_replace(' ', '', $photoshoot_name);
			$extension 				= $request->file('photoshoot_icon_img')->getClientOriginalExtension();
			$file      				= $photoshootImageName.'.'.$extension;

			if($request->file('photoshoot_icon_img')->move($temp, $file) ) {
				\File::copy($temp.$file, $path.$file);
				\File::delete($temp.$file);
			}// End File
		} // HasFile

		$sql              		 			= New PhotoshootType();
		$sql->photoshoot_name    			= trim($request->photoshoot_name);
		$sql->types_id						= $request->userType;
		$sql->mode       		 			= $request->mode;
		if($request->hasFile('photoshoot_icon_img')){
			$sql->photoshoot_icon_img    	= $file;
		}
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_photoshoot'));

    	return redirect('panel/admin/photoshoot-type');

	}//<--- END METHOD

	public function editPhotoshootType($id) {

		$photoshootType        = PhotoshootType::find( $id );

		$getUserTypes = Types::orderBy('type_name')->get();

		return view('admin.edit-photoshoot-type',compact('photoshootType', 'getUserTypes'));

	}//<--- END METHOD

	public function updatePhotoshootType( Request $request ) {


		$photoshootType  = PhotoshootType::find( $request->id );

		$temp            = 'public/temp/'; // Temp
	    $path            = 'public/img-photoshoot_type/'; // Path General

	    if( !isset($photoshootType) ) {
			return redirect('panel/admin/photoshoot-type');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'photoshoot_name'        => 'required'
	     );

		$this->validate($request, $rules);

		//======= City Image
		if( $request->hasFile('photoshoot_icon_img') )	{
			$photoshoot_name 		= $request->photoshoot_name;
			$photoshootImageName 	= str_replace(' ', '', $photoshoot_name);
			$extension 				= $request->file('photoshoot_icon_img')->getClientOriginalExtension();
			$file      				= $photoshootImageName.'.'.$extension;
			// print_r($file);
			// print_r($request->hasFile('photoshoot_icon_img'));
			// die;
			if($request->file('photoshoot_icon_img')->move($temp, $file) ) {
				\File::copy($temp.$file, $path.$file);
				\File::delete($temp.$file);
			}// End File
		} // HasFile

		// UPDATE CATEGORY
		$photoshootType->photoshoot_name   			= $request->photoshoot_name;
		$photoshootType->types_id					= $request->userType;	
		if($request->hasFile('photoshoot_icon_img')){

			$photoshootType->photoshoot_icon_img    = $file;
		}
		$photoshootType->mode        				= $request->mode;
		$photoshootType->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/photoshoot-type');

	}//<--- END METHOD

	public function deletePhotoshootType($id){

		$photoshootType        = PhotoshootType::find( $id );
		$thumbnail          = 'public/img-photoshoot_type/'.$photoshootType->photoshoot_icon_img; // Path General

		if(!isset($photoshootType)) {
			return redirect('panel/admin/photoshoot-type');
		} else {

			// Delete Category
			$photoshootType->delete();

			// Delete City Image
			if ( \File::exists($thumbnail) ) {
				\File::delete($thumbnail);
			}

			return redirect('panel/admin/photoshoot-type');
		}
	}//<--- END METHOD

	// START
	public function timeDay() {

		$data      = TimeDay::get();
		return view('admin.time-day')->withData($data);

	}//<--- END METHOD

	public function addTimeDay() {

		return view('admin.add-time-day');

	}//<--- END METHOD

	public function storeTimeDay(Request $request) {

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'time_of_day'        => 'required'
        );

		$this->validate($request, $rules);

		$sql              		 			= New TimeDay();
		$sql->time_of_day    			= trim($request->time_of_day);
		$sql->short_description    			= $request->short_description;
		$sql->mode       		 			= $request->mode;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_timeday'));

    	return redirect('panel/admin/time-day');

	}//<--- END METHOD

	public function editTimeDay($id) {

		$timeDay        = TimeDay::find( $id );

		return view('admin.edit-time-day',compact('timeDay'));

	}//<--- END METHOD

	public function updateTimeDay( Request $request ) {


		$timeDay  = TimeDay::find( $request->id );

	    if( !isset($timeDay) ) {
			return redirect('panel/admin/time-day');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'time_of_day'        => 'required'
	     );

		$this->validate($request, $rules);

		// UPDATE CATEGORY
		$timeDay->time_of_day   			= $request->time_of_day;
		$timeDay->short_description   		= $request->short_description;
		$timeDay->mode        				= $request->mode;
		$timeDay->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/time-day');

	}//<--- END METHOD

	public function deleteTimeDay($id){

		$timeDay        = TimeDay::find( $id );

		if(!isset($timeDay)) {
			return redirect('panel/admin/time-day');
		} else {

			// Delete Category
			$timeDay->delete();

			return redirect('panel/admin/time-day');
		}
	}//<--- END METHOD

	// START
	public function tripReason() {

		$data      = TripReason::get();
		return view('admin.trip-reason')->withData($data);

	}//<--- END METHOD

	public function addTripReason() {

		return view('admin.add-trip-reason');

	}//<--- END METHOD

	public function storeTripReason(Request $request) {

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'trip_reason_name'        => 'required'
        );

		$this->validate($request, $rules);

		$sql              		 			= New TripReason();
		$sql->trip_reason_name    			= trim($request->trip_reason_name);
		$sql->mode       		 			= $request->mode;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_tripreason'));

    	return redirect('panel/admin/trip-reason');

	}//<--- END METHOD

	public function editTripReason($id) {

		$tripReason        = TripReason::find( $id );

		return view('admin.edit-trip-reason',compact('tripReason'));

	}//<--- END METHOD

	public function updateTripReason( Request $request ) {


		$tripReason  = TripReason::find( $request->id );

	    if( !isset($tripReason) ) {
			return redirect('panel/admin/trip-reason');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'trip_reason_name'        => 'required'
	     );

		$this->validate($request, $rules);

		// UPDATE CATEGORY
		$tripReason->trip_reason_name   		= $request->trip_reason_name;
		$tripReason->mode        				= $request->mode;
		$tripReason->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/trip-reason');

	}//<--- END METHOD

	public function deleteTripReason($id){

		$tripReason        = TripReason::find( $id );

		if(!isset($tripReason)) {
			return redirect('panel/admin/trip-reason');
		} else {

			// Delete Category
			$tripReason->delete();

			return redirect('panel/admin/trip-reason');
		}
	}//<--- END METHOD

	// START
	public function Package() {

		$data      = Package::get();
		return view('admin.package')->withData($data);

	}//<--- END METHOD

	public function addPackage() {

		return view('admin.add-package');

	}//<--- END METHOD

	public function storePackage(Request $request) {

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            // 'hours'        		=> 'required',
            'price'        		=> 'required',
            'number_of_photos'  => 'required'
        );

		$this->validate($request, $rules);

		$sql              		= New Package();
		$sql->hours    			= $request->hours;
		$sql->minutes    		= $request->minutes;
		$sql->price    			= $request->price;
		$sql->number_of_photos  = $request->number_of_photos;
		$sql->mode       		= $request->mode;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_package'));

    	return redirect('panel/admin/package');

	}//<--- END METHOD

	public function editPackage($id) {

		$package        = Package::find( $id );

		return view('admin.edit-package',compact('package'));

	}//<--- END METHOD

	public function updatePackage( Request $request ) {


		$package  = Package::find( $request->id );

	    if( !isset($package) ) {
			return redirect('panel/admin/package');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            // 'hours'        		=> 'required',
            'price'        		=> 'required',
            'number_of_photos'  => 'required'
	     );

		$this->validate($request, $rules);

		// UPDATE CATEGORY
		
		$package->hours    			= $request->hours;
		$package->minutes    		= $request->minutes;
		$package->price    			= $request->price;
		$package->number_of_photos  = $request->number_of_photos;
		$package->mode        		= $request->mode;
		$package->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/package');

	}//<--- END METHOD

	public function deletePackage($id){

		$package        = Package::find( $id );

		if(!isset($package)) {
			return redirect('panel/admin/package');
		} else {

			// Delete Category
			$package->delete();

			return redirect('panel/admin/package');
		}
	}//<--- END METHOD

	// START
	public function preferredStylePhoto() {

		$data      = PreferredStylePhoto::get();
		return view('admin.preferred-style-photo')->withData($data);

	}//<--- END METHOD

	public function addPreferredStylePhoto() {

		return view('admin.add-preferred-style-photo');

	}//<--- END METHOD

	public function storePreferredStylePhoto(Request $request) {

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'name'        => 'required'
        );

		$this->validate($request, $rules);

		$sql      	= New PreferredStylePhoto();
		$sql->name	= trim($request->name);
		$sql->mode	= $request->mode;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_preferred_style_photo'));

    	return redirect('panel/admin/preferred-style-photo');

	}//<--- END METHOD

	public function editPreferredStylePhoto($id) {

		$preferredStylePhoto        = PreferredStylePhoto::find( $id );

		return view('admin.edit-preferred-style-photo',compact('preferredStylePhoto'));

	}//<--- END METHOD

	public function updatePreferredStylePhoto( Request $request ) {


		$preferredStylePhoto  = PreferredStylePhoto::find( $request->id );

	    if( !isset($preferredStylePhoto) ) {
			return redirect('panel/admin/preferred-style-photo');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'name'        => 'required'
	     );

		$this->validate($request, $rules);

		// UPDATE CATEGORY
		$preferredStylePhoto->name  = $request->name;
		$preferredStylePhoto->mode  = $request->mode;
		$preferredStylePhoto->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/preferred-style-photo');

	}//<--- END METHOD

	public function deletePreferredStylePhoto($id){

		$preferredStylePhoto        = PreferredStylePhoto::find( $id );

		if(!isset($preferredStylePhoto)) {
			return redirect('panel/admin/preferred-style-photo');
		} else {

			// Delete Category
			$preferredStylePhoto->delete();

			return redirect('panel/admin/preferred-style-photo');
		}
	}//<--- END METHOD

	// START
	public function levelOfDirection() {

		$data      = LevelOfDirection::get();
		return view('admin.level-of-direction')->withData($data);

	}//<--- END METHOD

	public function addLevelOfDirection() {

		return view('admin.add-level-of-direction');

	}//<--- END METHOD

	public function storeLevelOfDirection(Request $request) {

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'name'        => 'required'
        );

		$this->validate($request, $rules);

		$sql      	= New LevelOfDirection();
		$sql->name	= trim($request->name);
		$sql->mode	= $request->mode;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_level_of_direction'));

    	return redirect('panel/admin/level-of-direction');

	}//<--- END METHOD

	public function editLevelOfDirection($id) {

		$levelOfDirection        = LevelOfDirection::find( $id );

		return view('admin.edit-level-of-direction',compact('levelOfDirection'));

	}//<--- END METHOD

	public function updateLevelOfDirection( Request $request ) {


		$levelOfDirection  = LevelOfDirection::find( $request->id );

	    if( !isset($preferredStylePhoto) ) {
			return redirect('panel/admin/level-of-direction');
		}

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'name'        => 'required'
	     );

		$this->validate($request, $rules);

		// UPDATE CATEGORY
		$levelOfDirection->name  = $request->name;
		$levelOfDirection->mode  = $request->mode;
		$levelOfDirection->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/level-of-direction');

	}//<--- END METHOD

	public function deleteLevelOfDirection($id){

		$levelOfDirection        = LevelOfDirection::find( $id );

		if(!isset($levelOfDirection)) {
			return redirect('panel/admin/level-of-direction');
		} else {

			// Delete Category
			$levelOfDirection->delete();

			return redirect('panel/admin/level-of-direction');
		}
	}//<--- END METHOD

	// START Music Type
	public function musicType() {

		$data      = MusicType::where('is_deleted','!=', '1')->where('parent_id','=','0')->get();
		return view('admin.music-type')->withData($data);

	}//<--- END METHOD

	public function addMusicType() {

		return view('admin.add-music-type');

	}//<--- END METHOD

	public function storeMusicType(Request $request) {

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'music_type'        => 'required'
        );

		$this->validate($request, $rules);

		$currentDate = date('Y-m-d HH:i:s a');

		$sql      	= New MusicType();
		$sql->music_type	= trim($request->music_type);
		$sql->created_date	= $currentDate;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_music_type'));

    	return redirect('panel/admin/music-type');

	}//<--- END METHOD

	public function editMusicType($id) {

		$musicType        = MusicType::find( $id );

		return view('admin.edit-music-type',compact('musicType'));

	}//<--- END METHOD

	public function updateMusicType( Request $request ) {


		$musicType  = MusicType::find( $request->id );

	    // if( !isset($preferredStylePhoto) ) {
		// 	return redirect('panel/admin/level-of-direction');
		// }

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'music_type'        => 'required'
	     );

		$this->validate($request, $rules);

		// UPDATE CATEGORY
		$musicType->music_type  = $request->music_type;
		$musicType->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/music-type');

	}//<--- END METHOD

	public function deleteMusicType($id){

		$musicType        = MusicType::find( $id );

		if(!isset($musicType)) {
			return redirect('panel/admin/music-type');
		} else {

			// Delete Category
			$musicType->is_deleted = '1';
			$musicType->save();

			return redirect('panel/admin/music-type');
		}
	}//<--- END METHOD
	//End Music Type

	// START Music Sub Type
	public function musicSubType() {

		$data      = MusicType::select('music_types.id AS subTypeId','music_types.music_type AS subTypeName', 'parentType.music_type AS parentTypeName')->join('music_types AS parentType', 'parentType.id','=', 'music_types.parent_id')->where('music_types.is_deleted','!=', '1')->where('music_types.parent_id','!=','0')->get();
		// var_dump($data);
		// die;
		return view('admin.music-sub-type')->withData($data);

	}//<--- END METHOD

	public function addMusicSubType() {

		$musicTypeData = MusicType::where('parent_id','=', '0')->where('is_deleted','!=', '1')->get();
		return view('admin.add-music-sub-type', compact('musicTypeData'));

	}//<--- END METHOD

	public function storeMusicSubType(Request $request) {

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'music_type'        => 'required',
			'parent_id' 		=> 'required'
        );

		$this->validate($request, $rules);

		$currentDate = date('Y-m-d HH:i:s a');

		$sql      	= New MusicType();
		$sql->music_type	= trim($request->music_type);
		$sql->parent_id	= $request->parent_id;
		$sql->created_date	= $currentDate;
		$sql->save();

		\Session::flash('success_message', trans('admin.success_add_music_type'));

    	return redirect('panel/admin/music-sub-type');

	}//<--- END METHOD

	public function editMusicSubType($id) {

		$musicType        = MusicType::find( $id );

		$parentMusicTypeData = MusicType::where('parent_id','=', '0')->where('is_deleted','!=', '1')->get();

		return view('admin.edit-music-sub-type',compact('musicType','parentMusicTypeData'));

	}//<--- END METHOD

	public function updateMusicSubType( Request $request ) {


		$musicType  = MusicType::find( $request->id );

	    // if( !isset($preferredStylePhoto) ) {
		// 	return redirect('panel/admin/level-of-direction');
		// }

		Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		$rules = array(
            'music_type'        => 'required',
			'parent_id'			=> 'required'
	     );

		$this->validate($request, $rules);

		// UPDATE CATEGORY
		$musicType->music_type  = $request->music_type;
		$musicType->parent_id  = $request->parent_id;
		$musicType->save();

		\Session::flash('success_message', trans('misc.success_update'));

    	return redirect('panel/admin/music-type');

	}//<--- END METHOD

	public function deleteMusicSubType($id){

		$musicType        = MusicType::find( $id );

		if(!isset($musicType)) {
			return redirect('panel/admin/music-sub-type');
		} else {

			// Delete Category
			$musicType->is_deleted = '1';
			$musicType->save();

			return redirect('panel/admin/music-sub-type');
		}
	}//<--- END METHOD
	//End Music Sub Type

	public function bookingPendingRequests(){
		$getPendingBookingRequests =  Booking::select('bookings.*', 'cities.country_id as CountryId', 'cities.city_name', 'cities.description', 'userCustomer.username AS UserName', 'userCustomer.name AS User_Name', 'userArtist.username AS UserNameArtist', 'userArtist.name AS User_Name_Artist')->join('cities','cities.id','=','bookings.city_id')->join('users AS userArtist','userArtist.id','=','bookings.artist_id')->join('users AS userCustomer','userCustomer.id','=','bookings.customer_id')->where('bookings.status', '=', 'pending')->orderBy('requested_date','ASC')->get();
		return view('admin.bookings-pending-requests', ['data' => $getPendingBookingRequests]);
	}

	public function bookingPendingRequestsDetails($shootId){
		$getBookingPendingDetails = Booking::select('bookings.*', 'cities.country_id as CountryId', 'cities.city_name', 'cities.description', 'userCustomer.username AS UserName', 'userCustomer.name AS User_Name', 'userArtist.username AS UserNameArtist', 'userArtist.name AS User_Name_Artist')->join('cities','cities.id','=','bookings.city_id')->join('users AS userArtist','userArtist.id','=','bookings.artist_id')->join('users AS userCustomer','userCustomer.id','=','bookings.customer_id')->where('bookings.id', '=', $shootId)->first();
    	return view('admin.bookings-pending-details', ['data' => $getBookingPendingDetails]);
	}

	public function bookingRejectedRequests(){
		$getRejectedBookingRequests =  Booking::select('bookings.*', 'cities.country_id as CountryId', 'cities.city_name', 'cities.description', 'userCustomer.username AS UserName', 'userCustomer.name AS User_Name', 'userArtist.username AS UserNameArtist', 'userArtist.name AS User_Name_Artist')->join('cities','cities.id','=','bookings.city_id')->join('users AS userArtist','userArtist.id','=','bookings.artist_id')->join('users AS userCustomer','userCustomer.id','=','bookings.customer_id')->where('bookings.status', '=', 'rejected')->orderBy('requested_date','ASC')->get();
		return view('admin.bookings-rejected-requests', ['data' => $getRejectedBookingRequests]);
	}

	public function bookingRejectedRequestsDetails($shootId){
		$getBookingRejectedDetails = Booking::select('bookings.*', 'cities.country_id as CountryId', 'cities.city_name', 'cities.description', 'userCustomer.username AS UserName', 'userCustomer.name AS User_Name', 'userArtist.username AS UserNameArtist', 'userArtist.name AS User_Name_Artist')->join('cities','cities.id','=','bookings.city_id')->join('users AS userArtist','userArtist.id','=','bookings.artist_id')->join('users AS userCustomer','userCustomer.id','=','bookings.customer_id')->where('bookings.id', '=', $shootId)->first();
    	return view('admin.bookings-rejected-details', ['data' => $getBookingRejectedDetails]);
	}

	public function bookingCancelledRequests(){
		$getCencelledBookingRequests =  Booking::select('bookings.*', 'cities.country_id as CountryId', 'cities.city_name', 'cities.description', 'userCustomer.username AS UserName', 'userCustomer.name AS User_Name', 'userArtist.username AS UserNameArtist', 'userArtist.name AS User_Name_Artist')->join('cities','cities.id','=','bookings.city_id')->join('users AS userArtist','userArtist.id','=','bookings.artist_id')->join('users AS userCustomer','userCustomer.id','=','bookings.customer_id')->where('bookings.status', '=', 'cancelled')->orderBy('requested_date','ASC')->get();
		return view('admin.bookings-cancelled-requests', ['data' => $getCencelledBookingRequests]);
	}

	public function bookingCancelledRequestsDetails($shootId){
		$getBookingCancelledDetails = Booking::select('bookings.*', 'cities.country_id as CountryId', 'cities.city_name', 'cities.description', 'userCustomer.username AS UserName', 'userCustomer.name AS User_Name', 'userArtist.username AS UserNameArtist', 'userArtist.name AS User_Name_Artist')->join('cities','cities.id','=','bookings.city_id')->join('users AS userArtist','userArtist.id','=','bookings.artist_id')->join('users AS userCustomer','userCustomer.id','=','bookings.customer_id')->where('bookings.id', '=', $shootId)->first();
    	return view('admin.bookings-cancelled-details', ['data' => $getBookingCancelledDetails]);
	}

	public function bookingApprovedRequests(){
		$getApprovedBookingRequests =  Booking::select('bookings.*', 'cities.country_id as CountryId', 'cities.city_name', 'cities.description', 'userCustomer.username AS UserName', 'userCustomer.name AS User_Name', 'userArtist.username AS UserNameArtist', 'userArtist.name AS User_Name_Artist')->join('cities','cities.id','=','bookings.city_id')->join('users AS userArtist','userArtist.id','=','bookings.artist_id')->join('users AS userCustomer','userCustomer.id','=','bookings.customer_id')->where('bookings.status', '=', 'approved')->orderBy('requested_date','ASC')->get();
		return view('admin.bookings-approved-requests', ['data' => $getApprovedBookingRequests]);
	}

	public function bookingApprovedRequestsDetails($shootId){
		$getBookingApprovedDetails = Booking::select('bookings.*', 'cities.country_id as CountryId', 'cities.city_name', 'cities.description', 'userCustomer.username AS UserName', 'userCustomer.name AS User_Name', 'userArtist.username AS UserNameArtist', 'userArtist.name AS User_Name_Artist')->join('cities','cities.id','=','bookings.city_id')->join('users AS userArtist','userArtist.id','=','bookings.artist_id')->join('users AS userCustomer','userCustomer.id','=','bookings.customer_id')->where('bookings.id', '=', $shootId)->first();
    	return view('admin.bookings-approved-details', ['data' => $getBookingApprovedDetails]);
	}

	public function bookingCompletedRequests(){
		$getCompletedBookingRequests =  Booking::select('bookings.*', 'cities.country_id as CountryId', 'cities.city_name', 'cities.description', 'userCustomer.username AS UserName', 'userCustomer.name AS User_Name', 'userArtist.username AS UserNameArtist', 'userArtist.name AS User_Name_Artist')->join('cities','cities.id','=','bookings.city_id')->join('users AS userArtist','userArtist.id','=','bookings.artist_id')->join('users AS userCustomer','userCustomer.id','=','bookings.customer_id')->where('bookings.status', '=', 'completed')->orderBy('requested_date','ASC')->get();
		return view('admin.bookings-completed-requests', ['data' => $getCompletedBookingRequests]);
	}

	public function bookingCompletedRequestsDetails($shootId){
		$getBookingCompletedDetails = Booking::select('bookings.*', 'cities.country_id as CountryId', 'cities.city_name', 'cities.description', 'userCustomer.username AS UserName', 'userCustomer.name AS User_Name', 'userArtist.username AS UserNameArtist', 'userArtist.name AS User_Name_Artist')->join('cities','cities.id','=','bookings.city_id')->join('users AS userArtist','userArtist.id','=','bookings.artist_id')->join('users AS userCustomer','userCustomer.id','=','bookings.customer_id')->where('bookings.id', '=', $shootId)->first();
    	return view('admin.bookings-completed-details', ['data' => $getBookingCompletedDetails]);
	}
	
	public function getPaymentDetails($shootId)
	{
	    $getBookingDetailsForPayment = Booking::select('bookings.*', 'userCustomer.username AS UserName', 'userCustomer.name AS User_Name', 'userArtist.username AS UserNameArtist', 'userArtist.name AS User_Name_Artist')->join('users AS userArtist','userArtist.id','=','bookings.artist_id')->join('users AS userCustomer','userCustomer.id','=','bookings.customer_id')->where('bookings.id', '=', $shootId)->first();
	    return view('admin.bookings-completed-payment-details', ['data' => $getBookingDetailsForPayment]);
	}

}
