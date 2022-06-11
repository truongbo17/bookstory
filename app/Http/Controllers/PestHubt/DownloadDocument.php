<?php

namespace App\Http\Controllers\PestHubt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadDocument extends Controller
{
    public function download(Request $request)
    {
        return view('pesthubt.download');
    }
}
