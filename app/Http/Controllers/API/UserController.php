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
        $checkPhone = User::where('num_telephone', $request->phone)->first();

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
                'num_telephone'=> 'required|numeric',
                'photos' => 'nullable|mimes:jpg,jpeg,png|max:2048',

            ]);

            if($validator->fails()){
                return $this->SendError('Validate Error', $validator->errors());
            }

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            if ($request->hasFile('photos')) {

                $filename = $request->file('photos');
                //$filename = time() . '.' . $photos->guessExtension();
            //     $img=Image::make($photos)->resize(120, 120, function ($constraint) {
            //     $constraint->aspectRatio();
            //  });
             Storage::putFileAs('images/profile',$filename,random_int(1,100). '.' .$filename->guessExtension());

             DB::table('utilisateurs')->where('email', $request['email'])->update([ 'photos' => $filename, ]); }


            $token = Str::random(5);
            try{
                DB::table('utilisateurs')->where('email', $request['email'])->update([
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

            if($request->has('adresse1')){
                $adresse=new Adresse();
                $adresse->adresse1= $request->adresse1 ;
                if($request->has('adresse2'))
                $adresse->adresse2= $request->adresse2 ;
                $adresse->ville= $request->ville;
                $adresse->code_postal = $request->code_postal;
                $adresse->id_user=$userData->id;
                try {
                    $adresse->save();
                } catch (\Throwable $th) {
                    return $this->SendError($th->getMessage(), 400);
                }

            }
            $success['name'] = $userData->name;
            $success['role'] = $userData->role;
            $success['photos'] = $userData->photos;
            $success['token'] = $userData->createToken('@123*EMOOO*457##')->accessToken;
            return $this->SendResponse($success, 'Registered successfully');
        } catch (\Throwable $th) {
            return $this->SendError('Failed',$th->getMessage());
        }

    }

    public function login(Request $request){

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $user = Auth::user();
                if($user->is_verified != 1){
                    return $this->SendError('Verify your email', 400);
                }
                $success['name'] = $user->name;
                $success['role'] = $user->role;
                $success['photos'] = $user->photos;
                $success['token'] = $user->createToken('@123*EMOOO*457##')->accessToken;
                return $this->SendResponse($success, 'you logging in successfully');
            }else{
                return $this->SendError('Unauthorised', ['error', 'Unauthorised']);
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
	            $success['role'] = $user->role;
                $success['photos'] = $user->photos;
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


    public function ajouterLivreur(Request $request){
        //$user=a
        if(Gate::denies('isAdmin')){
            return $this->SendError('vous n\'avez pas les permissions');
        }
        else{
            $checkEmail = User::where('email', $request->email)->first();
            $checkPhone = User::where('num_telephone', $request->phone)->first();

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
                    'num_telephone'=> 'required|numeric',
                    'photos' => 'nullable|mimes:jpg,jpeg,png|max:5048',

                ]);

                if($validator->fails()){
                    return $this->SendError('Validate Error', $validator->errors());
                }

                $input = $request->all();
                $input['password'] = Hash::make($input['password']);
                $input['role']='livreur';
                $user = User::create($input);

                $token = Str::random(5);
                try{
                    DB::table('utilisateurs')->where('email', $request['email'])->update([
                        'is_verified' => $token,
                    ]);
                    $email = $request['email'];
                    $pass=$request->password;
                    Mail::send('Mails.verification', ['token' => $token,'pass'=>$pass], function ($message) use ($email) {
                        $message->to($email);
                        $message->subject('Verify your email');
                    });
                }catch(\Exception $exception){
                    return $this->SendError($exception->getMessage(), 400);
                }
                $userData = User::where('email', $request['email'])->first();
                $success['name'] = $userData->name;
                $success['role'] = $userData->role;
                $success['photos'] = $userData->photos;
                $success['token'] = $userData->createToken('@123*EMOOO*457##')->accessToken;
                return $this->SendResponse($success, 'Registered successfully');
            } catch (\Throwable $th) {
                return $this->SendError('Failed',$th->getMessage());
            }
        }
    }


    //mot de passe oublier
    public function forgotPassword(Request $request){

        $email = $request['email'];
        $validator = Validator::make($request->all(),[
            'email' => 'required | email',
        ]);
        if($validator->fails()){
            return $this->SendError('Validate Error', $validator->errors());
        }

        if(User::where('email', $email)->doesntExist()){
            return $this->SendError('Email is not exist', 404);
        }

        $token = Str::random(4);
        try {
            if (DB::table('password_resets')->where('email', $request['email'])->first()) {
                DB::table('password_resets')->where('email', $request['email'])->update([
                    'token' => $token,

                ]);
                $email = $request['email'];
                Mail::send('Mails.forgot', ['token' => $token], function ($message) use ($email){
                    $message->to($email);
                    $message->subject('Reset your password');
                    $message->priority(1);
                });
                return $this->SendResponse('check your email', 200);
            }

            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
            ]);

            Mail::send('Mails.forgotPassword', ['token' => $token], function ($message) use ($email){
                $message->to($email);
                $message->subject('Reset your password');
                $message->priority(1);
            });
            return $this->SendResponse('check your email', 200);
        } catch (\Exception $exception) {
            return $this->SendError($exception->getMessage(), 400);
        }
    }

    //Reset password
    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required',
            'c_password' => 'required |same:password',
        ]);
        if($validator->fails()){
            return $this->SendError('Validate Error', $validator->errors());
        }
        if (User::where('email', $request['email'])->doesntExist()) {
            $this->SendError('Invalid Email', 404);
        }
        if (!DB::table('password_resets')->where('email', $request['email'])->first()) {
            return $this->SendError('Invalid email', 404);
        }
        if (!DB::table('password_resets')->where('token', $request['token'])->first()) {
            return $this->SendError('Invalid token', 404);
        }
        $user = User::where('email', $request['email'])->first();
        $user->password = Hash::make($request['password']);
        DB::table('password_resets')->where('email', $request['email'])->where('token', $request['token'])->delete();
        $user->save();
        return $this->SendResponse('User password changed successfully', 200);
    }

    //change password
    public function changePassword(Request $request)
{
    $input = $request->all();
    $userid = Auth::user()->id;
    $validator=Validator::make($request->all(),[
        'old_password' => 'required',
        'new_password' => 'required|min:6',
        'confirm_password' => 'required|same:new_password',
    ]);

    if ($validator->fails()) {
        return $this->SendError('Error Validator',$validator->errors());
    } else {
        try {
            if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                return $this->SendError('Verify your old password',400);
            } else {
                User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                return $this->SendResponse('password updated Seccessfully!',200);
            }
        } catch (\Exception $ex) {
            return $this->SendError('Error ',$ex->getMessage());
        }
    }
}

public function logoutApi(Request $request)
{

    if (Auth::check()) {
        $request->user()->token()->revoke();
    return response()->json([
        'message' => 'Successfully logged out']);
    }
    return response()->json([
        'error' => 'Unable to logout user',
        'code' => 401,

    ], 401);

}

}
