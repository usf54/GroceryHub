<x-mail::message>
# Thank you for your order, {{ $order->user->name }}!

Your order **#{{ $order->id }}** has been successfully placed.

**Order details:**

{{-- Product items --}}
@foreach($order->orderDetails as $detail)
- **{{ $detail->product->name }}** × {{ $detail->quantity }} — ${{ number_format($detail->subtotal, 2) }}
@endforeach

{{-- Pack items --}}
@foreach($order->orderPackDetails as $detail)
- **{{ $detail->pack->name }}** × {{ $detail->quantity }} — ${{ number_format($detail->subtotal, 2) }}
@endforeach

**Total:** ${{ number_format($order->final_total, 2) }}

@component('mail::button', ['url' => route('orders.show', $order->id)])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
