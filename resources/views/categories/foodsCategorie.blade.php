
@extends('home')
@section('dash')


<div class="card">
    <div class="card-header">
        <span class="redir" > <a href="{{route('categories')}}"><i class="las la-angle-left"></i></a>
             </span>
        <h3 style="margin-right: 30%" >Les Repas existe dans {{$categorie->nom}} </h3>
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
            <table width=100%>
                <thead>
                    <tr>
                        <td>id</td>
                        <td>Nom</td>
                        <td>Description</td>
                        <td>Prix</td>
                        <td>Image</td>
                        <td>Stock</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($foods as $food )
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

                            {{-- <td><a  href=" {{ route('food.edit',['id'=>$food->id]) }} "><i class="lar la-edit"></i></a> &nbsp;
                                <form class="form-inlin" method="Post" action="{{route('food.destroy',['id'=>$food->id])}}  ">
                                    @csrf
                                    @method('DELETE')
                                    <button class="trash-bt" type="submit"><i class="las la-trash"></i></button>
                                </form>
                            </td> --}}



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
