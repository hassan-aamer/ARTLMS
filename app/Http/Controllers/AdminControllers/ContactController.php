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
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ArticleRequest;
use App\Models\ContactFile;
use Illuminate\Support\Facades\Storage;

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

    public function showUpdate($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin_dashboard.contacts.update', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $contact = Contact::findOrFail($id);

            $contact->update($request->all());

            DB::commit();

            return redirect()->back()->with(['success' => 'تم تعديل الرساله ']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function att(Request $request, $id)
    {
        DB::beginTransaction();
        try {
        $contact = Contact::findOrFail($id);
        $contactFileData = [
            'contact_id' => $contact->id,
            'url' => implode(', ', $request['url']),
            'link' => implode(', ', $request['link']),
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

        ContactFile::create($contactFileData);

        DB::commit();

        return redirect()->back()->with(['success' => 'تم اضافة المرفقات']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function send(Request $request, $id)
    {
        try {
            $request->validate([
                'message' => 'required|string',
            ]);

            $contact = Contact::find($id);

            $email = $contact->email;
            $title = $request->title;
            $message = $request->message;

            Mail::to($email)->send(new sendMail($message,$title));

            return redirect()->back()->with(['success' => 'تم ارسال الرسالة بنجاح']);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function showAtt($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin_dashboard.contacts.attatch', compact('contact'));
    }

}
