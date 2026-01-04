<h1>Camisetas</h1>

<a href="{{ route('shirts.create') }}">Añadir camiseta</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Temporada</th>
        <th>Precio</th>
        <th>Equipo</th>
        <th>Imagenes</th>
        <th>Acciones</th>
    </tr>

    @foreach ($shirts as $shirt)
    <tr>
        <td>{{ $shirt->id }}</td>
        <td>{{ $shirt->name }}</td>
        <td>{{ $shirt->season }}</td>
        <td>{{ $shirt->price }}</td>
        <td>{{ $shirt->team->name }}</td>
        <td>
            @foreach ($shirt->images as $image)
            <img src="{{ asset('storage/' . $image->url_image) }}" width="60">
            @endforeach
        </td>
        <td>
            <a href="{{ route('shirts.edit', $shirt) }}">Editar</a>

            <form action="{{ route('shirts.destroy', $shirt) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>