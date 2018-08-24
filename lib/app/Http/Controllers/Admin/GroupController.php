<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
class GroupController extends Controller
{
    public function getList(){
    	$data['items'] = Group::where('gr_parent_id', 0)->paginate(10);
    	return view('backend.group',$data);
    }
    public function getDetail($id){
    	$gr = Group::find($id);
        $data['items'] = Group::where('gr_parent_id', $gr->gr_id)->paginate(10);
    	return view('backend.group', $data);
    }
    public function postDetail(Request $request){
        $gr = new Group;
        $gr->gr_name = $request->name;
        $gr->gr_parent_id = $request->segment(4);
        $image = $request->file('img');
        if ($request->hasFile('img')) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $gr->gr_img = $filename;
            $request->img->storeAs('group',$filename);
        }
        // $gr->gr_img = $request->icon;
        $gr->gr_slug = str_slug($request->name);
        
        $gr->save();

        return back()->with('success','Thêm lĩnh vực thành công');
    }
    public function postAdd(Request $request){
    	$gr = new Group;
        $gr->gr_name = $request->name;

        $image = $request->file('img');
        if ($request->hasFile('img')) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $gr->gr_img = $filename;
            $request->img->storeAs('group',$filename);
        }
        // $gr->gr_img = $request->icon;
        $gr->gr_slug = str_slug($request->name);
        
        $gr->save();

    	return redirect('admin/group')->with('success','Thêm lĩnh vực thành công');
    }
    public function getEdit($id){
    	$data['items'] = Group::paginate(8);
        $data['item'] = Group::find($id);
        return view('backend.editGroup', $data);
    }
    public function postEdit(Request $request, $id){
        $gr = Group::find($id);
        $gr->gr_name = $request->name;

        $image = $request->file('img');
        if ($request->hasFile('img')) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $gr->gr_img = $filename;
            $request->img->storeAs('group',$filename);
        }
        // $gr->gr_img = $request->icon;
        $gr->gr_slug = str_slug($request->name);
        
       
        $gr->save();

        return back()->with('success','Sửa lĩnh vực thành công');
    }

    public function getDelete($id){
        Group::destroy($id);
        return back();
    }
}
