<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Images;
use App\Models\Stock;
use App\Models\User;
use App\Models\AdminSettings;
use App\Models\Categories;
use App\Helper;
use App\Models\Types;
use Mockery\Matcher\Type;
use DB;

class Query extends Model
{

	protected $guarded = array();
	public $timestamps = false;


	public static function users()
	{

		$settings = AdminSettings::first();

		$page      = request()->get('page');
		$sort      =  request()->get('sort');
		$location  =  request()->get('location');

		if ($sort == 'latest') {
			$sortQuery = 'users.id';
		} else if ($sort == 'photos') {
			$sortQuery = 'COUNT(images.id)';
		} else {
			$sortQuery = 'COUNT(followers.id)';
		}

		$data = User::where('users.status', 'active');

		// lOCATION
		if (isset($location) && $location != '') {
			$data->where('users.countries_id', $location);
		}

		// PHOTOS
		if ($sort == 'photos') {
			$data->leftjoin('images', 'users.id', '=', \DB::raw('images.user_id AND images.status = "active"'));
		}

		// POPULAR
		if ($sort == 'popular' || !$sort) {
			$data->leftjoin('followers', 'users.id', '=', \DB::raw('followers.following AND followers.status = "1"'));
		}

		$query = 	$data->where('users.status', '=', 'active')
			->groupBy('users.id')
			->orderBy(\DB::raw($sortQuery), 'DESC')
			->orderBy('users.id', 'ASC')
			->select('users.*')
			->paginate($settings->result_request)->onEachSide(1);

		return ['data' => $query, 'page' => $page, 'sort' => $sort, 'location' => $location];
	} //<---- End Method

	//Search
	public static function searchImages()
	{

		$settings = AdminSettings::first();

		$q    = request()->get('txt_search');
		$page = request()->get('page');
		$words = explode(' ', $q);

		if (count($words) == 1) {
			// var_dump($q);
			// var_dump($words);
			// die;
			$images = Images::searchLike($q)->paginate($settings->result_request)->onEachSide(1);
		} else {
			// print_r('in else');
			// die;
			$images = Images::search($q)->paginate($settings->result_request)->onEachSide(1);
		}

		if ($images->total() == 0) {
		}

		// dd($images);
		$title = trans('misc.result_of') . ' ' . $q . ' - ';
		$total = $images->total();

		return ['images' => $images, 'page' => $page, 'title' => $title, 'total' => $total, 'q' => $q];
	} //<---- End Method

