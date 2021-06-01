<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Gate;
use Illuminate\Http\Request;

class OffersController extends Controller
{

    public function displayOffers()
    {
        if(Gate::denies('isAdmin')){
            return $this->SendError('vous n\'avez pas les permissions');
        }else{
            $offers = Offer::orderBy('id', 'DESC')->get();
            if($offers->count()==0){
                return $this->SendError('offers list is empty');
            }
            return $this->SendResponse($offers,'list of offers');
        }
    }



    public function storeNewOffer(Request $request)
    {

    }

    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
