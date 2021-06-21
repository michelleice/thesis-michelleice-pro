Thank you, <br />
<b style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 20px;">{{ $conversation->signature }}</b><br />
@if ($conversation->ticket && $conversation->ticket->vendor)
{{ $conversation->ticket->vendor->name }}
@endif
