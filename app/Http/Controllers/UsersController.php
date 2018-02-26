<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Supplier_quotations;
use Illuminate\Support\Facades\View;
use App\ForgetPassword;
use Illuminate\Mail;


class UsersController extends Controller

{
    public function __construct()
    {
        $sup_quo = Supplier_quotations::count();
        View::share('sup_quo_count', $sup_quo);

        $quo_app = Supplier_quotations::where('status','=','requested')->count();
        View::share('quo_approve', $quo_app);

        $tender = Supplier_quotations::where('status','=','approved')->count();
        View::share('tender', $tender);
    }
    public function add(Request $request){
        //
    }

    public function edit(Request $request){
        //
    }

    public function delete(Request $request){
        //
    }

    public function allUsers(Request $request){
        //
    }

    public function changePassword(Request $request){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
        }
        if($request->isMethod('post')){
                if (!Hash::check($request->old_pass, Auth::user()->password)) {
                    return redirect()
                        ->to('/profile/change-password')
                        ->withErrors("Old Password does not match");
                }
                elseif($request->new_pass != $request->retype_pass){
                    return redirect()
                        ->to('/profile/change-password')
                        ->withErrors("New password does not match");
                }else{
                    $user->password = bcrypt($request->new_pass);
                    $user->save();
                    return redirect('/profile/change-password')
                        ->with('success-message', 'New password changed successfully!');
                }
            }
        return view('users.change-password');
    }

    public function login(Request $request){
        if(Auth::user()){
            return redirect()->to('/');
        }
        if($request->isMethod('post')){

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect('/');
            }else{
                return redirect()
                    ->to('/login')
                    ->with('error-message', 'Wrong username/password!!')
                    ->withInput();
            }
        }
        return view('users.login');
    }

    public function logout(){
        if(Auth::logout());
        return redirect('/login');
    }

    public function dashboard(){
        $id = Auth::id();
        $user = User::find($id);
        if(!Auth::user()){
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }elseif ($user->role == 'suppliers'){
            return redirect('/supplier-controller/view-qr/');
        }else{
            return view('dashboard');
        }
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function webForgetPassword(Request $request){
        if($request->isMethod('post')){
            if(!$request->email){
                return redirect()->back()->with('error-message', 'Please provide an email!');
            }

            $mailCheck = User::where('email', $request->email)->get();
            if(!$mailCheck->first()){
                return redirect()->back()->with('error-message', 'Wrong email address!');
            }

            $reqCheck = ForgetPassword::where('email', $request->email)->get();
            if($reqCheck->first()){
                return redirect()->back()->with('error-message', 'An email with password reset link has been sent to you already!');
            }

            $linkExtension = $this->generateRandomString();
            $link = url('/new-password').'/'.$linkExtension;

            $transport = (new \Swift_SmtpTransport('ssl://mail.bbcplantation.com.my', 465))
                ->setUsername("resetpassword@bbcplantation.com.my")
                ->setPassword('$nW-~KmU]A$g');

            $mailer = new \Swift_Mailer($transport);

            $message = new \Swift_Message('BBC Plantation - Password Reset Link');
            $message->setFrom(['resetpassword@bbcplantation.com.my' => 'Admin - BBC Plantation']);
            $message->setTo([$request->email => $mailCheck[0]['name']]);
            $message->setBody('<html><body>'.
                '<h1>Hi '.$mailCheck[0]['name'].',</h1>'.
                '<p style="font-size:18px;">You recently requested to reset your password. Please click the button/link below to reset.</p>'.
                '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                              <div>
                                <!--[if mso]>
                                  <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://litmus.com" style="height:36px;v-text-anchor:middle;width:150px;" arcsize="5%" strokecolor="#EB7035" fillcolor="#EB7035">
                                    <w:anchorlock/>
                                    <center style="color:#ffffff;font-family:Helvetica, Arial,sans-serif;font-size:16px;">I am a button &rarr;</center>
                                  </v:roundrect>
                                <![endif]-->
                                <a href="'.$link.'" style="background-color:#EB7035;border:1px solid #EB7035;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;">Reset password &rarr;</a>
                              </div>
                            </td>
                          </tr>
                        </table>'.
                '<br><br>Thank You<br>BBC Plantation<br>Customer Care Team</body></html>',
                'text/html');

            $result = $mailer->send($message);

            if($result){
                $genLink = new ForgetPassword();

                $genLink->email = $request->email;
                $genLink->token = $linkExtension;

                $genLink->save();

                return redirect()
                    ->to('forget-password/')
                    ->with('success-message','Password Reset Link Has Been Send To Your Email Successfully !');
            }else{
                return redirect()
                    ->to('forget-password/')
                    ->with('error-message','Something went wrong while sending the email! Please try again!');
            }
            return redirect()
                ->to('forget-password/')
                ->with('success-message','Password Reset Link Has Been Send To Your Email Successfully ! Do Not Forget To Check Your Spam Folder !');
        }
        return view('users.forget-password');
    }
    public function newPasswordView(){
        return view('users.new-password');
    }
    public function newPassword($token,Request $request){
        if($request->isMethod('post')){
            if(!$request->password or !$request->repass){
                return redirect()->back()->with('error-message', 'Password fields are required!');
            }
            if($request->password != $request->repass){
                return redirect()->back()->with('error-message', 'Password fields should match!');
            }
            $user = User::where('email', $request->email)->get();
            if(!$user->first()){
                return redirect()->back()->with('error-message', 'E-mail address was not found!');
            }
            if($request->password == $request->repass){
                User::where('email', $request->email)
                    ->update(['password' => bcrypt($request->password)]);
                ForgetPassword::where('email', $request->email)->delete();
            }
            return redirect()
                ->to('/login')
                ->with('success-message', 'Your password has been reset. Try login now.'."\n".'Thank you!');
        }
        $tokenCheck = ForgetPassword::where('token', $token)->get();
        if($tokenCheck->first()){
            return view('users.new-password', [
                'email' => $tokenCheck[0]['email'],
                'token' => $token
            ]);
        }else{
            return 'This link doesn\'t exist';
        }
    }
}
