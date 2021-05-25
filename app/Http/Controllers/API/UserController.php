<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required',
            'c_password' => 'required | same:password',
            'shippingAddress' => 'required',
            'photo' => 'nullable|mimes:jpg,jpeg,png|max:5048',
        ]);

        if($validator->fails()){
            return $this->SendError('Validate Error', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        if ($request->has('photo')) {
            $newImageName = time() . '_' . $request->photo->getClientOriginalName();
            $request->photo->move('uploads/ProfilePics', $newImageName);
            $imgaeURL = url('/uploads/ProfilePics'.'/'.$newImageName);
            DB::table('users')->where('email', $request['email'])->update([
                'photo' => $imgaeURL,
            ]);
        }
	    //send the verify code
	    $token = Str::random(5);
	    // try{
		//     DB::table('users')->where('email', $request['email'])->update([
		// 	    'is_verify' => $token,
		//     ]);
		//     $email = $request['email'];
		//     Mail::send('Mails.verify', ['token' => $token], function ($message) use ($email) {
		// 	    $message->to($email);
		// 	    $message->subject('Verify your email');
		//     });
	    // }catch(\Exception $exception){
		//     return $this->SendError($exception->getMessage(), 400);
	    // }
        $userData = User::where('email', $request['email'])->first();
	    $success['name'] = $userData->name;
	    $success['is_Admin'] = $userData->is_Admin;
        $success['photo'] = $userData->photo;
        $success['token'] = $userData->createToken('customer')->accessToken;
        return $this->SendResponse($success, 'Registered successfully');
    }
}
