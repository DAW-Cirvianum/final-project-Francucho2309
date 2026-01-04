<h1>Editar camiseta</h1>

<form action="{{ route('shirts.update', $shirt) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombre: </label>
    <input type="text" name="name" value="{{ $shirt->name }}" required>

    <label>Temporada: </label>
    <input type="text" name="season" placeholder="2025/2026" value="{{ $shirt->season }}" required>

    <label>Precio (€): </label>
    <input type="number" step="0.01" name="price" value="{{ $shirt->price }}" required>

    <label>Equipo: </label>
    <select name="team_id" required>
        @foreach ($teams as $team)
        <option value="{{ $team->id }}" {{ $shirt->team_id == $team->id ? 'selected' : '' }}>
            {{ $team->name }}
        </option>
        @endforeach
    </select>

    <button>Actualizar</button>
</form>