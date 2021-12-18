<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input as Input;
use App\Http\Requests;
use App\Models\User;
use App\Models\Images;
use Illuminate\Http\Request;
use App\Models\AdminSettings;
use App\Models\HomePageSettings;
use App\Models\Categories;
use App\Models\Query;
use App\Models\Collections;
use App\Models\Types;
use App\Models\MusicType;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct(HomePageSettings $homePageSettings) {
		$this->homePageSettings = $homePageSettings::first();
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	public function index() {
		$homePageData = HomePageSettings::first();
		// dd($homePageData);
		// $categories = Categories::where('mode','on')->orderBy('name')->paginate(12);
		$categories = Categories::where('mode','on')->orderBy('name')->paginate(12);

		$images     = Query::latestImages();
		// $images     = Query::RecentImages();

		$featured   = Query::featuredImages();
		$popularCategories = Categories::withCount('images')->latest('images_count')->has('images')->take(5)->with('images')->get();
		if ($popularCategories->count() != 0) {
			foreach ($popularCategories as $popularCategorie) {
				$popularCategorieArray[]  = '<a style="color:#FFF;" href="'.url('category', $popularCategorie->slug).'">'.$popularCategorie->name.'</a>';
			}
			$categoryPopular = implode( ', ', $popularCategorieArray);
		} else {
			$categoryPopular = false;
		}


		$getCategoriesList = Categories::where('slug', '!=', 'uncategorized')->where('parent_id','=','0')->limit('8')->get();

		$totalArtistCount = 0;
// 		$getUserArtistListPhotographer = User::join('types', 'users.user_type_id','=','types.types_id')->where('user_type_id', '!=', '')->where('user_type_id','=', '1')->limit('2')->get();
		$getUserArtistListPhotographer = User::select('users.*', 'types.*', 'new_countries.name AS CountryName')->join('types', 'users.user_type_id','=','types.types_id')->join('new_countries', 'users.country_id','=','new_countries.id')->where('user_type_id', '!=', '')->where('user_type_id','=', '1')->limit('2')->get();
// 		dd($getUserArtistListPhotographer);
// 		$getUserArtistListAnimator = User::join('types', 'users.user_type_id','=','types.types_id')->where('user_type_id', '!=', '')->where('user_type_id','=', '2')->limit('2')->get();
		$getUserArtistListAnimator = User::select('users.*','types.*','new_countries.name AS CountryName')->join('types', 'users.user_type_id','=','types.types_id')->join('new_countries', 'users.country_id','=','new_countries.id')->where('user_type_id', '!=', '')->where('user_type_id','=', '2')->limit('2')->get();
		// dd($getUserArtistListAnimator);
// 		$getUserArtistListVideographer = User::join('types', 'users.user_type_id','=','types.types_id')->where('user_type_id', '!=', '')->where('user_type_id','=', '3')->limit('2')->get();
		$getUserArtistListVideographer = User::select('users.*','types.*','new_countries.name AS CountryName')->join('types', 'users.user_type_id','=','types.types_id')->join('new_countries', 'users.country_id','=','new_countries.id')->where('user_type_id', '!=', '')->where('user_type_id','=', '3')->limit('2')->get();
// 		$getUserArtistListMusician = User::join('types', 'users.user_type_id','=','types.types_id')->where('user_type_id', '!=', '')->where('user_type_id','=', '4')->limit('2')->get();
		$getUserArtistListMusician = User::select('users.*','types.*','new_countries.name AS CountryName')->join('types', 'users.user_type_id','=','types.types_id')->join('new_countries', 'users.country_id','=','new_countries.id')->where('user_type_id', '!=', '')->where('user_type_id','=', '4')->limit('2')->get();
		// dd($getUserArtistList);
		$totalArtistCount += $getUserArtistListPhotographer->count();
		$totalArtistCount += $getUserArtistListAnimator->count();
		$totalArtistCount += $getUserArtistListVideographer->count();
		$totalArtistCount += $getUserArtistListMusician->count();
		return view(
      	'new_template.home', [
    	//   'index.home', [
		'homePageSettings' => $homePageData,
        'categories'       => $categories,
        'images'           => $images,
        'featured'         => $featured,
		'categoryPopular'  => $categoryPopular,
		'categoriesList'   => $getCategoriesList,
		// 'userArtistList'   => $getUserArtistList
		'userArtistListPhotographer'   => $getUserArtistListPhotographer,
		'userArtistListAnimator'   => $getUserArtistListAnimator,
		'userArtistListVideographer'   => $getUserArtistListVideographer,
		'userArtistListMusician'   => $getUserArtistListMusician,
		'totalArtistCount' => $totalArtistCount
      	]);

	}// End Method

	public function getAllCategory()
	{
		$queryCategory = Categories::where('slug','!=', 'uncategorized')->get();

		if(count($queryCategory) > 0){
			echo json_encode($queryCategory);
		}else{
			echo json_encode('false');
		}
	}

	public function getAllType()
	{
		$queryType = Types::get();

		if(count($queryType) > 0){
			echo json_encode($queryType);
		}else{
			echo json_encode('false');
		}
	}

	public function destinations()
	{
		return view('new_template.destinations');
	}

	public function getVerifyAccount( $confirmation_code ) {


		if( Auth::guest()
        || Auth::check()
        && Auth::user()->activation_code == $confirmation_code
        && Auth::user()->status == 'pending'
        ) {
		$user = User::where( 'activation_code', $confirmation_code )->where('status','pending')->first();

		if( $user ) {

			$update = User::where( 'activation_code', $confirmation_code )
			->where('status','pending')
			->update( array( 'status' => 'active', 'activation_code' => '' ) );


			Auth::loginUsingId($user->id);

			 return redirect('/')
					->with([
						'success_verify' => true,
					]);
			} else {
			return redirect('/')
					->with([
						'error_verify' => true,
					]);
			}
		}
    else {
			 return redirect('/');
		}
	}// End Method

	public function getSearch() {

    $q = request()->get('q');

		$images = Query::searchImages();

		//<--- * If $q is empty or is minus to 1 * ---->
		if( $q == '' || strlen( $q ) <= 2 ){
			return redirect('/');
		}

		return view('default.search')->with($images);
	}// End Method

	public function getSearchNew() {


		$q = request()->get('txt_search');

		// dd(request()->get('type'));

		if(request()->get('type') != null && request()->get('type') == "4"){
// dd('music');
			$images = Query::searchMusicNew();
			// dd($images);
		}else{
// var_dump('else');
// var_dump($q);
// die;
			// dd('images');
			$images = Query::searchImagesNew();
// 			dd($images);
		}

		// $getImages = Images::whereRaw('FIND_IN_SET(?,tags)', [$q])->get();
		// dd($getImages);

		$getImagesTags = Images::select('tags')->whereRaw('NOT FIND_IN_SET(?,tags)', [$q])->get();
		// dd($getImagesTags);
		//Getting Tags expect tag that is use for search.
		$arrayImageTags = array();
		for($i = 0; $i<count($getImagesTags);$i++){
			$tagComma = explode(",", $getImagesTags[$i]->tags);
			for($k = 0; $k < count($tagComma); $k++){
				if(!in_array($tagComma[$k], $arrayImageTags)){
					array_push($arrayImageTags, $tagComma[$k]);
				}
			}
		}

		$sliceArrayAnyTenImageTags = array_slice($arrayImageTags, 0, 10);


		$getParentMusicTypes = MusicType::where('parent_id','=','0')->get();
		// $getChildMusicTypes = MusicType::where('parent_id','!=','0')->get();

		// $title = trans('misc.result_of').' '. $q .' - ';
		// echo '<pre>';
		// 	var_dump($images);die;
		// return view('default.search_new')->with($images);
		return view('default.search_new2',compact('sliceArrayAnyTenImageTags', 'images', 'q','getParentMusicTypes'));
	}// End Method

	public function latest() {

		$images = Query::latestImages();

    if (request()->ajax()) {
            return view('ajax.images-ajax',['images' => $images])->render();
        }

		return view('index.latest', ['images' => $images]);

	}// End Method

	public function featured() {

		$images = Query::featuredImages();

		return view('index.featured', ['images' => $images]);

	}// End Method


	public function popular() {

		$images = Query::popularImages();

		return view('index.popular', ['images' => $images]);

	}// End Method

	public function commented() {

		$images = Query::commentedImages();

		return view('index.commented', ['images' => $images]);

	}// End Method

	public function viewed() {

		$images = Query::viewedImages();

		return view('index.viewed', ['images' => $images]);

	}// End Method

	public function downloads() {

		$images = Query::downloadsImages();

		return view('index.downloads', ['images' => $images]);

	}// End Method

	public function getSubCategoryByCategory($CatId){

		$subCategory = Categories::where('parent_id','=', $CatId)->get();

		if(count($subCategory) > 0){
			echo json_encode($subCategory);
		}else{
			echo json_encode('no data');
		}

	}

	//vuejs component functionality
	public function getUsersByCategory($categorySlug)
	{

		// dd($categorySlug);
		$getCategoryDetails = Categories::where('slug','=', $categorySlug)->first();

		$user = Auth::user();

        if($user != null){

			$query = "SELECT
			users.*, types.type_name,
			(case when (images.is_type = 'image' and images.`status`= 'active') then images.thumbnail else 0 end) as img,
			(case when (images.is_type = 'video' and images.`status`= 'active') then images.thumbnail else 0 end) as vid,
			(case when (images.is_type = 'animation' and images.`status`= 'active') then images.thumbnail else 0 end) as ani,
			CONCAT('screen-shot-',(case when (images.is_type = 'video') then REPLACE(images.thumbnail, images.extension, 'png') else '' end)) as ScreenShot,
			images.is_type
			FROM
			`users`
			INNER JOIN `types` ON `types`.`types_id` = `users`.`user_type_id`
			INNER JOIN `images` ON `images`.`user_id` = `users`.`id`";
			$query .=" WHERE users.`user_type_id` != 0 AND users.`user_type_id` = ". $getCategoryDetails['link_with'] ." AND users.`id` != ". Auth::user()->id ." AND users.`status` = 'active' GROUP BY users.`id`";

		}else{

			$query = "SELECT
			users.*, types.type_name,
			(case when (images.is_type = 'image' and images.`status`= 'active') then images.thumbnail else 0 end) as img,
			(case when (images.is_type = 'video' and images.`status`= 'active') then images.thumbnail else 0 end) as vid,
			(case when (images.is_type = 'animation' and images.`status`= 'active') then images.thumbnail else 0 end) as ani,
			CONCAT('screen-shot-',(case when (images.is_type = 'video') then REPLACE(images.thumbnail, images.extension, 'png') else '' end)) as ScreenShot,
			images.is_type
			FROM
			`users`
			INNER JOIN `types` ON `types`.`types_id` = `users`.`user_type_id`
			INNER JOIN `images` ON `images`.`user_id` = `users`.`id`";
			$query .=" WHERE users.`user_type_id` != 0 AND users.`user_type_id` = ". $getCategoryDetails['link_with'] ." AND users.`status` = 'active' GROUP BY users.`id`";

		}

		$getUsersByCategory =  \DB::select($query);

        return response()->json([
            'getUserArtistList' => $getUsersByCategory
		], 200);

	}

	public function category($slug) {


        // dd($slug);
		if($slug != "music"){
			$images = Query::categoryImages($slug);
		}else{
			$images = Query::categoryMusic($slug);

		}

// 		echo '<pre>';
// 		dd($images);
// 		die;


		if(strpos($slug, '-') !== false){
			// echo "Word Found!";
// 			dd('if');
			return view('default.user-category')->with($images);
		} else{
// dd('else');
			if($slug == "music"){
				return view('default.categor_music')->with($images);
			}else{
				// echo "Word Not Found!";
				// dd('aasd');
				return view('default.category')->with($images);
            }
		}

	}// End Method

	public function getLimitImagesByUserId($userId)
	{
        $getLimitImages = Images::where(['is_type' => 'image', 'user_id' => $userId])->limit(4)->get();

        echo json_encode($getLimitImages);
	}

	public function getLimitVideosByUserId($userId)
	{
        $getLimitImages = Images::where(['is_type' => 'video', 'user_id' => $userId])->limit(4)->get();

        echo json_encode($getLimitImages);
	}

// 	public function getLimitVideosByUserId($userId)
// 	{
// 	    $getLimitImages = Images::where(['is_type' => 'video', 'user_id' => $userId])->limit(4)->get();

//         echo json_encode($getLimitImages);
// 	}

	public function subCategory($slug) {
		$images = Query::subCategoryImages($slug);
		// if(strpos($slug, '-') !== false){
		// 	// echo "Word Found!";
		// 	return view('default.user-category')->with($images);
		// } else{
			// echo "Word Not Found!";
			return view('default.sub_category')->with($images);
		// }

	}// End Method

	public function subMusicCategory($slug) {

		$images = Query::subCategoryMusic($slug);
		// if(strpos($slug, '-') !== false){
		// 	// echo "Word Found!";
		// 	return view('default.user-category')->with($images);
		// } else{
			// echo "Word Not Found!";
			// dd($images);
			return view('default.sub_category_music')->with($images);
		// }

	}// End Method

	public function categoryImages($slug) {

		$images = Query::getCategoryImages($slug);

		if($slug == "photographer"){
			return view('includes.ajax-users-artist')->with($images);
		}elseif($slug == "videographer"){
			return view('includes.ajax-users-artist')->with($images);
		}elseif($slug == "musician"){
			return view('includes.ajax-users-artist')->with($images);
		}elseif($slug == "animator"){
			return view('includes.ajax-users-artist')->with($images);
		}else{

			return view('includes.ajax-images')->with($images);
		}

	}// End Method

	public function searchArtist(Request $request){

		if(isset($request->searchArtistValue)){
			$q = $request->searchArtistValue;
		}else{
			$q = '';
		}

		$typeId = $request->searchArtistTypeId;

		$images = Query::searchArtistData($q, $typeId);
// 		dd($images);
		echo json_encode($images);
		// return view('default.search_new2',compact('images', 'q'));

	}

	public function searchByIndustry(Request $request){

		// dd($request);
		// if(isset($request->searchIndustryValue)){
		// 	$q = $request->searchIndustryValue;
		// }else{
		// 	$q = '';
		// }
		if(isset($request->txt_search_industry)){
			$q = $request->txt_search_industry;
		}else{
			$q = '';
		}

		// $industryId = $request->searchIndustryId;
		$industryId = $request->txt_search_industry_id;
		// dd($industryId);
		if(isset($request->slug) && $request->slug == "music"){
			$slugMusic = "music";
		}else{
			$slugMusic = "";
		}
		$images = Query::searchIndustryData($q, $industryId, $slugMusic);
		// dd($images);
		// echo json_encode($images);
		if(isset($request->slug) && $request->slug == "music"){

			return view('default.categor_music')->with($images);
		}else{

			return view('default.category')->with($images);
		}
		// return view('default.search_new2',compact('images', 'q'));

	}

	public function searchBySubCategoryIndustry(Request $request)
	{
		if(isset($request->txt_search_industry)){
			$q = $request->txt_search_industry;
		}else{
			$q = '';
		}

		// $industryId = $request->searchIndustryId;
		$industryId = $request->txt_search_industry_id;
		// dd($industryId);
		$images = Query::searchSubIndustryData($q, $industryId, $slugMusic);
		// dd($images);
		// echo json_encode($images);
		return view('default.sub_category')->with($images);
		// return view('default.search_new2',compact('images', 'q'));
	}

	public function searchMusicBySubCategoryIndustry(Request $request){
		if(isset($request->txt_search_industry)){
			$q = $request->txt_search_industry;
		}else{
			$q = '';
		}

		// $industryId = $request->searchIndustryId;
		$industryId = $request->txt_search_industry_id;
		// dd($industryId);
		if(isset($request->slug) && $request->slug == "music"){
			$slugMusic = "music";
		}else{
			$slugMusic = "";
		}
		$images = Query::searchMusicSubIndustryData($q, $industryId, $slugMusic);
		// dd($images);
		// echo json_encode($images);
		if(isset($request->slug) && $request->slug == "music"){
			return view('default.sub_category_music')->with($images);
		}else{
			return view('default.sub_category')->with($images);
		}
		// return view('default.search_new2',compact('images', 'q'));
	}

	public function tags($slug) {

	 if( strlen( $slug ) > 1 ) {
		$settings = AdminSettings::first();

		$images = Query::tagsImages($slug);

		return view('default.tags-show')->with($images);
		} else {
			abort('404');
		}

	}// End Method

	public function cameras($slug) {

	if( strlen( $slug ) > 3 ) {
		$settings = AdminSettings::first();

		$images = Query::camerasImages($slug);

		return view('default.cameras')->with($images);

		} else {
			abort('404');
		}
	}// End Method

	public function colors($slug) {

		if( strlen( $slug ) == 6 ) {

			$settings = AdminSettings::first();

			$images = Query::colorsImages($slug);

			return view('default.colors')->with($images);

		} else {
			abort('404');
		}
	}// End Method

	public function collections(Request $request) {

		$settings = AdminSettings::first();

		$title       = trans('misc.collections').' - ';

	   $data = Collections::has('collection_images')
	   ->where('type','public')
		->orderBy('id','desc')
		->paginate( $settings->result_request );

		if( $request->input('page') > $data->lastPage() ) {
			abort('404');
		}

 		return view('default.collections', [ 'title' => $title, 'data' => $data] );
    }//<--- End Method

    public function premium() {

      $settings = AdminSettings::first();

      if ($settings->sell_option == 'off') {
          abort(404);
      }

  		$images = Query::premiumImages();

  		return view('index.premium', ['images' => $images]);

	  }// End Method

	  public function stockData($id)
	  {
		$stock = \App\Models\Stock::whereImagesId($id)->whereType('small')->select('name')->first();

		echo json_encode($stock);
	  }

}
