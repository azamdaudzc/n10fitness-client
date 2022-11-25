<?php
namespace App\Http\Controllers\UserControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserControllers\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Mail;
use App\Traits\ApiResponser;

class RegisterController extends BaseController

{
    use ApiResponser;
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request)

    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);



        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['user_type']='user';
        $user = User::create($input);

        // Mail::send('email.signin', ['name' => $user->first_name.' '.$user->last_name], function($message) use($request){
        //     $message->to($request->email);
        //     $message->subject('Hello');
        // });

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken,
            'name' => $user->first_name.' '.$user->last_name
        ]);

    }



    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)

    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            return $this->success([
                'token' => $user->createToken('API Token')->plainTextToken,
                'name' => $user->first_name.' '.$user->last_name
            ]);

        }

        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }

    }

}
