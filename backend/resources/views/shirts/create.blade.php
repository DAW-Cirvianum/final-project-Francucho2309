<h1>Nueva camiseta</h1>

<form action="{{ route('shirts.store') }}" method="POST">
    @csrf

    <select name="team_id">
        @foreach($teams as $team)
            <option value="{{ $team->id }}">{{ $team->name }}</option>
        @endforeach
    </select>

    <input type="text" name="season" placeholder="Temporada">
    <input type="text" name="size" placeholder="Talla">
    <input type="number" name="price" placeholder="Precio">
    
    <button>Guardar</button>
</form>