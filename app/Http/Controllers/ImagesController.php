<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Models\User;
use App\Models\Images;
use App\Models\ImagesReported;
use App\Models\Stock;
use App\Models\AdminSettings;
use App\Models\Downloads;
use App\Models\Notifications;
use App\Models\Visits;
use App\Models\CollectionsImages;
use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;
use Image;
use App\Models\Purchases;
use FFMpeg;
use PaypalPayoutsSDK\Core\PayPalHttpClient;
use PaypalPayoutsSDK\Core\SandboxEnvironment;
use PaypalPayoutsSDK\Payouts\PayoutsPostRequest;
use Stripe;
use Session;

class ImagesController extends Controller
{

    public function __construct(AdminSettings $settings, Request $request)
    {
        $this->settings = $settings::first();
        $this->request = $request;
    }

    protected function validator(array $data, $id = null)
    {

        Validator::extend('ascii_only', function ($attribute, $value, $parameters) {
            return !preg_match('/[^x00-x7F\-]/i', $value);
        });

        $sizeAllowed = $this->settings->file_size_allowed * 1024;

        $dimensions = explode('x', $this->settings->min_width_height_image);

        if ($this->settings->currency_position == 'right') {
            $currencyPosition = 2;
        } else {
            $currencyPosition = null;
        }

        $messages = array(
            'photo.required' => trans('misc.please_select_image'),
            "photo.max" => trans('misc.max_size') . ' ' . Helper::formatBytes($sizeAllowed, 1),
            "price.required_if" => trans('misc.price_required'),
            'price.min' => trans('misc.price_minimum_sale' . $currencyPosition, ['symbol' => $this->settings->currency_symbol, 'code' => $this->settings->currency_code]),
            'price.max' => trans('misc.price_maximum_sale' . $currencyPosition, ['symbol' => $this->settings->currency_symbol, 'code' => $this->settings->currency_code]),

        );

        // Create Rules
        if ($id == null) {
            return Validator::make($data, [
                'photo' => 'required|mimes:jpg,gif,png,jpe,jpeg|dimensions:min_width=' . $dimensions[0] . ',min_height=' . $dimensions[1] . '|max:' . $this->settings->file_size_allowed . '',
                'photo' => 'required|mimes:jpg,gif,png,jpe,jpeg',
                'title' => 'required|min:3|max:50',
                'description' => 'min:2|max:' . $this->settings->description_length . '',
                'tags' => 'required',
                'price' => 'required_if:item_for_sale,==,sale|integer|min:' . $this->settings->min_sale_amount . '|max:' . $this->settings->max_sale_amount . '',
                'file' => 'max:' . $this->settings->file_size_allowed_vector . '',
            ], $messages);

            // Update Rules
        } else {
            return Validator::make($data, [
                'title' => 'required|min:3|max:50',
                'description' => 'min:2|max:' . $this->settings->description_length . '',
                'tags' => 'required',
                'price' => 'required_if:item_for_sale,==,sale|integer|min:' . $this->settings->min_sale_amount . '|max:' . $this->settings->max_sale_amount . ''
            ], $messages);
        }

    }

    public function hireDetail($id)
    {
        return view('new_template.hire_page');
    }

    public function hireMore($id)
    {
        return view('new_template.hire_more');
    }

    protected function validatorVideo(array $data, $id = null)
    {

        Validator::extend('ascii_only', function ($attribute, $value, $parameters) {
            return !preg_match('/[^x00-x7F\-]/i', $value);
        });

        $sizeAllowed = $this->settings->file_size_allowed * 1024;

        $dimensions = explode('x', $this->settings->min_width_height_image);

        if ($this->settings->currency_position == 'right') {
            $currencyPosition = 2;
        } else {
            $currencyPosition = null;
        }

        $messages = array(
            'video.required' => 'Please Select Video File',
            // 	'photo.required' => trans('misc.please_select_image'),
            // "photo.max"   => trans('misc.max_size').' '.Helper::formatBytes( $sizeAllowed, 1 ),
            "price.required_if" => trans('misc.price_required'),
            'price.min' => trans('misc.price_minimum_sale' . $currencyPosition, ['symbol' => $this->settings->currency_symbol, 'code' => $this->settings->currency_code]),
            'price.max' => trans('misc.price_maximum_sale' . $currencyPosition, ['symbol' => $this->settings->currency_symbol, 'code' => $this->settings->currency_code]),

        );

        // Create Rules
        if ($id == null) {
            return Validator::make($data, [
                //  'photo'       => 'required|mimes:jpg,gif,png,jpe,jpeg|dimensions:min_width='.$dimensions[0].',min_height='.$dimensions[1].'|max:'.$this->settings->file_size_allowed.'',
                'video' => 'required|mimes:mp4',
                'title' => 'required|min:3|max:50',
                'description' => 'min:2|max:' . $this->settings->description_length . '',
                'tags' => 'required',
                'price' => 'required_if:item_for_sale,==,sale|integer|min:' . $this->settings->min_sale_amount . '|max:' . $this->settings->max_sale_amount . '',
                'file' => 'max:' . $this->settings->file_size_allowed_vector . '',
            ], $messages);

            // Update Rules
        } else {
            return Validator::make($data, [
                'title' => 'required|min:3|max:50',
                'description' => 'min:2|max:' . $this->settings->description_length . '',
                'tags' => 'required',
                'price' => 'required_if:item_for_sale,==,sale|integer|min:' . $this->settings->min_sale_amount . '|max:' . $this->settings->max_sale_amount . ''
            ], $messages);
        }

    }


