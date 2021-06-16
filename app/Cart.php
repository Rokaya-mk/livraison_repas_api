<?php

namespace App;

use Carbon\Carbon;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
    //add new item
    public function add($item, $id,$quantity,$promo) {
        $newItem=['quantity'=>0, 'price' =>$item->prix ,'promoType' =>$promo->type_promotion ,'item'=>$item ];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $newItem = $this->items[$id];
            }
        }
        $newItem['quantity']+=$quantity;
        if((!is_null($promo)) && ($promo->active==true)&&($promo->date_experation>=Carbon::now())){
            if($promo->type_promotion=="Percent"){
                $newItem['price']=($item->prix) - (($promo->valeur_promotion / 100) * $item->prix);
            }else if($promo->type_promotion=='fix'){
                $newItem['price'] = $item->prix - ($promo->valeur_promotion) ;
            }
        }
        $newItem['price']=($newItem['price'])*$newItem['quantity'];
        $newItem['price']=number_format($newItem['price'],2);
        $this->items[$id] = $newItem;
        $this->totalQty+=$quantity;
        $this->totalPrice += $newItem['price'];
    }
    //verify if item id exist in cart
    public function contains($id){
        return ($this->items) && array_key_exists($id, $this->items);
      }
    //delete item from cart
    public function deleteItem($id){
        $this->totalQty-=$this->items[$id]['quantity'];
        $this->totalPrice-=($this->items[$id]['price'])*($this->items[$id]['quantity']);
        $this->totalPrice=number_format($this->totalPrice);
        unset($this->items[$id]);
    }

    //update
    public function update($item, $id, $quantity,$promo){
        $newItem=['quantity'=>0, 'price' =>$item->prix ,'promoType' =>$promo->type_promotion ,'item'=>$item ];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $newItem = $this->items[$id];
            }
        }
        if($quantity <= 0){
            $this->deleteItem($id);
            return;
        }
        // $this->totalQty -= $newItem['quantity'];
        // $this->totalPrice -= $item->price * $newItem['quantity'];
        $newItem['quantity']+=$quantity;
        if((!is_null($promo)) && ($promo->active==true)&&($promo->date_experation>=Carbon::now())){
            if($promo->type_promotion=="Percent"){
                $newItem['price']=($item->prix) - (($promo->valeur_promotion / 100) * $item->prix);
            }else if($promo->type_promotion=='fix'){
                $newItem['price'] = $item->prix - ($promo->valeur_promotion) ;
            }
        }
        $newItem['price']=($newItem['price'])*$newItem['quantity'];
        $newItem['price']=number_format($newItem['price'],2);
        $this->totalQty+=$quantity;
        $this->totalPrice += $newItem['price'];
        $this->items[$id] = $newItem;
    }

}
