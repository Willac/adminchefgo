@component('mail::message')

Hi {{ $user->fullname() }}

You have successfully completed your registration. Welcome to {{ config('app.name') }}.

Thanks,

Team {{ config('app.name') }}
@endcomponent