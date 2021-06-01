<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Offer;
use Auth;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferController extends BaseController
{
    public function displayOffers(Request $request)
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
        $user=Auth::user();
        //dd($user);
        //verify if user is admin
        $this->authorize('isAdmin',$user);
        //validate data
        $validator=Validator::make($request->all(),[
            'description_offre'         => 'required',
            'valeur_offre'               => 'required|unique:offers',
            'type_offre'                      =>'required|in:POURCENTAGE,FIX',
            'active'                     =>'required',
            'date_creation'               =>'required|date',
            'date_experation'               =>'required|date',

        ]);
        if($validator->fails())
            return $this->SendError('Error Validator ', $validator->errors());
            //dd($validator);
        //try to add offer into database
        try {
            $offer = new Offer();
            //dd($offer);
            $offer->description_offre=$request->description_offre;
            $offer->valeur_offre=$request->valeur_offre;
            $offer->type_offre=$request->type_offre;
            $offer->active=$request->active;
            $offer->date_creation=Carbon::parse($request->date_creation);
            $date=Carbon::now()->toDateString();
            //dd($date, $offer->date_creation->format('Y-m-d'));

            if($date>($offer->date_creation->format('Y-m-d'))){
                return $this->SendError('this date creation not accepted should be grater then time now');
            }
            $offer->date_creation= $offer->date_creation->format('Y-m-d H:i:s');
            $offer->date_experation=Carbon::parse($request->date_experation)->format('Y-m-d H:i:s');
            //dd($offer->date_experation,$offer->date_creation);
            if($offer->date_experation<=$offer->date_creation){
                return $this->SendError('experired date can not be less then created date');
            }

            $offer->save();
            return $this->SendResponse($offer,'offer added Successfully!');

        } catch (\Throwable $th) {
            return $this->SendError('Error ',$th->getMessage());
        }
    }

    public function showOffer(Request $request,$id)
    {
        $user=Auth::user();
        //verify if user is admin
        $this->authorize('isAdmin',$user);
        try {
            $offer=Offer::findOrFail($id);
            return $this->SendResponse($offer,'offer retrieved successfully');
        } catch (\Throwable $th) {
            return $this->SendError('offer not founded',$th->getMessage());
        }

    }


    public function updateOffer(Request $request, $id)
    {
        $user=Auth::user();
          //verify if user is admin
        $this->authorize('isAdmin',$user);
        //find food
        $offer=Offer::findOrFail($id);
        //validate data
        $validator=Validator::make($request->all(),[
            'description_offre'         => 'required',
            'valeur_offre'               => 'required',
            'type_offre'                      =>'required|in:POURCENTAGE,FIX',
            'active'                     =>'required',
            'date_creation'               =>'required|date',
            'date_experation'               =>'required|date',

        ]);
        if($validator->fails())
            return $this->SendError('Error Validator ', $validator->errors());
        //try to add offer into database
        try {
            $offer->description_offre=$request->description_offre;
            $offer->valeur_offre=$request->valeur_offre;
            $offer->type_offre=$request->type_offre;
            $offer->active=$request->active;
            $offer->date_creation=Carbon::parse($request->date_creation)->format('Y-m-d H:i:s');
            $offer->date_experation=Carbon::parse($request->date_experation)->format('Y-m-d H:i:s');
            if($offer->date_experation<$offer->date_creation){
                return $this->SendError('experired date can not be less then created date');
            }
            $offer->save();
            return $this->SendResponse($offer,'offer updated Successfully!');

        } catch (\Throwable $th) {
            return $this->SendError('Error to update this offer',$th->getMessage());
        }
    }
    public function disableOffer(Request $request,$id){
        $user=Auth::user();
        //verify if user is admin
        $this->authorize('isAdmin',$user);
        try {
             //find offer
            $offer=Offer::findOrFail($id);
            try {
                $offer->active=0;
                $offer->save();
                return $this->SendResponse($offer, 'offer disabled successfully');
            } catch (\Throwable $th) {
                return $this->SendError('Error to delete offer',$th->getMessage());
            }
        } catch (\Throwable $th) {
            return $this->SendError('offer not founded',$th->getMessage());
        }

    }
    public function destroyOffer(Request $request, $id)
    {
        $user=Auth::user();
        //verify if user is admin
        $this->authorize('isAdmin',$user);
        try {
            $offer=Offer::findOrFail($id);
            $offer->delete();
            return $this->SendResponse($offer, 'offer deleted successfully');
        } catch (\Throwable $th) {
            return $this->SendError('Error to delete offer',$th->getMessage());
        }
    }
}
