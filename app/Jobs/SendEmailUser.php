<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Contact;
use App\Mail\SendEmailUsers;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendEmailUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contactMessageId;
    protected $teacherIds;
    protected $studentIds;

    public function __construct($contactMessageId, $teacherIds, $studentIds)
    {
        $this->contactMessageId = $contactMessageId;
        $this->teacherIds = $teacherIds;
        $this->studentIds = $studentIds;
    }

    public function handle()
    {

        $contactDetails = Contact::find($this->contactMessageId);

        $userIds = array_merge($this->teacherIds, $this->studentIds);

        $emails = User::whereIn('id', $userIds)->pluck('email')->toArray();

        Mail::to($emails)->send(new SendEmailUsers($contactDetails));

    }
}
