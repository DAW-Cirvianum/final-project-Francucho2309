<h1>Añadir equipo</h1>

<form action="{{ route('teams.store') }}" method="POST">
    @csrf

    <label>Nombre de equipo: </label>
    <input type="text" name="name" required>

    <label>Liga: </label>
    <select name="league_id" required>
        <option value="" disabled selected>Selecciona una liga</option>
        @foreach ($leagues as $league)
        <option value="{{ $league->id }}">{{ $league->name }}</option>
        @endforeach
    </select>

    <button>Guardar</button>
</form>