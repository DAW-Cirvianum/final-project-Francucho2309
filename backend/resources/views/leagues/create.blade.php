<h1>Añadir ligas</h1>

<form action="{{ route('leagues.store') }}" method="POST">
    @csrf

    <label>Nombre de liga: </label>
    <input type="text" name="name">

    <label>País: </label>
    <select name="country">
        <option value="" disabled selected>Selecciona un país</option>

        @foreach ($countries as $country)
        <option value="{{ $country }}">{{ $country }}</option>
        @endforeach
    </select>

    <button>Guardar</button>
</form>