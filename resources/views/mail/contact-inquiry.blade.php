<x-mail::message>
# New clinic message

**Name:** {{ $contact->name }}

**Phone:** {{ $contact->phone }}

@if ($contact->branch)
**Branch:** {{ $contact->branch }}
@endif

@if ($contact->service)
**Service:** {{ $contact->service }}
@endif

@if ($contact->message)
**Message:**

{{ $contact->message }}
@endif
</x-mail::message>
