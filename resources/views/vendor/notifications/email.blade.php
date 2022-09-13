@component('mail::message')
@lang(
    "  copy and paste the URL below\n".
    'into your postman and use get method for it you should conider that bearer token should set:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endcomponent