    protected function validatorAudio(array $data, $id = null)
    {

        Validator::extend('ascii_only', function ($attribute, $value, $parameters) {
            return !preg_match('/[^x00-x7F\-]/i', $value);
        });

        $sizeAllowed = $this->settings->file_size_allowed * 1024;

        $dimensions = explode('x', $this->settings->min_width_height_image);

        if ($this->settings->currency_position == 'right') {
            $currencyPosition = 2;
        } else {
            $currencyPosition = null;
        }

        $messages = array(
            'audio.required' => 'Please Select Audio File',
            // 	'photo.required' => trans('misc.please_select_image'),
            // "photo.max"   => trans('misc.max_size').' '.Helper::formatBytes( $sizeAllowed, 1 ),
            "price.required_if" => trans('misc.price_required'),
            'price.min' => trans('misc.price_minimum_sale' . $currencyPosition, ['symbol' => $this->settings->currency_symbol, 'code' => $this->settings->currency_code]),
            'price.max' => trans('misc.price_maximum_sale' . $currencyPosition, ['symbol' => $this->settings->currency_symbol, 'code' => $this->settings->currency_code]),

        );

        // Create Rules
        if ($id == null) {
            return Validator::make($data, [
                //  'photo'       => 'required|mimes:jpg,gif,png,jpe,jpeg|dimensions:min_width='.$dimensions[0].',min_height='.$dimensions[1].'|max:'.$this->settings->file_size_allowed.'',
                'audio' => 'required|mimes:mp3,wav',
                'title' => 'required|min:3|max:50',
                'description' => 'min:2|max:' . $this->settings->description_length . '',
                'tags' => 'required',
                'price' => 'required_if:item_for_sale,==,sale|integer|min:' . $this->settings->min_sale_amount . '|max:' . $this->settings->max_sale_amount . '',
                'file' => 'max:' . $this->settings->file_size_allowed_vector . '',
            ], $messages);

            // Update Rules
        } else {
            return Validator::make($data, [
                'title' => 'required|min:3|max:50',
                'description' => 'min:2|max:' . $this->settings->description_length . '',
                'tags' => 'required',
                'price' => 'required_if:item_for_sale,==,sale|integer|min:' . $this->settings->min_sale_amount . '|max:' . $this->settings->max_sale_amount . ''
            ], $messages);
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $data = Images::all();

        return view('admin.images')->withData($data);
    }


    public function imageUploadShahzadBackUp(Request $request)
    {

        if (Auth::guest()) {
            return response()->json([
                'session_null' => true,
                'success' => false,
            ]);
        }

        $input = $request->all();

        $validator = $this->validator($input);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ]);
        }


        $description = '';
        if (!empty($request->description))
            $description = Helper::checkTextDb($request->description);


        if ($this->settings->auto_approve_images == 'on') {
            $status = 'active';
        } else {
            $status = 'pending';
        }

        $token_id = str_random(200);


        $sql = new Images;

        $sql->title = trim($request->title);
        $sql->description = trim($description);
        $sql->categories_id = $request->categories_id;
        $sql->sub_categories_id = $request->sub_categories_id;
        $sql->user_id = Auth::user()->id;
        $sql->status = $status;
        $sql->token_id = $token_id;
        $sql->tags = strtolower($request->tags);

        //$sql->colors               = $colors_image; // later work
        //$sql->exif                 = trim($exif);   // later work
        //$sql->camera               = $camera;       // later work

        $sql->how_use_image = $request->how_use_image;
        $sql->attribution_required = $request->attribution_required;

        $sql->price = $request->price ? $request->price : 0;
        $sql->item_for_sale = $request->item_for_sale ? $request->item_for_sale : 'free';


        $extension = 'empty';
        $originalName = 'empty';
        $vectorFile = '';


        if ($request->hasfile('photo')) {


            //$preview = 'preview-'.time().rand(1,100).'.'.$request->photo->extension();
            //$thumbnail = 'thumbnail-'.time().rand(1,100).'.'.$request->photo->extension();

            $extension = $request->photo->extension();
            $originalName = $request->photo->getClientOriginalName();


            /* Cropped Image Upload */

            $folderPath = public_path('uploads/preview/');

            $image_parts = explode(";base64,", $request->base64data);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            $imageName = 'preview-' . time() . rand(1, 100) . '.' . $request->photo->extension();

            $imageFullPath = $folderPath . $imageName;

            file_put_contents($imageFullPath, $image_base64);
            /* Cropped Image Upload end */

            $temp = 'uploads/preview/' . $imageName;
            $watermarkSource = 'img/watermark.png';

            // Add Watermark on Images
            if ($this->settings->show_watermark == '1') {
                Helper::watermark($temp, $watermarkSource);
            }


            //$request->photo->move(public_path('uploads/preview'), $preview);
            //$request->photo->move(public_path('uploads/thumbnail'), $thumbnail);

            //$sql->thumbnail            = $thumbnail;
            $sql->preview = $imageName;

        }

        $sql->extension = strtolower($extension);
        $sql->original_name = $originalName;
        $sql->vector = $vectorFile;
        $sql->is_type = 'image';


        if ($sql->save()) {
            return response()->json([
                'success' => true,
                'target' => url('photo', $sql->id),
            ]);
        } else {
            return "Some Error Occured!";
        }


        //dd($request->all());

    }

    public function imageUpload(Request $request)
    {
        // dd(get_extension_funcs("gd"));
        if (Auth::guest()) {
            return response()->json([
                'session_null' => true,
                'success' => false,
            ]);
        }

        // PATHS
        $temp = 'temp/';
        $path_preview = 'uploads/preview/';
        $path_thumbnail = 'uploads/thumbnail/';
        $path_small = 'uploads/small/';
        $path_medium = 'uploads/medium/';
        $path_large = 'uploads/large/';
        $watermarkSource = 'img/watermark.png';
        $pathFileVector = 'uploads/files/';

        $input = $request->all();

        $validator = $this->validator($input);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ]);
        } //<-- Validator

        $vectorFile = '';

        // File Vector
        if ($request->hasFile('file')) {

            $extensionVector = strtolower($request->file('file')->getClientOriginalExtension());
            $fileVector = strtolower(Auth::user()->id . time() . str_random(40) . '.' . $extensionVector);
            $sizeFileVector = Helper::formatBytes($request->file('file')->getSize(), 1);

            $valid_formats = ['ai', 'psd', 'eps', 'svg'];

            if (!in_array($extensionVector, $valid_formats)) {
                return response()->json([
                    'success' => false,
                    'errors' => ['error_file' => trans('misc.file_validation', ['values' => 'AI, EPS, PSD, SVG'])],
                ]);
            }

            if ($extensionVector == 'ai') {
                $mime = ['application/illustrator', 'application/postscript', 'application/vnd.adobe.illustrator', 'application/pdf'];

            } elseif ($extensionVector == 'eps') {
                $mime = ['application/postscript', 'image/x-eps', 'application/pdf', 'application/octet-stream'];

            } elseif ($extensionVector == 'psd') {
                $mime = ['application/photoshop', 'application/x-photoshop', 'image/photoshop', 'image/psd', 'image/vnd.adobe.photoshop', 'image/x-photoshop', 'image/x-psd'];

            } elseif ($extensionVector == 'svg') {
                $mime = ['image/svg+xml'];
            }

            if (!in_array($request->file('file')->getMimeType(), $mime)) {
                return response()->json([
                    'success' => false,
                    'errors' => ['error_file' => trans('misc.file_validation', ['values' => 'AI, EPS, PSD, SVG'])],
                ]);
            }


            if ($request->file('file')->move($temp, $fileVector)) {
                //======= Copy Folder Large and Delete...
                if (\File::exists($temp . $fileVector)) {
                    \File::copy($temp . $fileVector, $pathFileVector . $fileVector);
                    \File::delete($temp . $fileVector);

                    $vectorFile = 'yes';
                }//<--- IF FILE EXISTS
            }
        }


        //<--- HASFILE PHOTO
        if ($request->hasFile('photo')) {

//             $getBase64Img       = $request->baseTxtImg;
// 			$changeBase64Img = str_replace('data:image/png;base64,', '', $getBase64Img);
//             $changeBase64Img2 = str_replace(' ', '+', $changeBase64Img);

            $getBase64Img = $request->baseTxtImg;

            list($type, $getBase64Img) = explode(';', $getBase64Img); // Commented by shahzad
            list(, $getBase64Img) = explode(',', $getBase64Img); // Commented by shahzad
            $getBase64ImgDecoded = base64_decode($getBase64Img);      // Commented by shahzad

            //$getBase64ImgDecoded = 'WhatIsbaseTxtImg'; //Added by shahzad

            // file_put_contents('/tmp/image.png', $getBase64ImgDecoded);

            // $imageName = str_random(10).'.'.'png';
            // \File::put(storage_path(). '/' . $imageName, base64_decode($extension));


            $extension = $request->file('photo')->getClientOriginalExtension();
// 			$originalName    = Helper::fileNameOriginal($request->file('photo')->getClientOriginalName());
            $originalName = 'cropped_' . str_random(100) . '.' . $extension;
// 			$type_mime_img   = $request->file('photo')->getMimeType();
// 			$sizeFile        = $request->file('photo')->getSize();
            $large = strtolower(Auth::user()->id . time() . str_random(100) . '.' . $extension);
// 			$large           = 'cropped_' . strtolower( Auth::user()->id.time().str_random(100).'.'.$extension );
// 			$large           = 'cropped_hamza'.'.'.$extension;
            $medium = strtolower(Auth::user()->id . time() . str_random(100) . '.' . $extension);
            $small = strtolower(Auth::user()->id . time() . str_random(100) . '.' . $extension);
            $preview = strtolower(str_slug($request->title, '-') . '-' . Auth::user()->id . time() . str_random(10) . '.' . $extension);
            $thumbnail = strtolower(str_slug($request->title, '-') . '-' . Auth::user()->id . time() . str_random(10) . '.' . $extension);
            //return $temp.$large;
// 			if($request->file('photo')->move($temp, $large) ) {
            if (file_put_contents($temp . $large, $getBase64ImgDecoded)) {

                set_time_limit(0);

                $original = $temp . $large;

                list($width, $height, $type, $attr) = getimagesize($original);

                //$width    = Helper::getWidth( $original );   // Commented by shahzad
                //$height   = Helper::getHeight( $original );  // Commented by shahzad

                if ($width > $height) {

                    if ($width > 1280) : $_scale = 1280;
                    else: $_scale = 900; endif;

                    // PREVIEW
                    $scale = 850 / $width;
                    $uploaded = Helper::resizeImage($original, $width, $height, $scale, $temp . $preview, $request->rotation);

                    // Medium
                    $scaleM = $_scale / $width;
                    $uploaded = Helper::resizeImage($original, $width, $height, $scaleM, $temp . $medium, $request->rotation);

                    // Small
                    $scaleS = 640 / $width;
                    $uploaded = Helper::resizeImage($original, $width, $height, $scaleS, $temp . $small, $request->rotation);

                    // Thumbnail
                    $scaleT = 280 / $width;
                    $uploaded = Helper::resizeImage($original, $width, $height, $scaleT, $temp . $thumbnail, $request->rotation);

                } else {

                    if ($width > 1280) : $_scale = 960;
                    else: $_scale = 800; endif;

                    // PREVIEW
                    $scale = 480 / $width;
                    $uploaded = Helper::resizeImage($original, $width, $height, $scale, $temp . $preview, $request->rotation);

                    // Medium
                    $scaleM = $_scale / $width;
                    $uploaded = Helper::resizeImage($original, $width, $height, $scaleM, $temp . $medium, $request->rotation);

                    // Small
                    $scaleS = 480 / $width;
                    $uploaded = Helper::resizeImage($original, $width, $height, $scaleS, $temp . $small, $request->rotation);

                    // Thumbnail
                    $scaleT = 190 / $width;
                    $uploaded = Helper::resizeImage($original, $width, $height, $scaleT, $temp . $thumbnail, $request->rotation);

                }

                // Add Watermark on Images
                if ($this->settings->show_watermark == '1') {
                    Helper::watermark($temp . $preview, $watermarkSource);
                }

            }// End File

        } //<----- HASFILE PHOTO

        if (!empty($request->description)) {
            $description = Helper::checkTextDb($request->description);
        } else {
            $description = '';
        }

        // Exif Read Data
        /* Commented by shahzad Exif Extension disabled from server
        $exif_data = @exif_read_data($temp.$large, 0, true);

        if( isset($exif_data['EXIF']['ISOSpeedRatings'][0]) ) {
            $ISO = 'ISO '.$exif_data['EXIF']['ISOSpeedRatings'][0];
        }

        if( isset($exif_data['EXIF']['ExposureTime']) ) {
            $ExposureTime = $exif_data['EXIF']['ExposureTime'].'s';
        }

        if( isset($exif_data['EXIF']['FocalLength']) ) {
            $FocalLength = round($exif_data['EXIF']['FocalLength'], 1).'mm';
        }

        if( isset($exif_data['COMPUTED']['ApertureFNumber']) ) {
            $ApertureFNumber = $exif_data['COMPUTED']['ApertureFNumber'];
        }

        if( !isset($FocalLength) ) {
            $FocalLength = '';
        }

        if( !isset($ExposureTime) ) {
            $ExposureTime = '';
        }

        if( !isset($ISO) ) {
            $ISO = '';
        }

        if( !isset($ApertureFNumber) ) {
            $ApertureFNumber = '';
        }

        $exif = $FocalLength.' '.$ApertureFNumber.' '.$ExposureTime. ' '.$ISO;

        if( isset($exif_data['IFD0']['Model']) ) {
            $camera = $exif_data['IFD0']['Model'];
        } else {
            $camera = '';
        }*/

        $exif = null;
        $camera = null;

        //=========== Colors
        $palette = Palette::fromFilename(url('temp/') . '/' . $preview);

        $extractor = new ColorExtractor($palette);

        // it defines an extract method which return the most “representative” colors
        $colors = $extractor->extract(5);

        // $palette is an iterator on colors sorted by pixel count
        foreach ($colors as $color) {

            $_color[] = trim(Color::fromIntToHex($color), '#');
        }

        $colors_image = implode(',', $_color);

        if ($this->settings->auto_approve_images == 'on') {
            $status = 'active';
        } else {
            $status = 'pending';
        }

        $token_id = str_random(200);

        $sql = new Images;
        $sql->thumbnail = $thumbnail;
        $sql->preview = $preview;
        $sql->title = trim($request->title);
        $sql->description = trim($description);
        $sql->categories_id = $request->categories_id;
        $sql->sub_categories_id = $request->sub_categories_id;
        $sql->user_id = Auth::user()->id;
        $sql->status = $status;
        $sql->token_id = $token_id;
        $sql->tags = strtolower($request->tags);
        $sql->extension = strtolower($extension);
        $sql->colors = $colors_image;
        $sql->exif = trim($exif);
        $sql->camera = $camera;
        $sql->how_use_image = $request->how_use_image;
        $sql->attribution_required = $request->attribution_required;
        $sql->original_name = $originalName;
        $sql->price = $request->price ? $request->price : 0;
        $sql->item_for_sale = $request->item_for_sale ? $request->item_for_sale : 'free';
        $sql->vector = $vectorFile;
        $sql->is_type = 'image';

        $sql->save();

        // ID INSERT
        $imageID = $sql->id;

        // Save Vector DB
        if ($request->hasFile('file')) {
            $stockVector = new Stock;
            $stockVector->images_id = $imageID;
            $stockVector->name = $fileVector;
            $stockVector->type = 'vector';
            $stockVector->extension = $extensionVector;
            $stockVector->resolution = '';
            $stockVector->size = $sizeFileVector;
            $stockVector->token = $token_id;
            $stockVector->save();
        }


        // INSERT STOCK IMAGES

        $lResolution = list($w, $h) = getimagesize($temp . $large);
        $lSize = Helper::formatBytes(filesize($temp . $large), 1);

        $mResolution = list($_w, $_h) = getimagesize($temp . $medium);
        $mSize = Helper::formatBytes(filesize($temp . $medium), 1);

        $smallResolution = list($__w, $__h) = getimagesize($temp . $small);
        $smallSize = Helper::formatBytes(filesize($temp . $small), 1);


        $stockImages = [
            ['name' => $large, 'type' => 'large', 'resolution' => $w . 'x' . $h, 'size' => $lSize],
            ['name' => $medium, 'type' => 'medium', 'resolution' => $_w . 'x' . $_h, 'size' => $mSize],
            ['name' => $small, 'type' => 'small', 'resolution' => $__w . 'x' . $__h, 'size' => $smallSize],
        ];

        foreach ($stockImages as $key) {

            $stock = new Stock;
            $stock->images_id = $imageID;
            $stock->name = $key['name'];
            $stock->type = $key['type'];
            $stock->extension = $extension;
            $stock->resolution = $key['resolution'];
            $stock->size = $key['size'];
            $stock->token = $token_id;
            $stock->save();

        }

        \File::copy($temp . $preview, $path_preview . $preview);
        \File::delete($temp . $preview);

        \File::copy($temp . $thumbnail, $path_thumbnail . $thumbnail);
        \File::delete($temp . $thumbnail);

        \File::copy($temp . $small, $path_small . $small);
        \File::delete($temp . $small);

        \File::copy($temp . $medium, $path_medium . $medium);
        \File::delete($temp . $medium);

        \File::copy($temp . $large, $path_large . $large);
        \File::delete($temp . $large);

        //\Session::flash('success_message',trans('admin.success_add'));

        return response()->json([
            'success' => true,
            'target' => url('photo', $imageID),
        ]);
    }

    public function videoUpload(Request $request)
    {
        if (Auth::guest()) {
            return response()->json([
                'session_null' => true,
                'success' => false,
            ]);
        }

        // PATHS
        $temp = '/temp/';
        $path_preview = '/uploads/video/preview/';
        $path_thumbnail = '/uploads/video/thumbnail/';
        $path_small = '/uploads/video/small/';
        $path_medium = '/uploads/video/medium/';
        $path_large_ss = '/uploads/video/screen_shot/';
        $path_large = '/uploads/video/water_mark_large/';
        $pathnew = '/uploads/video/large/';
        $setPath = '/uploads/video/large/';
        $watermarkSource = '/img/watermark.png';
        $pathFileVector = '/uploads/video/files/';

        $input = $request->all();
        $validator = $this->validatorVideo($input);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ]);
        } //<-- Validator

        //<--- HASFILE VIDEO
        if ($request->hasFile('video')) {

            $extension = $request->file('video')->getClientOriginalExtension();
            $originalName = Helper::fileNameOriginal($request->file('video')->getClientOriginalName());
            $type_mime_img = $request->file('video')->getMimeType();
            $sizeFile = $request->file('video')->getSize();
            $large = strtolower(Auth::user()->id . time() . str_random(100) . '.' . $extension);
            $medium = strtolower(Auth::user()->id . time() . str_random(100) . '.' . $extension);
            $small = strtolower(Auth::user()->id . time() . str_random(100) . '.' . $extension);
            $random = Auth::user()->id . time() . str_random(10);
            $preview = strtolower(str_slug($request->title, '-') . '-' . $random . '.' . $extension);
            $thumbnail = strtolower(str_slug($request->title, '-') . '-' . $random . '.' . $extension);
            $thumbnailss = strtolower(str_slug($request->title, '-') . '-' . $random . '.png');


            if ($request->file('video')->move(getcwd() . $setPath, $thumbnail)) {
                if ($this->settings->show_watermark == '1') {

                    $videoFile = $request->file('video');

                    $mainPathss = getcwd() . $path_large_ss;
                    $mainPath = getcwd() . $path_large;
                    $newPath = getcwd() . $pathnew;
                    $waterPath = getcwd() . $watermarkSource;
                    $fileName = "testvid.mp4";


                    $waterMarkImgTitle = "watermark-" . $thumbnail;


                    // Centralize Watermark ...
                    system(' ffmpeg -i ' . $newPath . $thumbnail . ' -i ' . $waterPath . ' -filter_complex "overlay=(main_w-overlay_w)/2:(main_h-overlay_h)/2" -codec:a copy ' . $mainPath . $waterMarkImgTitle . '');


                    $adaty2 = system("ffmpeg -i " . $newPath . '\\' . $thumbnail . " -ss 00:00:01.000 -vframes 1 " . $mainPathss . '\\' . 'screen-shot-' . $thumbnailss . "");//2>&1
                }
            }

        } //<----- HASFILE PHOTO

        if (!empty($request->description)) {
            $description = Helper::checkTextDb($request->description);
        } else {
            $description = '';
        }

        // Exif Read Data
        $exif_data = @exif_read_data($temp . $large, 0, true);

        if (isset($exif_data['EXIF']['ISOSpeedRatings'][0])) {
            $ISO = 'ISO ' . $exif_data['EXIF']['ISOSpeedRatings'][0];
        }

        if (isset($exif_data['EXIF']['ExposureTime'])) {
            $ExposureTime = $exif_data['EXIF']['ExposureTime'] . 's';
        }

        if (isset($exif_data['EXIF']['FocalLength'])) {
            $FocalLength = round($exif_data['EXIF']['FocalLength'], 1) . 'mm';
        }

        if (isset($exif_data['COMPUTED']['ApertureFNumber'])) {
            $ApertureFNumber = $exif_data['COMPUTED']['ApertureFNumber'];
        }

        if (!isset($FocalLength)) {
            $FocalLength = '';
        }

        if (!isset($ExposureTime)) {
            $ExposureTime = '';
        }

        if (!isset($ISO)) {
            $ISO = '';
        }

        if (!isset($ApertureFNumber)) {
            $ApertureFNumber = '';
        }

        $exif = $FocalLength . ' ' . $ApertureFNumber . ' ' . $ExposureTime . ' ' . $ISO;

        if (isset($exif_data['IFD0']['Model'])) {
            $camera = $exif_data['IFD0']['Model'];
        } else {
            $camera = '';
        }

        //=========== Colors
        $palette = Palette::fromFilename(url('uploads/video/screen_shot') . '/' . 'screen-shot-' . $thumbnailss);

        $extractor = new ColorExtractor($palette);

        // it defines an extract method which return the most “representative” colors
        $colors = $extractor->extract(5);

        // $palette is an iterator on colors sorted by pixel count
        foreach ($colors as $color) {

            $_color[] = trim(Color::fromIntToHex($color), '#');
        }

        $colors_image = implode(',', $_color);

        if ($this->settings->auto_approve_images == 'on') {
            $status = 'active';
        } else {
            $status = 'pending';
        }

        $token_id = str_random(200);

        $sql = new Images;
        $sql->thumbnail = $thumbnail;
        $sql->preview = $preview;
        $sql->title = trim($request->title);
        $sql->description = trim($description);
        $sql->categories_id = $request->categories_id;
        $sql->sub_categories_id = $request->sub_categories_id;
        $sql->user_id = Auth::user()->id;
        $sql->status = $status;
        $sql->token_id = $token_id;
        $sql->tags = strtolower($request->tags);
        $sql->extension = strtolower($extension);
        $sql->colors = $colors_image;
        $sql->exif = trim($exif);
        $sql->camera = $camera;
        $sql->how_use_image = $request->how_use_image;
        $sql->attribution_required = $request->attribution_required;
        $sql->original_name = $originalName;
        $sql->price = $request->price ? $request->price : 0;
        $sql->item_for_sale = $request->item_for_sale ? $request->item_for_sale : 'free';
        $sql->is_type = 'video';

        $sql->save();

        // ID INSERT
        $videoID = $sql->id;


        $stockImages = [
            ['name' => $thumbnail, 'type' => 'thumbnail'],
        ];

        foreach ($stockImages as $key) {

            $stock = new Stock;
            $stock->images_id = $videoID;
            $stock->name = $key['name'];
            $stock->type = $key['type'];
            $stock->extension = $extension;
            $stock->resolution = '';
            $stock->size = '';
            // $stock->resolution = $key['resolution'];
            // $stock->size       = $key['size'];
            $stock->token = $token_id;
            $stock->save();

        }
        \Session::flash('success_message', trans('admin.success_add'));

        return response()->json([
            'success' => true,
            'target' => url('video', $videoID),
        ]);
    }


    public function audioUpload(Request $request)
    {
        if (Auth::guest()) {
            return response()->json([
                'session_null' => true,
                'success' => false,
            ]);
        }

        // PATHS
        $path_large = '\public\uploads\audio\water_mark_large\\';
        $pathnew = '\public\uploads\audio\large\\';
        $setPath = 'uploads/audio/large/';
        $watermarkSource = 'img/audio_watermark.mp3';
        $watermarkSource2 = '\public\img\audio_watermark.mp3';
        $pathFileVector = 'uploads/audio/files/';


        $input = $request->all();

        $validator = $this->validatorAudio($input);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ]);
        } //<-- Validator

        //<--- HASFILE Audio
        if ($request->hasFile('audio')) {

            $extension = $request->file('audio')->getClientOriginalExtension();
            $originalName = Helper::fileNameOriginal($request->file('audio')->getClientOriginalName());
            $type_mime_img = $request->file('audio')->getMimeType();
            $sizeFile = $request->file('audio')->getSize();
            $large = strtolower(Auth::user()->id . time() . str_random(100) . '.' . $extension);
            $medium = strtolower(Auth::user()->id . time() . str_random(100) . '.' . $extension);
            $small = strtolower(Auth::user()->id . time() . str_random(100) . '.' . $extension);
            $preview = strtolower(str_slug($request->title, '-') . '-' . Auth::user()->id . time() . str_random(10) . '.' . $extension);
            $thumbnail = strtolower(str_slug($request->title, '-') . '-' . Auth::user()->id . time() . str_random(10) . '.' . $extension);
            // var_dump($thumbnail);
            if ($request->file('audio')->move($setPath, $thumbnail)) {
                // Add Watermark on Images
                // var_dump('asd');
                // die();
                if ($this->settings->show_watermark == '1') {

                    $audioFile = $request->file('audio');

                    $mainPath = getcwd() . $path_large;
                    $newPath = getcwd() . $pathnew;


                    // var_dump('file path');
                    // echo '<br/>';
                    // var_dump($newPath . $thumbnail);
                    // echo '<br/>';
                    // var_dump('watermark audio path');
                    // echo '<br/>';
                    // var_dump($mainPath . 'watermark-'. $thumbnail);
                    // echo '<br/>';
                    // var_dump('watermark path');
                    // echo '<br/>';
                    // var_dump($watermarkSource);
                    // $waterpath = $watermarkSource;

                    // echo '<br/>';
                    // var_dump('watermark ');
                    // echo '<br/>';
                    // var_dump($waterpath);

                    // die();


                    // system("ffmpeg -i ". $newPath.'\\'. $thumbnail ." -filter_complex 'amovie=". $watermarkSource .":loop=0,asetpts=N/SR/TB[speech]; [0][speech]amix=duration=shortest,volume=8 ". $mainPath.'\\'.'watermark-'.$thumbnail ."");
                    // system("ffmpeg -i" . $newPath . $thumbnail. " -i " . $waterpath ." -filter_complex [0:a]aformat=channel_layouts=stereo,aresample=async=1000[main]; [1:a]atrim=0:1,adelay=5000|5000[wm];[main][wm]amix=inputs=2 -vf scale=1280:720:sws_dither=ed:flags=lanczos,setdar=16:9 -c:v libx264 -ac 2 -ar 48000 -b:a 96k -threads 0 -y ". $mainPath.'watermark-'. $thumbnail. "");
                    // system("ffmpeg -y -i ". $newPath .'\\'. $thumbnail ." -i ". $watermarkSource2 ." -filter_complex '[0:0][1:0] amix=inputs=2:duration=longest' -c:a libmp3lame ". $mainPath.'\\'. 'watermark- '.$thumbnail ."");

                    // system("ffmpeg -y -i ". $newPath .'\\'. $thumbnail ." -i ". $watermarkSource ." -filter_complex '[0:0][1:0] amix=inputs=2:duration=longest' -c:a libmp3lame ". $newPath.'\\'. "watermark-asdwww.mp3");
                    system("ffmpeg -i " . $newPath . '\\' . $thumbnail . " -i " . $watermarkSource . " -filter_complex 'amovie=speech.mp3:loop=0,asetpts=N/SR/TB,adelay=10s:all=1[speech]; [0][speech]amix=duration=shortest,volume=10' " . $newPath . '\\' . "watermark-asdwww.mp3");

                }
            }
            // die;
            // if($request->file('video')->move($temp, $large) ) {

            // set_time_limit(0);

            // $original = $temp.$large;

            // $width    = Helper::getWidth( $original );
            // $height   = Helper::getHeight( $original );

            // if ( $width > $height ) {

            // 	if( $width > 1280) : $_scale = 1280; else: $_scale = 900; endif;

            // 	// PREVIEW
            // 	$scale    = 850 / $width;
            // 	$uploaded = Helper::resizeImage( $original, $width, $height, $scale, $temp.$preview, $request->rotation );

            // 	// Medium
            // 	$scaleM   = $_scale / $width;
            // 	$uploaded = Helper::resizeImage( $original, $width, $height, $scaleM, $temp.$medium, $request->rotation );

            // 	// Small
            // 	$scaleS   = 640 / $width;
            // 	$uploaded = Helper::resizeImage( $original, $width, $height, $scaleS, $temp.$small, $request->rotation );

            // 	// Thumbnail
            // 	$scaleT   = 280 / $width;
            // 	$uploaded = Helper::resizeImage( $original, $width, $height, $scaleT, $temp.$thumbnail, $request->rotation );

            // } else {

            // 	if( $width > 1280) : $_scale = 960; else: $_scale = 800; endif;

            // 	// PREVIEW
            // 	$scale    = 480 / $width;
            // 	$uploaded = Helper::resizeImage( $original, $width, $height, $scale, $temp.$preview, $request->rotation );

            // 	// Medium
            // 	$scaleM   = $_scale / $width;
            // 	$uploaded = Helper::resizeImage( $original, $width, $height, $scaleM, $temp.$medium, $request->rotation );

            // 	// Small
            // 	$scaleS   = 480 / $width;
            // 	$uploaded = Helper::resizeImage( $original, $width, $height, $scaleS, $temp.$small, $request->rotation );

            // 	// Thumbnail
            // 	$scaleT   = 190 / $width;
            // 	$uploaded = Helper::resizeImage( $original, $width, $height, $scaleT, $temp.$thumbnail, $request->rotation );

            // }


            // }
            // End File

        } //<----- HASFILE Audio

        if (!empty($request->description)) {
            $description = Helper::checkTextDb($request->description);
        } else {
            $description = '';
        }

        // Exif Read Data
        $exif_data = @exif_read_data($temp . $large, 0, true);

        if (isset($exif_data['EXIF']['ISOSpeedRatings'][0])) {
            $ISO = 'ISO ' . $exif_data['EXIF']['ISOSpeedRatings'][0];
        }

        if (isset($exif_data['EXIF']['ExposureTime'])) {
            $ExposureTime = $exif_data['EXIF']['ExposureTime'] . 's';
        }

        if (isset($exif_data['EXIF']['FocalLength'])) {
            $FocalLength = round($exif_data['EXIF']['FocalLength'], 1) . 'mm';
        }

        if (isset($exif_data['COMPUTED']['ApertureFNumber'])) {
            $ApertureFNumber = $exif_data['COMPUTED']['ApertureFNumber'];
        }

        if (!isset($FocalLength)) {
            $FocalLength = '';
        }

        if (!isset($ExposureTime)) {
            $ExposureTime = '';
        }

        if (!isset($ISO)) {
            $ISO = '';
        }

        if (!isset($ApertureFNumber)) {
            $ApertureFNumber = '';
        }

        $exif = $FocalLength . ' ' . $ApertureFNumber . ' ' . $ExposureTime . ' ' . $ISO;

        if (isset($exif_data['IFD0']['Model'])) {
            $camera = $exif_data['IFD0']['Model'];
        } else {
            $camera = '';
        }
        if ($this->settings->auto_approve_images == 'on') {
            $status = 'active';
        } else {
            $status = 'pending';
        }

        $token_id = str_random(200);

        $sql = new Images;
        $sql->thumbnail = $thumbnail;
        $sql->preview = $preview;
        $sql->title = trim($request->title);
        $sql->description = trim($description);
        $sql->categories_id = $request->categories_id;
        $sql->sub_categories_id = $request->sub_categories_id;
        $sql->user_id = Auth::user()->id;
        $sql->status = $status;
        $sql->token_id = $token_id;
        $sql->tags = strtolower($request->tags);
        $sql->extension = strtolower($extension);
        // $sql->colors               = $colors_image;
        $sql->exif = trim($exif);
        $sql->camera = $camera;
        $sql->how_use_image = $request->how_use_image;
        $sql->attribution_required = $request->attribution_required;
        $sql->original_name = $originalName;
        $sql->price = $request->price ? $request->price : 0;
        $sql->item_for_sale = $request->item_for_sale ? $request->item_for_sale : 'free';
        $sql->is_type = 'audio';


        $sql->save();

        // ID INSERT
        $videoID = $sql->id;

        $stockImages = [
            ['name' => $thumbnail, 'type' => 'thumbnail'],
        ];

        foreach ($stockImages as $key) {

            $stock = new Stock;
            $stock->images_id = $videoID;
            $stock->name = $key['name'];
            $stock->type = $key['type'];
            $stock->extension = $extension;
            $stock->resolution = '';
            $stock->size = '';
            $stock->token = $token_id;
            $stock->save();
        }

        \Session::flash('success_message', trans('admin.success_add'));

        return response()->json([
            'success' => true,
            'target' => url('home'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function showVideo($id, $slug = null)
    {
        // echo '<pre>';
        // print_r($id);
        // die;

        $response = Images::findOrFail($id);

        if (Auth::check() && $response->user_id != Auth::user()->id && $response->status == 'pending' && Auth::user()->role != 'admin') {
            abort(404);
        } else if (Auth::guest() && $response->status == 'pending') {
            abort(404);
        }

        $uri = $this->request->path();

        if (str_slug($response->title) == '') {

            $slugUrl = '';
        } else {
            $slugUrl = '/' . str_slug($response->title);
        }

        $url_image = 'video/' . $response->id . $slugUrl;

        //<<<-- * Redirect the user real page * -->>>
        $uriImage = $this->request->path();
        $uriCanonical = $url_image;

        if ($uriImage != $uriCanonical) {
            return redirect($uriCanonical);
        }

        //<--------- * Visits * ---------->
        $user_IP = request()->ip();
        $date = time();

        if (Auth::check()) {
            // SELECT IF YOU REGISTERED AND VISITED THE PUBLICATION
            $visitCheckUser = $response->visits()->where('user_id', Auth::user()->id)->first();

            if (!$visitCheckUser && Auth::user()->id != $response->user()->id) {
                $visit = new Visits;
                $visit->images_id = $response->id;
                $visit->user_id = Auth::user()->id;
                $visit->ip = $user_IP;
                $visit->save();
            }

        } else {

            // IF YOU SELECT "UNREGISTERED" ALREADY VISITED THE PUBLICATION
            $visitCheckGuest = $response->visits()->where('user_id', 0)
                ->where('ip', $user_IP)
                ->orderBy('date', 'desc')
                ->first();

            if ($visitCheckGuest) {
                $dateGuest = strtotime($visitCheckGuest->date) + (7200); // 2 Hours

            }

            if (empty($visitCheckGuest->ip)) {
                $visit = new Visits;
                $visit->images_id = $response->id;
                $visit->user_id = 0;
                $visit->ip = $user_IP;
                $visit->save();
            } else if ($dateGuest < $date) {
                $visit = new Visits;
                $visit->images_id = $response->id;
                $visit->user_id = 0;
                $visit->ip = $user_IP;
                $visit->save();
            }

        }//<--------- * Visits * ---------->

        return view('images.show_video')->withResponse($response);

    }//<--- End Method

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id, $slug = null)
    {
        $response = Images::findOrFail($id);

        if (Auth::check() && $response->user_id != Auth::user()->id && $response->status == 'pending' && Auth::user()->role != 'admin') {
            abort(404);
        } else if (Auth::guest() && $response->status == 'pending') {
            abort(404);
        }

        $uri = $this->request->path();

        if (str_slug($response->title) == '') {

            $slugUrl = '';
        } else {
            $slugUrl = '/' . str_slug($response->title);
        }

        $url_image = 'photo/' . $response->id . $slugUrl;

        //<<<-- * Redirect the user real page * -->>>
        $uriImage = $this->request->path();
        $uriCanonical = $url_image;

        if ($uriImage != $uriCanonical) {
            return redirect($uriCanonical);
        }

        //<--------- * Visits * ---------->
        $user_IP = request()->ip();
        $date = time();

        if (Auth::check()) {
            // SELECT IF YOU REGISTERED AND VISITED THE PUBLICATION
            $visitCheckUser = $response->visits()->where('user_id', Auth::user()->id)->first();

            if (!$visitCheckUser && Auth::user()->id != $response->user()->id) {
                $visit = new Visits;
                $visit->images_id = $response->id;
                $visit->user_id = Auth::user()->id;
                $visit->ip = $user_IP;
                $visit->save();
            }

        } else {

            // IF YOU SELECT "UNREGISTERED" ALREADY VISITED THE PUBLICATION
            $visitCheckGuest = $response->visits()->where('user_id', 0)
                ->where('ip', $user_IP)
                ->orderBy('date', 'desc')
                ->first();

            if ($visitCheckGuest) {
                $dateGuest = strtotime($visitCheckGuest->date) + (7200); // 2 Hours

            }

            if (empty($visitCheckGuest->ip)) {
                $visit = new Visits;
                $visit->images_id = $response->id;
                $visit->user_id = 0;
                $visit->ip = $user_IP;
                $visit->save();
            } else if ($dateGuest < $date) {
                $visit = new Visits;
                $visit->images_id = $response->id;
                $visit->user_id = 0;
                $visit->ip = $user_IP;
                $visit->save();
            }

        }//<--------- * Visits * ---------->
        $showPayment = User::where('id', $response->user_id)->where('paypal_account', '!=', '')->first() ? true : false;
        $response->showPayment = $showPayment;
        return view('images.show')->withResponse($response);

    }//<--- End Method

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

        $data = Images::findOrFail($id);

        if ($data->user_id != Auth::user()->id) {
            abort('404');
        }

        return view('images.edit')->withData($data);

    }//<--- End Method

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {

        $image = Images::findOrFail($request->id);

        if ($image->user_id != Auth::user()->id) {
            return redirect('/');
        }

        $input = $request->all();

        if ($image->item_for_sale == 'sale' || $request->item_for_sale == 'sale') {
            $input['item_for_sale'] = 'sale';
        } else {
            $input['item_for_sale'] = 'free';
        }

        $validator = $this->validator($input, $request->id);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $image->fill($input)->save();

        \Session::flash('success_message', trans('admin.success_update'));

        return redirect('edit/photo/' . $image->id);

    }//<--- End Method


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {

        $image = Images::find($request->id);

        if ($image->user_id != Auth::user()->id) {
            return redirect('/');
        }

        // Delete Notification
        $notifications = Notifications::where('destination', $request->id)
            ->where('type', '2')
            ->orWhere('destination', $request->id)
            ->where('type', '3')
            ->orWhere('destination', $request->id)
            ->where('type', '4')
            ->get();

        if (isset($notifications)) {
            foreach ($notifications as $notification) {
                $notification->delete();
            }
        }

        // Collections Images
        $collectionsImages = CollectionsImages::where('images_id', '=', $request->id)->get();
        if (isset($collectionsImages)) {
            foreach ($collectionsImages as $collectionsImage) {
                $collectionsImage->delete();
            }
        }

        // Images Reported
        $imagesReporteds = ImagesReported::where('image_id', '=', $request->id)->get();
        if (isset($imagesReporteds)) {
            foreach ($imagesReporteds as $imagesReported) {
                $imagesReported->delete();
            }
        }

        //<---- ALL RESOLUTIONS IMAGES
        $stocks = Stock::where('images_id', '=', $request->id)->get();

        foreach ($stocks as $stock) {

            $stock_path = 'uploads/' . $stock->type . '/' . $stock->name;
            $stock_pathVector = 'uploads/files/' . $stock->name;

            // Delete Stock
            if (\File::exists($stock_path)) {
                \File::delete($stock_path);
            }//<--- IF FILE EXISTS

            // Delete Stock Vector
            if (\File::exists($stock_pathVector)) {
                \File::delete($stock_pathVector);
            }//<--- IF FILE EXISTS

            $stock->delete();

        }//<--- End foreach

        $preview_image = 'uploads/preview/' . $image->preview;
        $thumbnail = 'uploads/thumbnail/' . $image->thumbnail;

        // Delete preview
        if (\File::exists($preview_image)) {
            \File::delete($preview_image);
        }//<--- IF FILE EXISTS

        // Delete thumbnail
        if (\File::exists($thumbnail)) {
            \File::delete($thumbnail);
        }//<--- IF FILE EXISTS

        $image->delete();

        return redirect(Auth::user()->username);

    }//<--- End Method

    public function download($token_id)
    {
        ///return $this->request->all();
        $type = $this->request->type;

        // var_dump($type);
        // die;

        $image = Images::where('token_id', $token_id)->where('item_for_sale', 'free')->firstOrFail();

        if (isset($image)) {

            if ($image->is_type == 'image')
                $getImage = Stock::where('images_id', $image->id)->where('type', '=', $type)->firstOrFail();
            else
                $getImage = Stock::where('images_id', $image->id)->firstOrFail();
        }

        if (isset($getImage)) {

            // Download Check User
            $user_IP = request()->ip();
            $date = time();

            if (Auth::check()) {

                $downloadCheckUser = $image->downloads()->where('user_id', Auth::user()->id)->first();

                if (!$downloadCheckUser && Auth::user()->id != $image->user()->id) {
                    $download = new Downloads;
                    $download->images_id = $image->id;
                    $download->user_id = Auth::user()->id;
                    $download->ip = $user_IP;
                    $download->save();
                }
            }// Auth check

            else {

                // IF YOU SELECT "UNREGISTERED" ALREADY DOWNLOAD THE IMAGE
                $downloadCheckUser = $image->downloads()->where('user_id', 0)
                    ->where('ip', $user_IP)
                    ->orderBy('date', 'desc')
                    ->first();

                if ($downloadCheckUser) {
                    $dateGuest = strtotime($downloadCheckUser->date) + (7200); // 2 Hours

                }

                if (empty($downloadCheckUser->ip)) {
                    $download = new Downloads;
                    $download->images_id = $image->id;
                    $download->user_id = 0;
                    $download->ip = $user_IP;
                    $download->save();
                } else if ($dateGuest < $date) {
                    $download = new Downloads;
                    $download->images_id = $image->id;
                    $download->user_id = 0;
                    $download->ip = $user_IP;
                    $download->save();
                }

            }//<--------- * Visits * ---------->
            //<<<<---/ Download Check User

            if ($image->is_type == "video") {

                if ($type != 'vector') {
                    $pathFile = 'uploads/video/large/' . $image->thumbnail;
                    $resolution = $getImage->resolution;
                } else {
                    $pathFile = 'uploads/files/' . $getImage->name;
                    $resolution = trans('misc.vector_graphic');
                }

                $headers = [
                    'Content-Type:' => ' image/' . $image->extension,
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0'
                ];

            } else {

                if ($type != 'vector') {
                    $pathFile = 'uploads/' . $type . '/' . $getImage->name;
                    $resolution = $getImage->resolution;
                } else {
                    $pathFile = 'uploads/files/' . $getImage->name;
                    $resolution = trans('misc.vector_graphic');
                }

                $headers = [
                    'Content-Type:' => ' image/' . $image->extension,
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0'
                ];
            }


            return response()->download($pathFile, $image->title . ' - ' . $resolution . '.' . $getImage->extension, $headers);
        }
    }//<--- End Method

    public function report(Request $request)
    {

        $data = ImagesReported::firstOrNew(['user_id' => Auth::user()->id, 'image_id' => $request->id]);

        if ($data->exists) {
            \Session::flash('noty_error', 'error');
            return redirect()->back();
        } else {

            $data->reason = $request->reason;
            $data->save();
            \Session::flash('noty_success', 'success');
            return redirect()->back();
        }

    }//<--- End Method

    /* Created by shahzad for audio purchase */
    public function purchaseaudio($token_id)
    {
        $image = Images::where('token_id', $token_id)->firstOrFail();
        $priceItem = $image->price;

        if ($this->settings->sell_option == 'off' && Auth::user()->id != $image->user()->id) {
            return back()->withPurchaseNotAllowed(trans('misc.purchase_not_allowed'));
        }
        if (isset($image)) {
            $getImage = Stock::where('images_id', $image->id)->firstOrFail();
        }
        // Download image from the user's Dashboard
        if ($this->request->downloadAgain) {
            return $this->downloadAgain($image, $getImage);
        }

        if (isset($getImage)) {

            // Earnings Net Seller
            $earningNetSeller = $priceItem - ($priceItem * $this->settings->fee_commission / 100);

            // Earnings Net Admin
            $earningNetAdmin = ($priceItem - $earningNetSeller);

            if (Auth::user()->id != $image->user()->id) {

                if ($this->request->payment_option == 'stripe') {
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                    $data = Stripe\Charge::create([
                        "amount" => $priceItem * 100,
                        "currency" => "usd",
                        "source" => $this->request->stripeToken,
                        "description" => "ArtStock Payment"
                    ]);
                    if (!$data['status'] == 'succeeded') {
                        return back()->withErrorPurchase("Some error occured! while processing payment.");
                    }
                }


                $user_IP = request()->ip();

                $purchase = new Purchases;
                $purchase->images_id = $image->id;
                $purchase->user_id = Auth::user()->id;
                $purchase->price = $priceItem;
                $purchase->earning_net_seller = $earningNetSeller;
                $purchase->earning_net_admin = $earningNetAdmin;
                $purchase->type = 'audio';
                $purchase->license = 'regular';
                $purchase->order_id = substr(strtolower(md5(microtime() . mt_rand(1000, 9999))), 0, 15);
                //$purchase->purchase_code      = implode( '-', str_split( substr( strtolower( md5( time() . mt_rand( 1000, 9999 ) ) ), 0, 27 ), 5 ) );
                $purchase->purchase_code = ($this->request->payment_option == 'paypal') ? $this->request->paypalTxnId : $data['id'];
                $purchase->save();

                // Download
                $download = new Downloads;
                $download->images_id = $image->id;
                $download->user_id = Auth::user()->id;
                $download->ip = $user_IP;
                $download->save();

                // Send Notification //destination, author, type, target
                Notifications::send($image->user()->id, Auth::user()->id, '5', $image->id);

            }
            //<<<<---/  Verify Purchase of the User

            $pathFile = 'uploads/audio/large/' . $image->thumbnail;

            $headers = [
                'Content-Type:' => ' image/' . $image->extension,
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ];
            return response()->download($pathFile);
            //return response()->download($pathFile, $image->title.' - '.$resolution.'.'.$getImage->extension, $headers);
        }


    }

    /* Created by shahzad for audio purchase */

    public function instant_buy(Request $request)
    {

        $image = Images::find($request->fileId);
        $getImage = Stock::where('images_id', $image->id)->firstOrFail();

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $data = Stripe\Charge::create([
            "amount" => $image->price * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "ArtStock Payment-Instant Buy"
        ]);
        if (!$data['status'] == 'succeeded') {
            return back()->withErrorPurchase("Some error occured! while processing payment.");
        }

        if ($image->is_type == "image")
            $pathFile = 'uploads/medium/' . $getImage->name;
        if ($image->is_type == "video")
            $pathFile = 'uploads/video/large/' . $image->thumbnail;

        $resolution = $getImage->resolution;
        $headers = [
            'Content-Type:' => ' image/' . $image->extension,
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ];

        return response()->download($pathFile, $image->title . ' - ' . $resolution . '.' . $getImage->extension, $headers);
    }

    public function purchase($token_id)
    {
        $type = strtolower($this->request->type);
        $license = strtolower($this->request->license);
        $urlDashboardUser = url('user/dashboard/purchases');

        if (url()->previous() == $urlDashboardUser && !$this->request->downloadAgain) {
            abort(404);
        }

        $image = Images::where('token_id', $token_id)->firstOrFail();

        $user = User::where('id', $image->user_id)->where('paypal_account', '!=', '')->firstOrFail();

        // Validate Licenses and Type
        $licensesArray = ['regular', 'extended'];
        $typeArray = ['small', 'medium', 'large', 'vector'];

        // License
        if (!in_array($license, $licensesArray) && Auth::user()->id != $image->user()->id) {
            abort(404);
        }

        // Type
        if ($image->is_type == 'image') { // Added by shahzad for Video purchase error
            if (!in_array($type, $typeArray) && Auth::user()->id != $image->user()->id) {
                abort(404);
            }
        }

        if ($license == 'extended') {
            $image->price = ($image->price * 10);
        }
        // var_dump($type);
        // die;
        $priceItem = $image->price; // Added by shahzad (Error: Video download Error)...
        switch ($type) {
            case 'small':
                $priceItem = $image->price;
                break;
            case 'medium':
                $priceItem = ($image->price * 2);
                break;
            case 'large':
                $priceItem = ($image->price * 3);
                break;
            case 'vector':
                $priceItem = ($image->price * 4);
                break;
        }
        // dd($priceItem);

        if ($this->settings->sell_option == 'off' && Auth::user()->id != $image->user()->id) {
            return back()->withPurchaseNotAllowed(trans('misc.purchase_not_allowed'));
        }

        if (isset($image)) {
            $getImage = Stock::where('images_id', $image->id)->where('type', '=', $type)->firstOrFail();
        }

        // Download image from the user's Dashboard
        if ($this->request->downloadAgain) {
            return $this->downloadAgain($image, $getImage);
        }

        if (isset($getImage)) {

            /* Commented by shahzad
            if(Auth::user()->funds < $priceItem && Auth::user()->id != $image->user()->id) {
                return back()->withErrorPurchase(trans('misc.not_enough_funds'));
            }*/


            // Verify Purchase of the User
            //$verifyPurchaseUser = $image->purchases()->where('user_id', Auth::user()->id)->where('type', '=', $type)->first();

            // Earnings Net Seller
            $earningNetSeller = $priceItem - ($priceItem * $this->settings->fee_commission / 100);

            // Earnings Net Admin
            $earningNetAdmin = ($priceItem - $earningNetSeller);

            if (Auth::user()->id != $image->user()->id) {

                if ($this->request->payment_option == 'stripe') {
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                    $data = Stripe\Charge::create([
                        "amount" => $priceItem * 100,
                        "currency" => "usd",
                        "source" => $this->request->stripeToken,
                        "description" => "ArtStock Payment"
                    ]);
                    if (!$data['status'] == 'succeeded') {
                        return back()->withErrorPurchase("Some error occured! while processing payment.");
                    }
                }


                $user_IP = request()->ip();

                $purchase = new Purchases;
                $purchase->images_id = $image->id;
                $purchase->user_id = Auth::user()->id;
                $purchase->price = $priceItem;
                $purchase->earning_net_seller = $earningNetSeller;
                $purchase->earning_net_admin = $earningNetAdmin;
                $purchase->type = $type;
                $purchase->license = $license;
                $purchase->order_id = substr(strtolower(md5(microtime() . mt_rand(1000, 9999))), 0, 15);
                //$purchase->purchase_code      = implode( '-', str_split( substr( strtolower( md5( time() . mt_rand( 1000, 9999 ) ) ), 0, 27 ), 5 ) );
                $purchase->purchase_code = ($this->request->payment_option == 'paypal') ? $this->request->paypalTxnId : $data['id'];
                $purchase->save();

                // Download
                $download = new Downloads;
                $download->images_id = $image->id;
                $download->user_id = Auth::user()->id;
                $download->ip = $user_IP;
                $download->save();

                // Send Notification //destination, author, type, target
                Notifications::send($image->user()->id, Auth::user()->id, '5', $image->id);

                //Subtract user funds
                //User::find(Auth::user()->id)->decrement('funds', $priceItem); // Commented by shahzad

                //Add user balance
                //User::find($image->user()->id)->increment('balance', $earningNetSeller); //Commented by shahzad
            }
            // refund money to artist

            $this->refundMoneyToArtist($user->paypal_account, $earningNetSeller);
            //<<<<---/  Verify Purchase of the User
            if ($image->is_type == "video") {
                if ($type != 'vector') {
                    $pathFile = 'uploads/video/large/' . $image->thumbnail;
                    $resolution = $getImage->resolution;
                } else {
                    $pathFile = 'uploads/files/' . $getImage->name;
                    $resolution = trans('misc.vector_graphic');
                }

                $headers = [
                    'Content-Type:' => ' image/' . $image->extension,
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0'
                ];
            } else {
                if ($type != 'vector') {
                    $pathFile = 'uploads/' . $type . '/' . $getImage->name;
                    $resolution = $getImage->resolution;
                } else {
                    $pathFile = 'uploads/files/' . $getImage->name;
                    $resolution = trans('misc.vector_graphic');
                }

                $headers = [
                    'Content-Type:' => ' image/' . $image->extension,
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0'
                ];
            }

            return response()->download($pathFile, $image->title . ' - ' . $resolution . '.' . $getImage->extension, $headers);
        }// $getImage

    }//<--- End Method

    public function downloadAgain($image, $getImage)
    {

        $verifyPurchaseUserAgain = $image->purchases()
            ->where('user_id', Auth::user()->id)
            ->where('images_id', $image->id)
            ->where('type', '=', $this->request->type)
            ->where('license', '=', $this->request->license)
            ->first();

        if (!$verifyPurchaseUserAgain) {
            abort(404);
        }

        if ($this->request->type != 'vector') {
            $pathFile = 'uploads/' . $this->request->type . '/' . $getImage->name;
            $resolution = $getImage->resolution;
        } else {
            $pathFile = 'uploads/files/' . $getImage->name;
            $resolution = trans('misc.vector_graphic');
        }

        $headers = [
            'Content-Type:' => ' image/' . $image->extension,
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ];

        return response()->download($pathFile, $image->title . ' - ' . $resolution . '.' . $getImage->extension, $headers);

    }//<--- End Method

    public function refundMoneyToArtist($paypalEmail, $value)
    {
        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_CLIENT_SECRET');

        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment);


        $request = new PayoutsPostRequest();
        $json =
            '{
                "sender_batch_header":
                {
                  "email_subject": "Refund from Artstock"
                },
                "items": [
                {
                  "recipient_type": "EMAIL",
                  "receiver": "' . $paypalEmail . '",
                  "note": "Refund Image",
                  "sender_item_id": "",
                  "amount":
                  {
                    "currency": "USD",
                    "value": "' . $value . '"
                  }
                }]
            }';
//        dd($json);
        $body = json_decode(
            $json,
            true);
        $request->body = $body;
        $response = $client->execute($request);
        print "Status Code: {$response->statusCode}\n";
        print "Status: {$response->result->batch_header->batch_status}\n";
        print "Batch ID: {$response->result->batch_header->payout_batch_id}\n";
        print "Links:\n";
        foreach ($response->result->links as $link) {
            print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
        }
        echo json_encode($response->result, JSON_PRETTY_PRINT), "\n";

    }
}
