
@extends('home')
@section('dash')


<div class="card">
    <div class="card-header">
        <span class="redir" > <a href="{{route('promos')}}"><i class="las la-angle-left"></i></a>
             </span>
        <h3 style="margin-right: 10%" >Les Repas existe dans {{$promo->description_promotion}} </h3>
        <button><a  href="{{route('promo.addFoods',['idPromo' =>$promo->id])}}" style="color: #fff">ajouter des Repas à cette promo</a>
            <span class="las la-arrow-right"></span>
        </button>


    </div>
    <div class="card-body">
        @if(Session::has('status'))
        <div class="alert alert-success">
            {{ Session::get('status') }}
        </div>
    @endif
    @if(Session::has('delete'))
    <div class="alert alert-success">
        {{ Session::get('delete') }}
    </div>
    @endif

        <div class="table-responsive">
            <table width=100%>
                <thead>
                    <tr>
                        <td>id</td>
                        <td>Nom</td>
                        <td>Description</td>
                        <td>Prix</td>
                        <td>Image</td>
                        <td>Stock</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($foodPromo as $food )
                        <tr>

                            <td> {{ $food->id }} </td>
                            <td> {{ $food->nom }}</td>
                            <td> {{ $food->description }} </td>
                            <td> {{ $food->prix }} </td>
                            <td style="width: 10%">
                                {{-- <img src= "{{asset("storage/app/public/images/foods/".$food->image) }} "> --}}
                                {{-- <img src=" {{$food->image}} " alt="img"> --}}
                                <div >
                                    <img src="{{ asset('/storage/images/foods/'.$food->image) }}" alt="" title="" width="90%" height="90%">
                                </div>

                                  </td>
                            <td> {{ $food->stock}} </td>

                            <td>
                                <form class="form-inlin" method="Post" action="{{route('promo.food.destroy',['idFood'=>$food->id])}}  ">
                                    @csrf
                                    @method('DELETE')
                                    <button class="trash-bt" type="submit"><i class="las la-trash"></i></button>
                                </form>
                            </td>

                        </tr>
                        @empty

                            <span class="badge badge-danger">Liste Repas est Vide!!</span>
                        @endforelse


                </tbody>
            </table>
        </div>

    </div>


</div>
@stop
