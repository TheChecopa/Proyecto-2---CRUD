
<h1> {{ $modo }} producto </h1>

@if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach( $errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>

@endif

<div class="form-group">
<label for="Foto"></label>
@if(isset($productos->Foto))
<img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$productos->Foto }}" width="100" alt="">
@endif
<input class="form-control" type="file" name="Foto" value="" id="Foto">
<br>
</div>

<div class="form-group">
    <label for="Nombre"> Nombre</label>
    <input class="form-control" type="text" name="Nombre" 
    value="{{ isset($productos->Nombre)?$productos->Nombre:old('Nombre') }}" id="Nombre">
    <br>
</div>

<div class="form-group">
    <label for="Descripcion"> Descripcion</label>
    <input class="form-control" type="text" name="Descripcion" 
    value="{{ isset($productos->Descripcion)?$productos->Descripcion:old('Descripcion') }}" id="Descripcion">
    <br>
</div>
    <input class="btn btn-success" type="submit" value="{{ $modo }} datos" id="Guardar datos">
    <a class="btn btn-primary" href="{{ url('productos/') }}">Regresar</a>
    <br>