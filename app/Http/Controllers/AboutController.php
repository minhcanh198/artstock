<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input as Input;
use App\Http\Requests;
use App\Models\User;
use App\Models\Images;
use Illuminate\Http\Request;
use App\Models\AdminSettings;
use App\Models\AboutPageSettings;


class AboutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct(AboutPageSettings $aboutPageSettings) {
		$this->aboutPageSettings = $aboutPageSettings::first();
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

		$aboutPageData = AboutPageSettings::first();

		return view(
      	'new_template.about', [
		      'aboutPageSettings' => $aboutPageData
      	]);

	}// End Method

}
