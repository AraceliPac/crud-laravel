@extends('app')
@section('content')
<div class="container w-25 border p-4 mt-4">
    <form action="{{ route('todos') }}" method="POST">
        @csrf
        <!-- mensaje de exitos y de error, la variable message ya esta inyectada en todas las vistas-->
        @if (session('success'))
            <h6 class="alert alert-success">
                {{ session('success') }}
            </h6>
        @endif
        @error('title')
            <h6 class="alert alert-danger">
                {{ $message }} 
            </h6>
        @enderror
        <div class="mb-3">

            <label for="title" class="form-label">Título de la tarea</label>
            <input type="text" name="title" class="form-control">

            <label for="category_id" class="form-label">Categoria de la tarea</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category) <!--esto viene de to do ycontroller-->
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear nueva tarea</button>

</form>
<div>
    <!--div que muestra filas de la tabla mediante un hipervinculo que manda a llamar la ruta todos-edit [coloca el id elem actual y muestra su titulo]-->
    @foreach ($todos as $todo)
    <div class="row py-1">
        <div class="col-md-9 d-flex align-items-center">
            <a href="{{ route('todos-edit', ['id' => $todo->id]) }}">{{ $todo->title }}</a>
        </div>
    <!--se inserta un hipervinculo para cuando haces click te lleve a otra vista para editar 
    ademas, boton para eliminar lo lleva a la ruta destroy y pasa el id-->
        <div class="col-md-3 d-flex justify-content-end">
            <form action="{{ route('todos-destroy', [$todo->id]) }}" method="POST">
                @method('DELETE') <!--informarmos que sera metodo delete-->
                @csrf
                <button class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
</div>
</div>
@endsection