<x-mail::message>
# Welcome, {{ $user->name }}!

Thank you for registering at **GroceryHub**. We're thrilled to have you on board!

You can now explore our platform and start your shopping with us.

@component('mail::button', ['url' => url('http://127.0.0.1:8000/')])
Go to GroceryHub
@endcomponent

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
