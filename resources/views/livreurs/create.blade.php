
@extends('home')
@section('dash')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
            @foreach ( $errors->all() as $error )
            <div class="alert alert-danger" role="alert" style="width: 50% ; height:30%">
                {{ $error }}
            </div>
            @endforeach

        @endif
            <div class="card">
                @if(Session::has('erreur'))
                <div class="alert alert-success">
                    {{ Session::get('erreur') }}
                </div>
                @endif
                <div class="card-header">
                    <span class="redir" > <a href="{{route('delivery-G')}}"><i class="las la-angle-left"></i></a>
                    </span>
                    <h3 style="margin-right: 20% ; font-size:25px"> Ajouter un Compte Livreur</h3>
                   </div>

                <div class="card-body">
                    <form method="POST" action=" {{ route('register.delivery') }} ">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nom</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="num_telephone" class="col-md-4 col-form-label text-md-right">telephone</label>

                            <div class="col-md-6">
                                <input id="num_telephone" type="text" class="form-control" name="num_telephone" value="{{ old('num_telephone') }}" required autocomplete="num_telephone" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Enregistrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
