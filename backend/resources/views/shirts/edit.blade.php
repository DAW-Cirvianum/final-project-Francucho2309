<h1>Editar camiseta</h1>

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('shirts.update', $shirt) }}" method="POST" enctype="multipart/form-data">
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

    <label>Imágenes: </label>
    <input type="file" name="images[]" multiple>

    <h3>Imágenes actuales</h3>

    @foreach ($shirt->images as $image)
    <div style="display: inline-block; margin:10px;">
        <img src="{{ asset('storage/' . $image->url_image) }}" width="80">

        <form action="{{ route('shirt-images.destroy', $image) }}" method="POST">
            @csrf
            @method('DELETE')
            <button>Eliminar</button>
        </form>
    </div>
    @endforeach

    <button>Actualizar</button>
</form>