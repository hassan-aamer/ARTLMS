<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TermRequest;
use App\Http\Traits\HelperTrait;
use App\Models\Term;

class TermController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->isTeacher())
        {
            $content = Term::where('teacher_id', $this->userId())->latest()->paginate($this->paginate);
        }
        else
        {
            $content = Term::latest()->paginate($this->paginate);
        }
        return view('admin_dashboard.terms.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_dashboard.terms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TermRequest $request)
    {
        $data = $request->validated();
        $data['teacher_id'] = $this->userId();
        Term::create($data);
        toastr()->success($this->insertMsg, 'تم إضافة الفصل الدراسي بنجاح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Term $term)
    {
        $content =  $term;
        $this->editPermission($content);
        return view('admin_dashboard.terms.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TermRequest $request, Term $term)
    {
        $data = $request->validated();
        $term->update($data);
        toastr()->success($this->updateMsg, 'تم تعديل الفصل الدراسي', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Term $term)
    {
        $term->delete();
        toastr()->success($this->deleteMsg, 'تم حذف الفصل الدراسي بنجاح', ['timeOut' => 5000]);
        return redirect()->back();
    }
}
