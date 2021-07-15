
@extends('home')
@section('dash')

<div class="col-md-10">
    <div>
        @if ($errors->any())
            @foreach ( $errors->all() as $error )
            <div class="alert alert-danger" role="alert" style="width: 50% ; height:30%">
                {{ $error }}
            </div>
            @endforeach

        @endif
    </div>
    <div class="card">


        <div class="card-header"><span  style="text-align: center"> Ajouter nouvelle Categorie</span></div>
        <div class="card-body">
            <form name="my-form"  action=" {{ route('categorie.store') }} " enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="nom" class="col-md-4 col-form-label text-md-left">Nom du Categorie</label>
                    <div class="col-md-6">
                        <input type="text" id="nom" class="form-control" name="nom">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description_c" class="col-md-4 col-form-label text-md-left">Description</label>
                    <div class="col-md-6">
                        <textarea class="form-control" name="description_c" id="description_c" cols="30" rows="10"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image_c" class="col-md-4 col-form-label text-md-left">Image</label>
                    <div class="col-md-6">
                        <input type="file" name="image_c" id="image_c" class="form-control-file">
                    </div>
                </div>
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-success">
                    Ajouter
                    </button>

                </div>


        </form>
    </div>
</div>

</div>

@endsection
