<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Course;
use App\Models\Code;
use App\Models\Teacher;
use Auth;
use DateTime;

class TeacherController extends Controller
{
    public function getDashboard(){
    	$acc= Account::find(Auth::user()->id);
    	$data['teacher'] = $acc->teacher;
    	$total_amount = 0;
    	$total_student = 0;
    	$student_month = 0;
    	$date = new DateTime();
    	foreach ($acc->course as $course) {
    		$total_amount += $course->cou_price;
    		// $total_student += $course->cou_student;
    		foreach ($course->orderDe as $orderDe) {
    			if ($orderDe->order->ord_status == 0) {
    				$total_student ++;
                    if (date_format($date,"m") == date_format($orderDe->created_at,"m")) {
                        $student_month ++;
                    }
                }
    		}
    	}
    	$data = [
    		'teacher' => $acc->teacher,
    		'total_amount' => $total_amount,
    		'total_student' => $total_student,
    		'student_month' => $student_month
    	];
    	return view('frontend.teacher.dashboard', $data);
    }

    public function getCourse(){
    	$data['acc']= Account::find(Auth::user()->id);
    	return view('frontend.teacher.course', $data );
    }

    public function getTeacher($email){
        $data['teacher'] = Account::where('email',$email)->first();
        
        if(Auth::check()){
            $data['rate'] = Teacher_Rating::where('tr_acc_id', Auth::user()->id)->where('tr_tea_id',$data['teacher']->teacher->tea_id)->first();
        }
        else{
            $data['rate'] = "";
        }
        
        // switch ($data['teacher']->teacher->tea_templace) {
        //     case 1:
        //         return view('frontend.teacher1',$data);
        //     case 2:
        //         return view('frontend.teacher2',$data);
        //     case 3:
        //         return view('frontend.teacher3',$data);
        //     default:
        //         return view('frontend.teacher1',$data);
        // }
        // dd($data['teacher']);
        $data['course'] = Course::where('cou_tea_id',$data['teacher']->id)->paginate(6);
        return view('frontend.teacher.profile',$data);
    }



    public function getTeacherRating($email ,$rate){
       
        //Check xem người dùng đẵ đăng nhập chưa
        if(Auth::check()){
            $account = Account::find(Auth::user()->id);
            $teacher = Teacher::where('tea_email', $email)->first();
            //check xem tài khoản có đăng ký khóa học không
            $check = 0;
            // dd($teacher);
            foreach ($account->order as $order) {
                if ($order->ord_status == 0) {
                    foreach ($order->orderDe as $orderDe) {
                        if($orderDe->course->tea->email == $email){
                            $check = 1;
                        }
                    }
                }
            }
            if ($check == 1) {
                $teacher_rating = Teacher_Rating::where('tr_acc_id', Auth::user()->id)->where('tr_tea_id', $teacher->tea_id)->first();
                //Check xem người dùng đã đánh giá hay chưa ??
                if ($teacher_rating == null) {
                    //Tài khoản chưa đánh giá
                    $teacher_rating = new Teacher_Rating;
                    $teacher_rating->tr_rate = $rate;
                    $teacher_rating->tr_tea_id = $teacher->tea_id;
                    $teacher_rating->tr_acc_id = $account->id;
                    $teacher_rating->save();

                    $total_rate = 0;
                    foreach ($teacher->rate as $rate) {
                        $total_rate += $rate->tr_rate;
                    }
                    $teacher->tea_rating = $total_rate/count($teacher->rate);
                    $teacher->save();
                    return back();
                }
                else{
                    //Tài khoản đã có đánh giá giáo viên
                    $teacher_rating->tr_rate = $rate;
                    $teacher_rating->tr_tea_id = $teacher->tea_id;
                    $teacher_rating->tr_acc_id = $account->id;
                    $teacher_rating->save();

                    $total_rate = 0;
                    foreach ($teacher->rate as $rate) {
                        $total_rate += $rate->tr_rate;
                    }
                    $teacher->tea_rating = $total_rate/count($teacher->rate);
                    $teacher->save();
                    return back();
                }
            }
            else{
                return back()->with("error","Bạn chưa học khóa học nào của giáo viên này");
            }
        }
        else{
            return back()->with("error","Bạn Phải đăng nhập để đánh giá giáo viên");
        }
    }

    public function getProfile(){
    	$acc= Account::find(Auth::user()->id);
    	$data['user'] = $acc;
    	$data['course'] = $acc->course;
    	return view('frontend.teacher.personal', $data);
    }
}
