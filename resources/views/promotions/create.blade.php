
@extends('home')
@section('dash')

<div class="col-md-10">
    <div>
        @if ($errors->any())
            @foreach ( $errors->all() as $error )
            <div class="alert alert-danger" role="alert" style="width: 70% ; height:25%">
                {{ $error }}
            </div>
            @endforeach

        @endif
    </div>
    @if(Session::has('status'))
        <div class="alert alert-success">
            {{ Session::get('status') }}
        </div>
    @endif
    <div class="card">


        <div class="card-header"><span  style="text-align: center"> Ajouter nouvelle Promotion</span></div>
        <div class="card-body">
            <form name="my-form"  action=" {{ route('promo.store') }} " enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="description_promotion" class="col-md-4 col-form-label text-md-left">Description Promo</label>
                    <div class="col-md-6">
                        <input type="text" id="description_promotion" class="form-control" name="description_promotion">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="valeur_promotion" class="col-md-4 col-form-label text-md-left">Valeur du Promo</label>
                    <div class="col-md-6">
                        <input type="text" id="valeur_promotion" class="form-control" name="valeur_promotion">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type_promotion" class="col-md-4 col-form-label text-md-left">Type Promo</label>
                    <div class="form-check col-md-3" style="margin-left: 20px">
                        <input class="form-check-input" type="radio" name="type_promotion" id="exampleRadios1" value="Percent " checked>
                        <label class="form-check-label" for="exampleRadios1">
                         %
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_promotion" id="exampleRadios2" value="fix">
                        <label class="form-check-label" for="exampleRadios2">
                          nombre fix
                        </label>
                      </div>

                </div>

                <div class="form-group row">
                    <label for="active" class="col-md-4 col-form-label text-md-left">Activer la promotion</label>

                      <div class="form-check checkbox-lg">
                        <input class="form-check-input" type="checkbox" value="true"  name="active" id="active">
                        <label class="form-check-label" for="active">

                        </label>
                      </div>
                </div>
                <div class="form-group row">
                    <label for="date_creation" class="col-md-4 col-form-label text-md-left">Date de Creation</label>
                    <div class="col-md-6">
                        <input type="date" id="date_creation" class="form-control" name="date_creation">
                    </div>
                </div>
                @if(Session::has('date-creation-error'))
                    <div class="alert alert-warning">
                        {{ Session::get('date-creation-error') }}
                    </div>
                @endif
                <div class="form-group row">
                    <label for="date_experation" class="col-md-4 col-form-label text-md-left">Date de d'expération</label>
                    <div class="col-md-6">
                        <input type="date" id="date_experation" class="form-control" name="date_experation">
                    </div>
                </div>
                @if(Session::has('expired-date-error'))
                    <div class="alert alert-warning">
                        {{ Session::get('expired-date-error') }}
                    </div>
                @endif
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
