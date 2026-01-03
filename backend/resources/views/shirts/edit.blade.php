<h1>Editar camiseta</h1>

<form action="{{ route('shirts.update', $shirt) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Equipo</label>
    <select name="team_id">
        @foreach($teams as $team)
            <option value="{{ $team->id }}" {{ $shirt->team_id == $team->id ? 'selected' : '' }}>
                {{ $team->name }}
            </option>
        @endforeach
    </select>

    <label>Temporada</label>
    <input type="text" name="season" value="{{ $shirt->season }}">

    <button>Actualizar</button>
</form>