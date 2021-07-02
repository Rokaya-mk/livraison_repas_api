<?php

namespace App\Http\Controllers\API;

use App\Cart;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Commande;
use App\Models\CommandeRepas;
use App\Models\Paiement;
use App\Models\Repas;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends BaseController
{
    //make order
    public function makeOrder(Request $request){
        try {
            $userId=Auth::user()->id;
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $order=new Commande();
            $lastOrder = Commande::orderBy('id', 'desc')->first();
            //if there is no order yet
            if(is_null($lastOrder)){
                $order->id=1;
            }else{
                $order->id=$lastOrder->id +1;
            }
            //generate unique_order_id
            $latestOrder = Commande::orderBy('created_at','DESC')->first();
            if(is_null($latestOrder)){
                $order->unique_id_commande = '#'.str_pad( 1, 8, "0", STR_PAD_LEFT);
            }else{
                    $order->unique_id_commande = '#'.str_pad($latestOrder->id + 1, 8, "0", STR_PAD_LEFT);
                }
        $order->user_id=$userId;
        $user=User::find($userId);
        $order->total=$cart->totalPrice;
        //dd($order);
        //$user=User::find($userId);
        try {
            $order->user()->associate($user);
            $order->save();


        } catch (\Throwable $th) {
            return $this->SendError('Error',$th->getMessage());
        }
         $payment=new Paiement();
        if($request->has('payment_method')){
            try {
            $payment->user_id=$userId;
            $payment->methode_paiement=$request->payment_method;
            $payment->montant=$order->total;
            $payment->date_paiement=Carbon::now()->format('Y-m-d H:i:s');
            $payment->commande_id=$order->id;
            $payment->commande()->associate($order);
            $payment->save();
            } catch (\Throwable $th) {
                return $this->SendError('Error',$th->getMessage());
            }
        }else{
            return $this->SendError('you must specify payment method');
        }
        try {
            $products=$cart->items;
            foreach($products as $product){
                $productItem=Repas::find( $product['item']->id);
                $order->repas()->attach($productItem,[
                    'prix'    =>$product['price'],
                    'quantite'=>$product['quantity'],
                ]);
                $productItem->stock=($productItem->stock)-($product['quantity']);
                $productItem->save();
            }
            Session::forget('cart');

        } catch (\Throwable $th) {
            return $this->SendError(trans('messages.try_error'),$th->getMessage());
        }

        } catch (\Throwable $th) {
            return $this->SendError(trans('messages.try_error'),$th->getMessage());
        }
    }
}
