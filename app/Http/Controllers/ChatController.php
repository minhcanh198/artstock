<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use GetStream\StreamChat\Client as StreamClient;
use App\Models\User;
use App\Models\Channel;
use Session;

class ChatController extends Controller
{
    protected $client;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client =  new StreamClient(
            getenv("STREAM_API_KEY"), 
            getenv("STREAM_API_SECRET"),
            null,
            null,
            9 // timeout
        );
    }

    /**
     * Generate Token from Stream Chat
     */
    public function getnerateToken(Request $request)
    {
        return response()->json([
            'token' => $this->client->createToken($request->input('username'))
        ], 200);
    }

    /**
     * Get all users
     */
    public function getUsers(Request $request)
    {

        return response()->json([
            'users' => User::select('users.*','types.type_name','types.types_id')->join('types', 'users.user_type_id', '=', 'types.types_id')->where('users.id','!=', Auth::user()->id)->get()
        ], 200);
    }

    public function getUsersAll(Request $request)
    {
        $user = Auth::user();        
        
        if($user == null){


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
            $query .=" AND users.`user_type_id` != 0 AND users.`user_type_id` = 1 AND users.`status` = 'active' GROUP BY users.id LIMIT 2";


                
            $queryAnimator = "SELECT
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
            $queryAnimator .=" AND users.`user_type_id` != 0 AND users.`user_type_id` = 2 AND users.`status` = 'active' GROUP BY users.id LIMIT 2";

            $queryVideographer = "SELECT
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
            $queryVideographer .=" AND users.`user_type_id` != 0 AND users.`user_type_id` = 3 AND users.`status` = 'active' GROUP BY users.id LIMIT 2";

            $queryMusician = "SELECT
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
            $queryMusician .=" AND users.`user_type_id` != 0 AND users.`user_type_id` = 4 AND users.`status` = 'active' GROUP BY users.id LIMIT 2";

            return response()->json([
                // 'getUserArtistListPhotographer' => User::select('users.*','types.type_name','types.types_id')->join('types', 'users.user_type_id', '=', 'types.types_id')->where('user_type_id', '!=', '')->where('user_type_id','=', '1')->get(),
                // 'getUserArtistListAnimator' => User::select('users.*','types.type_name','types.types_id')->join('types', 'users.user_type_id', '=', 'types.types_id')->where('user_type_id', '!=', '')->where('user_type_id','=', '2')->limit('2')->get(),
                // 'getUserArtistListVideographer' => User::select('users.*','types.type_name','types.types_id')->join('types', 'users.user_type_id', '=', 'types.types_id')->where('user_type_id', '!=', '')->where('user_type_id','=', '3')->limit('2')->get(),
                // 'getUserArtistListMusician' => User::select('users.*','types.type_name','types.types_id')->join('types', 'users.user_type_id', '=', 'types.types_id')->where('user_type_id', '!=', '')->where('user_type_id','=', '4')->limit('2')->get(),

                'getUserArtistListPhotographer' => \DB::select($query),
                'getUserArtistListAnimator' => \DB::select($queryAnimator),
                'getUserArtistListVideographer' => \DB::select($queryVideographer),
                'getUserArtistListMusician' => \DB::select($queryMusician),
            ], 200);

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
                $query .=" AND users.`user_type_id` != 0 AND users.`user_type_id` = 1 AND users.`status` = 'active' AND users.`id` != " . Auth::user()->id . "  GROUP BY users.id LIMIT 2";


                
            $queryAnimator = "SELECT
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
            $queryAnimator .=" AND users.`user_type_id` != 0 AND users.`user_type_id` = 2 AND users.`status` = 'active' AND users.`id` != " . Auth::user()->id . "  GROUP BY users.id LIMIT 2";

            $queryVideographer = "SELECT
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
            $queryVideographer .=" AND users.`user_type_id` != 0 AND users.`user_type_id` = 3 AND users.`status` = 'active' AND users.`id` != " . Auth::user()->id . "  GROUP BY users.id LIMIT 2";

            $queryMusician = "SELECT
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
            $queryMusician .=" AND users.`user_type_id` != 0 AND users.`user_type_id` = 4 AND users.`status` = 'active' AND users.`id` != " . Auth::user()->id . "  GROUP BY users.id LIMIT 2";

            return response()->json([
                // 'getUserArtistListPhotographer' => User::select('users.*','types.type_name','types.types_id')->join('types', 'users.user_type_id', '=', 'types.types_id')->where('user_type_id', '!=', '')->where('user_type_id','=', '1')->where('users.id','!=', Auth::user()->id)->limit('2')->get(),
                // 'getUserArtistListAnimator' => User::select('users.*','types.type_name','types.types_id')->join('types', 'users.user_type_id', '=', 'types.types_id')->where('user_type_id', '!=', '')->where('user_type_id','=', '2')->where('users.id','!=', Auth::user()->id)->limit('2')->get(),
                // 'getUserArtistListVideographer' => User::select('users.*','types.type_name','types.types_id')->join('types', 'users.user_type_id', '=', 'types.types_id')->where('user_type_id', '!=', '')->where('user_type_id','=', '3')->where('users.id','!=', Auth::user()->id)->limit('2')->get(),
                // 'getUserArtistListMusician' => User::select('users.*','types.type_name','types.types_id')->join('types', 'users.user_type_id', '=', 'types.types_id')->where('user_type_id', '!=', '')->where('user_type_id','=', '4')->where('users.id','!=', Auth::user()->id)->limit('2')->get(),
                'getUserArtistListPhotographer' => \DB::select($query),
                'getUserArtistListAnimator' => \DB::select($queryAnimator),
                'getUserArtistListVideographer' => \DB::select($queryVideographer),
                'getUserArtistListMusician' => \DB::select($queryMusician),
            ], 200);
        }
    }

    
}