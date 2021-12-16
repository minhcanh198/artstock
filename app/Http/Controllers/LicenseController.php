<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input as Input;
use App\Http\Requests;
use App\Models\User;
use App\Models\Images;
use Illuminate\Http\Request;
use App\Models\AdminSettings;
use App\Models\LicensePageSettings;


class LicenseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct(LicensePageSettings $licensePageSettings) {
		$this->licensePageSettings = $licensePageSettings::first();
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

		$licensePageData = LicensePageSettings::first();

		return view(
      	'new_template.license', [
		      'licensePageSettings' => $licensePageData
      	]);

	}// End Method

}
