<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Socialite;
use Session;
use App\SocialAccountService;
use App\SocialAccount;
use App\User;

class SocialAuthController extends Controller
{
	public function redirect($driver = 'facebook'){
		return Socialite::driver($driver)->redirect();
	}

	public function callback(SocialAccountService $service, $driver='facebook'){
        if( $driver == 'twitter' ){
            $user = $service->createOrGetUser(Socialite::driver($driver)->user(), $driver);
        }else{
            $user = $service->createOrGetUser(Socialite::driver($driver)->stateless()->user(), $driver);
        }
        if(!empty($user->user_id)){
         	session()->regenerate();
         	session(['usertype' => 'buyer', 'user_id' => $user->user_id]);
         	return redirect('/buyerdashboard');
     	}
     	else{
     		$user_ids = User::where('email',$user->email)->first();
     		SocialAccount::where('email',$user->email)->update(['user_id' => $user_ids->user_id]);
     		session()->regenerate();
         	session(['usertype' => 'buyer', 'user_id' => $user_ids->user_id]);
         	return redirect('/buyerdashboard');
     	}
	}
}
