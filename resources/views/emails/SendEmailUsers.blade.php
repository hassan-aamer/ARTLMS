<x-mail::message>

Name: {{ $contactDetails->name }}
<br>
Email: {{ $contactDetails->email }}
<br>
Phone: {{ $contactDetails->phone }}
<br>
Message: {{ $contactDetails->message }}
<br>
Subject: {{ $contactDetails->subject }}

<br><br>
<x-mail::button :url="'https://art-lms.net'">
View Website
</x-mail::button>

</x-mail::message>
