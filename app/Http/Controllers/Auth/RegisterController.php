<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Types;
use Validator;
use App\Models\AdminSettings;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Routes;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use GetStream\StreamChat\Client as StreamClient;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      $settings = AdminSettings::first();
      $data['_captcha'] = $settings->captcha;

		$messages = array (
			"letters"    => trans('validation.letters'),
      'g-recaptcha-response.required_if' => trans('misc.captcha_error_required'),
      'g-recaptcha-response.captcha' => trans('misc.captcha_error'),
        );

		 Validator::extend('ascii_only', function($attribute, $value, $parameters){
    		return !preg_match('/[^x00-x7F\-]/i', $value);
		});

		// Validate if have one letter
	Validator::extend('letters', function($attribute, $value, $parameters){
    	return preg_match('/[a-zA-Z0-9]/', $value);
	});

        return Validator::make($data, [
            'username'  => 'required|min:3|max:15|ascii_only|alpha_dash|letters|unique:users|unique:pages,slug|unique:reserved,name',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'agree_gdpr' => 'required',
            'g-recaptcha-response' => 'required_if:_captcha,==,on|captcha'
        ],$messages);
    }

	public function showRegistrationForm()
  {
      $settings = AdminSettings::first();
       
      $types = Types::where('mode','=','on')->get();

    //   $getCountries = Country::select('country.*')->join('cities','country.id','=','cities.country_id')->join('routes', 'cities.id','=','routes.city_id')->where('country.is_active', '=', '1')->groupBy('country.id')->get();
      // $getCities    = Cities::where('is_active', '=', '1')->get();
    //   $getCountries = Country::select('country.*')->join('cities','country.id','=','cities.country_id')->where('country.is_active', '=', '1')->groupBy('country.id')->get();
      $getCountries = DB::table('new_countries')->select('new_countries.*')->join('new_cities','new_countries.id','=','new_cities.country_id')->where('new_countries.is_active', '=', '1')->groupBy('new_countries.id')->get();
// dd($getCountries);
		if($settings->registration_active == '1')	{
			return view('auth.register', compact('types', 'getCountries'));
		} else {
			return redirect('/');
		}
  }


  public function getCityByCountryId($countryId)
	{

    // $getCities = Cities::select('cities.*')->join('routes', 'cities.id','=','routes.city_id')->where('cities.country_id', '=', $countryId)->where('cities.is_active', '=', '1')->orderBy('cities.city_name', 'ASC')->groupBy('cities.id')->get();
    $getCities = DB::table('new_cities')->select('new_cities.*')->where('new_cities.country_id', '=', $countryId)->where('new_cities.is_active', '=', '1')->orderBy('new_cities.name', 'ASC')->groupBy('new_cities.id')->get();
    // dd($getCities);
		echo json_encode($getCities);
  }
  
  public function getRouteByCityId($cityId)
  {
    $getRoutes = Routes::where('city_id','=',$cityId)->where('is_active','=','1')->orderBy('route_name','ASC')->get();
    // dd($getRoutes);
		echo json_encode($getRoutes);
  }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      $settings    = AdminSettings::first();

      // Verify Settings Admin
      if( $settings->email_verification == '1' ) {

        $confirmation_code = str_random(100);
        $status = 'pending';

        //send verification mail to user
        $_username      = $data['username'];
        $_email_user    = $data['email'];
        $_title_site    = $settings->title;
        $_email_noreply = $settings->email_no_reply;

        Mail::send('emails.verify', array('confirmation_code' => $confirmation_code),
        function($message) use (
            $_username,
            $_email_user,
            $_title_site,
            $_email_noreply
        ) {
            $message->from($_email_noreply, $_title_site);
            $message->subject(trans('users.title_email_verify'));
            $message->to($_email_user,$_username);
        });

      } else {
        $confirmation_code = '';
        $status            = 'active';
      }

      $token   = str_random(75);
      $userIP = request()->ip();

      // var_dump($data['country_id']);
      // var_dump($data['city_id']);
      // var_dump($data['route_id']);

      // if(count($data['route_id']) > 0)
      // die;

      if(isset($data['perHour'])){
        $perHour = $data['perHour'];
      }else{
        $perHour = '';
      }

    //   if(isset($data['route_id'])){
          
    //     $implodeRoutesData = implode(",", $data['route_id']);
    //   }else{
    //     $implodeRoutesData = "";
    //   }
  

      // create the user to Stream Chat
    //   $client = new StreamClient(
    //     getenv("STREAM_API_KEY"), 
    //     getenv("STREAM_API_SECRET"),
    //     null,
    //     null,
    //     9 // timeout
    // );
    // var_dump(getenv("STREAM_API_KEY"), getenv("STREAM_API_SECRET"));
    // $userStream = [
    //     'id' => preg_replace('/[@\.]/', '_', $data['email']),
    //     'name' => $data['username'],
    //     'role' => 'admin'
    // ];
    
    // $client->updateUser($userStream);

      return User::create([
        'username'          => $data['username'],
        'name'              => '',
        'bio'               => '',
        'password'          => bcrypt($data['password']),
        'email'             => strtolower($data['email']),
        'avatar'            => 'default.jpg',
        'cover'             => 'cover.jpg',
        'status'            => $status,
        'type_account'      => '1',
        'website'           => '',
        'twitter'           => '',
        'paypal_account'    => '',
        'activation_code'   => $confirmation_code,
        'oauth_uid'         => '',
        'oauth_provider'    => '',
        'token'             => $token,
        'ip'                => $userIP,
        'user_type_id'      => $data['user_type'],
        'country_id'        => $data['country_id'],
        'city_id'           => $data['city_id'],
        // 'route_id'          => $implodeRoutesData,
        'per_hour'          => $perHour
      ]);
    }
}
