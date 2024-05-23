<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function index()
    {
        $content = Group::all();
        return view('admin_dashboard.Groups.index',compact('content'));
    }

    public function create(Request $request)
    {
        Group::create($request->all());
        return redirect()->route('groups.index');
    }


    public function update(Request $request, string $id)
    {
        $group = Group::find($id);
        $group->update($request->all());
        return redirect()->back()->with(['success' => 'تم تعديل اسم المجموعه بنجاح  ']);
    }
    public function destroy($id)
    {
        Group::find($id)->delete();
        return redirect()->back()->with(['success' => 'تم الحذف بنجاح  ']);
    }
}
