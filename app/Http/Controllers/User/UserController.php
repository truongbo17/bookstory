<?php

namespace App\Http\Controllers\User;

use App\Crawler\Enum\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserAddDocumentRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            if ($user->image != null && Storage::disk(config('crawl.document_disk'))->exists($user->image)) {
                Storage::disk(config('crawl.document_disk'))->delete($user->image);
            }

            $image = $request->file('image');
            $image_name = uniqid() . $image->getClientOriginalName();

            $path = Storage::disk(config('crawl.document_disk'))->put(config('crawl.path.avatar_user'), $image);

            $user->image = $path;
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
            return response()->json(['message' => 'Password is don\'t match'], 500);
        }

        User::find(auth()->user()->id)->update(['status' => UserStatus::DEACTIVE]);

        $this->logout($request);

        return response()->json(['message' => 'Deactive success'], 200);
    }

    public function listDocument()
    {
        $user = User::findorFail(auth()->user()->id)->with('documents')->get();

        return view('user.document.list', compact('user'));
    }

    public function addDocument()
    {
        return view('user.document.add');
    }

    public function storeDocument(UserAddDocumentRequest $request)
    {
        dd($request->all());
    }
}
