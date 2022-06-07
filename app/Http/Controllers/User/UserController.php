<?php

namespace App\Http\Controllers\User;

use App\Crawler\Enum\Status;
use App\Crawler\Enum\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserAddDocumentRequest;
use App\Libs\DiskPathTools\DiskPathInfo;
use App\Libs\IdToPath;
use App\Models\Document;
use App\Models\User;
use App\Services\DocumentManager;
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

            $file_name = IdToPath::make($user->id, $request->image->extension());
            $file_name = new DiskPathInfo(config('crawl.document_disk'), config('crawl.path.avatar_user') . '/' . $file_name);
            $file_name->put($request->file('image')->getContent());

            $user->image = $file_name;
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

        if (is_null($request->input('slug'))) {
            $slug = createSlug($request->input('title'));
        } else {
            $slug = createSlug($request->input('slug'));
        }

        $document = Document::create([
            "title" => $request->input('title'),
            "slug" => $slug,
            "code" => $request->input('code'),
            "download_link" => "",
            "content_file" => "",
            "binding" => "PDF",
            "count_page" => $request->input('page'),
            "content_hash" => md5($request->input('content')),
            'is_crawl' => 0,
            'status' => Status::PENDING,
        ]);

        if ($request->hasFile('image')) {
            $image_name = IdToPath::make($document->id, $request->image->extension());
            $image_name = new DiskPathInfo(config('crawl.document_disk'), config('crawl.path.document_image') . '/' . $image_name);

            $image_name->put($request->file('image')->getContent());

            $document->image = $image_name->__toString();
        }

        if ($request->hasFile('file_upload')) {
            $file_name = IdToPath::make($document->id, $request->file_upload->extension());
            $file_name = new DiskPathInfo(config('crawl.pdf_disk'), config('crawl.path.document_pdf') . '/' . $file_name);
            $file_name->put($request->file('file_upload')->getContent());

            $document->download_link = $file_name;
        }

        DocumentManager::updateContentFile($document, $request->input('content'));
        if (!is_null($request->input('keyword'))) {
            DocumentManager::updateKeywords($document, explode(',', $request->input('keyword')));
        }
        $document->users()->attach(\auth()->user()->id);

        $document->save();

        return redirect(url()->previous())->with('status', 'Success upload document,Please wait for approval !!!');
    }
}
