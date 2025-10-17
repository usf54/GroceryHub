<x-mail::message>
# New Order Received

A new order has been placed by **{{ $order->user->name }}**.

**Order ID:** #{{ $order->id }}  
**Shipping Address:** {{ $order->address }}, {{ $order->city }}  
**Total:** ${{ number_format($order->final_total, 2) }}

**Order details:**

{{-- Product items --}}
@foreach($order->orderDetails as $detail)
- **{{ $detail->product->name }}** × {{ $detail->quantity }} — ${{ number_format($detail->subtotal, 2) }}
@endforeach

{{-- Pack items --}}
@foreach($order->orderPackDetails as $detail)
- **{{ $detail->pack->name }}** × {{ $detail->quantity }} — ${{ number_format($detail->subtotal, 2) }}
@endforeach

@component('mail::button', ['url' => route('admin.orders.edit', $order->id)])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
