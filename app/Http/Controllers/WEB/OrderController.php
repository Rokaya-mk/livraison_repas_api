<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Libraries\General;
use App\Models\Commande;
use App\Models\CommandeRepas;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders=Commande::all();
        // $users=[];
        // foreach($orders as $order){
        //     $order->user;
        //    echo "<br>". 'order=>'.$order ;
        // }
        // $user=User::findOrFail(2)->with('co');
        // $orders=$user->commandes;
        // echo $orders;
        return view('commandes.index',compact('orders'));
    }

    public function show($idOrder)
    {
        $order=Commande::findOrFail($idOrder);
        //$foodsOrder=CommandeRepas::where('commande_id',$order->id)->get();
        //dd($order->repas,$foodsOrder);
        // foreach($order->repas as $food){
        //      dd($food);
        // }
        return view('commandes.showFoodsOrder',compact('order'));
    }

    public function edit($idOrder)
    {
        $order=Commande::findOrFail($idOrder);
        $status = General::getEnumValues('commandes','status');
        $enumoption = General::getEnumValues('utilisateurs','role') ;
        //dd($enumoption['2']);
        $role=$enumoption['2'];
        $delivery_guys=User::where('role',$role)->get();

        return view('commandes.edit',compact('order','status','delivery_guys'));
    }


    public function update(Request $request, $idOrder)
    {
        dd($request->input('est_payée'),$request->input('status'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
