<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Repas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class PromoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $promotions = Promotion::orderBy('id', 'DESC')->get();
        //dd($promotions);
        return view('promotions.index',compact('promotions'));

    }


    public function create()
    {
        return view('promotions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'description_promotion'         => 'required|unique:promotions',
            'valeur_promotion'                 => 'required',
            'type_promotion'                   =>'required|in:Percent,fix',
            // 'active'                           =>'required',
            'date_creation'                    =>'required|date',
            'date_experation'                  =>'required|date',
        ]);

        $promo = new Promotion();
        $promo->description_promotion=$request->input('description_promotion');
        $promo->valeur_promotion= $request->input('valeur_promotion');
        $promo->type_promotion= $request->input('type_promotion');
        if($request->input('active')){
            $promo->active=true;
        }else{
            $promo->active=false;
        }
        //dd($request->input('active'));
        $promo->date_creation=Carbon::parse($request->input('date_creation'));
        $date=Carbon::now()->toDateString();
        if($date>($promo->date_creation->format('Y-m-d'))){
            return back()->with('date-creation-error','la date de creation ne peux pas être  moins que la date d\'aujourd\'hui !');
        }
        $promo->date_creation= $promo->date_creation->format('Y-m-d H:i:s');
        $promo->date_experation=Carbon::parse($request->input('date_experation'))->format('Y-m-d H:i:s');
        if($promo->date_experation<=$promo->date_creation){
            return back()->with('expired-date-error','la date de d\'experation doit être plus grand que la date de creation !');
        }
        //dd($promo);
        $promo->save();
        Session::flash('status','Promotion a été ajouter avec succès!!');

        return redirect()->route('promo.addFoods',['idPromo' =>$promo->id]);
    }

    public function addFoods(Request $request,$idPromo)
    {
        $promo=Promotion::findOrFail($idPromo);
        $foods= Repas::where('promotion_id',null)->get();
        return view('promotions.addFoodsToPromo',compact('promo','foods'));
    }

    public function addPromoFoods(Request $request,$idPromo){
        $this->validate($request,[
            'foods' => 'required'
        ]);
        $promo=Promotion::findOrFail($idPromo);
        $foods=$request->get('foods');
        //dd($foods);
        $foodPromo=[];
        foreach($foods as $food){
            $foodP= Repas::findOrFail($food);
            $foodP->promotion_id=$idPromo;
            $foodP->save();
            array_push($foodPromo,$foodP);
        }
        //dd($foodPromo);
        return view('promotions.showFoodsPromo',compact('promo','foodPromo'));

    }

    public function show($id)
    {
        $promo=Promotion::findOrFail($id);
        $foodPromo= Repas::where('promotion_id',$promo->id)->get();
        //dd($promo->description_promotion,$foodPromo);
        return view('promotions.showFoodsPromo',compact('promo','foodPromo'));

    }


    public function edit($id)
    {
        $promo=Promotion::findOrFail($id);
        return view('promotions.edit',compact('promo'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'description_promotion'         => 'required|',
            'valeur_promotion'                 => 'required',
            'type_promotion'                   =>'required|in:Percent,fix',
            'date_creation'                    =>'required|date',
            'date_experation'                  =>'required|date',
        ]);
        $promo =Promotion::findOrFail($id);
        $promo->description_promotion=$request->input('description_promotion');
        $promo->valeur_promotion= $request->input('valeur_promotion');
        $promo->type_promotion= $request->input('type_promotion');
        if($request->input('active')){
            $promo->active=true;
        }else{
            $promo->active=false;
        }
        $promo->date_creation=Carbon::parse($request->input('date_creation'));
        $date=Carbon::now()->toDateString();
        // if($date>($promo->date_creation->format('Y-m-d'))){
        //     return back()->with('date-creation-error','la date de creation ne peux pas être  moins que la date d\'aujourd\'hui !');
        // }
        $promo->date_creation= $promo->date_creation->format('Y-m-d H:i:s');
        $promo->date_experation=Carbon::parse($request->input('date_experation'))->format('Y-m-d H:i:s');
        if($promo->date_experation<=$promo->date_creation){
            return back()->with('expired-date-error','la date de d\'experation doit être plus grand que la date de creation !');
        }
        $promo->save();
        Session::flash('status','Promotion a été midifier avec succès!!');

        return redirect()->route('promos');
    }

    public function destroy( Request $request,$id)
    {
        $promotion=Promotion::findOrFail($id);
        $promotion->delete();

        $request->session()->flash('delete','  promotion Supprimer!!');
        return redirect()->route('promos');
    }
    public function destroyFood(Request $request,$idFood){
        $food=Repas::findOrFail($idFood);
        $food->promotion_id=null;
        $food->save();
        $request->session()->flash('delete','  repas a été Supprimer!!');
        return redirect()->back();


    }
}
