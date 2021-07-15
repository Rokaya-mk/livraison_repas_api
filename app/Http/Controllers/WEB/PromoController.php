<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'description_promotion'         => 'required|unique:promotions',
            'valeur_promotion'                 => 'required|unique:promotions',
            'type_promotion'                   =>'required|in:Percent,fix',
            'active'                           =>'required',
            'date_creation'                    =>'required|date',
            'date_experation'                  =>'required|date',
        ]);
        $promo = new Promotion();
        $promo->description_promotion=$request->input('description_promotion');
        $promo->valeur_promotion= $request->input('valeur_promotion');
        $promo->type_promotion= $request->input('type_promotion');
        $promo->active=$request->input('active');
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
        $promo->save();
        Session::flash('status','Promotion a été ajouter avec succès!!');

        return redirect()->route('promos');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $promo=Promotion::findOrFail($id);
        return view('promotions.edit',compact('promo'));
    }


    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        //
    }
}
