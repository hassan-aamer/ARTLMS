<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\HelperTrait;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\File;

class ContactController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

       $content = Contact::latest()->paginate($this->paginate);
        return view('admin_dashboard.contacts.index' , compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Contact $contact)
    {
        $content =  $contact;
        return view('admin_dashboard.contacts.show', compact('content'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        toastr()->success($this->deleteMsg, 'نجح', ['timeOut' => 5000]);
        return redirect()->back();
    }
}
