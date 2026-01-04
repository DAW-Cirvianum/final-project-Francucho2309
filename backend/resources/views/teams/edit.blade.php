<h1>Editar equipo</h1>

<form action="{{ route('teams.update', $team) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombre de equipo: </label>
    <input type="text" name="name" value="{{ $team->name }}" required>

    <label>Liga</label>
    <select name="league_id" required>
        @foreach ($leagues as $league)
        <option value="{{ $league->id }}" {{ $team->league_id == $league->id ? 'selected' : '' }}>
            {{ $league->name }}
        </option>
        @endforeach
    </select>

    <button>Actualizar</button>
</form>