	//Search
	public static function searchImagesNew()
	{
// dd('in search Image new');
		$settings = AdminSettings::first();
// dd($settings);
		$q    			= request()->get('txt_search');
		$type 			= request()->get('type');
		$artist 		= request()->get('artist');
		$sort 			= request()->get('sort');
		$sub_category 	= request()->get('sub_category');
		$words = explode(' ', $q);
// dd($type);

		if($sort == "Fresh"){
			$sortValue = "asc";
		}else{
			$sortValue = "asc";
		}
		if($type !== null){

			$images = DB::table('images')
// 			->select('images.*','v.id as vID','v.images_id as vImgId')
// 			->leftJoin('visits as v', 'images.id', '=', 'v.images_id')
			->where(function($query) use($q, $sort, $sortValue, $sub_category, $type){


				if($type !== "all"){

					// 	$is_type = "";
					$getCategoryDetails = Categories::where('id', '=', $type)->first();
					if ($getCategoryDetails->slug == "music") {
						$is_type = "audio";
					} else if ($getCategoryDetails->slug == "photo") {
						$is_type = "image";
					} else {
						$is_type = $getCategoryDetails->slug;
					}

					$query->where('is_type','=', $is_type);
					
				}

				if($sub_category !== "" && $sub_category !== null){
					$query->orWhere('sub_categories_id','=', $sub_category);
				}

				if($q !== "" && $q !== null){
					$query->where('title', 'LIKE', "%{$q}%")
					->orWhere('tags', 'LIKE', "%{$q}%")
					->orWhere('description', 'LIKE', "%{$q}%");
				}

				

				// if($sort == "Fresh"){
				// dd($sort);
				// dd($sortValue);

					// $query->orderBy('date',$sortValue);
					// echo 'yeee';
					// dd($sort);
					// $query->leftJoin('visits', 'images.id', '=', 'visits.images_id')
					// ->select(\DB::raw("count(visits.images_id) AS total_visits"))
					// ->groupBy('visits.images_id');
					// ->get();
				// }
			})->where('is_type','!=', 'audio')->orderBy('date', 'asc')
			 //->toSql();
			// ->get();
			->paginate($settings->result_request)->onEachSide(1);
// 			->paginate(8)->onEachSide(1);

// 			dd($images);
			// dd('in if');
		}else{
			// dd('in else');
			$images = DB::table('users')
			->select('users.*', 'types.types_id as TypeId', 'types.type_name', 'new_countries.name AS CountryName',
			//old work.
            // 	DB::raw('(CASE WHEN images.is_type = "image" and images.status = "active" THEN images.thumbnail ELSE 0 END) AS img'),
            // 	DB::raw('(CASE WHEN images.is_type = "video" and images.status = "active" THEN images.thumbnail ELSE 0 END) AS vid'),
            // 	DB::raw('(CASE WHEN images.is_type = "animation" and images.status = "active" THEN images.thumbnail ELSE 0 END) AS ani'),
            // 	DB::raw('(CONCAT("screen-shot-",CASE WHEN images.is_type = "video" THEN REPLACE(images.thumbnail, images.extension, "png") ELSE "" END)) AS ScreenShot'))

			DB::raw('(SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = "image" AND `images`.`user_id` = users.`id` LIMIT  4) AS img'),
			DB::raw('(SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = "video" AND `images`.`user_id` = users.`id` LIMIT  4) AS vid'),
			DB::raw('(SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = "video" AND `images`.`user_id` = users.`id` LIMIT  4) AS ani'),
			DB::raw('(SELECT GROUP_CONCAT(`images`.`thumbnail`) FROM `images` WHERE `is_type`  = "audio" AND `images`.`user_id` = users.`id` LIMIT  1) AS mus'))
			
			->join('types', 'users.user_type_id','=', 'types.types_id')
			->join('images','images.user_id','=', 'users.id')
			->join('new_countries', 'users.country_id','=','new_countries.id')
			->where(function($query) use($q, $sort, $sortValue, $artist){

				if($artist !== "all"){
					$query->where('user_type_id','=', $artist);
				}

				if($q !== "" && $q !== null){
					$query->where('users.username', 'LIKE', "%{$q}%")
					->orWhere('users.name', 'LIKE', "%{$q}%")
					->orWhere('users.email', 'LIKE', "%{$q}%");
				}

			})->orderBy('date', 'asc')->groupBy('users.id')
			//  ->toSql();
			// ->get();
// 			->paginate($settings->result_request)->onEachSide(1);
			->paginate(8)->onEachSide(1);
// dd($images);
    //         $query = "SELECT users.*, types.type_name, (SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'image' AND `user_id` = users.`id` LIMIT  4) AS img, 
 	  //          (SELECT GROUP_CONCAT(REPLACE(`images`.`preview`, `images`.`extension`, 'png')) FROM `images` WHERE `is_type`  = 'video' AND `user_id` = users.`id` LIMIT  4) AS vid,
 	  //          (SELECT GROUP_CONCAT(REPLACE(`images`.`preview`, `images`.`extension`, 'png')) FROM `images` WHERE `is_type`  = 'video' AND `user_id` = users.`id` LIMIT  4) AS ani,
 	  //          (SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'audio' AND `user_id` = users.`id` LIMIT  1) AS mus,
	   //         images.is_type FROM `users` INNER JOIN `types` ON `types`.`types_id` = `users`.`user_type_id` INNER JOIN `images` ON `images`.`user_id` = `users`.`id`";
				// if (Auth::user() !== null) {
				// // 	$query .= " WHERE users.`user_type_id` != 0 AND users.`id` = " . $users->id . " AND users.`status` = 'active' AND users.`country_id` = " . $country . " AND users.`id` != " . Auth::user()->id . " GROUP BY users.id";
				// 	$query .= " WHERE users.`user_type_id` != 0 AND users.`status` = 'active'  AND users.`id` != " . Auth::user()->id . " GROUP BY users.id";
				// } else {
				// // 	$query .= " WHERE users.`user_type_id` != 0 AND users.`id` = " . $users->id . " AND users.`status` = 'active' AND users.`country_id` = " . $country . " GROUP BY users.id";
				// 	$query .= " WHERE users.`user_type_id` != 0  AND users.`status` = 'active'  GROUP BY users.id";
				// }
				// $GettingUsers =  \DB::select($query)->paginate($settings->result_request)->onEachSide(1);
				
				// dd($images);
		}

		$title = trans('misc.result_of') . ' ' . $q . ' - ';
		// $total = $images->total();

		// return ['images' => $images, 'type' => $type, 'sort' => $sort, 'title' => $title, 'total' => $total, 'q' => $q];
		return ['images' => $images, 'artist' => $artist, 'type' => $type, 'sort' => $sort, 'title' => $title, 'q' => $q];
	} //<---- End Method
	
