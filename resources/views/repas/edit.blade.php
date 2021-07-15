
@extends('home')
@section('dash')

<div class="col-md-10">
    <div class="card">

    <div class="card-header"><span  style="text-align: center"> Modifier Repas</span></div>
    <div class="card-body">
        <form method="Post" name="my-form"  action=" {{ route('food.update',['id' =>$food->id]) }} " enctype="multipart/form-data" >
            @csrf
            @method('PUT')
                <div class="form-group row">
                    <label for="nom" class="col-md-4 col-form-label text-md-left">Nom</label>
                    <div class="col-md-6">
                        <input type="text" id="nom" class="form-control" name="nom" value=" {{ $food->nom }} " >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-left">Description</label>
                    <div class="col-md-6">
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10"> {{ $food->description }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="prix" class="col-md-4 col-form-label text-md-left">Prix</label>
                    <div class="col-md-6">
                        <input type="text" id="prix" class="form-control" name="prix"  value=" {{ $food->prix }} ">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-left">Image</label>
                     @if ("/storage/images/foods/{{ $food->image }}")
                        <img src="{{ asset('/storage/images/foods/'.$food->image) }}" alt="" title="" width="25%" height="25%">
                        @else
                        <p>image n'existe pas</p>
                @endif
                    <div class="col-md-6" style="margin:2% 0 0 30%">
                        <input type="file" name="image" id="image" class="form-control-file">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stock" class="col-md-4 col-form-label text-md-left">Stock</label>
                    <div class="col-md-6">
                        <input type="text" id="stock" class="form-control" name="stock"  value=" {{ $food->stock }} ">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="categories" class="col-md-4 col-form-label text-md-left">Categorie</label>
                    <div class="col-md-6">
                        <select class="custom-select mr-sm-2" id="categories" name="categories">
                            @foreach($categories as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $food->categorie_id) selected @endif>{{ $item->nom }}</option>
                          @endforeach
                          </select>
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
