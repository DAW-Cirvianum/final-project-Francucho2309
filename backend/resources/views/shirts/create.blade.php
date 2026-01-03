<h1>Nueva camiseta</h1>

<form action="{{ route('shirts.store') }}" method="POST">
    @csrf

    <label>Equipos</label>
    <select name="team_id">
        @foreach($teams as $team)
            <option value="{{ $team->id }}">{{ $team->name }}</option>
        @endforeach
    </select>

    <label>Temporada</label>
    <input type="text" name="season">
    
    <button>Guardar</button>
</form>