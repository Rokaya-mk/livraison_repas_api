<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Food;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FoodController extends BaseController
{

    public function foods()
    {
        $foods=Food::all();
        if($foods->isEmpty())
            return $this->SendError('foods list is empty!');
        return $this->SendResponse($foods,'Foods list retrieved Successfully!');
    }

    public function addNewFood(Request $request)
    {
        $user=Auth::user();
        //dd($user);
        //verify if user is admin
        $this->authorize('isAdmin',$user);
        //validate data
        $validator=Validator::make($request->all(),[
            'nom'         => 'required|unique:foods',
            'description' => 'required',
            'prix'        =>'required',
            'image'       =>'required|mimes:jpg,jpeg,png|max:2048',
            'category_id' =>'required',
            'offer_id'    =>'nullable'
        ]);
        if($validator->fails())
            return $this->SendError('Error Validator ', $validator->errors());
            //dd($validator);
        //try to add category into database
        try {
            $food = new Food();
            //dd($food);
            $food->nom=$request->nom;
            $food->description=$request->description;
            $food->prix=$request->prix;
            $food->category_id=$request->category_id;
            //dd($food);
            $image = $request->file('image');
            $filename = time() . random_int(1,100). '.' .$image->guessExtension();
            Storage::putFileAs('images/foods',$image,$filename);
            $food->image=$filename;

            if($request->offer_id)
                $food->offer_id;
            $food->save();
            return $this->SendResponse($food,'Food added Successfully!');

        } catch (\Throwable $th) {
            return $this->SendError('Error ',$th->getMessage());
        }
    }


    public function showFood(Request $request,$id)
    {
        $food=Food::findOrFail($id);
        if(!$food){
            return $this->SendError('food not founded!');
        }else{
            if(auth('api')->user()){
                $user=Auth::user();
                if(Gate::allows('isAdmin')){
                    return $this->SendResponse($food,'food retrieved Successfully!');
                }
          }
          $foodUser=$food->pluck('id','nom','description','prix','image','category_id','offer_id');
        }
    }

    public function updateFood(Request $request, $id)
    {
        $user=Auth::user();
          //verify if user is admin
        $this->authorize('isAdmin',$user);
        //find food
        $food=Food::findOrFail($id);
        //validate data
        $validator=Validator::make($request->all(),[
            'nom'         => 'required|unique:foods',
            'description' => 'required',
            'prix'        => 'required',
            'image'       => 'required|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required',

        ]);
        if($validator->fails())
            return $this->SendError('Error Validator ', $validator->errors());
        //try to add food into database
        try {
            $food->nom=$request->nom;
            $food->description=$request->description;
            $food->prix=$request->prix;
            $image = $request->file('image_c');
            $filename = time() . random_int(1,100). '.' .$image->guessExtension();
            Storage::putFileAs('images/categories',$image,$filename);
            $food->image_c=$filename;
            $food->category_id=$request->category_id;
            $food->save();
            return $this->SendResponse($food,'food updated Successfully!');

        } catch (\Throwable $th) {
            return $this->SendError('Error to update this food',$th->getMessage());
        }
    }

    public function updateStatusProduct(Request $request,$id){
        $user=Auth::user();
        //verify if user is admin
      $this->authorize('isAdmin',$user);
      //find food
      $food=Food::findOrFail($id);
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
          return $this->SendResponse($food,'food status updated Successfully!');
      } catch (\Throwable $th) {
        return $this->SendError('Error to update food status',$th->getMessage());
      }

    }

    public function destroyFood(Request $request, $id)
    {
        $user=Auth::user();
        //verify if user is admin
        $this->authorize('isAdmin',$user);
        //find food
        $food=Food::findOrFail($id);
        if(!$food)
            return $this->SendError('food not founded');
        try {
            $food->delete();
            return $this->SendResponse($food, 'food deleted successfully');
        } catch (\Throwable $th) {
            return $this->SendError('Error to delete food',$th->getMessage());
        }
    }

    //search food
    public function searchFood(Request $request){
        try {
            $data=$request->data;
            $foods=Food::where('nom','like', '%' . $data . '%');
            if($foods->isEmpty())
                return $this->SendError('can\'t find this food name ,try by other keywords');
            return $this->SendResponse($foods,'foods founded ');
        } catch (\Throwable $th) {
            return $this->SendError('Error',$th->getMessage());
        }


    }

}
