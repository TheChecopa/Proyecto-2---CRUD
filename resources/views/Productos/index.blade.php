
@extends('layouts.app')
@section('content')
<div class="container">
    
@if(Session::has('mensaje'))
<div class="alert alert-warning alert-bs-dismissible" role="alert">
    {{ Session::get('mensaje') }}
    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif





<a href="{{ url('productos/create') }}" class="btn btn-success">Registrar nuevo producto</a>
    <br/>
    <br/>
    <table class="table table-light">
        <thead>
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach( $productos as $Producto )
            <tr>
                <td>{{ $Producto->id }}</td>
                <td><img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$Producto->Foto }}"  width="100" alt=""></td>
                <td>{{ $Producto->Nombre }}</td>
                <td>{{ $Producto->Descripcion }}</td>
                
                

                <td>
                    <a href="{{ url('/productos/'.$Producto->id.'/edit') }}" class="btn btn-warning">
                        Editar</a>
                    <form action="{{ url('/productos/'.$Producto->id ) }}" class="d-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('Quieres borrar?')" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $productos->links() !!}
</div>
@endsection