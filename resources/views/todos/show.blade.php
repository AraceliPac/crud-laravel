@extends('app')

@section('content')

<div class="container w-25 border p-4">
    <div class="row mx-auto">
    <form  method="POST" action="{{ route('todos-update', ['id' => $todo->id]) }}">
        @method('PATCH')
        @csrf
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif

            <label for="title" class="form-label">Título de la tarea</label>
            <input type="text" class="form-control" name="title"  value="{{ $todo->title }}">

            <div class="mb-3">
            <button type="submit"  class="btn btn-primary my-2">Actualizar Tarea</button>
        </div>
    </form>

    
    </div>
</div>
@endsection