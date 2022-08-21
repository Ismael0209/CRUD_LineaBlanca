<h1>{{ $modo }} articulo</h1>

@if(count($errors)>0)

    <div class="alert alert-primary" role="alert">
<ul> 
    @foreach( $errors->all() as $error)
          <li> {{ $error }} </li>
    @endforeach
</ul>    
    </div>  

@endif

<div class="form-group">
<label for="Articulo"> Articulo</label>
<input type="text" class="form-control" name="Articulo" 
value="{{ isset($articulo->Articulo)?$articulo->Articulo:old('Articulo')}}" id="Articulo"> 
<br>
</div>


<div class="form-group">
<label for="Cantidad"> Cantidad</label>
<input type="text" class="form-control" name="Cantidad" 
value="{{isset($articulo->Cantidad)?$articulo->Cantidad:old('Cantidad')}}" id="Cantidad">
<br>
</div>


<div class="form-group">
<label for="Caducidad"> Caducidad (YYYY-MM-DD)</label>
<input type="text" class="form-control" name="Caducidad" 
value="{{isset($articulo->Caducidad)?$articulo->Caducidad:old('Caducidad')}}" id="Caducidad">
<br>
</div>

<div class="form-group">
<label for="Precio"> Precio</label>
<input type="text" class="form-control" name="Precio" 
value="{{isset($articulo->Precio)?$articulo->Precio:old('Precio')}}" id="Precio">
<br>
</div>

<div class="form-group">
<label for="Foto"> </label>
@if(isset($articulo->Foto))
<img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$articulo->Foto}}" width="100" alt="">
@endif
<input type="file" class="form-control" name="Foto" value="" id="Foto">
<br>
</div>

<input class="btn btn-success" type="submit" value="{{ $modo }} datos">

<a class="btn btn-primary" href="{{url('/articulo')}}"> Regresar</a>
<br>