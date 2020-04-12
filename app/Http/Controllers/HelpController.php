<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\ActivateHelp;
use App\Mail\ActivateAccount;
use App\Mail\ManageAccount;
use App\User;
use App\Help;

class HelpController extends Controller
{
    public function activate(Request $request)
    {
        $h = Help::where('help.token', $request->token)
            ->join('user', 'help.user_id', '=', 'user.id')
            ->select([
                'help.*',
                'user.name',
                'user.email'
            ])
            ->first();

        if($h) {
            $h->active = true;

            $h->save();

            Mail::to($h->email)->send(new ManageAccount($h));
        }

        return view('help-activated')
            ->with('help', $h);
    }

    public function delete(Request $request)
    {
        $h = Help::where('help.token', $request->token)
                ->first();

        if($h) {
            $h->active = false;

            $h->save();
        }

        return view('help-deleted');
    }

    public function edit(Request $request)
    {
        $h = Help::where('help.token', $request->token)
            ->join('user', 'help.user_id', '=', 'user.id')
            ->select([
                'help.*',
                'user.name'
            ])
            ->first();

        if($h) {
            return view('edit-help')
                ->with('help', $h)
                ->with('categories', Category::get());
        }
    }

    public function alter(Request $request) 
    {
        $h = Help::where('help.token', $request->token)
                ->first();

        if($h) {
            $h->title = $request->title;
            $h->category = $request->category;
            $h->help = $request->help;
            $h->closed = false;

            $h->save();

            $u = User::find($h->user_id);

            if($u) {
                $u->name = $request->name;

                $u->save();
            }
        }

        return view('help-edited');
    }

    public function help(Request $request)
    {
        $u = User::where('email', $request->email)
                ->first();

        if(!$u) {
            $token = base64_encode('help' . $request->email . date('c'));

            $u = new User();

            $u->email = $request->email;
            $u->token = $token;
            $u->name = $request->name;

            Mail::to($u->email)->send(new ActivateAccount($u, $token));
        }

        $u->latitude = $request->latitude;
        $u->longitude = $request->longitude;

        $u->save();

        $token = base64_encode($request->help . $u->id . date('c'));

        $h = new Help();

        $h->title = $request->title;
        $h->category = $request->category;
        $h->help = $request->help;
        $h->token = $token;
        $h->user_id = $u->id;

        $h->save();

        Mail::to($u->email)->send(new ActivateHelp($u, $token));

        return ['success' => true];
    }

    public function getCategories(Request $request)
    {
        return Category::get();
    }
}
