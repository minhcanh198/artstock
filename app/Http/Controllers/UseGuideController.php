<?php

namespace App\Http\Controllers;

use App\Models\UseGuidePageSettings;


class UseGuideController extends Controller
{
    private UseGuidePageSettings $useGuidePageSettings;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(UseGuidePageSettings $useGuidePageSettings)
    {
        $this->useGuidePageSettings = $useGuidePageSettings;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $useGuidePageData = $this->useGuidePageSettings->first();

        return view(
            'new_template.use_guide', [
            'useGuidePageSettings' => $useGuidePageData
        ]);
    }

}
