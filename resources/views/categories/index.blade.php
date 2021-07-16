
@extends('home')
@section('dash')


<div class="card">
    <div class="card-header">
        <span class="redir" > <a href="{{route('home')}}"><i class="las la-angle-left"></i></a>
             </span>
        <h3>Lists des Categories</h3>
        <button><a  href="{{route('categorie.create')}}" style="color: #fff">ajouter une Categorie</a>
            <span class="las la-arrow-right"></span>


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
                        <td>Nom Categorie</td>
                        <td>Description</td>
                        <td></td>
                        <td>Image</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $categorie )
                        <tr>

                            <td> {{ $categorie->id }} </td>
                            <td> {{ $categorie->nom }}</td>
                            <td> {{ $categorie->description_c }} </td>
                            <td></td>
                            <td>
                                <div>
                                    <img src="{{ asset('/storage/images/categories/'.$categorie->image_c) }}" alt="" title="" width="60px" height="60px">
                                </div>

                                  </td>
                            <td>
                                <a href=" {{ route('categorie.foods.show',['id'=>$categorie->id]) }} "><i class="las la-eye"></i></a> &nbsp;
                                <a  href=" {{ route('categorie.edit',['id'=>$categorie->id]) }} "><i class="lar la-edit"></i></a> &nbsp;&nbsp;
                                <form class="form-inlin" method="Post" action="{{route('categorie.destroy',['id'=>$categorie->id])}}  ">
                                    @csrf
                                    @method('DELETE')
                                    <button class="trash-bt" type="submit"><i class="las la-trash"></i></button>
                                </form>
                            </td>



                        </tr>
                        @empty

                            <span class="badge badge-danger">Liste Categories est Vide!!</span>
                        @endforelse


                </tbody>
            </table>
        </div>

    </div>


</div>
@endsection
