<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input as Input;
use App\Http\Requests;
use App\Models\User;
use App\Models\Images;
use Illuminate\Http\Request;
use App\Models\AdminSettings;
use App\Models\PrivacyPolicyPageSettings;


class PrivacyPolicyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct(PrivacyPolicyPageSettings $privacyPolicyPageSettings) {
		$this->privacyPolicyPageSettings = $privacyPolicyPageSettings::first();
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

		$privacyPolicyPageData = PrivacyPolicyPageSettings::first();

		return view(
      	'new_template.privacy_policy', [
		      'privacyPolicyPageSettings' => $privacyPolicyPageData
      	]);

	}// End Method

}
