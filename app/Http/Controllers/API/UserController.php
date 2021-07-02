<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Libraries\General;
use App\Models\Adresse;
use App\Models\User;
use File;
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
            return $this->SendError(trans('messages.email_phone_verification'));
        }
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required | email',
                'password' => 'required',
                'c_password' => 'required|same:password',
                'num_telephone'=> 'required|numeric',
                // 'photos' => 'nullable|mimes:jpg,jpeg,png|max:2048',

            ]);

            if($validator->fails()){
                return $this->SendError(trans('messages.error_validator'), $validator->errors());
            }

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            // if ($request->hasFile('photos')) {
            //     $image = $request->file('photos');
            //     $filename = time() . random_int(1,100). '.' .$image->guessExtension();
            //     Storage::putFileAs('images/profiles',$image,$filename);
            //     DB::table('utilisateurs')->where('email', $request['email'])->update([ 'photos' => $filename, ]);
            // }


            $token = Str::random(5);
            try{
                DB::table('utilisateurs')->where('email', $request['email'])->update([
            	    'is_verified' => $token,
                ]);
                $email = $request['email'];
                Mail::send('Mails.verification', ['token' => $token], function ($message) use ($email) {
            	    $message->to($email);
            	    $message->subject(trans('messages.mail_subject'));
                });
            }catch(\Exception $exception){
                return $this->SendError($exception->getMessage(), 400);
            }
            $userData = User::where('email', $request['email'])->first();

            // if($request->has('adresse1')){
            //     $adresse=new Adresse();
            //     $adresse->adresse1= $request->adresse1 ;
            //     if($request->has('adresse2'))
            //     $adresse->adresse2= $request->adresse2 ;
            //     $adresse->code_postal = $request->code_postal;
            //     $adresse->user_id=$userData->id;
            //     try {
            //         $user->adresse()->save($adresse);
            //     } catch (\Throwable $th) {
            //         return $this->SendError($th->getMessage(), 400);
            //     }

            // }
            $success['name'] = $userData->name;
            $success['role'] = $userData->role;
            $success['email'] = $userData->email;
            $success['token'] = $userData->createToken('@123*EMOOO*457##')->accessToken;
            return $this->SendResponse($success, trans_choice('messages.register_success',1));
        } catch (\Throwable $th) {
            return $this->SendError(trans_choice('messages.register_success',2),$th->getMessage());
        }

    }

    public function login(Request $request){

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $user = Auth::user();
                if($user->is_verified != 1){
                    return $this->SendError(trans('messages.is_verified_email'), 400);
                }
                $success['name'] = $user->name;
                $success['role'] = $user->role;
                $success['photos'] = $user->photos;
                $success['token'] = $user->createToken('@123*EMOOO*457##')->accessToken;
                return $this->SendResponse($success,trans_choice('messages.login_msg',1));
            }else{
                return $this->SendError(trans_choice('messages.login_msg',2));
            }
        }


    public function emailVerification(Request $request){
	    $validator = Validator::make($request->all(), [
		    'email' => 'required | email',
		    'token' => 'required',
	    ]);
        if($validator->fails()){
            return $this->SendError(trans('messages.error_validator'), $validator->errors());
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
		    return $this->SendResponse(trans('messages.email_verified'), 200);
	    }

        if ($user->is_verified == 1) {
            return $this->SendError(trans('messages.email_already_verified'), 400);
        }
	    return $this->SendError(trans('messages.wrong_token'), 404);
    }


    public function ajouterLivreur(Request $request){
        //$user=a
        if(Gate::denies('isAdmin')){
            return $this->SendError(trans('messages.admin_permession'));
        }
        else{
            $checkEmail = User::where('email', $request->email)->first();
            $checkPhone = User::where('num_telephone', $request->phone)->first();

            if ($checkPhone || $checkEmail) {
                return $this->SendError(trans('messages.email_phone_verification'));
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
                    return $this->SendError(trans('messages.error_validator'), $validator->errors());
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
                        $message->subject(trans('messages.is_verified_email'));
                    });
                }catch(\Exception $exception){
                    return $this->SendError($exception->getMessage(), 400);
                }
                $userData = User::where('email', $request['email'])->first();
                $success['name'] = $userData->name;
                $success['role'] = $userData->role;
                $success['photos'] = $userData->photos;
                $success['token'] = $userData->createToken('@123*EMOOO*457##')->accessToken;
                return $this->SendResponse($success,trans_choice('messages.register_success',1));
            } catch (\Throwable $th) {
                return $this->SendError(trans_choice('messages.register_success',2),$th->getMessage());
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
            return $this->SendError(trans('messages.error_validator'), $validator->errors());
        }

        if(User::where('email', $email)->doesntExist()){
            return $this->SendError(trans('messages.email_exist'), 404);
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
                    $message->subject(trans('messages.reset_pass'));
                    $message->priority(1);
                });
                return $this->SendResponse(trans('messages.check'), 200);
            }

            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
            ]);

            Mail::send('Mails.forgotPassword', ['token' => $token], function ($message) use ($email){
                $message->to($email);
                $message->subject(trans('messages.reset_pass'));
                $message->priority(1);
            });
            return $this->SendResponse(trans('messages.check'), 200);
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
            return $this->SendError(trans('messages.error_validator'), $validator->errors());
        }
        if (User::where('email', $request['email'])->doesntExist()) {
            $this->SendError(trans('messages.invalid_email'), 404);
        }
        if (!DB::table('password_resets')->where('email', $request['email'])->first()) {
            return $this->SendError(trans('messages.invalid_email'), 404);
        }
        if (!DB::table('password_resets')->where('token', $request['token'])->first()) {
            return $this->SendError(trans('messages.invalid_token'), 404);
        }
        $user = User::where('email', $request['email'])->first();
        $user->password = Hash::make($request['password']);
        DB::table('password_resets')->where('email', $request['email'])->where('token', $request['token'])->delete();
        $user->save();
        return $this->SendResponse(trans('messages.reset_sucess'), 200);
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
        return $this->SendError(trans('messages.error_validator'),$validator->errors());
    } else {
        try {
            if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                return $this->SendError(trans_choice('messages.change_response',2),400);
            } else {
                User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                return $this->SendResponse(trans_choice('messages.change_response',1),200);
            }
        } catch (\Exception $ex) {
            return $this->SendError(trans('messages.error_excep'),$ex->getMessage());
        }
    }
}

