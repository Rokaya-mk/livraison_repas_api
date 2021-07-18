
@extends('home')
@section('dash')


<div class="card">
    <div class="card-header">
        <span class="redir" > <a href="{{route('orders')}}"><i class="las la-angle-left"></i></a>
             </span>
        <h3 style="margin-right: 40%"> Repas de la  Commande  : <span style="color:var(--main-color)">{{ $order->unique_id_commande }} </span> </h3>



    </div>
    <div class="card-body">
        @if(Session::has('status'))
        <div class="alert alert-success">
            {{ Session::get('status') }}
        </div>
        @endif

        <div class="table-responsive">
            <table width=100% class="table table-hover">
                <thead>
                    <tr>
                       <td>Nom</td>
                       <td>Image</td>
                       <td>Informations</td>
                       <td>Quantité</td>
                       <td>Prix</td>
                       <td>Nom Catégorie</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($order->repas as $foodOrder )
                        <tr>
                            <td> {{ $foodOrder->nom }} </td>
                            <td>
                                <div>
                                    <img src="{{ asset('/storage/images/foods/'.$foodOrder->image) }}" alt="" title="" width="60px" height="60px">
                                </div>
                            </td>
                            <td> {{ $foodOrder->description }} </td>
                            <td> {{ $foodOrder->pivot->quantite }} </td>
                            <td>
                                <span style="font-weight: bold ; font-size:20px"> {{ $foodOrder->pivot->prix }} </span><br>
                                @if ($foodOrder->promotion_id)
                                        @if ($foodOrder->promotion->type_promotion =='Percent')
                                        <span style="color: #f00"> -{{ $foodOrder->promotion->valeur_promotion }}%</span>
                                        @else
                                        <span style="color: #f00"> -{{ $foodOrder->promotion->valeur_promotion }} DH</span>
                                        @endif

                                @endif

                            </td>
                            <td> {{ $foodOrder->categorie->nom }} </td>
                            {{-- <td>
                                <a href=" {{ route('order.show.foods',['idOrder' =>$order->id]) }} "><i class="las la-eye"></i></a> &nbsp;
                                <a  href=" "><i class="lar la-edit"></i></a> &nbsp;&nbsp;
                                {{-- <form class="form-inlin" method="Post" action=" ">
                                    @csrf
                                    @method('DELETE')
                                    <button class="trash-bt" type="submit"><i class="las la-trash"></i></button>
                                </form> --}}
                            </td>

                        </tr>

                        @empty

                            <span class="badge badge-danger">Liste Commandes est Vide!!</span>
                        @endforelse


                </tbody>
            </table>
        </div>

    </div>


</div>
@endsection
