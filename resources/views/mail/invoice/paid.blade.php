@component('mail::message')
Obrigado por gerar este pedido de pagamento, use o link a seguir para continuar



@component('mail::button', ['url' => 'https://www.sistemafaculdade.com.br/'])
Pagar
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
