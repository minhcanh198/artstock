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
use App\Models\PhotoshootType;
use App\Models\Routes;
use App\Models\Query;
use App\Models\Collections;
use App\Models\Continents;
use App\Models\TimeDay;
use App\Models\TripReason;
use App\Models\Package;
use App\Models\PreferredStylePhoto;
use App\Models\LevelOfDirection;
use App\Models\Booking;
use App\Models\Types;
use DB;
use PhpParser\Node\Expr\New_;

class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct() {

	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

    }// End Method

    // public function requestToBook()
    // {
    //     return view('new_template.request_to_book');
    // }

    // public function requestToBook($userId, $cityId = null, $preferred_date = null, $preferred_time_of_day = null)

    public function getArtistByCityIdPhotoShoot($cityId, $photoShootId){


        $getPhotoShootDetails = PhotoshootType::where('id','=', $photoShootId)->first();
        $getArtist = User::join('types', 'types.types_id','=','users.user_type_id')->where('city_id','=',$cityId)->where('users.user_type_id','=', $getPhotoShootDetails->types_id)->get();

        if(count($getArtist) > 0){
            echo json_encode($getArtist);
        }else{
            echo json_encode("not artist found");
        }
    }

    public function getArtistByCityId($cityId){

        $getArtist = User::where('city_id','=',$cityId)->get();

        if(count($getArtist) > 0){
            echo json_encode($getArtist);
        }else{
            echo json_encode("not artist found");
        }
    }

    public function requestToBook(Request $request)
	{
        // return view('new_template.hire_more');
        // dd($request->photographer);
        // dd(\Request::query('photographerId'));

        if(\Request::query('photographerId') != null){
            $getUserDetails = User::where('id','=', \Request::query('photographerId'))->first();

            $userTypeId = $getUserDetails->user_type_id;

            $getTypeDetails = Types::where('types_id','=', $userTypeId)->first();
            $photoshootTypes = PhotoshootType::where('types_id','=', $userTypeId)->get();
        }else{
            $getUserDetails = null;
            $getTypeDetails = null;
            $photoshootTypes = PhotoshootType::get();
        }

        
        
		return view('new_template.request_to_book', compact('photoshootTypes', 'getUserDetails', 'getTypeDetails'));
    }
    
    public function requestToBookStepOne(Request $request)
    {
        // dd($request->isMethod('post'));
        
        if($request->isMethod('post')){
            $photographerId         = $request->photographerId;
            $photoshootId           = $request->photoshootId;
            $cityId                 = $request->cityId;
            $datePreferedData       = $request->DatePrefered;
            $timeOfDayData          = $request->timeOfDay;

            if($photographerId      != ""){
                $getUserData        = User::where('id','=', $photographerId)->first();
                // dd($getUserData);
                $userTypeId         = $getUserData->user_type_id;
                $getTypeDetails = Types::where('types_id','=', $userTypeId)->first();
            }else{
                $getUserData        = null;
                $getTypeDetails = null;
            }
// dd($cityId);
            if($cityId              != ""){

                // $getCityAndCountry  = Cities::select('cities.*', 'country.id as CountryId','country.country_name as countryName')->join('country', 'country.id','=','cities.country_id')->where('cities.id','=', $cityId)->first();
                $getCityAndCountry  = DB::table('new_cities')->select('new_cities.*', 'new_countries.id as CountryId','new_countries.name as countryName')->join('new_countries', 'new_countries.id','=','new_cities.country_id')->where('new_cities.id','=', $cityId)->first();
            }else{
                // $getCityAndCountry  = Cities::orderBy('city_name')->get();
                $getCityAndCountry  = DB::table('new_cities')->select('new_cities.*', 'new_countries.id as CountryId','new_countries.name as countryName')->join('new_countries', 'new_countries.id','=','new_cities.country_id')->where('country_id','=',$getUserData->country_id)->get();
                
// dd($getCityAndCountry);
            }
            $getCountry  = DB::table('new_countries')->select('new_countries.*')->get();
//             var_dump($cityId);

// dd($getCityAndCountry);
            if($datePreferedData    != ""){

                $datePrefered       = $datePreferedData;

            }else{

                $datePrefered       = null; 

            }

            if($timeOfDayData       != ""){
                $timeOfDay          = $timeOfDayData;
            }else{
                $timeOfDay          = null;
            }

            $getTimeOfDay           = TimeDay::get();
            $getCalendarData        = DB::table('booking_calendar')->first();

            return view('new_template.request_to_book_step_one',compact('getUserData', 'getTypeDetails', 'timeOfDay', 'datePrefered', 'getCityAndCountry', 'getTimeOfDay', 'getCalendarData', 'photoshootId', 'photographerId', 'cityId', 'getCountry'));
        }else{
            return redirect('request-to-book');
        }
    }

    public function requestToBookStepTwo(Request $request)
    {
        
        if($request->isMethod('post')){
            $photographerId     = $request->photographerId;
            $photoshootId       = $request->photoshootId;
            $cityId             = $request->cityId;
            $countryId             = $request->countryId;
            $datePrefered       = $request->DatePrefered;
            $timeDay            = $request->timeOfDay;

            $getTripReason      = TripReason::get();
            // $getPackage         = Package::get();
            // var_dump($photographerId);
            $getPackage         = Package::where('artist_id','=', $photographerId)->get();
// dd($getPackage);
            // dd($photographerId);
            $getUserData        = User::where('id','=', $photographerId)->first();
            $userTypeId         = $getUserData->user_type_id;
            $getTypeDetails = Types::where('types_id','=', $userTypeId)->first();

            // $getCityAndCountry  = Cities::select('new_cities.*', 'new_countries.id as CountryId','new_countries.name as countryName')->join('new_countries', 'new_countries.id','=','new_cities.country_id')->where('new_cities.id','=', $cityId)->first();
            $getCityAndCountry  = DB::table('new_cities')->select('new_cities.*', 'new_countries.id as CountryId','new_countries.name as countryName')->join('new_countries', 'new_countries.id','=','new_cities.country_id')->where('new_cities.id','=', $cityId)->first();
            // dd($getCityAndCountry);
            return view('new_template.request_to_book_step_two',compact('getUserData', 'getTypeDetails', 'getCityAndCountry', 'timeDay', 'datePrefered', 'getTripReason', 'getPackage', 'photoshootId', 'photographerId', 'cityId', 'countryId'));
        }else{
            return redirect('request-to-book');
        }
        
    }

    public function requestToBookStepThree(Request $request)
    {
        if($request->isMethod('post')){
            $photographerId                 = $request->photographerId;
            $photoshootId                   = $request->photoshootId;
            $countryId                         = $request->countryId;
            $cityId                         = $request->cityId;
            $datePrefered                   = $request->DatePrefered;
            $timeDay                        = $request->timeOfDay;

            $adultsCount                    = $request->adultsCounters;
            $childrenCount                  = $request->childrenCounters;
            $infantsCount                   = $request->infantsCounters;
            // $tripReasonId                   = $request->trip_reason;
            $packageId                      = $request->package;
            $timeRestrictionDescription     = $request->time_restrictions_description;

            $getUserData                    = User::where('id','=', $photographerId)->first();
            $userTypeId                     = $getUserData->user_type_id;
            $getTypeDetails                 = Types::where('types_id','=', $userTypeId)->first();
            // $getCityAndCountry              = Cities::select('new_cities.*', 'new_countries.id as CountryId','new_countries.country_name as countryName')->join('new_countries', 'new_countries.id','=','new_cities.country_id')->where('new_cities.id','=', $cityId)->first();
            $getCityAndCountry              = DB::table('new_cities')->select('new_cities.*', 'new_countries.id as CountryId','new_countries.name as countryName')->join('new_countries', 'new_countries.id','=','new_cities.country_id')->where('new_cities.id','=', $cityId)->first();
            $getRoutes                      = Routes::where('city_id','=', $cityId)->get();
            
            $getPreferredStylePhoto         = PreferredStylePhoto::get();
            $getLevelOfDirection            = LevelOfDirection::get();

            // return view('new_template.request_to_book_step_three', compact('getUserData', 'getCityAndCountry', 'getRoutes', 'getPreferredStylePhoto', 'getLevelOfDirection', 'photographerId', 'photoshootId', 'cityId', 'datePrefered', 'timeDay', 'adultsCount', 'childrenCount', 'infantsCount', 'tripReasonId', 'packageId', 'timeRestrictionDescription'));
            return view('new_template.request_to_book_step_three', compact('getUserData', 'getTypeDetails', 'getCityAndCountry', 'getRoutes', 'getPreferredStylePhoto', 'getLevelOfDirection', 'photographerId', 'photoshootId', 'cityId', 'countryId', 'datePrefered', 'timeDay', 'adultsCount', 'childrenCount', 'infantsCount', 'packageId', 'timeRestrictionDescription'));
        }else{
            return redirect('request-to-book');
        }

    }

    public function requestToBookComplete(Request $request){
        
        $photoShootId                   = $request->photoshootId;
        $getPhotoShootData              = PhotoshootType::where('id', '=', $photoShootId)->first();
        $photoShootValue                = $getPhotoShootData->photoshoot_name;   
        $photographerId                 = $request->photographerId;
        $countryId                         = $request->countryId;
        $cityId                         = $request->cityId;
        $datePreferred                  = $request->DatePrefered;
        $timeDay                        = $request->timeOfDay;
        $getTimeOfDayData               = TimeDay::where('id', '=', $timeDay)->first();
        $timeOfDayValue                 = $getTimeOfDayData->time_of_day;
        $adultsCount                    = $request->adultsCount;
        $childrenCount                  = $request->childrenCount;
        $infantsCount                   = $request->infantsCount;
        // $tripReasonId                   = $request->tripReasonId;
        // $getTripReasonData              = TripReason::where('id', '=', $tripReasonId)->first();
        // $tripReasonValue                = $getTripReasonData->trip_reason_name;
        $packageId                      = $request->packageId;
        $getPackageData                 = Package::where('id', '=', $packageId)->first();
        $packageHoursValue              = $getPackageData->hours;
        $packageMinutesValue            = $getPackageData->minutes;
        $packagePriceValue              = $getPackageData->price;
        $packageNoOFPhotosValue         = $getPackageData->number_of_photos;
        $timeRestrictionDescription     = $request->timeRestrictionDescription;
        $routeId                        = $request->getRouteId;
        $describeRoute                  = $request->describe_specific_location_route;
        $meetingArtist                  = $request->address_meet_artist;
        $importantInformationForArtist  = $request->important_information_for_artist;
        $preferredStylePhoto            = $request->preferred_style_photo;
        $preferredStylePhotoData        = PreferredStylePhoto::where('id', '=', $preferredStylePhoto)->first();
        // dd($preferredStylePhotoData);
        if($preferredStylePhotoData != null){
            $preferredStylePhotoValue       = $preferredStylePhotoData->name;
        }else{
            $preferredStylePhotoValue       = null;
        }
        // $levelOfDirection               = $request->level_of_direction;
        // $levelOfDirectionData           = LevelOfDirection::where('id', '=', $levelOfDirection)->first();
        // $levelOfDirectionValue          = $levelOfDirectionData->name;
        $referenceNo                    = mt_rand(100000, 999999);

        // echo '<pre>';
        // var_dump("photoShootValue ======>". $photoShootValue);
        // var_dump("cityId ======>". $cityId);
        // var_dump("photographerId ======>". $photographerId);
        // var_dump("datePreferred ======>". $datePreferred);
        // var_dump("timeOfDayValue ======> ". $timeOfDayValue);
        // var_dump("adultsCount ======> ". $adultsCount);
        // var_dump("childrenCount ======> ". $childrenCount);
        // var_dump("infantsCount ======> ". $infantsCount);
        // var_dump("tripReasonValue ========> ". $tripReasonValue);
        // var_dump("packageHoursValue =======> ". $packageHoursValue);
        // var_dump("packageMinutesValue ========> ". $packageMinutesValue);
        // var_dump("packagePriceValue =========>". $packagePriceValue);
        // var_dump("packageNoOFPhotosValue ======> ". $packageNoOFPhotosValue);
        // var_dump("timeRestrictionDescription ======> ". $timeRestrictionDescription);
        // var_dump("routeId ======> ". $routeId);
        // var_dump("describeRoute ======> ". $describeRoute);
        // var_dump("meetingArtist ======> ". $meetingArtist);
        // var_dump("importantInformationForArtist ======> ". $importantInformationForArtist);
        // var_dump("preferredStylePhotoValue =======> ". $preferredStylePhotoValue);
        // var_dump("levelOfDirectionValue ========> ". $levelOfDirectionValue);
        // die();
        $booking                                = New Booking();
        $booking->reference_no                  = $referenceNo;
        $booking->photoshoot_type               = $photoShootValue; 
        $booking->country_id                       = $countryId;
        $booking->city_id                       = $cityId;
        $booking->artist_id                     = $photographerId;
        $booking->requested_date                = $datePreferred;
        $booking->requested_time                = $timeOfDayValue;
        $booking->participants_adults_count     = $adultsCount;
        $booking->participants_children_count   = $childrenCount;
        $booking->participants_infants_count    = $infantsCount;
        // $booking->trip_reason                   = $tripReasonValue;
        $booking->package_hours                 = $packageHoursValue;
        $booking->package_minutes               = $packageMinutesValue;
        $booking->package_price                 = $packagePriceValue;
        $booking->package_number_of_photos      = $packageNoOFPhotosValue;
        $booking->time_restriction              = $timeRestrictionDescription;
        $booking->route_id                      = $routeId;
        $booking->describe_route                = $describeRoute;
        $booking->requested_meeting_location    = $meetingArtist;
        $booking->important_information         = $importantInformationForArtist;
        $booking->preferred_style               = $preferredStylePhotoValue;
        // $booking->level_of_direction            = $levelOfDirectionValue;
        $booking->customer_id                   = Auth::user()->id;
        $booking->status                        = 'pending';
        $booking->save();

        \Session::flash('success_message', 'Your booking request is sent');

    	return redirect('user/dashboard');



    }

    public function getTimeDate()
    {
        $getTimeDay = TimeDay::get();

        if(count($getTimeDay)  > 0){
            echo json_encode($getTimeDay);
        }else{
            echo json_encode('false');
        }
    }

}
