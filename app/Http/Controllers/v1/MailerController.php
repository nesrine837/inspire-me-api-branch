<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Mail\NewProject;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MailerController extends Controller
{
    public function newProject(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:40',
            'email' => 'required|email',
            'cell' => 'min:10|max:10',
            'message' => 'required|max:500'
        ]);

        $data = $request->input();
        Storage::put('log.txt', $request);
        \Mail::to('phabiann@redmountaindev.co.za')->send(new NewProject($data));

        return response([], 200);
    }
}
