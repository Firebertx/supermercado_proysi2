@component('mail::message')
# Credenciales para acceder a la plataforma {{config('app.name')}}

Utiliza estas credenciales para acceder al sistema.

@component('mail::table')
    | Usuario | Contraseña |
    |:----------|:----------|
    |{{$user->email}}|{{$password}}|
@endcomponent
@component('mail::button', ['url' => url('login')])
Login
@endcomponent

Gracias, <br>
{{ config('app.name') }}
@endcomponent
