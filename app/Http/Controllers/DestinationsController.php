<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input as Input;
use App\Http\Requests;
use App\Models\User;
use App\Models\RequestSuggestCountryCity;
use App\Models\SuggestCityPageSettings;
use App\Models\Images;
use Illuminate\Http\Request;
use App\Models\AdminSettings;
use App\Models\HomePageSettings;
use App\Models\DestinationPageSettings;
use App\Models\Categories;
use App\Models\Cities;
use App\Models\Routes;
use App\Models\Query;
use App\Models\Collections;
use App\Models\Continents;
use DB;

class DestinationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct(DestinationPageSettings $destinationPageSettings) {
		$this->destinationPageSettings = $destinationPageSettings::first();
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $destinationPageData    = DestinationPageSettings::first();
    
        $getContinent           = Continents::get();

        $getCities              = Cities::where('city_img','!=','')->orderBy('city_name','ASC')->limit(8)->get();
		
		
		
		

		
		// return view(
      	// 'new_template.home', [
    	// //   'index.home', [
		// 'homePageSettings' => $homePageData,
        // 'categories'       => $categories,
        // 'images'           => $images,
        // 'featured'         => $featured,
		// 'categoryPopular'  => $categoryPopular,
		// 'categoriesList'   => $getCategoriesList,
		// // 'userArtistList'   => $getUserArtistList
		// 'userArtistListPhotographer'   => $getUserArtistListPhotographer,
		// 'userArtistListAnimator'   => $getUserArtistListAnimator,
		// 'userArtistListVideographer'   => $getUserArtistListVideographer,
		// 'userArtistListMusician'   => $getUserArtistListMusician,
		// 'totalArtistCount' => $totalArtistCount
        // ]);
          
