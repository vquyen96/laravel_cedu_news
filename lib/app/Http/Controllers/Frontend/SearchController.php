<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Group;
use App\Models\Account;
use App\Models\Teacher;
class SearchController extends Controller
{
    public function getList(Request $request){
    	$data['searchValue'] = $request->search;
    	$data['course'] = Course::where('cou_name','like','%'.$request->search.'%')->get();
    	$data['teacher_total'] = Teacher::count();
    	$data['teacher'] = Teacher::orderBy('tea_featured','desc')->paginate(7);
    	
    	return view('frontend.course',$data);
    }
}
