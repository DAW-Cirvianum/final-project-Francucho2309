<h1>Ligas</h1>

<a href="{{ route('leagues.create') }}">Añadir liga</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>País</th>
        <th>Acciones</th>
    </tr>

    @foreach ($leagues as $league)
    <tr>
        <td>{{ $league->id }}</td>
        <td>{{ $league->name }}</td>
        <td>{{ $league->country }}</td>
        <td>
            <a href="{{ route('leagues.edit', $league) }}">Editar</a>

            <form action="{{ route('leagues.destroy', $league) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>