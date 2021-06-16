<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Categorie;
use App\Models\Promotion;
use App\Models\Repas;
use App\ResetPromo;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FoodController extends BaseController
{

    //display all foods
    public function foods(Request $request)
    {
        // $foods=Repas::select('id','nom_'.App::getLocale(),'description_'.App::getLocale(),
        //                     'prix','image','stock','categorie_id','promotion_id',
        //                     'recommandee','populaire','nouveau','created_at','updated_at'
        //                     )->get();

        $foods=Repas::all();
        $promo=new ResetPromo();

      if($foods->isEmpty())
            //foods list is empty!
           //dd($request->header('localization'));
            return $this->SendError(trans_choice('messages.foods_msg',2));
            //Foods list retrieved Successfully!
        foreach($foods as $food){
            //dd($food->id);
            $promo->resetPromotionIdRepas($food->id);
        }
        return $this->SendResponse($foods,trans_choice('messages.foods_msg',1));
    }

    public function addNewFood(Request $request)
    {
        if(Gate::denies('isAdmin')){
            return $this->SendError(trans('messages.admin_permession'));
        }
        //validate data
        $validator=Validator::make($request->all(),[
        'nom_fr'                =>'required|unique:repas',
        'nom_en'                =>'nullable',
        'nom_ar'                =>'nullable',
        'description_fr'        => 'required',
        'description_en'        =>'nullable',
        'description_ar'        =>'nullable',
        'prix'                  =>'required',
        'image'                 =>'required|mimes:jpg,jpeg,png|max:2048',
        'stock'                 =>'required',
        'categorie_id'          =>'required',
        'promotion_id'              =>'nullable',
        // 'recommandee'           =>'required',
        // 'populaire'             =>'required',
        // 'nouveau'               =>'required'

        ]);
        if($validator->fails())
            return $this->SendError(trans('messages.error_validator'), $validator->errors());
            //dd($validator);
        //try to add category into database
        try {
            $food = new Repas();
            $food->nom_fr=$request->nom_fr;
            $food->nom_en=$request->nom_en;
            $food->nom_ar=$request->nom_ar;
            $food->description_fr=$request->description_fr;
            $food->description_en=$request->description_en;
            $food->description_ar=$request->description_ar;
            $food->prix=$request->prix;
            //$food->category_id=$request->category_id;
            //dd($food);
            $image = $request->file('image');
            $filename = time() . random_int(1,100). '.' .$image->guessExtension();
            Storage::putFileAs('images/foods',$image,$filename);
            $food->image=$filename;
            $food->stock=$request->stock;
            //find categorie
            $category=Categorie::find($request->categorie_id);
            if(is_null($category))
                return $this->SendError(trans('messages.found_category'));
            if($request->promotion_id){
                $promotion=Promotion::find($request->promotion_id);
                if(is_null($promotion))
                    return $this->SendError(trans_choice('messages.promo_show',2));
            $food->promotion_id=$request->promotion_id;
            $food->categorie()->associate($category);
            $food->promotion()->associate($promotion);
            $food->save();
            return $this->SendResponse($food,trans('messages.add_food'));
            }

        } catch (\Throwable $th) {
            return $this->SendError(trans('messages.try_error'),$th->getMessage());
        }
    }


    public function showFood(Request $request,$id)
    {
        $food=Repas::find($id);
        //dd($food);
        if(is_null($food))
            return $this->SendError(trans('messages.found_food'));

        return $this->SendResponse($food,trans('messages.show_food'));


    }

    public function updateFood(Request $request, $id)
    {
        if(Gate::denies('isAdmin')){
            return $this->SendError(trans('messages.admin_permession'));
        }
        //find food
        $food=Repas::find($id);
        if(is_null($food))
            return $this->SendError(trans('messages.found_food'));
        //validate data
        $validator=Validator::make($request->all(),[
        'nom_fr'                =>'required',
        'nom_en'                =>'nullable',
        'nom_ar'                =>'nullable',
        'description_fr'        => 'required',
        'description_en'        =>'nullable',
        'description_ar'        =>'nullable',
        'prix'                  =>'required',
        'image'                 =>'required|mimes:jpg,jpeg,png|max:2048',
        'stock'                 =>'required',
        'categorie_id'          =>'required',
        'promotion_id'              =>'nullable',
        ]);
        if($validator->fails())
            return $this->SendError(trans('messages.error_validator'), $validator->errors());
        //try to add food into database
        try {
            $food->nom_fr=$request->nom_fr;
            $food->nom_en=$request->nom_en;
            $food->nom_ar=$request->nom_ar;
            $food->description_fr=$request->description_fr;
            $food->description_en=$request->description_en;
            $food->description_ar=$request->description_ar;
            $food->prix=$request->prix;
            $image = $request->file('image');
            $filename = time() . random_int(1,100). '.' .$image->guessExtension();
            //dd($filename);
            $oldImage=Repas::find($food->id);
            //dd($oldImage->photos);
            if($oldImage->image){
                //dd(Storage::exists('images/categories/'.$oldImage->image_c));
                try{
                    if((Storage::exists('images/foods/'.$oldImage->image))){
                       Storage::delete('images/foods/'.$oldImage->image);
                    }else{
                        //File does not exists.;
                        return $this->SendError(trans('messages.file_exist'),$validator->errors());
                    }
                }catch(\Throwable $th){
                    return $this->SendError($th->getMessage(), 400);
                }
            }
            Storage::putFileAs('images/foods',$image,$filename);
            $food->image=$filename;
            $food->stock=$request->stock;
            //find categorie
            $category=Categorie::find($request->categorie_id);
            if(is_null($category))
                return $this->SendError(trans('messages.found_category'));
            if($request->promotion_id){
                $promotion=Promotion::find($request->promotion_id);
                if(is_null($promotion))
                    return $this->SendError(trans_choice('messages.promo_show',2));
            $food->promotion_id=$request->promotion_id;
            $food->categorie()->associate($category);
            $food->promotion()->associate($promotion);
            $food->save();
            return $this->SendResponse($food,trans_choice('messages.update_food',1));
         }
        } catch (\Throwable $th) {
            return $this->SendError(trans_choice('messages.update_food',2),$th->getMessage());
        }
    }

    public function updateStatusProduct(Request $request,$id){

        if(Gate::denies('isAdmin')){
            return $this->SendError(trans('messages.admin_permession'));
        }
        //find food
        $food=Repas::find($id);
        if(is_null($food))
            return $this->SendError(trans('messages.found_food'));
      //validate data
      $validator=Validator::make($request->all(),[
          'recommandee' => 'required|',
          'populaire' => 'required',
          'nouveau'        => 'required'

      ]);
      if($validator->fails())
          return $this->SendError('Error Validator ', $validator->errors());
      //try to add food into database
      try {
          $food->recommandee=$request->recommandee;
          $food->populaire=$request->populaire;
          $food->nouveau=$request->nouveau;
          $food->save();
          return $this->SendResponse($food,trans_choice('messages.status_food',1));
      } catch (\Throwable $th) {
        return $this->SendError(trans_choice('messages.status_food',2),$th->getMessage());
      }

    }

    public function destroyFood(Request $request, $id)
    {
        if(Gate::denies('isAdmin')){
            return $this->SendError(trans('messages.admin_permession'));
        }
        //find food
        $food=Repas::find($id);
        if(is_null($food))
        return $this->SendError(trans('messages.found_food'));
        try {
            $food->delete();
            return $this->SendResponse($food,trans_choice('messages.delete_food',1));
        } catch (\Throwable $th) {
            return $this->SendError(trans_choice('messages.delete_food',2),$th->getMessage());
        }
    }

    //search food
    public function searchFood(Request $request){
        try {
            $data=$request->data;
            $foods=Repas::where('nom_fr','like', '%' . $data . '%')->get();
            if($foods->isEmpty())
                return $this->SendError(trans_choice('messages.search_food',2));
            return $this->SendResponse($foods,trans_choice('messages.search_food',1));
        } catch (\Throwable $th) {
            return $this->SendError($th->getMessage());
        }


    }

}
