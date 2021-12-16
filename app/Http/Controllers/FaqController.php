<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input as Input;
use App\Http\Requests;
use App\Models\User;
use App\Models\Images;
use Illuminate\Http\Request;
use App\Models\AdminSettings;
use App\Models\FaqPageSettings;
use App\Models\FaqCategories;
use App\Models\Faq;


class FaqController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct(FaqPageSettings $faqPageSettings) {
		$this->faqPageSettings = $faqPageSettings::first();
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

    $faqPageData = FaqPageSettings::first();
    $faqCategoriesParents = FaqCategories::where('parent_id','=', '0')->get();
    $faqCategories = FaqCategories::where('parent_id','!=', '0')->get();


		return view(
      	'new_template.faq', [
		      'faqPageSettings' => $faqPageData,
		      'faqCategoriesParents' => $faqCategoriesParents,
		      'faqCategories' => $faqCategories
      	]);

  }// End Method
  
  public function faqList($categoryId)
  {
    $faqPageData = FaqPageSettings::first();
    $faqCategories = FaqCategories::where('id','=', $categoryId)->first();
    $faqQuestions = Faq::where('faq_category_id', '=',$categoryId)->get();

    return view(
      'new_template.faq-list', [
        
        'faqPageSettings' => $faqPageData,
        'faqCategories' => $faqCategories,
        'faqQuestions' => $faqQuestions
      ]);
  }

  public function faqDetails($questionId)
  {
    $faqPageData = FaqPageSettings::first();
    
    $faqQuestions = Faq::where('id', '=',$questionId)->first();
    $faqAllQuestions = Faq::where('faq_category_id', '=', $faqQuestions->faq_category_id)->get();
    $faqCategories = FaqCategories::where('id','=', $faqQuestions->faq_category_id)->first();
    return view(
      'new_template.faq-details', [
        
        'faqPageSettings' => $faqPageData,
        'faqQuestions' => $faqQuestions,
        'faqAllQuestions' => $faqAllQuestions,
        'faqCategories' => $faqCategories
      ]);
  }

}
