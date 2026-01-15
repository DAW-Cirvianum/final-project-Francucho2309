@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Panel de administración')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-4 shadow rounded">
        <p class="text-gray-500">Usuarios</p>
        <p class="text-2xl font-bold">{{ $usersCount }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <p class="text-gray-500">Pedidos</p>
        <p class="text-2xl font-bold">{{ $ordersCount }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <p class="text-gray-500">Camisetas</p>
        <p class="text-2xl font-bold">{{ $shirtsCount }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <p class="text-gray-500">Ingresos</p>
        <p class="text-2xl font-bold">{{ number_format($totalRevenue, 2) }} €</p>
    </div>
</div>

<div class="bg-white shadow rounded">
    <h2 class="text-lg font-bold p-4 border-b">Últimos pedidos</h2>

    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Usuario</th>
                <th class="p-2">Total</th>
                <th class="p-2">Fecha</th>
                <th class="p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($latestOrders as $order)
            <tr class="border-t">
                <td class="p-2 text-center">#{{ $order->id }}</td>
                <td class="p-2 text-center">{{ $order->user->name }}</td>
                <td class="p-2 text-center">{{ $order->total_price }} €</td>
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