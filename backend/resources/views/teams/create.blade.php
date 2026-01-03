<h1>Nuevo Equipo</h1>

<form action="{{ route('teams.store') }}" method="POST">
    @csrf

    <label>Nombre de equipo</label>
    <input type="text" name="name">

    <label>Liga</label>
    <input type="text" name="league">

    <label>País</label>
    <input type="text" name="country">

    <button>Guardar</button>
</form>