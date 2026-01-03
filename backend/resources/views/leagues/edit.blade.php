<h1>Editar ligas</h1>

<form action="{{ route('leagues.update', $league) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombre de liga: </label>
    <input type="text" name="name" value="{{ $league->name }}">

    <label>País: </label>
    <select name="country">
        @foreach ($countries as $country)
        <option value="{{ $country }}" {{ $league->country == $country ? 'selected' : '' }}>
            {{ $country }}
        </option>
        @endforeach
    </select>

    <button>Actualizar</button>
</form>