//resend code reset password
public function resendCodeReset(Request $request){
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
    ]);
    if ($validator->fails()) {
        return $this->SendError(trans('messages.error_validator'),$validator->errors());
    }
    $email = $request['email'];
    $token = Str::random(4);
    DB::table('password_resets')->where('email', $request['email'])->update([
        'token' => $token,

    ]);
    $email = $request['email'];
    Mail::send('Mails.forgot', ['token' => $token], function ($message) use ($email){
        $message->to($email);
        //Reset your password
        $message->subject(trans('messages.reset_pass'));
        $message->priority(1);
    });
    //check your email
    return $this->SendResponse(trans('messages.check'), 200);
}
//logout api
public function logoutApi(Request $request)
{
   if (Auth::check()) {
        $request->user()->token()->revoke();
    return $this->SendResponse(trans_choice('messages.logout_msg',1),200);
    }
    return $this->SendError(trans_choice('messages.logout_msg',2));
}

//Update Profile
public function updateProfile(Request $request){
    $user=Auth::user();
    //dd($user);
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'email|unique:utilisateurs,email,' . auth()->user()->id,
        'num_telephone'=> 'required|numeric',
        'photos' => 'nullable|mimes:jpg,jpeg,png|max:2048',
    ]);
    if ($validator->fails()) {
        return $this->SendError(trans('messages.error_validator'),$validator->errors());
    }

    if ($request->hasFile('photos')) {
        $image = $request->file('photos');
        $filename = time() . random_int(1,100). '.' .$image->guessExtension();
        //dd($filename);
        $oldImage=User::findOrFail($user->id);
        //dd($oldImage->photos);
        if($oldImage->photos){
            try{
                if(Storage::exists('images/profiles/'.$oldImage->photos)){

                    Storage::delete('images/profiles/'.$oldImage->photos);

                }else{
                    //File does not exists.;
                    return $this->SendError(trans('messages.file_exist'),$validator->errors());
                }
            }catch(\Throwable $th){
                return $this->SendError($th->getMessage(), 400);
            }
        }
        Storage::putFileAs('images/profiles',$image,$filename);
        $user->photos=$filename;
    }
    $user->name=$request->name;
    $user->email=$request->email;
    $user->num_telephone=$request->num_telephone;

    try {
        $user->save();
        if($request->has('adresse1')){
        $adresseId=Adresse::where('user_id',$user->id)->first();
        if(!is_null($adresseId)){
            $adresse=Adresse::findOrFail($adresseId->id);
            $adresse->adresse1= $request->adresse1 ;
            $adresse->adresse2= $request->adresse2 ;
            $adresse->code_postal = $request->code_postal;
            $adresse->user_id=$user->id;
            $user->adresse()->save($adresse);
        }else{
            $adresse=new Adresse();
            $adresse->adresse1= $request->adresse1 ;
            if($request->has('adresse2'))
            $adresse->adresse2= $request->adresse2 ;
            $adresse->code_postal = $request->code_postal;
            $adresse->user_id=$user->id;
            $user->adresse()->save($adresse);
        }
        //Information Updated Successfully
        return $this->SendResponse(trans('messages.update_profile'),$user->photos);
    }
    }catch(\Throwable $th) {
        return $this->SendError($th->getMessage(), 400);
    }
}

//show user profile
public function showMyProfile(){
    $user=Auth::user();
    try {
        $adresse=Adresse::with('utilisateur')->where('user_id',$user->id)->get();
        return $this->SendResponse($adresse,200);
    } catch (\Throwable $th) {
        return $this->SendError($th->getMessage(), 400);
    }
}
//display all delivery-guys
public function allDeliveryGuys(Request $request){
    //$user=a
    $enumoption = General::getEnumValues('utilisateurs','role') ;
    //dd($enumoption['2']);
    $role=$enumoption['2'];
    if(Gate::denies('isAdmin')){
        return $this->SendError(trans('messages.admin_permession'));
    }else{
        $delivery_guys=User::where('role',$role)->get();
        if($delivery_guys->isEmpty())
            return $this->SendError(trans('messages.exist_delevery'));
        return $this->SendResponse($delivery_guys,200);
    }
}
public function getUsers(Request $request){
    //$user=a
    return $this->SendResponse('test',200);
    $enumoption = General::getEnumValues('utilisateurs','role') ;
    //dd($enumoption['2']);
    $role=$enumoption['0'];
    if(Gate::denies('isAdmin')){
        return $this->SendError(trans('messages.admin_permession'));
    }else{
        $delivery_guys=User::where('role',$role)->get();
        if($delivery_guys->isEmpty())
            return $this->SendError(trans('messages.exist_delevery'));
        return $this->SendResponse($delivery_guys,200);
    }
}

public function currentUser(Request $request){
    $user=Auth::user();
    return $this->SendResponse($user,'current user');
}

}
