<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;


class AdminController extends Controller
{
    protected $request;
    private $Data_model,$Image_model;

    public function __construct()
    {
        $this->request = request();
        $this->Data_model = new User();
        $this->Image_model = new Image();
    }

    public function adminView(){
        if (auth()->check()){
            if(auth()->user()->is_admin == 1)
            {
                $users = $this->Data_model::with('images')->get();
                return view('admin.registeredUser', compact('users'));
            }
        }else{
            return redirect()->route('auth.login')->with('error', 'Please log in to access the profile.');
        }

    }

    public function updateStatus($id) {
        $user = $this->Data_model->find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $newStatus = $user->status == '1' ? '0' : '1';
        $user->status = $newStatus;
        $user->save();

        return response()->json(['status' => $newStatus]);
    }

    public function getUserImages($userId){
        $userImages = $this->Image_model::where('user_id', $userId)->get(['photo']);
        return response()->json($userImages);
    }


}
