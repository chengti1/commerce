<?php



namespace App\Http\Controllers;



use Illuminate\Foundation\Bus\DispatchesJobs;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use Session;

use Hash;

use App\User;

use App\Products;

use DB;

use App\user_messages;

use Redirect;

use App\Categories;

use URL;

use Mail;



class UserController extends BaseController

{



    public function featured(){

    return Products::where('sell_type_id', 1)->orderBy('price_after_discount', 'desc')->take(3)->get();

  }



    public function daily(){

    return Products::where('sell_type_id', 1)->orderBy('created_at', 'desc')->take(3)->get();

  }





    public function index(){

        $products = Products::where('sell_type_id', 1)->paginate(12);

        $categories = Categories::where('parent_id', 0)->get();

        $featured = $this->featured();

        $daily = $this->daily();

        session()->regenerate();

        if(session('usertype') == 'buyer'){

            $user = User::where('user_id', Session('user_id'))->first();

            return view('index')->with('userData',$user)->with('products',$products)->with('categories', $categories)->with('featured', $featured)->with('daily', $daily);

        }

        else{

            return view('index')->with('products',$products)->with('categories', $categories)->with('featured', $featured)->with('daily', $daily);

        }

    }



 	public function login(){

        session()->regenerate();

        if(session('usertype') == 'buyer'){

            return redirect('buyerdashboard');

        }

        else{

            return view('login');

        }

    }



    public function buyerdashboard(){

        session()->regenerate();

        if(session('usertype') == 'buyer'){

            $userData = User::where('user_id', session('user_id'))->first();

            return view('buyerdashboard')->with('userData',$userData);

        }

        else{

            return redirect('login');

        }

    }



    public function dologin(Request $request){

 		$users = User::where('email',$request->email)->get();

        if(count($users)==1){

            foreach($users as $userss){

                $email = $userss->email;

                $password = $userss->password;

                $is_buyer = $userss->is_buyer;

                $confirmed = $userss->confirmed;

                $user_id = $userss->user_id;

            }
			// prashant kumar

            if($confirmed != '1'){
				
				session::put('change_email_user_id',$user_id);

                $flash = \Session::flash('warning', 'Please activate your account first. If you want to change email address, please <a href="change-email">click</a> here');

                return redirect('login')->with($flash);

            }
			// prashant kumar

            if($email == $request->email &&  (Hash::check($request->password, $password)) && $is_buyer == '1' && $confirmed == '1'){

                session()->regenerate();

                session(['usertype' => 'buyer',

                        'user_id' => $user_id,

                    ]);



                return redirect(URL::previous())->with('success','Successfully Logged In');

            }

            else{

                return redirect(URL::previous())->with('error','Invalid Email or Password');

            }

        }

        else{

            return redirect(URL::previous())->with('error','Email does not exist');

        }

	}



    public function logout(){

        session()->regenerate();

        Session::flush();

        return redirect('login');

        }



    public function register(){

        if(session('usertype') == 'buyer'){

            return redirect('buyerdashboard');

        }

        else{

            return view('register');

        }

    }



    public function doregister(Request $request){

        $validator = Validator::make($request->all(), [

                'FirstName'=>'required|max:50',

                'LastName'=>'required|max:50',

                'email'=>'required|max:100|email|unique:users',

                'password'=>'required|max:50|min:6',

                'company'=>'max:100|string',

                'address1'=>'required|max:50',

                'address2'=>'max:50',

                'country'=>'required|max:50',

                'postalcode'=>'required|max:50',

                'region'=>'required|max:50',

                'paypalemail'=>'required|max:50',

                'usertype'=>'required|max:1|min:0|numeric',

                'newsletter'=>'required|max:1',

                'mobilenumber'=>'required|max:20|min:8|unique:users,mobile_number',
				
				'captcha' => 'required|captcha',

            ]);



        if ($validator->fails()) {

             return redirect('register')->with('errors',$validator->errors())->withInput();

        }

        else{

            $data = array('email'=>$request->input('email'), 'name'=>$request->input('FirstName'));

            $user = new User;

            $user->first_name = $request->input('FirstName');

            $user->last_name = $request->input('LastName');

            $user->email = $request->input('email');

            $user->password = Hash::make($request->input('password'));

            $user->company = $request->input('company');

            $user->address1 = $request->input('address1');

            $user->address2 = $request->input('address2');

            $user->country = $request->input('country');

            $user->postal_code = $request->input('postalcode');

            if($request->input('usertype') == 0){

                $user->is_buyer = 1;

                $user->is_seller = 1;

            }

            else{

                $user->is_buyer = 1;

                $user->is_seller = 0;

            }

            $user->region = $request->input('region');

            $user->paypal_email = $request->input('paypalemail');

            $user->newsletter = $request->input('newsletter');

            $user->mobile_number = $request->input('mobilenumber');

            $user->confirm_code = rand(10000000, 99999999);

            $user->save();

            $userid = User::where('email',$request->input('email'))->first();

            User::where('email',$request->input('email'))->update(['created_by'=>$userid->user_id, 'updated_by' => $userid->user_id]);

            $code = User::where('email',$request->input('email'))->first();

            

            Mail::send('mails.welcome', ['confirm_code'=>$code->confirm_code, 'user_id'=>$code->user_id], function($message) use($data)

                {

                    $message->from('testmail0987654@gmail.com', 'Bubiland');

                    $message->to($data['email'], $data['name'])->subject('Verification Email');

                });
				
				// prashant kumar
             \Session::flash('msg', 'Please activate your account. Email has been sent to '. $data['email']. ' check your inbox in order to activate and login into your account');

            // return redirect('login')->with('success', 'Please check your inbox in order to activate and login into your account');

			// prashant kumar

            return redirect('login')->with('success', 'Please check your inbox in order to activate and login into your account');

        }

    }



