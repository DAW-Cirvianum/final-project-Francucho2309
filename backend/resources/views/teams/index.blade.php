<h1>Equipos</h1>

<a href="{{ route('teams.create') }}">Añadir equipo</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Equipos</th>
        <th>Liga</th>
        <th>Acciones</th>
    </tr>

    @foreach ($teams as $team)
    <tr>
        <td>{{ $team->id }}</td>
        <td>{{ $team->name }}</td>
        <td>{{ $team->league->name }}</td>
        <td>
            <a href="{{ route('teams.edit', $team) }}">Editar</a>

            <form action="{{ route('teams.destroy', $team) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>