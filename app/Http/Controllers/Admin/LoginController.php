<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Session;

class Login extends Controller
{

    private $__queryStatus = FALSE;
	private $__table = "users";
	private $__id = NULL;
	private $__encId = NULL;
	private $__SpecialSymbol = ""; 
	const ATMPTVAL  = 3;
	const ATMPTMINUTE  = 10;

    function index(){
       return view('admin.login.login'); 
    }

    function checkLogin(Request $req){
        

        $validatedData = $req->validate([
            'username' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
            ],
            ['captcha.captcha'=>'Invalid captcha code.']);


            $result = DB::table('users')->where('username',$req->input('username'))->get();
            $res = json_decode($result,true);
            if(sizeof($res)==0){
                $req->session()->flash('error','Username  does not exist. Please register yourself first');
                return redirect('manage/login');
                } else{
                    $encrypted_password = $result[0]->password;
                    $decrypted_password = Crypt::decrypt($encrypted_password);
                    if($decrypted_password==$req->input('password')){
                    $sessionData = array(
                        'user' => $result[0]->name,
                        'user_id' =>$result[0]->id,
                        
                    );
                    $req->session()->put($sessionData);
                    return redirect('manage/dashboard');
                    }
                    else{
                    $req->session()->flash('error','Password Incorrect!!!');
                    return redirect('manage/login');
                    }
                }
    }


        public function logout() {
            Session::forget('user','user_id'); // Removes a specific variable
            return redirect('manage/login');
        }


        public function refreshCaptcha()
            {
                return response()->json(['captcha'=> captcha_img()]);
            }

}
