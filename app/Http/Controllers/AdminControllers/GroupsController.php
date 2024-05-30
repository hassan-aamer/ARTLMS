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
        $contactFileData = [
            'name' => $request->name,
            'url' => implode(', ', $request['url']),
            'link' => implode(', ', $request['link']),

            // 'url' => $request->url,
            // 'link' => $request->link,
            'file' => $request->file,
            'description' => $request->description,
            'title' => $request->title,
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'images');
            $contactFileData['image'] = $imagePath;
        }

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('files', 'images');
            $contactFileData['file'] = $filePath;
        }
        Group::create($contactFileData);
        return redirect()->route('groups.index');
    }


    public function update(Request $request, string $id)
    {
        $group = Group::find($id);
        $group->update($request->all());
        return redirect()->back()->with(['success' => 'تم تعديل اسم المجموعه بنجاح  ']);
    }
    public function show()
    {


        return view('admin_dashboard.groups.create',);
    }
    public function destroy($id)
    {
        Group::find($id)->delete();
        return redirect()->back()->with(['success' => 'تم الحذف بنجاح  ']);
    }
}
