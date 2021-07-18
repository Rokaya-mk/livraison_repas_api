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


        <div class="card-header">
            <span class="redir" > <a href="{{route('orders')}}"><i class="las la-angle-left"></i></a>
            </span>
            <span  style="margin-right: 40%"> Modifier la Commande</span>
        </div>

        <div class="card-body">
            <form name="my-form"  action=" {{ route('order.update',['idOrder' =>$order->id]) }} " method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="active" class="col-md-4 col-form-label text-md-left">Confirmer le paiement</label>

                      <div class="form-check checkbox-lg" style="margin-left:12px">
                        <input style="display: block ; width:20px ; height:20px"
                          class="form-check-input" type="checkbox" value="true"  name="est_payée" id="est_payée"
                       @if($order->est_payée) checked @endif>
                        <label class="form-check-label" for="est_payée">

                        </label>
                      </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-md-4 col-form-label text-md-left">Changer le Status </label>
                    <div class="col-md-6">
                        <select class="custom-select mr-sm-2" id="status" name="status">
                            @foreach($status as $item)
                            <option value="{{ $item }}" @if ($item == $order->status) selected @endif>{{ $item }}</option>
                          @endforeach
                          </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="livreur" class="col-md-4 col-form-label text-md-left">Choisir le livreur </label>
                    <div class="col-md-6">
                        <select class="custom-select mr-sm-2" id="livreur" name="livreur">
                            <option value=""></option>
                            @foreach($delivery_guys as $item)
                            <option value="{{ $item->name }}" @if ($item->name == $order->nom_livreur) selected @endif>{{  $item->name }}</option>
                          @endforeach
                          </select>
                    </div>
                </div>

                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-success">
                    Modifier
                    </button>

                </div>


        </form>
    </div>
</div>

</div>

@endsection
