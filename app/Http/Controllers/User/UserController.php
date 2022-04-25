<?php

namespace App\Http\Controllers\User;

use App\Crawler\Enum\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {
        return view('user.index');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function edit()
    {
        return view('user.edit');
    }

    public function update(UpdateUserRequest $request)
    {
        $user = User::find(auth()->user()->id);

        if ($request->hasFile('image')) {
            File::delete(public_path($user->image)); //Xóa file cũ đi
            $image = $request->file('image');
            $image_name = uniqid() . $image->getClientOriginalName();
            $image->move(public_path('/images/avatar'), $image_name);

            $image_path = "/images/avatar/" . $image_name;
            $user->image = $image_path;
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect(url()->previous())->with('status', 'Update user success !!!');
    }

    public function deactive(Request $request)
    {
        if (!Hash::check($request->password, Auth::user()->password)) {
            return response()->json(['message' => 'Password is don\'t match'],500);
        }

        User::find(auth()->user()->id)->update(['status' => UserStatus::DEACTIVE]);

        $this->logout($request);

        return response()->json(['message' => 'Deactive success'], 200);
    }
}
