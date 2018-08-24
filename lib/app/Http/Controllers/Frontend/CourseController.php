<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Group;
use App\Models\Account;
use App\Models\Code;
use App\Models\Rating;
use App\Models\Teacher;
use Auth;
use Illuminate\Support\Facades\Input;

class CourseController extends Controller
{
    public function getList(Request $request){

        if (($request->price != null && $request->price != "null") || ($request->level != null && $request->level != "null") || ($request->tag != null && $request->tag != "null")) {
            if($request->price != null && $request->price != "null"){
                $price = (int)$request->price;
            }
            else{
                $price = 10000000;
            }
            if($request->tag != null && $request->tag != "null"){
                $tag = $request->tag;
            }
            else{
                
                $tag = "";
            }
            if($request->level != null && $request->level != "null"){
                $level = $request->level;
            }
            else{
                
                $level = "all";
            }
            $data['course'] = Course::where('cou_status', '1')->get();
            $data['courseByMost'] = Course::where('cou_price','<', $price)->where('cou_tag', 'like', '%'.$tag.'%')->where('cou_level', $level)->orderBy('cou_student','desc')->where('cou_status', '1')->paginate(6);
            $data['courseNewMost'] = Course::where('cou_price','<', $price)->where('cou_tag', 'like', '%'.$tag.'%')->where('cou_level', $level)->orderBy('created_at','desc')->where('cou_status', '1')->paginate(6);
            $data['courseVoteMost'] = Course::where('cou_price','<', $price)->where('cou_tag', 'like', '%'.$tag.'%')->where('cou_level', $level)->orderBy('cou_star','desc')->where('cou_status', '1')->paginate(6);
            $data['courseSaleMost'] = Course::where('cou_price','<', $price)->where('cou_tag', 'like', '%'.$tag.'%')->where('cou_level', $level)->orderBy('cou_sale','desc')->where('cou_status', '1')->paginate(6);

            $data['teacher'] = Teacher::orderBy('tea_featured','desc')->paginate(7);
            $data['teacher_total'] = Teacher::count();
            
            // dd($data['teacher']);
            return view('frontend/course',$data);
        }
        $data['course'] = Course::where('cou_status', '1')->get();
    	$data['courseByMost'] = Course::orderBy('cou_student','desc')->where('cou_status', '1')->paginate(15);
        $data['courseNewMost'] = Course::orderBy('created_at','desc')->where('cou_status', '1')->paginate(15);
        $data['courseVoteMost'] = Course::orderBy('cou_star','desc')->where('cou_status', '1')->paginate(15);
        $data['courseSaleMost'] = Course::orderBy('cou_sale','desc')->where('cou_status', '1')->paginate(15);

    	$data['teacher'] = Teacher::orderBy('tea_featured','desc')->paginate(7);
        $data['teacher_total'] = Teacher::count();
        
    	return view('frontend/course',$data);
    }
    public function getDetail($slug){
    	$data['course'] = Course::where('cou_slug',$slug)->first();
        $course_relate = $data['course']->group->course;

        $list_cou_ids = [];
        foreach ($course_relate as $item) {
            if ($data['course']->cou_id != $item->cou_id) {
                $list_cou_ids[] = $item->cou_id;
            }
            
        }

        $data['course_relate'] = Course::whereIn('cou_id', $list_cou_ids)->inRandomOrder()->take(3)->get();

        // dd($data['course_relate']);
        if ($data['course']->cou_status == 1) {
            if(Auth::check()){
                $data['acc'] = Account::where('id', Auth::user()->id)->where('level', 8)->first();
                $orderDe_id = 0;
                $code = 0;
                foreach ($data['course']->orderDe as $item) {
                    if ($item->order != null && $item->order->ord_acc_id == Auth::user()->id) {
                        $orderDe_id = $item->orderDe_id;
                    }
                }
                if ($orderDe_id != null) {
                    $code = Code::where('code_orderDe_id',$orderDe_id)->first();
                }
                
                if($code != null){
                    if($code->code_status == 1){
                        return redirect('courses/detail/'.$slug.'.html/active');
                    }
                    else{
                        return view('frontend.course.detail',$data)->with('error','Bạn chưa kích hoạt khóa học này');
                    }
                }
                else{
                    return view('frontend.course.detail',$data);
                }
            }
            else{
                return view('frontend.course.detail',$data);
            }
        }
        else{
            return back()->with('error','Khóa học của chúng tôi đang trong quá trình bảo trì');
        }
            
    	
    }
    public function getGroup($slug){
    	$group = Group::where('gr_slug', $slug)->first();
    	$groupId = $group->gr_id;
    	$data['group'] = $group;
        $data['group_child'] = Group::where('gr_parent_id', $group->gr_id)->get();
    	$data['course'] = Course::where('cou_gr_id',$groupId)->where('cou_status', '1')->get();
        $data['courseByMost'] = Course::where('cou_gr_id',$groupId)->orderBy('cou_star','desc')->where('cou_status', '1')->take(10)->get();
        $data['courseNewMost'] = Course::where('cou_gr_id',$groupId)->orderBy('created_at','desc')->where('cou_status', '1')->take(10)->get();
        $data['courseVoteMost'] = Course::where('cou_gr_id',$groupId)->orderBy('cou_star','desc')->where('cou_status', '1')->take(10)->get();
        $data['courseSaleMost'] = Course::where('cou_gr_id',$groupId)->orderBy('cou_star','desc')->where('cou_status', '1')->take(10)->get();
    	$data['teacher'] = Teacher::orderBy('tea_featured','desc')->paginate(10);
        // $data['teacher_total'] = Teacher::count();
        // dd($data['courseVoteMost']);
    	return view('frontend.course.group',$data);
    }
    public function getAll($slug){
        $group = Group::where('gr_slug', $slug)->first();
        $groupId = $group->gr_id;
        $data['group'] = $group;
        $data['group_child'] = Group::where('gr_parent_id', $group->gr_id)->get();
        $data['courses'] = Course::where('cou_gr_id',$groupId)->where('cou_status', '1')->paginate(10);
        
        $data['teacher'] = Teacher::orderBy('tea_featured','desc')->paginate(10);
        
        return view('frontend.course.all',$data);
    }

