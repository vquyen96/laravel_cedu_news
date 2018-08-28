<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Course;
use App\Models\Code;
use App\Models\Teacher;
use Auth;
class TeacherController extends Controller
{
    public function getDashboard(){
    	$acc= Account::find(Auth::user()->id);
    	$data['teacher'] = $acc->teacher;
    	
    	return view('frontend.teacher.dashboard', $data);
    }
}
