
@extends('home')
@section('dash')
<div class="card">
    <div class="card-header">
        {{-- <span class="redir" > <a href="{{route('home')}}"><i class="las la-angle-left"></i></a>
             </span> --}}
        <h3 style="margin-left: 30%">list des Livreurs</h3>
        <button><a  href=" {{ route('delivery-G.create') }} " style="color: #fff">ajouter un Livreur</a>
            <span class="las la-arrow-right"></span>
        </button>


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
                       <td>Id</td>
                       <td>Nom Livreur</td>
                       <td>Image</td>
                       <td>Email</td>
                       <td>Tel</td>
                       <td>Nombre Commandes livrée</td>
                       <td></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($delivery_guys as $delivery_guy )
                        <tr>
                            <td> {{ $delivery_guy->id }} </td>
                            <td> {{ $delivery_guy->name }} </td>
                            <td> {{ $delivery_guy->photos }} </td>
                            <td> {{ $delivery_guy->email }} </td>
                            <td> {{ $delivery_guy->num_telephone }} </td>
                            <td>
                                {{-- foreach($groupedOrders as $key => $groupedOrder) {
                                    foreach($groupedOrder as $item) {
                                        //get each item in the group
                                    }
                                     echo "key: ".$key. " ," .$groupedOrder->count(). "<br>" ;
                                } --}}
                                @foreach ( $groupedOrders as $key => $groupedOrder)
                                   @if ($key== $delivery_guy->name)
                                   {{ $groupedOrder->count() }}
                                   @endif
                                @endforeach
                            </td>
                            <td>
                                <form class="form-inlin" method="Post" action="{{route('delivery-G.destroy',['id'=>$delivery_guy->id])}}  ">
                                    @csrf
                                    @method('DELETE')
                                    <button class="trash-bt" type="submit"><i class="las la-trash"></i></button>
                                </form>
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
