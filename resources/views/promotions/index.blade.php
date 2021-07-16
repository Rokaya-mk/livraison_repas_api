
@extends('home')
@section('dash')


<div class="card">
    <div class="card-header">
        <span class="redir" > <a href="{{route('home')}}"><i class="las la-angle-left"></i></a>
             </span>
        <h3>Lists des Promotions</h3>
        <button><a  href="{{route('promo.create')}}" style="color: #fff">ajouter une promotion</a>
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
            <div class="alert alert-danger">
                {{ Session::get('delete') }}
            </div>
        @endif

        <div class="table-responsive">
            <table width=100%>
                <thead>
                    <tr>
                        <td>id</td>
                        <td>Description</td>
                        <td>Valeur du la Promotion</td>
                        <td>Le type</td>
                        <td>Active</td>
                        <td>Date de Creation</td>
                        <td>Date d'éxpération</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($promotions as $promotion  )
                        <tr>

                            <td> {{ $promotion->id }} </td>
                            <td> {{ $promotion->description_promotion }}</td>
                            <td> {{ $promotion->valeur_promotion }} </td>
                            @if ( $promotion->type_promotion == 'Percent')
                            <td> <span><i class="las la-percent" style="font-size :25px"></i></span> </td>
                            @else
                                <td>Fix</td>
                            @endif

                            @if ( $promotion->active )
                            <td> <span><i class="las la-check" style="color:#09B44D ;font-size :25px"></i></span> </td>
                            @else
                            <td> <span><i class="las la-times" style="color:#f00 ;font-size :25px"></i></span> </td>
                            @endif
                            <td> {{ $promotion->date_creation }} </td>
                            <td> {{ $promotion->date_experation }} </td>
                            <td>
                                <a href=" {{ route('promo.show',['id'=>$promotion->id ]) }} " ><i class="las la-eye"></i></a> &nbsp;
                                <a  href=" {{ route('promo.edit',['id'=>$promotion->id]) }} " ><i class="lar la-edit"></i></a> &nbsp;&nbsp;
                                <form  class=" {{($promotion->active ==true)? 'invisible' : '' }} form-inlin" method="Post" action="{{route('promo.destroy',['id'=>$promotion->id])}}  ">
                                    @csrf
                                    @method('DELETE')
                                    <button class="trash-bt" type="submit"><i class="las la-trash"></i></button>
                                </form>
                            </td>



                        </tr>
                        @empty

                            <span class="badge badge-danger">Liste Promotions est Vide!!</span>
                        @endforelse


                </tbody>
            </table>
        </div>

    </div>


</div>
@stop
