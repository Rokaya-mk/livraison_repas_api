<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Cart;
use App\Models\Promotion;
use App\Models\Repas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends BaseController
{
    //get cart
    public function getMyCart(Request $request) {
        if (!Session::has('cart')) {
            return $this->SendError('your cart is empty!');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return $this->SendResponse(['products'=>$cart->items,
                                    'totalQuantity'=>$cart->totalQty
                                    ,'totalPrice' =>$cart->totalPrice],'cart retrieved Successfully!');
    }

    //add new product into cart
    public function addToCart(Request $request, $id) {
        $food = Repas::find($id);
        $promo=null;
        $quantity=1;
        if(is_null($food))
            return $this->SendError(trans('messages.found_food'));
        if($request->quantity)
            $quantity=$request->quantity;
        if(!is_null($food->promotion_id)){
            $promo=Promotion::find($food->promotion_id);
            //dd($promo);
            if(is_null($promo))
                return $this->SendError(trans_choice('messages.promo_show',2));
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($food,$food->id,$quantity,$promo);
        $request->session()->put('cart', $cart);
        return $this->SendResponse($cart,'cart added Successfully!');
    }

    //update  Cart
    public function updateCart(){

    }
    //remove item in the cart
    public function removeItemCart($id){
        $oldCart = Session::get('cart');
        $cart= new Cart($oldCart);
        $result=$cart->contains($id);
        if(!$result){
            return $this->SendError('this item not exist in your cart');
        }else{
            try {
                $cart->deleteItem($id);
                return $this->SendResponse($cart,'item deleted in your cart seccessfully');
            } catch (\Throwable $th) {
                return $this->SendError(trans('messages.try_error'),$th->getMessage());
            }
        }
    }
    //clear Cart
    public function clearCart(Request $request){
        try {
            $request->session()->forget('cart');
            return $this->SendResponse('Cart deleted Successfully',200);
        } catch (\Throwable $th) {
            return $this->SendError(trans('messages.try_error'),$th->getMessage());
        }



    }
}
