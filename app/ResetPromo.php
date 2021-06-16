<?php

namespace App;

use App\Http\Controllers\API\BaseController;
use App\Models\Promotion;
use App\Models\Repas;
use Carbon\Carbon;

class ResetPromo extends BaseController{

    public function resetPromotionIdRepas($idRepas){
        $product=Repas::find($idRepas);
        //dd('ddd');
        if(!is_null($product->promotion_id)){
            $promotion=Promotion::where('id',$product->promotion_id)->first();
            $now=Carbon::now()->toDateTimeString();
            $date_experation=Carbon::parse($promotion->date_experation)->format('Y-m-d H:i:s');
            //dd($date_experation,$now);
            if($date_experation<=$now){

                $product->promotion_id=null;
                $product->save();
            }
        }


    }
}
?>
