<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Tool;
use App\Models\ToolSection;
use Illuminate\Http\Request;
use App\Http\Traits\HelperTrait;
use App\Http\Requests\ToolRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ToolController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->isTeacher())
        {
            $content = Tool::where('teacher_id', $this->userId())->orderBy('sort', 'asc')->paginate($this->paginate);
        }
        else
        {
            $content = Tool::orderBy('sort', 'asc')->paginate($this->paginate);
        }
        return view('admin_dashboard.tools.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = ToolSection::all();
    return view('admin_dashboard.tools.create', compact('sections'));
    }


    public function section()
    {
            $sections = ToolSection::all();
            return view('admin_dashboard.toolsection.index', compact('sections'));

    }
    public function createsection(){
        return view('admin_dashboard.toolsection.create');

    }
    public function deletesection(request $request ,$id){
        $section = ToolSection::findOrFail($id);
        $section->delete();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('toolssection')->with('success', 'تم حذف قسم الأدوات الدراسية بنجاح.');
    }

    public function storesection(request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // إنشاء قسم الأدوات الدراسية وحفظه في قاعدة البيانات
        ToolSection::create([
            'section_name' => $validatedData['name'],
        ]);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('toolssection')->with('success', 'تم إضافة قسم الأدوات الدراسية بنجاح.');
    }
    public function editsection($id)
    {
        $section = ToolSection::findOrFail($id);
        return view('admin_dashboard.toolsection.edit', compact('section'));
    }

    // طريقة لتحديث بيانات قسم الأدوات الدراسية في قاعدة البيانات
    public function updatesection(Request $request, $id)
    {
        // تحقق من صحة البيانات المدخلة
        $validatedData = $request->validate([
            'section_name' => 'required|string|max:255',
        ]);

        // تحديث قسم الأدوات الدراسية في قاعدة البيانات
        $section = ToolSection::findOrFail($id);
        $section->update([
            'section_name' => $validatedData['section_name'],
        ]);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('toolssection')->with('success', 'تم تحديث قسم الأدوات الدراسية بنجاح.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ToolRequest $request)
    {
        $data = $request->validated();
        //upload Image
        $image = $this->upload_file_helper_trait($request, 'image', 'uploads/');
        $data['image'] = $image;
        isset($data['status']) ? $data['status'] = 'yes' : $data['status'] = 'no';
        $data['teacher_id'] = $this->userId();

        // إذا تم اختيار القسم، قم بحفظه مع البيانات
        if ($request->filled('tool_section_id')) {
            $data['tool_section_id'] = $request->input('tool_section_id');
        }

        Tool::create($data);
        return redirect()->route('tools.index')->with('success', 'تم انشاء  الأداه الدراسية بنجاح.');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tool $tool)
    {
        $content =  $tool;
        $this->editPermission($content);

        // استعلام للحصول على الأقسام من قاعدة البيانات
        $sections = ToolSection::all();

        return view('admin_dashboard.tools.edit', compact('content', 'sections'));
    }


    public function showAttach($id)
    {
        $content = Tool::find($id);
        return view('admin_dashboard.tools.attach', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ToolRequest $request, Tool $tool)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $image = $this->upload_file_helper_trait($request,'image', 'uploads/');
            $data['image'] = $image;
        }
        isset($data['status']) ? $data['status']='yes' : $data['status'] = 'no';

        // تحديث القسم المختار
        if ($request->filled('tool_section_id')) {
            $data['tool_section_id'] = $request->input('tool_section_id');
        }

        $tool->update($data);
        return redirect()->route('tools.index')->with('success', 'تم تحديث الأداه الدراسية بنجاح.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $tool)
    {
        $tool->delete();
        return redirect()->route('tools.index')->with('success', 'تم حذف  الأداه الدراسية بنجاح.');
    }
}