        return view(
            'new_template.destinations', [
            'destinationPageSettings' => $destinationPageData,
            'allContinents'           => $getContinent,
            'getCities'               => $getCities
        ]);

    }// End Method

    public function searchDestination(Request $request)
    {
        $country = $request->countryDes;
        $city = $request->cityDes;
        // var_dump($country);
        // var_dump($city);
        // die;
        if($city !== ""){

            // $getRoutes = Routes::where('country_id','=', $country)->where('city_id','=', $city)->where('is_active','=', '1')->get();
            // $getUsers = User::where('country_id','=', $country)->where('city_id','=', $city)->where('user_type_id','!=', 0)->where('status','=','active')->get();

            $getUsers = User::where('status', '=', 'active')->where('user_type_id', '!=', '0')->get(); //getting user by type.
			$arrayUsers = array(); //array for users list.
			$arrayUserss = array(); //array for users list.
			foreach ($getUsers as $users) //foreach loop on users.
			{

				// $query = "SELECT
				// users.*, types.type_name,
				// (case when (images.is_type = 'image' and images.`status`= 'active') then images.thumbnail else 0 end) as img,
				// (case when (images.is_type = 'video' and images.`status`= 'active') then images.thumbnail else 0 end) as vid,
				// (case when (images.is_type = 'animation' and images.`status`= 'active') then images.thumbnail else 0 end) as ani,
				// CONCAT('screen-shot-',(case when (images.is_type = 'video') then REPLACE(images.thumbnail, images.extension, 'png') else '' end)) as ScreenShot,
				// images.is_type
				// FROM
				// `users`
				// INNER JOIN `types` ON `types`.`types_id` = `users`.`user_type_id`
				// INNER JOIN `images` ON `images`.`user_id` = `users`.`id`";

// $query = "SELECT users.*, types.type_name,(SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'image' AND `user_id` = users.`id` LIMIT  4) AS img,images.is_type FROM `users` INNER JOIN `types` ON `types`.`types_id` = `users`.`user_type_id` INNER JOIN `images` ON `images`.`user_id` = `users`.`id`";


                $query = "SELECT users.*, types.type_name, new_countries.name AS CountryName, (SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'image' AND `user_id` = users.`id` LIMIT  4) AS img, 
 	            (SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'video' AND `user_id` = users.`id` LIMIT  4) AS vid,
 	            (SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'video' AND `user_id` = users.`id` LIMIT  4) AS ani,
 	            (SELECT GROUP_CONCAT(`images`.`thumbnail`) FROM `images` WHERE `is_type`  = 'audio' AND `user_id` = users.`id` LIMIT  1) AS mus,
	            images.is_type FROM `users` INNER JOIN `types` ON `types`.`types_id` = `users`.`user_type_id` INNER JOIN `images` ON `images`.`user_id` = `users`.`id` INNER JOIN `new_countries` ON `new_countries`.`id` = `users`.`country_id`";
				if (Auth::user() !== null) {
					$query .= " WHERE users.`user_type_id` != 0 AND users.`id` = " . $users->id . " AND users.`status` = 'active' AND users.`country_id` = " . $country . " AND users.`city_id` = " . $city . " AND users.`id` != " . Auth::user()->id . " GROUP BY users.id";
				} else {
					$query .= " WHERE users.`user_type_id` != 0 AND users.`id` = " . $users->id . " AND users.`status` = 'active' AND users.`country_id` = " . $country . " AND users.`city_id` = " . $city . " GROUP BY users.id";
				}
				$GettingUsers =  \DB::select($query);


        // dd($GettingUsers->toSql());
				if (!empty($GettingUsers)) {

					array_push($arrayUsers, $GettingUsers);
				}
			}
			
			// return ['images' => $arrayUsers, 'img' => $arrayUserss]; //returning data to response to ajax request.
            echo json_encode($arrayUsers);

        }else{

            // $getRoutes = Routes::where('country_id','=', $country)->where('is_active','=', '1')->get();
            // $getUsers = User::where('country_id','=', $country)->where('status','=', 'active')->get();

            $getUsers = User::where('status', '=', 'active')->where('user_type_id', '!=', '0')->get(); //getting user by type.
            // dd($getUsers);
			$arrayUsers = array(); //array for users list.
			$arrayUserss = array(); //array for users list.
			foreach ($getUsers as $users) //foreach loop on users.
			{

				// $query = "SELECT
				// users.*, types.type_name,
				// (case when (images.is_type = 'image' and images.`status`= 'active') then images.thumbnail else 0 end) as img,
				// (case when (images.is_type = 'video' and images.`status`= 'active') then images.thumbnail else 0 end) as vid,
				// (case when (images.is_type = 'animation' and images.`status`= 'active') then images.thumbnail else 0 end) as ani,
				// CONCAT('screen-shot-',(case when (images.is_type = 'video') then REPLACE(images.thumbnail, images.extension, 'png') else '' end)) as ScreenShot,
				// images.is_type
				// FROM
				// `users`
				// INNER JOIN `types` ON `types`.`types_id` = `users`.`user_type_id`
				// INNER JOIN `images` ON `images`.`user_id` = `users`.`id`";
    // (SELECT CONCAT('screen-shot-',(case when (images.is_type = 'video') then REPLACE(images.thumbnail, images.extension, 'png') else '' end))) as ScreenShot,
 	          //  (SELECT GROUP_CONCAT(REPLACE(`images`.`preview`, `images`.`extension`, 'png')) FROM `images` WHERE `is_type`  = 'video' AND `user_id` = users.`id` LIMIT  4) AS vid,
 	          //  (SELECT GROUP_CONCAT(REPLACE(`images`.`preview`, `images`.`extension`, 'png')) FROM `images` WHERE `is_type`  = 'video' AND `user_id` = users.`id` LIMIT  4) AS ani,
	        $query = "SELECT users.*, types.type_name, new_countries.name AS CountryName, (SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'image' AND `user_id` = users.`id` LIMIT  4) AS img, 
 	            (SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'video' AND `user_id` = users.`id` LIMIT  4) AS vid,
 	            (SELECT GROUP_CONCAT(`images`.`preview`) FROM `images` WHERE `is_type`  = 'video' AND `user_id` = users.`id` LIMIT  4) AS ani,
 	            (SELECT GROUP_CONCAT(`images`.`thumbnail`) FROM `images` WHERE `is_type`  = 'audio' AND `user_id` = users.`id` LIMIT  1) AS mus,
	            images.is_type FROM `users` INNER JOIN `types` ON `types`.`types_id` = `users`.`user_type_id` INNER JOIN `images` ON `images`.`user_id` = `users`.`id` INNER JOIN `new_countries` ON `new_countries`.`id` = `users`.`country_id`";
				if (Auth::user() !== null) {
					$query .= " WHERE users.`user_type_id` != 0 AND users.`id` = " . $users->id . " AND users.`status` = 'active' AND users.`country_id` = " . $country . " AND users.`id` != " . Auth::user()->id . " GROUP BY users.id";
				} else {
					$query .= " WHERE users.`user_type_id` != 0 AND users.`id` = " . $users->id . " AND users.`status` = 'active' AND users.`country_id` = " . $country . " GROUP BY users.id";
				}
				$GettingUsers =  \DB::select($query);
				// $query->toSql();
				
				

				if (!empty($GettingUsers)) {

					array_push($arrayUsers, $GettingUsers);
				}
			}
			
// 			dd($arrayUsers);
            // return ['images' => $arrayUsers, 'img' => $arrayUserss]; //returning data to response to ajax request.
            echo json_encode($arrayUsers);    
        }

        
    }

    public function getCityByCountryId($countryId)
	{

    // $getCities = Cities::select('cities.*')->where('cities.country_id', '=', $countryId)->where('cities.is_active', '=', '1')->orderBy('cities.city_name', 'ASC')->groupBy('cities.id')->get();
    $getCities = \DB::table('new_cities')->select('new_cities.*')->where('new_cities.country_id', '=', $countryId)->where('new_cities.is_active', '=', '1')->orderBy('new_cities.name', 'ASC')->groupBy('new_cities.name')->get();
    // dd($getCities);
		echo json_encode($getCities);
  }
    
    public function cityDestinations($cityNameSlug)
    {
        $getCityDetails = Cities::where('city_slug','=', $cityNameSlug)->first();
        $getUsersByCity = User::where('city_id','=', $getCityDetails->id)->where('user_type_id','!=', 0)->where('status','=','active')->get();
        $getRoutesByCity = Routes::where('city_id','=', $getCityDetails->id)->where('is_active','=', '1')->get();
        // print_r($getCityDetails);
        // print_r($getUsersByCity);
        // print_r($getRoutesByCity);
        // die;
        return view('new_template.destinations_city',[
            'getCityDetails'    => $getCityDetails,
            'getUsersByCity'    => $getUsersByCity,
            'getRoutesByCity'   => $getRoutesByCity
        ]);
    }

    public function routeDestinations($cityNameSlug, $routeNameSlug)
    {
        $getRouteDetails = Routes::where('route_slug','=', $routeNameSlug)->first();
        $getCityDetails  = Cities::where('city_slug','=', $cityNameSlug)->first();
        $getRoutesByCity = Routes::where('city_id','=', $getCityDetails->id)->where('route_slug','!=', $routeNameSlug)->where('is_active','=', '1')->get();
        if($getRouteDetails != null){
            $getUsersByCityAndRoute = \DB::table("users")->select("users.*")->whereRaw("find_in_set('$getRouteDetails->id',route_id)")->get();
        }else{
            $getUsersByCityAndRoute = "";
        }
        return view('new_template.destinations_route',[
            'getRouteDetails'   => $getRouteDetails,
            'getCityDetails'    => $getCityDetails,
            'getUsers'          => $getUsersByCityAndRoute,
            'getRoutesByCity'   => $getRoutesByCity
        ]);
    }

    public function suggestACity()
    {

        $suggestCityPageSettings = SuggestCityPageSettings::first();
        return view('new_template.suggest_a_city',[
            'suggestCityPageSettings'   => $suggestCityPageSettings
        ]);
    }

    public function requestSuggestCity(Request $request)
    {
        // dd($request);
        $countryName = $request->country;
        $cityName = $request->city;
        $emailAddress = $request->emailAddress;
        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $plannedDate = $request->planned_date;

        $sql                = New RequestSuggestCountryCity();
		$sql->country       = $countryName;
		$sql->city          = $cityName;
		$sql->email         = $emailAddress;
		$sql->first_name    = $firstName;
		$sql->last_name     = $lastName;
		$sql->planned_date  = $plannedDate;
        $sql->save();
        return redirect('destinations/thankyou/suggest/');
    }

    public function thankyouSuggest()
    {
        $suggestCityPageSettings = SuggestCityPageSettings::first();
        return view('new_template.suggest_thankyou',[
            'suggestCityPageSettings'   => $suggestCityPageSettings
        ]);
    }
	// public function destinations()
	// {
	// 	return view('new_template.destinations');
	// }

    public function getUsersByCityRoute($slug, $cityRoute)
    {
        if($cityRoute == "city"){

            $getSlugDetails = Cities::where('city_slug','=', $slug)->first();
        }
        
        if($cityRoute == "route"){
            
            $getSlugDetails = Routes::where('route_slug','=', $slug)->first();

        }
        // $getUsersByCity = User::join('types', 'types.types_id','=','users.user_type_id')->where('city_id','=', $getCityDetails->id)->where('user_type_id','!=', 0)->where('status','=','active')->toSql();
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
        if($cityRoute == "city"){

            $query .= " WHERE users.`city_id` =  $getSlugDetails->id";
        }

        if($cityRoute == "route"){

            $query .= " WHERE users.`route_id` LIKE '%$getSlugDetails->id%'";
        }

        if(Auth::user() != null){

            $query .=" AND users.`user_type_id` != 0 AND users.`status` = 'active' AND users.`id` != " . Auth::user()->id . " GROUP BY users.id";
        }else{
            $query .=" AND users.`user_type_id` != 0 AND users.`status` = 'active' GROUP BY users.`id`";
        }
        // dd(Auth::user());

        $getUsersByCity =  \DB::select($query);
        
      
        return response()->json([
            'getUserArtistList' => $getUsersByCity
        ], 200);
    }
	

}
