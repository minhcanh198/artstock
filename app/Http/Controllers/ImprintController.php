<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input as Input;
use App\Http\Requests;
use App\Models\User;
use App\Models\Images;
use Illuminate\Http\Request;
use App\Models\AdminSettings;
// use App\Models\LicensePageSettings;
use App\Models\ImprintPageSettings;


class ImprintController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct(ImprintPageSettings $imprintPageSettings) {
		$this->imprintPageSettings = $imprintPageSettings::first();
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

		$imprintPageData = ImprintPageSettings::first();

		return view(
      	'new_template.imprint', [
		      'imprintPageSettings' => $imprintPageData
      	]);

	}// End Method

}
