@extends('layouts.app')

@section('title', 'Pedidos')
@section('header', 'Pedidos realizados')

@section('content')
<div class="bg-white shadow rounded">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Usuario</th>
                <th class="p-2">Correo electrónico</th>
                <th class="p-2">Total</th>
                <th class="p-2">Fecha</th>
                <th class="p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="border-t">
                <td class="p-2 text-center">#{{ $order->id }}</td>
                <td class="p-2 text-center">{{ $order->user->name }}</td>
                <td class="p-2 text-center">{{ $order->user->email }}</td>
                <td class="p-2 text-center">{{ $order->total_price }}</td>
                <td class="p-2 text-center">{{ $order->created_at->format('d/m/Y') }}</td>
                <td class="p-2 text-center">
                    <a href="{{ route('orders.show', $order) }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection