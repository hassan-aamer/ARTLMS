<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Level;
use App\Mail\sendMail;
use App\Models\Contact;
use App\Mail\ContactMail;
use App\Models\ArticleTag;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Http\Traits\HelperTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ArticleRequest;

class ContactController extends Controller
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $content = Contact::latest()->paginate($this->paginate);
        return view('admin_dashboard.contacts.index', compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Contact $contact)
    {
        $content = $contact;
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

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        return redirect()->back()->with(['success' => 'تم ارسال الرسالة بنجاح']);
    }

    public function send(Request $request, $id)
    {
        try {
            $request->validate([
                'message' => 'required|string',
            ]);

            $contact = Contact::find($id);

            $email = $contact->email;
            $message = $request->message;

            Mail::to($email)->send(new sendMail($message));

            return redirect()->back()->with(['success' => 'تم ارسال الرسالة بنجاح']);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
