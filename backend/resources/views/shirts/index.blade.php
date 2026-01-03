<h1>Camisetas</h1>

<a href="{{ route('shirts.create') }}">Añadir camiseta</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Equipo</th>
        <th>Temporada</th>
        <th>Acciones</th>
    </tr>

    @foreach($shirts as $shirt)
    <tr>
        <td>{{ $shirt->id }}</td>
        <td>{{ $shirt->team->name }}</td>
        <td>{{ $shirt->season }}</td>
        <td>
            <a href="{{ route('shirts.edit', $shirt) }}">Editar</a>

            <form action="{{ route('shirts.destroy', $shirt) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>