    public function getVideo($slug, $id){
        $data['course'] = Course::where('cou_slug',$slug)->first();
        
        if(Auth::check()){
            $acc = Account::where('id',Auth::user()->id)->first();
            $orderDe_id = null;
            foreach ($data['course']->orderDe as $item) {
                if ($item->order->ord_acc_id == Auth::user()->id) {
                    $orderDe_id = $item->orderDe_id;
                }
            }
            
            $code = Code::where('code_orderDe_id',$orderDe_id)->first();
            if($code != null){
                if($code->code_status == 1){
                    $data['course'] = Course::where('cou_slug',$slug)->first();
                    $data['part'] = $data['course']->part;
                    $i = 0;
                    foreach ($data['part'] as $part) {
                        foreach ($part->lesson as $lesson) {
                           $data['listVideo'][$i] = $lesson->les_link;
                           $i++;
                        }
                    }
                    $data['video'] = $data['listVideo'][$id];
                   
                    return view('frontend.course.video',$data);
                }
                else{
                    return redirect('courses/detail/'.$slug.'.html')->with('error','Bạn chưa kích hoạt khóa học này');
                }
            }
            else{
                return redirect('courses/detail/'.$slug.'.html');
            }
        }
        else{
            return redirect('courses/detail/'.$slug.'.html');
        }

                    
    }

    public function getTeacher($slug){
        $course = Course::where('cou_slug',$slug)->first();
        $data['teacher'] = $course->tea;
        return view('frontend.teacher',$data);
    }

    public function getActive($slug){
        if(Auth::check()){

            $cou = Course::where('cou_slug',$slug)->first();

            if ($cou->cou_status == 1) {
                foreach ($cou->orderDe as $item) {
                    if ($item->order->ord_acc_id == Auth::user()->id) {
                        $orderDe_id = $item->orderDe_id;
                    }
                }

                $code = Code::where('code_orderDe_id',$orderDe_id)->first();
                if($code != null){
                    if($code->code_status == 1){

                        $course_relate = $cou->group->course;
                        $list_cou_ids = [];
                        foreach ($course_relate as $item) {
                            if ($cou->cou_id != $item->cou_id) {
                                $list_cou_ids[] = $item->cou_id;
                            }
                            
                        }

                        $data['course_relate'] = Course::whereIn('cou_id', $list_cou_ids)->inRandomOrder()->take(3)->get();
                        $data['course'] = $cou;
                        // $data['rat'] = Rating::where('rat_cou_id',$cou->cou_id)->where('rat_acc_id',Auth::user()->id)->first();
                        
                        $data['active'] = true;
                        return view('frontend.course.detail',$data);
                    }
                    else{
                        return redirect('courses/detail/'.$slug.'.html')->with('error','Bạn chưa kích hoạt khóa học này');
                    }
                }
                else{
                    return redirect('courses/detail/'.$slug.'.html')->with('error','Bạn đã cố gắng');
                }
            }
            else{
                return back()->with('error','Khóa học của chúng tôi đang trong quá trình bảo trì');
            }   
                
        }
        else{
            return redirect('courses/detail/'.$slug.'.html')->with('error','Bạn phải đăng nhập');
        }
            
    }
    public function postRate(){
        $star = (int)Input::get('star');
        $content = Input::get('content');
        $cou_id = Input::get('cou_id');
        if (Auth::check()) {
            $rate = Rating::where('rat_acc_id' , Auth::user()->id)->where('rat_cou_id', $cou_id)->first();
            isset($rate) ? '' : $rate = new Ratting;
            $rate->rat_star = $star;
            $rate->rat_content = $content;
            $rate->save();
            $this->reloadRate($cou_id);
            return response('ok', 200);
        }
        else{
            return response('error', 501);
        }   
            
    }
       
}

