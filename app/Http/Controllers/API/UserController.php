<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Adresse;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as Image;

class UserController extends BaseController
{
    public function userRegister(Request $request){


        $checkEmail = User::where('email', $request->email)->first();
        $checkPhone = User::where('number_phone', $request->phone)->first();

        if ($checkPhone || $checkEmail) {
            $response = [
                'email_phone_already_used' => true,
            ];
            return response()->json($response);
        }
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required | email',
                'password' => 'required',
                'c_password' => 'required|same:password',
                'number_phone'=> 'required|numeric',
                'photo' => 'nullable|mimes:jpg,jpeg,png|max:5048',

            ]);

            if($validator->fails()){
                return $this->SendError('Validate Error', $validator->errors());
            }

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            if ($request->hasFile('photo')) {

                $filename = $request->file('photo');
                //$filename = time() . '.' . $photo->guessExtension();
            //     $img=Image::make($photo)->resize(120, 120, function ($constraint) {
            //     $constraint->aspectRatio();
            //  });
             Storage::putFileAs('images',$filename,random_int(1,100). '.' .$filename->guessExtension());

             DB::table('users')->where('email', $request['email'])->update([ 'photo' => $filename, ]); }


            $token = Str::random(5);
            try{
                DB::table('users')->where('email', $request['email'])->update([
            	    'is_verified' => $token,
                ]);
                $email = $request['email'];
                Mail::send('Mails.verification', ['token' => $token], function ($message) use ($email) {
            	    $message->to($email);
            	    $message->subject('Verify your email');
                });
            }catch(\Exception $exception){
                return $this->SendError($exception->getMessage(), 400);
            }
            $userData = User::where('email', $request['email'])->first();

            if($request->has('address1')){
                $address=new Adresse();
                $address->adresse1= $request->address1 ;
                if($request->has('address2'))
                $address->adresse2= $request->adress2 ;
                $address->ville= $request->ville;
                $address->code_postal = $request->code_postal;
                $address->user_id=$userData->id;
                try {
                    $address->save();
                } catch (\Throwable $th) {
                    return $this->SendError($th->getMessage(), 400);
                }

            }
            $success['name'] = $userData->name;
            $success['role'] = $userData->role;
            $success['photo'] = $userData->photo;
            $success['token'] = $userData->createToken('@123*EMOOO*457##')->accessToken;
            return $this->SendResponse($success, 'Registered successfully');
        } catch (\Throwable $th) {
            return $this->SendError('Failed',$th->getMessage());
        }

    }

    public function login(Request $request){

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('@123*EMOOO*457##')->accessToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'User Login Successfully!' );
        }

       else{
            return $this->sendError('Unauthorised',['error','Unauthorised'] );
        }
    }


    public function emailVerification(Request $request){
	    $validator = Validator::make($request->all(), [
		    'email' => 'required | email',
		    'token' => 'required',
	    ]);
        if($validator->fails()){
            return $this->SendError('Validate Error', $validator->errors());
        }

	    $user = User::where('email', $request['email'])->first();
	    $token = $request['token'];
	    if($user->is_verified == $token){
		    $user->is_verified = 1;
		    $user->markEmailAsVerified();
		    $user->save();
            if (Gate::allows('isAdmin')) {
                $success['name'] = $user->name;
	            $success['is_Admin'] = $user->is_Admin;
                $success['photo'] = $user->photo;
                $success['token'] = $user->createToken('@123*EMOOO*457##')->accessToken;
		        return $this->SendResponse($success, 200);
            }
		    return $this->SendResponse('Email verified', 200);
	    }

        if ($user->is_verified == 1) {
            return $this->SendError('Email is already Verified', 400);
        }
	    return $this->SendError('Wrong token', 404);
    }
}
