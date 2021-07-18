
@extends('home')
@section('dash')


<div class="card">
    <div class="card-header">
        {{-- <span class="redir" > <a href="{{route('home')}}"><i class="las la-angle-left"></i></a>
             </span> --}}
        <h3 style="margin-left: 40%">Lists des Commandes</h3>
        {{-- <button><a  href="" style="color: #fff">ajouter une Categorie</a>
            <span class="las la-arrow-right"></span> --}}


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
                       <td>Code Commande</td>
                       <td>Informations Client</td>
                       <td>Prix Totale Commande</td>
                       <td>Paiement est verifié ?</td>
                       <td>Status</td>
                       <td>Livreur</td>
                       <td></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order )
                        <tr>
                            <td> {{ $order->unique_id_commande }} </td>
                            <td>
                                <span> <span style="font-weight: bold"> Nom:</span> {{ $order->user->name }} </span><br>
                                <span><span style="font-weight: bold">Email:</span> {{ $order->user->email }} </span><br>
                                <span><span style="font-weight: bold">Tel:</span> {{ $order->user->num_telephone }} </span>
                            </td>
                            <td> {{ $order->total }} </td>
                            <td> {{ ($order->est_payée) ? 'Oui': 'Non' }} </td>
                            <td> {{ $order->status }} </td>
                            <td> {{ $order->nom_livreur}} </td>
                            <td>
                                <a href=" {{ route('order.show.foods',['idOrder' =>$order->id]) }} "><i class="las la-eye"></i></a> &nbsp;
                                <a  href=" {{ route('order.edit',['idOrder' => $order->id]) }} "><i class="lar la-edit"></i></a> &nbsp;&nbsp;
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
