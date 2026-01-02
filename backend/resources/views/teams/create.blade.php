<h1>Nuevo Equipo</h1>

<form action="{{ route('teams.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Nombre del equipo">
    <input type="text" name="league" placeholder="Liga">
    <input type="text" name="country" placeholder="País">

    <button>Guardar</button>
</form>