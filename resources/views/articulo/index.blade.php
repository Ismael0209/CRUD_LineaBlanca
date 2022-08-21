@extends('layouts.app')

@section('content')


<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h3 class="display-4">Tienda de Linea Blanca &#127980;</h3>
    <p class="lead"> - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
         - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </p>
    
    <figure class="figure">
        <img src="https://cdn.homedepot.com.mx/departamentos/29_Linea_Blanca/2022/Hero_D.jpg" class="figure-img img-fluid rounded" 
        alt="A generic square placeholder image with rounded corners in a figure.">
    </figure>
    
  </div>
</div>

<br>
</br>


<div class="container">


@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
{{Session::get('mensaje')}}



<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>



</div>
@endif
<a href="{{url('/articulo/create')}}" class="btn btn-primary class = " > Añadir Nuevo Articulo</a>
<br>
</br>
<table class="table table-striped">

    <thead class="table table-striped">
        <tr>
            <th>ID articulo</th>
            <th>Foto</th>
            <th>Articulo</th>
            <th>Cantidad</th>
            <th>Caducidad</th>
            <th>Precio</th>  
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($articulos as $articulo)
        <tr>
            <td>{{$articulo->id}}</td>

            <td>
                <img class="img-thumbnail img-fluid"  src="{{asset('storage').'/'.$articulo->Foto}}" width="100" alt="">
                
            </td>


            <td>{{$articulo->Articulo}}</td>
            <td>{{$articulo->Cantidad}}</td>
            <td>{{$articulo->Caducidad}}</td>
            <td>{{$articulo->Precio}}</td>
            <td>

            <a href="{{url('/articulo/'.$articulo->id.'/edit')}}" class="btn btn-primary"> 
                Editar 
            </a>  
            
            <form action="{{url('/articulo/'.$articulo->id)}}" class="d-inline" method="post">
            @csrf
            {{method_field('DELETE')}}
            <input class="btn btn-danger"  type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
            </form>

            </td>
        </tr>
        @endforeach
    </tbody>

</table>
{!! $articulos->links() !!}
<br>
</br>




<br>
</br>

<br>
</br>
<br>
</br>
</div>
@endsection