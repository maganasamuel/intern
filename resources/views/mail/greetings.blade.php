<x-mail::message>
# Greetings from {{ config('app.name') }}

Hello World

<x-mail::button url="{{ config('app.url') }}">
View website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
