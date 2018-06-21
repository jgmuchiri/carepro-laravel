@component('mail::message')
# {{ $note->title }} <br>
##{{ date('l, F S Y',strtotime($note->created_at)) }} | {{ date('H:i:A',strtotime($note->created_at)) }} | By {{ $note->createdByUser->name }}
@if($note->note_type_id == 1)
##location: {{ $note->location->name }}
##Incident Type: {{ $note->incidentType->name }}
@endif

##Description: <br>
{!! $note->body !!}

@if($note->note_type_id == 1)
##Actions Taken: <br>
{{{ $note->action_taken }}}

##Witnesses(include their contact number): <br>
{{{ $note->witnesses }}}

##Remarks: <br>
{{{ $note->remarks }}}
@endif

<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