	public static function searchMusicNew()
	{

		$settings = AdminSettings::first();

		$q    			= request()->get('txt_search');
		$type 			= request()->get('type');
		$artist 		= request()->get('artist');
		$sort 			= request()->get('sort');
		$sub_category 	= request()->get('sub_category');
		$musicSubType	= request()->get('select_parent_music_type');
	
		$words = explode(' ', $q);

		if($sort == "Fresh"){
			$sortValue = "asc";
		}else{
			$sortValue = "asc";
		}
		

			$images = DB::table('images')->where('is_type','=', 'audio')->orderBy('date', 'asc')
			//  ->toSql();
			// ->get();
			->where(function($query) use($q, $sort, $sortValue, $sub_category, $type, $musicSubType){


				if($type !== "all"){

					// 	$is_type = "";
					$getCategoryDetails = Categories::where('id', '=', $type)->first();
					if ($getCategoryDetails->slug == "music") {
						$is_type = "audio";
					} else if ($getCategoryDetails->slug == "photo") {
						$is_type = "image";
					} else {
						$is_type = $getCategoryDetails->slug;
					}

					$query->where('is_type','=', $is_type);
				}

				if($sub_category !== "" && $sub_category !== null){
					$query->orWhere('sub_categories_id','=', $sub_category);
				}

				if($q !== "" && $q !== null){
					$query->where('title', 'LIKE', "%{$q}%")
					->orWhere('tags', 'LIKE', "%{$q}%")
					->orWhere('description', 'LIKE', "%{$q}%");
				}
				
				// dd();
				if($musicSubType !== null){
					if(array_filter($musicSubType) && $musicSubType !== null){
						
						$implodeMusicSubType = implode(",", $musicSubType);
						// dd($implodeMusicSubType);
						// $query->whereIn('music_type_id', $musicSubType);
						// $query->whereRaw('FIND_IN_SET(?,music_type_id)', $implodeMusicSubType);
						$query->whereRaw('FIND_IN_SET(?,music_type_id)', $musicSubType);
						// dd($query);
						
					}	
				}

				// if($sort == "Fresh"){
				// dd($sort);
				// dd($sortValue);

					// $query->orderBy('date',$sortValue);
					// echo 'yeee';
					// dd($sort);
					// $query->leftJoin('visits', 'images.id', '=', 'visits.images_id')
					// ->select(\DB::raw("count(visits.images_id) AS total_visits"))
					// ->groupBy('visits.images_id');
					// ->get();
				// }
			})->orderBy('date', 'asc')
			->paginate($settings->result_request)->onEachSide(1);

			// dd($images);
		
		if($q != ""){
			$title = trans('misc.result_of') . ' ' . $q . ' - ';
		}else{
			$title = '';
		}

		// $total = $images->total();

		// return ['images' => $images, 'type' => $type, 'sort' => $sort, 'title' => $title, 'total' => $total, 'q' => $q];
		// return ['images' => $images, 'artist' => $artist, 'type' => $type, 'sort' => $sort, 'title' => $title, 'q' => $q];
		return ['images' => $images, 'type' => $type, 'sort' => $sort, 'title' => $title, 'q' => $q];
	} //<---- End Method

	public static function latestImages()
	{

		$settings = AdminSettings::first();

		$data = Images::where('status', 'active')->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);