    public function verify($confirm_code,$user_id){

        $user = User::where('confirm_code',$confirm_code)->where('user_id',$user_id)->first();

        if(count($user) == 0){

            return view('register')->with('error','invalid code please try again');

        }

        else{

            User::where('confirm_code',$confirm_code)

          ->where('user_id',$user_id)

          ->update(['confirm_code' => 'null', 'confirmed' => '1']);



          session(['usertype' => 'buyer','user_id' => $user_id]);

          return redirect('buyerdashboard');

        }

    }



    public function sendmessage(Request $request){

        session()->regenerate();

        if(session('usertype') == 'buyer'){

            if($request->has('buyer_id') && $request->has('message') && $request->has('product')){

                $newmessage = $request->input('product')."<br>".$request->input('message');

                $message = new user_messages;

                $message->sender_id = Session('user_id');

                $message->receiver_id = $request->input('buyer_id');

                $message->message = $newmessage;

                $message->save();

                return 'Message sent successfully';

            }

            else{

                return 'Please input some text';

            }

        }

        else {return 'Please login to continue';}

    }

    public function forgotPassword(){
        return view('forgot-password');
    }

    public function doForgotPassword(Request $request){
        $validator = Validator::make($request->all(), [

                'email'=>'required|max:100|email',

            ]);

        if($validator->fails()){
            return redirect('forgot-password')->with('error','Invalid Email Address');
        }
        else{
            $user = User::where('email',$request->input('email'))->first();
            if(count($user) == 0){
                return redirect('forgot-password')->with('error','Invalid Email Address');
            }
            else{
                $data = array('email'=>$request->input('email'), 'name'=>$user->first_name);
                $rand = rand(10000000, 99999999);
                User::where('email',$request->input('email'))->update(['reset_code'=>$rand]);
                Mail::send('mails.reset', ['reset_code'=>$rand, 'user_id'=>$user->user_id], function($message) use($data)

                {

                    $message->from('testingneu@gmail.com', 'Bubiland');

                    $message->to($data['email'], $data['name'])->subject('Password Reset');

                });
                return redirect('forgot-password')->withInput()->with('success','Please check your email address for link to password reset');
            }
        }
    }
	
	// Prashant Kumar
     public function changeEmail(){

        return view('change-email');
    }

     public function doChangeEmail(Request $request){
        $validator = Validator::make($request->all(), [

                'email'=>'required|max:100|email|unique:users',

            ]);

        if($validator->fails()){
            return redirect('change-email')->with('error','Invalid Email Address');
        }
        else{
            $user = User::where('user_id',session::get('change_email_user_id'))->first();

            if(count($user) == 0){
                return redirect('change-email')->with('error','Invalid Email Address');
            }
            else{
              User::where('user_id',session::get('change_email_user_id'))->update(['email'=>$request->input('email')]);
              $userid = User::where('user_id',session::get('change_email_user_id'))->first();
              $data = array('email'=>$userid->email, 'name'=>$userid->first_name);
              //User::where('email',$request->input('email'))->update(['created_by'=>$userid->user_id, 'updated_by' => $userid->user_id]);

              $code = User::where('user_id',session::get('change_email_user_id'))->first();



              Mail::send('mails.welcome', ['confirm_code'=>$code->confirm_code, 'user_id'=>$code->user_id], function($message) use($data)

                  {

                      $message->from('testmail0987654@gmail.com', 'Bubiland');

                      $message->to($data['email'], $data['name'])->subject('Verification Email');

                  });

              session::forget('change_email_user_id');

                return redirect('change-email')->withInput()->with('success','Please check your email address for link to activate your account');
            }
        }
    }
// prashant Kumar

    public function changePassword($code,$id){
        $user = User::where('reset_code',$code)->where('user_id',$id)->first();
        if(count($user) == 0){
            return redirect('forgot-password')->with('error','Invalid Access Code, Please try again');
        }
        else{
            return view('change-password')->with('id',$id)->with('reset_code',$code);
        }
    }
	
	public function doChangePassword($code,$id, Request $request){
        $user = User::where('reset_code',$code)->where('user_id',$id)->where('email',$request->input('email'))->first();
        if(count($user) == 0){
            return redirect('forgot-password')->with('error','Invalid Access Code, Please try again');
        }
        else{
            $password = Hash::make($request->input('password'));
			
			User::where('reset_code',$code)->where('user_id',$id)->where('email',$request->input('email'))->update(['reset_code'=>'','password'=>$password]);
			return redirect('login')->with('success','Password successfully reset. Please login to continue');
        }
    }

// for captcha created by kartik.
    public function refereshCapcha(){
        return captcha_img('flat');
    }
// end captcha.

}