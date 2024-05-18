<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCategoryRequest;
use App\Http\Traits\HelperTrait;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\File;

class ArticleCategoryController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->isTeacher())
        {
            $content = ArticleCategory::where('teacher_id', $this->userId())->paginate($this->paginate);
        }
        else
        {
            $content = ArticleCategory::paginate($this->paginate);
        }
        return view('admin_dashboard.article_categories.index' , compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_dashboard.article_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleCategoryRequest $request)
    {
        $data = $request->validated();
        $data['teacher_id'] = $this->userId();
        ArticleCategory::create($data);
        toastr()->success($this->insertMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticleCategory $articleCategory)
    {
        $content =  $articleCategory;
        $this->editPermission($content);
        return view('admin_dashboard.article_categories.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleCategoryRequest $request, ArticleCategory $articleCategory)
    {
        $data = $request->validated();
        $articleCategory->update($data);
        toastr()->success($this->updateMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleCategory $articleCategory)
    {
        $articleCategory->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }
}
