<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\PasswordReset;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }
    
    public function forgotPassword()
    {
        return view('auth.passwords.email');
    }

    public function forgotPasswordProcess(Request $request){

        // dd($request);
        $email = $request->email;
        // Get some random bytes
        $token = random_bytes(8);
        // Since random_bytes() returns a string with all kinds of bytes, 
        // it can't be presented "as is".
        // We need to convert it to a better format. Let's use hex
        $token = bin2hex($token);

        $user      = User::where('email','=', $email)->first();
        if($user != NULL){

            $saveToken = PasswordReset::create([
                'token' => $token,
                'email' => $email,
                'created_at' => date('Y-m-d')
            ]);
            
            $userName = $user->username;
            $to_name = $userName;
            $to_email = $email;
            $data = array('name'=>$to_name, 'body' => 'A test mail', 'token' => $token, 'email' => $email);
            try{
                Mail::send('emails.password_reset', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                ->subject(trans('emails.password_reset'));
                $message->from('info@artstockunited.com','ArtStock United');
                });
            }catch(\Exception $e){}

            // dd('email sent');
            \Session::flash('notification','Check your email for reset password.');
            return redirect('/');
        }else{

            // dd('in else');
            //Email Address not exists.
            \Session::flash('status','Email not exist');
            return redirect('/forget_password');
        }
        
    }
    
    public function checkEmailAddress($email){
        $user = User::where('email','=', $email)->first();
        if($user != NULL){
            // \Session::flash('status','User Exist');
            echo json_encode(true);
        }else{
            \Session::flash('status','Email Not Exist');
            echo json_encode(false);
        }
    }

    public function resetPassword($token)
    {
        // dd($token);
        $checkToken = PasswordReset::where('token','=', $token)->first();
        // dd($checkToken);
        if($checkToken != NULL){
            $emailAddress = $checkToken->email;
            return view('auth.passwords.reset', compact('emailAddress','token'));
        }else{
            // dd('Token Not Exist');
            return redirect('/');
        }
    }

    public function resetPasswordProcess(Request $request)
    {
        $token = $request->token;
        $email = $request->email;
        $password = $request->password;
        $cPassword = $request->password_confirmation;
        
        if($cPassword == $password){
            // dd($password);
            $bcryptPassword = bcrypt($password);
            $updatePassword = User::where('email','=', $email)->update(['password' => $bcryptPassword]);
            if($updatePassword){
                
                $removeToken = PasswordReset::where('token','=',$token)->delete();
                // dd($removeToken);
                if($removeToken){
    
                    \Session::flash('notification','Password Changed Successfully');
                    return redirect('login');
                }
            }else{
                //failed to update.
               return redirect('/');
            }
        }else{
                    \Session::flash('status','Password and confirm password not match');
                    return redirect('/password/resets/'. $token);
        }
    }
    
}