		return $data;
	} //<---- End Method

	public static function RecentImages()
	{

		$settings = AdminSettings::first();

		$data = Images::where('status', 'active')->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1)->take(8);

		return $data;
	} //<---- End Method

	public static function featuredImages()
	{

		$settings = AdminSettings::first();

		$data = Images::where('featured', 'yes')->where('status', 'active')->orderBy('featured_date', 'DESC')->paginate($settings->result_request)->onEachSide(1);

		return $data;
	} //<---- End Method

	public static function popularImages()
	{

		$settings = AdminSettings::first();

		$data = Images::join('likes', function ($join) {
			$join->on('likes.images_id', '=', 'images.id')->where('likes.status', '=', '1')->where('images.status', 'active');
		})
			->groupBy('likes.images_id')
			->orderBy(\DB::raw('COUNT(likes.images_id)'), 'desc')
			->select('images.*')
			->paginate($settings->result_request)->onEachSide(1);

		return $data;
	} //<---- End Method

	public static function commentedImages()
	{

		$settings = AdminSettings::first();

		$data = Images::join('comments', 'images.id', '=', 'comments.images_id')
			->where('images.status', 'active')
			->groupBy('comments.images_id')
			->orderBy(\DB::raw('COUNT(comments.images_id)'), 'desc')
			->select('images.*')
			->paginate($settings->result_request)->onEachSide(1);

		return $data;
	} //<---- End Method

	public static function viewedImages()
	{

		$settings = AdminSettings::first();

		$data = Images::join('visits', 'images.id', '=', 'visits.images_id')
			->where('images.status', 'active')
			->groupBy('visits.images_id')
			->orderBy(\DB::raw('COUNT(visits.images_id)'), 'desc')
			->select('images.*')
			->paginate($settings->result_request)->onEachSide(1);

		return $data;
	} //<---- End Method

	public static function downloadsImages()
	{

		$settings = AdminSettings::first();

		$data = Images::join('downloads', 'images.id', '=', 'downloads.images_id')
			->where('images.status', 'active')
			->groupBy('downloads.images_id')
			->orderBy(\DB::raw('COUNT(downloads.images_id)'), 'desc')
			->select('images.*')
			->paginate($settings->result_request)->onEachSide(1);

		return $data;
	} //<---- End Method

	public static function searchArtistData($q, $typeId)
	{
// dd('ider');
		if($q != ''){

			$getUsers = User::where('status', '=', 'active')->where('user_type_id', '=', $typeId)->get(); //getting user by type.
			$arrayUsers = array(); //array for users list.
			$arrayUserss = array(); //array for users list.
			foreach ($getUsers as $users) //foreach loop on users.
			{
				// (case when (images.is_type = 'image' and images.`status`= 'active') then images.thumbnail else 0 end) as img,
				// (case when (images.is_type = 'video' and images.`status`= 'active') then images.thumbnail else 0 end) as vid,
				// (case when (images.is_type = 'animation' and images.`status`= 'active') then images.thumbnail else 0 end) as ani,
				// CONCAT('screen-shot-',(case when (images.is_type = 'video') then REPLACE(images.thumbnail, images.extension, 'png') else '' end)) as ScreenShot,
				
			 //   (SELECT GROUP_CONCAT(REPLACE(`images`.`preview`, `images`.`extension`, 'png')) FROM `images` WHERE `is_type`  = 'video' AND `images`.`user_id` = users.`id` LIMIT  4) AS vid,
		      //  (SELECT GROUP_CONCAT(REPLACE(`images`.`preview`, `images`.`extension`, 'png')) FROM `images` WHERE `is_type`  = 'video' AND `images`.`user_id` = users.`id` LIMIT  4) AS ani,
				$query = "SELECT
				users.*, types.type_name, new_countries.name AS CountryName,
				(SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'image' AND `images`.`user_id` = users.`id` LIMIT  4) AS img,
			    (SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'video' AND `images`.`user_id` = users.`id` LIMIT  4) AS vid,
		        (SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'video' AND `images`.`user_id` = users.`id` LIMIT  4) AS ani,
			    (SELECT GROUP_CONCAT(`images`.`thumbnail`) FROM `images` WHERE `is_type`  = 'audio' AND `images`.`user_id` = users.`id` LIMIT  1) AS mus,
				images.is_type
				FROM
				`users`
				INNER JOIN `types` ON `types`.`types_id` = `users`.`user_type_id`
				INNER JOIN `images` ON `images`.`user_id` = `users`.`id`
				INNER JOIN `new_countries` ON `new_countries`.`id` = `users`.`country_id`";


				if (Auth::user() !== null) {
					$query .= " WHERE users.`user_type_id` != 0 AND users.`id` = " . $users->id . " AND users.`status` = 'active' AND users.`id` != " . Auth::user()->id . " AND (users.email LIKE '%". $q ."%' OR users.name LIKE '%". $q ."%' OR users.username LIKE '%". $q ."%') GROUP BY users.id";
				} else {
					$query .= " WHERE users.`user_type_id` != 0 AND users.`id` = " . $users->id . " AND users.`status` = 'active' AND (users.email LIKE '%". $q ."%' OR users.name LIKE '%". $q ."%' OR users.username LIKE '%". $q ."%') GROUP BY users.id";
				}
				$GettingUsers =  \DB::select($query);

				if (!empty($GettingUsers)) {

					array_push($arrayUsers, $GettingUsers);
				}
			}
			
// 			dd($arrayUsers);
			// return ['images' => $arrayUsers, 'img' => $arrayUserss]; //returning data to response to ajax request.
			return  $arrayUsers; //returning data to response to ajax request.
		}else{
			$getUsers = User::where('status', '=', 'active')->where('user_type_id', '=', $typeId)->get(); //getting user by type.
			$arrayUsers = array(); //array for users list.
			$arrayUserss = array(); //array for users list.
			foreach ($getUsers as $users) //foreach loop on users.
			{
				// (case when (images.is_type = 'image' and images.`status`= 'active') then images.thumbnail else 0 end) as img,
				// (case when (images.is_type = 'video' and images.`status`= 'active') then images.thumbnail else 0 end) as vid,
				// (case when (images.is_type = 'animation' and images.`status`= 'active') then images.thumbnail else 0 end) as ani,
				// CONCAT('screen-shot-',(case when (images.is_type = 'video') then REPLACE(images.thumbnail, images.extension, 'png') else '' end)) as ScreenShot,
				
			 //   (SELECT GROUP_CONCAT(REPLACE(`images`.`preview`, `images`.`extension`, 'png')) FROM `images` WHERE `is_type`  = 'video' AND `images`.`user_id` = users.`id` LIMIT  4) AS vid,
		  //      (SELECT GROUP_CONCAT(REPLACE(`images`.`preview`, `images`.`extension`, 'png')) FROM `images` WHERE `is_type`  = 'video' AND `images`.`user_id` = users.`id` LIMIT  4) AS ani,
				$query = "SELECT
				users.*, types.type_name, new_countries.name AS CountryName,
				(SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'image' AND `images`.`user_id` = users.`id` LIMIT  4) AS img,
			    (SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'video' AND `images`.`user_id` = users.`id` LIMIT  4) AS vid,
		        (SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'video' AND `images`.`user_id` = users.`id` LIMIT  4) AS ani,
			    (SELECT GROUP_CONCAT(`images`.`thumbnail`) FROM `images` WHERE `is_type`  = 'audio' AND `images`.`user_id` = users.`id` LIMIT  1) AS mus,
				images.is_type
				FROM
				`users`
				INNER JOIN `types` ON `types`.`types_id` = `users`.`user_type_id`
				INNER JOIN `images` ON `images`.`user_id` = `users`.`id`
				INNER JOIN `new_countries` ON `new_countries`.`id` = `users`.`country_id`";


				if (Auth::user() !== null) {
					$query .= " WHERE users.`user_type_id` != 0 AND users.`id` = " . $users->id . " AND users.`status` = 'active' AND users.`id` != " . Auth::user()->id . "  AND types.`types_id` = " . $typeId . " GROUP BY users.id";
				} else {
					$query .= " WHERE users.`user_type_id` != 0 AND users.`id` = " . $users->id . " AND users.`status` = 'active' AND types.`types_id` = " . $typeId . " GROUP BY users.id";
				}
				$GettingUsers =  \DB::select($query);
				// dd('in sdasd');
// dd($GettingUsers);
				if (!empty($GettingUsers)) {

					array_push($arrayUsers, $GettingUsers);
				}
			}
// 			dd($arrayUsers);
			// return ['images' => $arrayUsers, 'img' => $arrayUserss,]; //returning data to response to ajax request.
			return $arrayUsers; //returning data to response to ajax request.
		}
		
	} //<---- End Method

	public static function searchIndustryData($q, $industryId, $slugMusic)
	{
		$settings = AdminSettings::first();

		if($slugMusic != ""){

			if($q != ''){

				$category = Categories::where('id', '=', $industryId)->firstOrFail();
				$images   = Images::where('status', 'active')
				->where('categories_id', $category->id)
				->where('is_type','=', 'audio')
				->where(function($query) use($q){
					$query->where('title', 'like', '%' . $q . '%')->orWhere('description', 'like', '%' . $q . '%')->orWhere('tags', 'like', '%' . $q . '%');
				})->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);
				
				return ['images' => $images, 'category' => $category, 'settings' => $settings, 'q' => $q, 'industryId' => $industryId];
			}else{
				// echo "Word Not Found!";
	
				$category = Categories::where('id', '=', $industryId)->firstOrFail();
				$images   = Images::where('status', 'active')->where('categories_id', $category->id)->where('is_type','=','audio')->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);
				return ['images' => $images, 'category' => $category, 'settings' => $settings, 'industryId' => $industryId];
	
				
			}

		}else{
			if($q != ''){

				$category = Categories::where('id', '=', $industryId)->firstOrFail();
				$images   = Images::where('status', 'active')
				->where('categories_id', $category->id)
				->where(function($query) use($q){
					$query->where('title', 'like', '%' . $q . '%')->orWhere('description', 'like', '%' . $q . '%')->orWhere('tags', 'like', '%' . $q . '%');
				})->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);
				
				return ['images' => $images, 'category' => $category, 'settings' => $settings, 'q' => $q, 'industryId' => $industryId];
			}else{
				// echo "Word Not Found!";
	
				$category = Categories::where('id', '=', $industryId)->firstOrFail();
				$images   = Images::where('status', 'active')->where('categories_id', $category->id)->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);
				return ['images' => $images, 'category' => $category, 'settings' => $settings, 'industryId' => $industryId];
	
				
			}
		}
		
	} //<---- End Method

	public static function categoryImages($slug)
	{

		$settings = AdminSettings::first();

		if (strpos($slug, '-') !== false) {
			// echo "Word Found!";
			$explodeSlug = explode("-", $slug)[1];

			$category = Types::where('type_name', '=', $explodeSlug)->firstOrFail();
		} else {
			// echo "Word Not Found!";
			$category = Categories::where('slug', '=', $slug)->firstOrFail();
		}


		/*if( !$category ) {
			 abort('404');
		 }*/

		if (strpos($slug, '-') !== false) {
		  //  dd('in here');
			// echo "Word Found!";
			$explodeSlug = explode("-", $slug)[1];

			$category = Types::where('type_name', '=', $explodeSlug)->firstOrFail();

			$getUserTypeId = Types::where('type_name', '=', $explodeSlug)->first(); // getting type details with slug.
			$getUsers = User::where('status', '=', 'active')->where('user_type_id', '=', $getUserTypeId->types_id)->get(); //getting user by type.
			$arrayUsers = array(); //array for users list.
			$arrayUserss = array(); //array for users list.
			foreach ($getUsers as $users) //foreach loop on users.
			{

				// (case when (images.is_type = 'image' and images.`status`= 'active') then images.thumbnail else 0 end) as img,
				// (case when (images.is_type = 'video' and images.`status`= 'active') then images.thumbnail else 0 end) as vid,
				// (case when (images.is_type = 'animation' and images.`status`= 'active') then images.thumbnail else 0 end) as ani,
				// CONCAT('screen-shot-',(case when (images.is_type = 'video') then REPLACE(images.thumbnail, images.extension, 'png') else '' end)) as ScreenShot,
				$query = "SELECT
				users.*, types.type_name, new_countries.name AS CountryName,
				(SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'image' AND `images`.`user_id` = users.`id` LIMIT  4) AS img,
			    (SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'video' AND `images`.`user_id` = users.`id` LIMIT  4) AS vid,
		        (SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'video' AND `images`.`user_id` = users.`id` LIMIT  4) AS ani,
			    (SELECT GROUP_CONCAT(`images`.`thumbnail`) FROM `images` WHERE `is_type`  = 'audio' AND `images`.`user_id` = users.`id` LIMIT  1) AS mus,
				images.is_type
				FROM
				`users`
				INNER JOIN `types` ON `types`.`types_id` = `users`.`user_type_id`
				INNER JOIN `images` ON `images`.`user_id` = `users`.`id`
				INNER JOIN `new_countries` ON `new_countries`.`id` = `users`.`country_id`";


				if (Auth::user() !== null) {
					$query .= " WHERE users.`user_type_id` != 0 AND users.`id` = " . $users->id . " AND users.`status` = 'active' AND users.`id` != " . Auth::user()->id . " GROUP BY users.id";
				} else {
					$query .= " WHERE users.`user_type_id` != 0 AND users.`id` = " . $users->id . " AND users.`status` = 'active' GROUP BY users.id";
				}
				$GettingUsers =  \DB::select($query);

				if (!empty($GettingUsers)) {

					array_push($arrayUsers, $GettingUsers);
				}
			}
			
// 			dd($arrayUsers);
			return ['images' => $arrayUsers, 'img' => $arrayUserss,  'category' => $category]; //returning data to response to ajax request.

		} else {
			// echo "Word Not Found!";
			$category = Categories::where('slug', '=', $slug)->firstOrFail();
// dd('else');
			$images   = Images::where('status', 'active')->where('categories_id', $category->id)->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);
			return ['images' => $images, 'category' => $category];

		}

	} //<---- End Method

	public static function categoryMusic($slug)
	{

		$settings = AdminSettings::first();

		if (strpos($slug, '-') !== false) {
			// echo "Word Found!";
			$explodeSlug = explode("-", $slug)[1];

			$category = Types::where('type_name', '=', $explodeSlug)->firstOrFail();
		} else {
			// echo "Word Not Found!";
			$category = Categories::where('slug', '=', $slug)->firstOrFail();
		}


		/*if( !$category ) {
			 abort('404');
		 }*/

		if (strpos($slug, '-') !== false) {
			// echo "Word Found!";
			$explodeSlug = explode("-", $slug)[1];

			$category = Types::where('type_name', '=', $explodeSlug)->firstOrFail();

			$getUserTypeId = Types::where('type_name', '=', $explodeSlug)->first(); // getting type details with slug.
			$getUsers = User::where('status', '=', 'active')->where('user_type_id', '=', $getUserTypeId->types_id)->get(); //getting user by type.
			$arrayUsers = array(); //array for users list.
			$arrayUserss = array(); //array for users list.
			foreach ($getUsers as $users) //foreach loop on users.
			{

				$query = "SELECT
				users.*, types.type_name,
				(case when (images.is_type = 'audio' and images.`status`= 'active') then images.thumbnail else 0 end) as aud,
				CONCAT('screen-shot-',(case when (images.is_type = 'audio') then REPLACE(images.thumbnail, images.extension, 'png') else '' end)) as ScreenShot,
				images.is_type
				FROM
				`users`
				INNER JOIN `types` ON `types`.`types_id` = `users`.`user_type_id`
				INNER JOIN `images` ON `images`.`user_id` = `users`.`id`";


				if (Auth::user() !== null) {
					$query .= " WHERE images.`is_type` = 'audio' AND users.`user_type_id` != 0 AND users.`id` = " . $users->id . " AND users.`status` = 'active' AND users.`id` != " . Auth::user()->id . " GROUP BY users.id";
				} else {
					$query .= " WHERE images.`is_type` = 'audio' AND users.`user_type_id` != 0 AND users.`id` = " . $users->id . " AND users.`status` = 'active' GROUP BY users.id";
				}
				$GettingUsers =  \DB::select($query);

				if (!empty($GettingUsers)) {

					array_push($arrayUsers, $GettingUsers);
				}
			}
			
			return ['images' => $arrayUsers, 'img' => $arrayUserss,  'category' => $category]; //returning data to response to ajax request.

		} else {
			// echo "Word Not Found!";
			$category = Categories::where('slug', '=', $slug)->firstOrFail();

			$images   = Images::where('status', 'active')->where('is_type','=', 'audio')->where('categories_id', $category->id)->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);
			return ['images' => $images, 'category' => $category];

		}

	} //<---- End Method

	public static function subCategoryImages($slug)
	{

		$settings = AdminSettings::first();

		$category = Categories::where('slug', '=', $slug)->firstOrFail();

		$parentCategory = Categories::where('id', '=', $category->parent_id)->first();
		
		$images   = Images::where('status', 'active')->where('sub_categories_id', $category->id)->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);
		return ['images' => $images, 'category' => $category, 'parentCategory' => $parentCategory];

	} //<---- End Method

	public static function subCategoryMusic($slug)
	{

		$settings = AdminSettings::first();

		$category = Categories::where('slug', '=', $slug)->firstOrFail();

		$parentCategory = Categories::where('id', '=', $category->parent_id)->first();
		
		$images   = Images::where('is_type','=','audio')->where('status', 'active')->where('sub_categories_id', $category->id)->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);
		return ['images' => $images, 'category' => $category, 'parentCategory' => $parentCategory];

	} //<---- End Method

	public static function searchSubIndustryData($q, $industryId)
	{
		$settings = AdminSettings::first();

		if($q != ''){

			$category = Categories::where('id', '=', $industryId)->firstOrFail();

			$parentCategory = Categories::where('id', '=', $category->parent_id)->first();
			
			$images   = Images::where('status', 'active')->where('sub_categories_id', $category->id)
			->where(function($query) use($q){
				$query->where('title', 'like', '%' . $q . '%')->orWhere('description', 'like', '%' . $q . '%')->orWhere('tags', 'like', '%' . $q . '%');
			})->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);

			return ['images' => $images, 'category' => $category, 'parentCategory' => $parentCategory, 'q' => $q, 'industryId' => $industryId];

		}else{
			// echo "Word Not Found!";

			$category = Categories::where('id', '=', $industryId)->firstOrFail();

			$parentCategory = Categories::where('id', '=', $category->parent_id)->first();
			
			$images   = Images::where('status', 'active')->where('sub_categories_id', $category->id)->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);

			return ['images' => $images, 'category' => $category, 'parentCategory' => $parentCategory, 'industryId' => $industryId];
			
		}
		
	} //<---- End Method

	public static function searchMusicSubIndustryData($q, $industryId, $slug)
	{
		$settings = AdminSettings::first();

		if($slug != ""){
			if($q != ''){

				$category = Categories::where('id', '=', $industryId)->firstOrFail();
	
				$parentCategory = Categories::where('id', '=', $category->parent_id)->first();
				
				$images   = Images::where('status', 'active')->where('is_type','=','audio')->where('sub_categories_id', $category->id)
				->where(function($query) use($q){
					$query->where('title', 'like', '%' . $q . '%')->orWhere('description', 'like', '%' . $q . '%')->orWhere('tags', 'like', '%' . $q . '%');
				})->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);
	
				return ['images' => $images, 'category' => $category, 'parentCategory' => $parentCategory, 'q' => $q, 'industryId' => $industryId];
	
			}else{
				// echo "Word Not Found!";
	
				$category = Categories::where('id', '=', $industryId)->firstOrFail();
	
				$parentCategory = Categories::where('id', '=', $category->parent_id)->first();
				
				$images   = Images::where('status', 'active')->where('is_type','=', 'audio')->where('sub_categories_id', $category->id)->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);
	
				return ['images' => $images, 'category' => $category, 'parentCategory' => $parentCategory, 'industryId' => $industryId];
				
			}
		}else{
			if($q != ''){

				$category = Categories::where('id', '=', $industryId)->firstOrFail();
	
				$parentCategory = Categories::where('id', '=', $category->parent_id)->first();
				
				$images   = Images::where('status', 'active')->where('sub_categories_id', $category->id)
				->where(function($query) use($q){
					$query->where('title', 'like', '%' . $q . '%')->orWhere('description', 'like', '%' . $q . '%')->orWhere('tags', 'like', '%' . $q . '%');
				})->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);
	
				return ['images' => $images, 'category' => $category, 'parentCategory' => $parentCategory, 'q' => $q, 'industryId' => $industryId];
	
			}else{
				// echo "Word Not Found!";
	
				$category = Categories::where('id', '=', $industryId)->firstOrFail();
	
				$parentCategory = Categories::where('id', '=', $category->parent_id)->first();
				
				$images   = Images::where('status', 'active')->where('sub_categories_id', $category->id)->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);
	
				return ['images' => $images, 'category' => $category, 'parentCategory' => $parentCategory, 'industryId' => $industryId];
				
			}
		}
		
		
	} //<---- End Method

	public static function getCategoryImages($slug)
	{

		$settings = AdminSettings::first();

		$category = Categories::where('slug', '=', $slug)->firstOrFail();

		/*if( !$category ) {
			abort('404');
		}*/

		if ($slug == "photographer") {

			$getUserTypeId = Types::where('type_name', '=', $slug)->first(); // getting type details with slug.
			$getUsers = User::where('status', '=', 'active')->where('user_type_id', '=', $getUserTypeId->types_id)->get(); //getting user by type.
			$arrayUsers = array(); //array for users list.
			foreach ($getUsers as $users) //foreach loop on users.
			{
				$GettingUsers = User::find($users->id); //getting specific user.
				$gettingUsersImages = $GettingUsers->images()->count(); //getting specific user image count.
				if ($gettingUsersImages >= 2) //checking user image count should 2 or more than 2.
				{
					array_push($arrayUsers, $GettingUsers); //passing user details into array for users list.
				}
			}
			return ['images' => $arrayUsers]; //returning data to response to ajax request.

		} elseif ($slug == "videographer") {

			$getUserTypeId = Types::where('type_name', '=', $slug)->first(); // getting type details with slug.
			$getUsers = User::where('status', '=', 'active')->where('user_type_id', '=', $getUserTypeId->types_id)->get(); //getting user by type.
			$arrayUsers = array(); //array for users list.
			foreach ($getUsers as $users) //foreach loop on users.
			{
				$GettingUsers = User::find($users->id); //getting specific user.
				$gettingUsersImages = $GettingUsers->images()->where('is_type', '=', 'video')->count(); //getting specific user image count.
				if ($gettingUsersImages >= 1) //checking user image count should 2 or more than 2.
				{
					array_push($arrayUsers, $GettingUsers); //passing user details into array for users list.
				}
			}
			return ['images' => $arrayUsers]; //returning data to response to ajax request.

		} elseif ($slug == "musician") {

			$getUserTypeId = Types::where('type_name', '=', $slug)->first(); // getting type details with slug.
			$getUsers = User::where('status', '=', 'active')->where('user_type_id', '=', $getUserTypeId->types_id)->get(); //getting user by type.
			$arrayUsers = array(); //array for users list.
			foreach ($getUsers as $users) //foreach loop on users.
			{
				$GettingUsers = User::find($users->id); //getting specific user.
				$gettingUsersImages = $GettingUsers->images()->where('is_type', '=', 'audio')->count(); //getting specific user image count.
				if ($gettingUsersImages >= 1) //checking user image count should 2 or more than 2.
				{
					array_push($arrayUsers, $GettingUsers); //passing user details into array for users list.
				}
			}
			return ['images' => $arrayUsers]; //returning data to response to ajax request.

		} elseif ($slug == "animator") {

			$getUserTypeId = Types::where('type_name', '=', $slug)->first(); // getting type details with slug.
			$getUsers = User::where('status', '=', 'active')->where('user_type_id', '=', $getUserTypeId->types_id)->get(); //getting user by type.
			$arrayUsers = array(); //array for users list.
			foreach ($getUsers as $users) //foreach loop on users.
			{
				$GettingUsers = User::find($users->id); //getting specific user.
				$gettingUsersImages = $GettingUsers->images()->where('is_type', '=', 'video')->count(); //getting specific user image count.
				if ($gettingUsersImages >= 1) //checking user image count should 2 or more than 2.
				{
					array_push($arrayUsers, $GettingUsers); //passing user details into array for users list.
				}
			}
			return ['images' => $arrayUsers]; //returning data to response to ajax request.

		} else {
			$images   = Images::where('status', 'active')->where('categories_id', $category->id)->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1)->take(8);
			// return ['images' => $images, 'category' => $category];
			return ['images' => $images];
		}
	} //<---- End Method

	public static function tagsImages($tags)
	{

		$settings = AdminSettings::first();

		$page = request()->get('page');

		$images = Images::where('tags', 'LIKE', '%' . $tags . '%')
			->where('status', 'active')
			->groupBy('id')
			->orderBy('id', 'desc')
			->paginate($settings->result_request)->onEachSide(1);

		$title = trans('misc.tags') . ' - ' . $tags;

		$total = $images->total();

		return ['images' => $images, 'title' => $title, 'total' => $total, 'tags' => $tags];
	} //<---- End Method

	public static function camerasImages($camera)
	{

		$settings = AdminSettings::first();

		$page = request()->get('page');

		$images = Images::where('camera', 'LIKE', '%' . $camera . '%')
			->where('status', 'active')
			->groupBy('id')
			->orderBy('id', 'desc')
			->paginate($settings->result_request)->onEachSide(1);

		$title = trans('misc.photos_taken_with') . ' ' . ucfirst($camera);

		$total = $images->total();

		return ['images' => $images, 'title' => $title, 'total' => $total, 'camera' => $camera];
	} //<---- End Method

	public static function colorsImages($colors)
	{

		$settings = AdminSettings::first();

		$page = request()->get('page');

		$images = Images::where('colors', 'LIKE', '%' . $colors . '%')
			->where('status', 'active')
			->groupBy('id')
			->orderBy('id', 'desc')
			->paginate($settings->result_request)->onEachSide(1);

		$title = trans('misc.colors') . ' #' . $colors;

		$total = $images->total();

		return ['images' => $images, 'title' => $title, 'total' => $total, 'colors' => $colors];
	} //<---- End Method

	public static function userImages($id)
	{

		$settings = AdminSettings::first();

		$images      = Images::where('user_id', $id)
			->where('status', 'active')
			->groupBy('id')
			->orderBy('id', 'desc')
			->paginate($settings->result_request)->onEachSide(1);

		return $images;
	} //<---- End Method

	public static function premiumImages()
	{

		$settings = AdminSettings::first();

		$data = Images::where('item_for_sale', 'sale')->where('status', 'active')->orderBy('id', 'DESC')->paginate($settings->result_request)->onEachSide(1);

		return $data;
	} //<---- End Method

}
