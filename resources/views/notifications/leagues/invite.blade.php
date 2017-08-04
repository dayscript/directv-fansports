@component('mail::message')
# Hola, tienes una invitación a unirte a una liga!

Has sido invitado a unirte a la liga: **{{ $league->name }}**, creada por {{ $league->user->full_name }}.

El código de la liga es: **{{ $league->code }}**.

@component('mail::button', ['url' => $url])
    Unirme a esta liga
@endcomponent

Gracias por participar en Fansports!,<br>
{{ config('app.name') }}
@endcomponent
