<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input as Input;
use App\Http\Requests;
use App\Models\User;
use App\Models\Images;
use Illuminate\Http\Request;
use App\Models\AdminSettings;
use App\Models\TermsPageSettings;


class TermsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct(TermsPageSettings $termsPageSettings) {
		$this->termsPageSettings = $termsPageSettings::first();
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

		$termsPageData = TermsPageSettings::first();

		return view(
      	'new_template.terms_of_use', [
		      'termsPageSettings' => $termsPageData
      	]);

	}// End Method

}
