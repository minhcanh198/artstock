<?php

namespace App\Http\Controllers;
use App\Models\UseGuidePageSettings;


class UseGuideController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct(UseGuidePageSettings $useGuidePageSettings) {
		$this->useGuidePageSettings = $useGuidePageSettings::first();
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

		$useGuidePageData = UseGuidePageSettings::first();

		return view(
      	'new_template.use_guide', [
		      'useGuidePageSettings' => $useGuidePageData
      	]);

	}// End Method

}
