<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\ActivateHelp;
use App\Mail\ActivateAccount;
use App\User;
use App\Help;

class HelpController extends Controller
{
    public function activate(Request $request)
    {
        $h = Help::where('token', $request->token)
            ->first();

        if($h) {
            $h->active = true;

            $h->save();
        }

        return view('help-activated')
            ->with('help', $h);
    }

    public function help(Request $request)
    {
        $u = User::where('email', $request->email)
                ->first();

        if(!$u) {
            $token = base64_encode($request->email . date('c'));

            $u = new User();

            $u->email = $request->email;
            $u->token = $token;

            Mail::to($u->email)->send(new ActivateAccount($u, $token));
        }

        $u->name = $request->name;
        $u->latitude = $request->latitude;
        $u->longitude = $request->longitude;

        $u->save();

        $token = base64_encode($request->help . date('c'));

        $h = new Help();

        $h->title = $request->title;
        $h->help = $request->help;
        $h->token = $token;
        $h->user_id = $u->id;

        $h->save();

        Mail::to($u->email)->send(new ActivateHelp($u, $token));

        return ['success' => true];
    }
}
