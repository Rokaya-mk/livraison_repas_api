
@extends('home')
@section('dash')


<div class="card">
    <div class="card-header">
        <span class="redir" > <a href="{{route('promos')}}"><i class="las la-angle-left"></i></a>
             </span>
        <h3 style="margin-right: 30%" >ajouter des Repas au  {{$promo->description_promotion}} </h3>
        {{-- <button><a  href="{{route('food.create')}}" style="color: #fff">ajouter un élement</a>
            <span class="las la-arrow-right"></span>
        </button> --}}
    </div>
    <div class="card-body">
        @if(Session::has('status'))
        <div class="alert alert-success">
            {{ Session::get('status') }}
        </div>
@endif
        <div class="table-responsive">
            <form name="my-form"  action="{{route('promo.foods.store',['idPromo' =>$promo->id])}}"  method="POST">
                @csrf
                <table class="table">
                    <thead>
                      <tr class="table-success">
                        <th scope="col" style="padding-left:9%">#</th>
                        <th scope="col" style="padding-left:9%">Nom</th>
                        <th scope="col">Image</th>

                      </tr>
                    </thead>
                    <tbody>
                    @forelse ($foods as $food )
                      <tr>
                        <th scope="row" style="padding-left:9%"><input type="checkbox" name="foods[]" value="{{ $food->id }}"></th>
                        <td style="padding-left:9%">{{ $food->nom }}</td>
                        <td>
                            <img src="{{ asset('/storage/images/foods/'.$food->image) }}" alt="" title="" width="70px" height="70px">
                        </td>

                      </tr>
                    @empty

                      <span class="badge badge-danger"> </span>
                    @endforelse

                    </tbody>
                  </table>
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-success">
                    Ajouter
                    </button>

                </div>
            </form>
              {{-- <button class="btn btn-success float-right" style="font-size:12px; padding:6px 12px; margin-right:20px"><a style="color:#fff" href="{{route('promo.foods.store')}}">Emregistrer</a>
            </button> --}}
        </div>

    </div>


</div>
@stop
