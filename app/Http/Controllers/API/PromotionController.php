<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Promotion;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class PromotionController extends BaseController
{
    public function displayPromotions(Request $request)
    {
        if(Gate::denies('isAdmin')){
            return $this->SendError(trans('messages.admin_permession'));
        }else{
            $promotions = Promotion::orderBy('id', 'DESC')->get();
            if($promotions->count()==0){
                return $this->SendError(trans_choice('messages.promotions_msg',2));
            }
            return $this->SendResponse($promotions,trans_choice('messages.promotions_msg',1));
        }
    }

    public function storeNewPromotion(Request $request)
    {
        //verify if user is admin
        if(Gate::denies('isAdmin'))
            return $this->SendError(trans('messages.admin_permession'));
        //validate data
        $validator=Validator::make($request->all(),[
            'description_promotion_fr'         => 'required|unique:promotions',
            'description_promotion_en'         => 'required',
            'description_promotion_ar'         => 'required',
            'valeur_promotion'                 => 'required|unique:promotions',
            'type_promotion'                   =>'required|in:Percent,fix',
            'active'                           =>'required',
            'date_creation'                    =>'required|date',
            'date_experation'                  =>'required|date',
        ]);
        if($validator->fails())
            return $this->SendError(trans('messages.error_validator'), $validator->errors());
        //try to add promotion into database
        try {
            $promotion = new Promotion();
            $promotion->description_promotion_fr=$request->description_promotion_fr;
            $promotion->description_promotion_en=$request->description_promotion_en;
            $promotion->description_promotion_ar=$request->description_promotion_ar;
            $promotion->valeur_promotion=$request->valeur_promotion;
            $promotion->type_promotion=$request->type_promotion;
            $promotion->active=$request->active;
            $promotion->date_creation=Carbon::parse($request->date_creation);
            $date=Carbon::now()->toDateString();
            if($date>($promotion->date_creation->format('Y-m-d'))){
                return $this->SendError(trans('messages.promo_date_create'));//this date creation not accepted should be grater then time now
            }
            $promotion->date_creation= $promotion->date_creation->format('Y-m-d H:i:s');
            $promotion->date_experation=Carbon::parse($request->date_experation)->format('Y-m-d H:i:s');
            if($promotion->date_experation<=$promotion->date_creation){
                return $this->SendError(trans('messages.promo_date_exp'));//experired date can not be less then created date
            }
            $promotion->save();
            return $this->SendResponse($promotion,trans('messages.promo_add'));

        } catch (\Throwable $th) {
            return $this->SendError(trans('messages.try_error'),$th->getMessage());
        }
    }
    //show promotion
    public function showPromotion(Request $request,$id)
    {
         //verify if user is admin
         if(Gate::denies('isAdmin'))
         return $this->SendError(trans('messages.admin_permession'));
        try {
            $promotion=Promotion::find($id);
            if(is_null($promotion))
                return $this->SendError(trans_choice('messages.promo_show',2));
            return $this->SendResponse($promotion,trans_choice('messages.promo_show',1));
        } catch (\Throwable $th) {
            return $this->SendError(trans('messages.try_error'),$th->getMessage());
        }

    }
    //show products of specified promotion
    public function showPromotionProducts(Request $request,$id)
    {
        $promotion=Promotion::find($id);
        //dd($promotion);
        if(is_null($promotion)){
            return $this->SendError(trans_choice('messages.promo_show',2));
        }else{

            $products=$promotion->repas;
            //dd($products);
            if(is_null($products))
                return $this->SendError(trans_choice('messages.promo_products',2));//there is no product in this promotion
            return $this->SendResponse($products,trans_choice('messages.promo_products',1));
        }
    }

    public function updatePromotion(Request $request, $id)
    {
        //verify if user is admin
        if(Gate::denies('isAdmin'))
        return $this->SendError(trans('messages.admin_permession'));
        //find food
        $promotion=Promotion::find($id);
        if(is_null($promotion)){
            return $this->SendError(trans_choice('messages.promo_show',2));
        }else{
            //validate data
            $validator=Validator::make($request->all(),[
            'description_promotion_fr'         => 'required',
            'description_promotion_en'         => 'required',
            'description_promotion_ar'         => 'required',
            'valeur_promotion'                 => 'required',
            'type_promotion'                   =>'required|in:Percent,fix',
            'active'                           =>'required',
            'date_creation'                    =>'required|date',
            'date_experation'                  =>'required|date',

            ]);
            if($validator->fails())
                return $this->SendError(trans('messages.error_validator'), $validator->errors());
            //try to add promotion into database
            try {
                $promotion->description_promotion_fr=$request->description_promotion_fr;
                $promotion->description_promotion_en=$request->description_promotion_en;
                $promotion->description_promotion_ar=$request->description_promotion_ar;
                $promotion->valeur_promotion=$request->valeur_promotion;
                $promotion->type_promotion=$request->type_promotion;
                $promotion->active=$request->active;
                $promotion->date_creation=Carbon::parse($request->date_creation)->format('Y-m-d H:i:s');
                $promotion->date_experation=Carbon::parse($request->date_experation)->format('Y-m-d H:i:s');
                if($promotion->date_experation<$promotion->date_creation){
                    return $this->SendError(trans('messages.promo_date_exp'));
                }
                $promotion->save();
                return $this->SendResponse($promotion,trans('messages.promo_update'));

            } catch (\Throwable $th) {
                return $this->SendError(trans('messages.try_error'),$th->getMessage());
            }
        }
    }
    public function disablePromotion(Request $request,$id){
        //verify if user is admin
        if(Gate::denies('isAdmin'))
        return $this->SendError(trans('messages.admin_permession'));
        //find food
        $promotion=Promotion::find($id);
        if(is_null($promotion)){
            return $this->SendError(trans('messages.promo_show',2));
        }else{
            try {
                $promotion->active=0;
                $promotion->save();
                return $this->SendResponse($promotion, trans('messages.promo_disable'));
            } catch (\Throwable $th) {
                return $this->SendError(trans('messages.try_error'),$th->getMessage());
            }
        }
    }
    public function destroyPromotion(Request $request, $id)
    {
        if(Gate::denies('isAdmin'))
        return $this->SendError(trans('messages.admin_permession'));
        //find food
        $promotion=Promotion::find($id);
        if(is_null($promotion))
            return $this->SendError(trans('messages.promo_show',2));
        try {
            $promotion->delete();
            return $this->SendResponse($promotion,trans_choice('messages.promo_delete',1));
        } catch (\Throwable $th) {
            return $this->SendError(trans_choice('messages.promo_delete',2),$th->getMessage());
        }
    }
}
