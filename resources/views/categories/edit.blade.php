
@extends('home')
@section('dash')

<div class="col-md-10">
    <div class="card">
    <div class="card-header">
        <span class="redir" > <a href="{{route('categories')}}"><i class="las la-angle-left"></i></a>
        </span>
        <span  style="text-align: center"> Modifier la Categorie</span></div>
    <div class="card-body">
        <form method="Post" name="my-form"  action=" {{ route('categorie.update',['id' =>$categorie->id]) }} " enctype="multipart/form-data" >
            @csrf
            @method('PUT')
                <div class="form-group row">
                    <label for="nom" class="col-md-4 col-form-label text-md-left">Nom</label>
                    <div class="col-md-6">
                        <input type="text" id="nom" class="form-control" name="nom" value=" {{ $categorie->nom }} " >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description_c" class="col-md-4 col-form-label text-md-left">Description</label>
                    <div class="col-md-6">
                        <textarea class="form-control" name="description_c" id="description_c" cols="30" rows="10"> {{ $categorie->description_c }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-left">Image</label>
                     @if ("/storage/images/categories/{{ $categorie->image_c }}")
                        <img src="{{ asset('/storage/images/categories/'.$categorie->image_c) }}" alt="" title="" width="25%" height="25%">
                        @else
                        <p>image n'existe pas</p>
                @endif
                    <div class="col-md-6" style="margin:2% 0 0 30%">
                        <input type="file" name="image_c" id="image" class="form-control-file">
                    </div>
                </div>

                @if($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)

                        <li>{{$error}} </li>
                        @endforeach
                    </ul>
                @endif
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-success">
                    Edit
                    </button>
                </div>
            </div>

        </form>

    </div>
</div>

</div>

@stop
