<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Libraries\General;
use App\Models\Commande;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Mail;
use Session;
use Str;

class ManageDeliveryGuys extends Controller
{

    public function index()
    {
        $enumoption = General::getEnumValues('utilisateurs','role') ;
        //dd($enumoption['2']);
        $role=$enumoption['2'];
        $delivery_guys=User::where('role',$role)->get();
        $orderslist=Commande::all();
        $groupedOrders = $orderslist->groupBy('nom_livreur');
        //dd($groupedOrders->nom_livreur);

        return view('livreurs.index',compact('delivery_guys','groupedOrders'));
    }

    public function registration()
    {
        return view('livreurs.create');
    }


    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:utilisateurs',
            'password' => 'required|min:6',
            'num_telephone' =>'required'
        ]);

        $data = $request->all();
        $email = $data['email'];
        $pass=$data['password'];
        //dd($email,$pass);
        //dd($data['_token']);
        $token = Str::random(5);
        $check = $this->create($data);
        try{
            DB::table('utilisateurs')->where('email', $request['email'])->update([
                'is_verified' => $token,
            ]);
            $email = $data['email'];
            $pass=$data['password'];
            Mail::send('Mails.verification', ['token' => $token,'pass'=>$pass], function ($message) use ($email) {
                $message->to($email);
                $message->subject(trans('messages.is_verified_email'));
            });
        //return redirect('delivery-G')->withSuccess('compte a été ajouter avec succés');
       Session::flash('status','compte a été ajouter avec succés');
       return redirect()->route('delivery-G');
        }catch(\Exception $exception){
            return back()->with('erreur','erreur d\'envoie email verification '.$exception->getMessage());
        }

    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'num_telephone' => $data['num_telephone'],
        'role'=>'livreur',
      ]);
    }




    public function destroy(Request $request, $id)
    {
        $food=User::findOrFail($id);
        $food->delete();
        $request->session()->flash('status','Livreur est suprimé avec succés');
        return redirect()->route('delivery-G');

    }
}
