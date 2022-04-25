<?php

namespace App\Http\Controllers;

use App\Mail\SendFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function __invoke(Request $request)
    {
        $request_data = $request->only(['subject', 'name', 'setting', 'phone', 'comment']);

        if (!empty($request_data['setting'])) {
            $request_data['setting'] = json_decode($request_data['setting'], 1);
        }

        Mail::to(setting('email', ''))->send(new SendFormMail($request_data));

        return response()->json(['location' => route('thanks')]);
    }
}
