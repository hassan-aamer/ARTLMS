<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Traits\HelperTrait;
use App\Http\Controllers\Controller;

class SendEmailController extends Controller
{
    use HelperTrait;
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $contactMessage = Contact::find($id);
        $student = User::with('userInfo')->whereType(3)->orderBy('id', 'asc')->paginate($this->paginate);
        $teacher = User::with('userInfo')->whereType(2)->orderBy('id', 'asc')->paginate($this->paginate);
        return view('admin_dashboard.send-email.index',compact('contactMessage','student','teacher'));
    }

    public function store(Request $request)
    {
        return $request;
    }


}
