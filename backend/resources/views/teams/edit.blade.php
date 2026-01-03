<h1>Editar equipo</h1>

<form action="{{ route('teams.update', $team) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Equipo</label>
    <input type="text" name="name" value="{{ $team->name }}">

    <label>Liga</label>
    <input type="text" name="league" value="{{ $team->league }}">

    <label>País</label>
    <input type="text" name="country" value="{{ $team->country }}">
    
    <button>Actualizar</button>
</form>