<h1>Añadir camiseta</h1>

<form action="{{ route('shirts.store') }}" method="POST">
    @csrf

    <label>Nombre: </label>
    <input type="text" name="name" required>

    <label>Temporada: </label>
    <input type="text" name="season" placeholder="2025/2026" required>

    <label>Precio (€): </label>
    <input type="number" step="0.01" name="price" required>

    <label>Equipo: </label>
    <select name="team_id" required>
        <option value="" disabled selected>Selecciona un equipo</option>
        @foreach ($teams as $team)
        <option value="{{ $team->id }}">{{ $team->name }}</option>
        @endforeach
    </select>

    <button>Guardar</button>
</form>