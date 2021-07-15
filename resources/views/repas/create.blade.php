
@extends('home')
@section('dash')

<div class="col-md-10">
    <div class="card">

        <div class="card-header"><span  style="text-align: center"> Ajouter nouveau Repas</span></div>
        <div class="card-body">
            <form name="my-form"  action=" {{ route('food.store') }} " enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="nom" class="col-md-4 col-form-label text-md-left">Nom</label>
                    <div class="col-md-6">
                        <input type="text" id="nom" class="form-control" name="nom">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-left">Description</label>
                    <div class="col-md-6">
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="prix" class="col-md-4 col-form-label text-md-left">Prix</label>
                    <div class="col-md-6">
                        <input type="text" id="prix" class="form-control" name="prix">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-left">Image</label>
                    <div class="col-md-6">
                        <input type="file" name="image" id="image" class="form-control-file">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stock" class="col-md-4 col-form-label text-md-left">Stock</label>
                    <div class="col-md-6">
                        <input type="text" id="stock" class="form-control" name="stock">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="categories" class="col-md-4 col-form-label text-md-left">Categorie</label>
                    <div class="col-md-6">
                        <select class="custom-select mr-sm-2" id="categories" name="categories">
                            <option value="">Choisir la catégorie...</option>
                            @foreach($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->nom }}</option>
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
                    Ajouter
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

</div>

@stop
