<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AccountController extends Controller
{
    public function activate(Request $request)
    {
        $u = User::where('token', $request->token)
            ->first();

        if($u) {
            $u->active = true;

            $u->save();
        }

        return view('account-activated')
            ->with('user', $u);
    }
}
