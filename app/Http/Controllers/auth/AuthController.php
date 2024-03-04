<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\RegisterRequest;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UserDetailRequest;
use Carbon\Carbon;
use App\Http\Requests\Step1LoginRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{
    protected $request;
    private $Data_model,$Image_model;

    public function __construct()
    {
        $this->request = request();
        $this->Data_model = new User();
        $this->Image_model = new Image();
        $this->middleware('web');
    }

    public function registerView(){
        return view('auth.register');
    }

    public function loginView(){
        return view('auth.login');
    }

    public function step1Register(RegisterRequest $request){
        $email = $request->input('email');
        $otp = rand(100000, 999999);
        // $this->Data_model::updateOrCreate(['email' => $email], ['otp' => $otp]);

        $to_email = $email;
        $data = ['otp' => $otp];

        Mail::send('emails.mail', $data, function ($message) use ($to_email) {
            $message->to($to_email)
                ->subject('Verification Code')
                ->from('your@gmail.com', 'Your App Name');
        });

        $this->Data_model::updateOrCreate(['email' => $email], ['otp' => $otp]);


        Session::put('email', $email);

        return redirect()->route('email.otpVerify');

    }

    public function verifyOtp(){
        return view('emails.verify-otp');
    }

    public function loginVerifyOtp(){
        return view('emails.login-verify-otp');

    }

    public function personalDetails(){
        $email = session('email');
        return view('user.personal-details',compact('email'));
    }

    public function otpVerification(){
        $otp = $this->request->input('otp');
        $email = session('email');
        if (!$email) {
            return redirect()->back()->with('error', 'Email not found in session.');
        }

        try {
            $user = $this->Data_model::where('email', $email)->where('otp', $otp)->first();

            if ($user) {
                $user->email_verified_at = now();
                $user->save();
                $successMessage = 'Email has been successfully verified.';
                return redirect()->route('user.personalDetails')->with('successMessage', $successMessage);
            } else {
                return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while verifying the email. Please try again.');
        }
    }

    public function loginOtpVerification()
    {
        $otp = $this->request->input('otp');
        $email = session('email');

        if (!$email) {
            return redirect()->back()->with('error', 'Email not found in session.');
        }

        try {
            $user = $this->Data_model::where('email', $email)->where('otp', $otp)->first();

            if ($user) {
                if ($user->status == 1) {
                    auth()->login($user);

                    if (!$user->hasVerifiedEmail()) {
                        $user->markEmailAsVerified();
                        $successMessage = 'You are successfully logged in.';
                        return redirect()->to('/edit-profile')->with('successMessage', $successMessage);
                    } else {
                        $successMessage = 'Your email is already verified.';
                        return redirect()->to('/edit-profile')->with('successMessage', $successMessage);
                    }
                } else {
                    return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while verifying the email. Please try again.');
        }
    }

    public function editProfile(){

        if (auth()->check()) {
            $user = auth()->user();
            $userImages = $this->Image_model::where('user_id', $user->id)->get();
            $userImages1 = $this->Image_model::where('user_id', $user->id)->first();

            $userProfile = $this->Data_model::where('email', $user->email)->first();
            return view('user.edit-profile', compact('userProfile','userImages','userImages1'));
        } else {
            return redirect()->route('auth.login')->with('error', 'Please log in to access the profile.');
        }
    }


    public function addUserDetail(UserDetailRequest $request)
    {
        $email = session('email');
        $user = $this->Data_model::where('email', $email)->first();

        if ($user) {
            $validatedData = $request->validated();

            if ($validatedData['password'] !== $validatedData['confirm_password']) {
                return redirect()->back()->with('error', 'Password confirmation does not match.');
            }

            $dob = Carbon::createFromFormat('m/d/Y', $validatedData['dob'])->format('Y-m-d');
            $user->update([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'dob' => $dob,
                'mobile_number' => $validatedData['mobile_number'],
                'password' => bcrypt($validatedData['password']),
                'confirm_password' => bcrypt($validatedData['confirm_password'])
            ]);
            $successMessage = 'User details updated successfully';
            return redirect()->route('user.editprofile')->with('successMessage', $successMessage);
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    public function step1Login(Step1LoginRequest $request)
    {
        $email = $request->input('email');
        $user = $this->Data_model::where('email', $email)->first();

        if ($user) {
            $otp = rand(100000, 999999);

            $user->update(['otp' => $otp]);

            $data = ['otp' => $otp];
            Mail::send('emails.loginMail', $data, function ($message) use ($email) {
                $message->to($email)
                    ->subject('Verification Code')
                    ->from('your@gmail.com', 'Your App Name');
            });

            Session::put('email', $email);

            return redirect()->route('email.loginMail');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    public function step2Login(LoginRequest $request){
        $validatedData = $request->validated();
        $username = $validatedData['username'];
        $password = $validatedData['password'];

        $user = $this->Data_model::where('username', $username)->first();

        if ($user) {
            if ($user->status == 1) {
                if (auth()->attempt(['username' => $username, 'password' => $password])) {
                    if (auth()->user()->is_admin == 1) {
                        return redirect()->route('auth.admin');
                    } else {
                        return redirect()->route('user.editprofile');
                    }
                } else {
                    return redirect()->route('auth.userLogin')->with('error', 'Invalid username or password');
                }
            } else {
                // $error = 'Your account is inactive. Please contact support.';
                return redirect()->route('auth.userLogin')->with('error', 'Your account is inactive. Please contact support.');
            }
        } else {
            return redirect()->route('auth.userLogin')->with('error', 'Invalid username or password');
        }
    }

    public function userProfile(){
        $user = auth()->user();
        $userProfile = $this->Data_model::where('email', $user->email)->first();

        if (!$userProfile) {
            return redirect()->back()->with('error', 'User profile not found.');
        }

        if ($this->request->isMethod('post')) {
            $validatedData = $this->request->validate([
                'name' => 'nullable|string',
                'email' => 'nullable|string',
                'dob' => 'nullable|date_format:m/d/Y',
                'password' => 'nullable|string|min:6',
                // 'photo_1' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:1024',
                'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:1024',
            ], [
                // 'photo_1.*' => 'Please upload an image with jpg, png, jpeg, or gif format.',
                'photo.*' => 'Please upload an image with jpg, png, jpeg, or gif format.',
            ]);

            $dob = $validatedData['dob'] ? Carbon::createFromFormat('m/d/Y', $validatedData['dob'])->format('Y-m-d') : null;

            $userProfile->name = $validatedData['name'];
            $userProfile->email = $validatedData['email'];
            $userProfile->dob = $dob;

            if ($validatedData['password']) {
                $userProfile->password = bcrypt($validatedData['password']);
            }

            if ($this->request->hasFile('photo')) {
                $file = $this->request->file('photo');
                $imageFileType1 = $file->getClientOriginalExtension();
                $allowedExtensions = ['jpg', 'png', 'jpeg', 'gif'];

                if (!in_array($imageFileType1, $allowedExtensions)) {
                    return redirect()->route('user.editprofile')->with('error', 'Please upload an image with jpg, png, jpeg, or gif format.');
                }

                if ($file->getSize() > 1 * 1024 * 1024) {
                    return redirect()->route('user.editprofile')->with('error', 'Sorry, the image file should be only 1MB in size.');
                }

                $menu1Image = $file->storeAs('public/multi_profile_images', $user->id . '_' . uniqid() . '.' . $file->getClientOriginalExtension());

                $this->Image_model::create([
                    'user_id' => $user->id,
                    'photo' => 'multi_profile_images/' . basename($menu1Image),
                ]);
            }


            $userProfile->save();

            $successMessage = 'Profile updated successfully.';
            return redirect()->route('user.editprofile')->with('successMessage', $successMessage);
        }

        return view('user.profile', compact('userProfile'));
    }


    public function step1Logout(){
        Auth::guard('web')->logout();
        session()->forget('email');
        return redirect()->route('auth.login');
    }

    public function forgotPasswordView(){
        return view('auth.forgot-password');
    }

    public function forgotPasswordOtpView(){
        return view('emails.forgot-password-verify-otp');
    }

    public function newPasswordView(){
        return view('auth.new-password');
    }

    public function forgotPasswordOtp(Step1LoginRequest $request){
        $email = $request->input('email');
        $user = $this->Data_model::where('email', $email)->first();

        if ($user) {
            if (isset($user->status) && $user->status == 1) {
                $otp = rand(100000, 999999);
                $user->update(['otp' => $otp]);

                $data = ['otp' => $otp];

                Mail::send('emails.forgotPasswordMail', $data, function ($message) use ($email) {
                    $message->to($email)
                        ->subject('Verification Code')
                        ->from('your@gmail.com', 'Your App Name');
                });
                Session::put('email', $email);

                return redirect()->route('email.password-verify-otp');
            } else {
                return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
            }
        } else {
            return redirect()->back()->with('error', 'User not found or invalid email.');
        }

    }

    public function forgotPasswordVerifyOtp(){
        $otp = $this->request->input('otp');
        $email = session('email');
        try {
            $user = $this->Data_model::where('email', $email)->where('otp', $otp)->first();
            if ($user) {
                if ($user->status == 1) {
                    return redirect()->route('auth.newPasswordView')->with('success', 'Successfully verified Otp.');
                } else {
                    return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while verifying the email. Please try again.');
        }
    }
}

