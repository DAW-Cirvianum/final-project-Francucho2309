@extends('layouts.app')

@section('title', 'Pedido #' . $order->id)
@section('header', 'Detalle del pedido')

@section('content')
<div class="mb-6">
    <p><strong>Pedido:</strong> #{{ $order->id }}</p>
    <p><strong>Usuario:</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>
    <p><strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Total:</strong> {{ $order->total }} €</p>
</div>

<div class="bg-white shadow rounded">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Camiseta</th>
                <th class="p-2">Equipo</th>
                <th class="p-2">Talla</th>
                <th class="p-2">Cantidad</th>
                <th class="p-2">Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->details as $detail)
            <tr class="border-t">
                <td class="p-2">{{ $item->shirt->name }}</td>
                <td class="p-2">{{ $item->shirt->team->name }}</td>
                <td class="p-2">{{ $item->size }}</td>
                <td class="p-2">{{ $item->quantity }}</td>
                <td class="p-2">{{ $item->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection