<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Help;
use App\Offer;
use App\User;
use App\Offeredhelp;
use App\Mail\ActivateAccount;
use App\Mail\OfferToCaller;
use App\Mail\OfferToOfferer;
use Mail;

class OfferController extends Controller
{
    public function match(Request $request)
    {
        $oh = Offeredhelp::where('token', $request->token)
            ->first();

        if($oh) {
            $oh->matched = true;

            $oh->save();

            $h = Help::where('id', $oh->help_id)
                ->first();

            $h->closed = true;

            $h->save();
        }

        return view('matched')
            ->with('matched', $oh);
    }

    public function offer(Request $request)
    {
        $h = Help::where('help.id', $request->help_id)
                ->join('user', 'user.id', '=', 'help.user_id')
                ->select([
                    'user.email',
                    'user.name',
                    'help.*'
                ])
                ->first();

        if($h) {
            $u = User::where('email', $request->email)
                    ->first();

            if(!$u) {
                $token = base64_encode('offer' . $request->email . date('c'));

                $u = new User();

                $u->email = $request->email;
                $u->token = $token;
                $u->name = $request->name;

                Mail::to($u->email)->send(new ActivateAccount($u, $token));
            }

            $u->latitude = $request->latitude;
            $u->longitude = $request->longitude;

            $u->save();

            $o = new Offer();

            $o->offer = $request->offer;
            $o->user_id = $u->id;
            
            $o->save();

            $token = base64_encode('offer' . $request->email . date('c'));

            $oh = new Offeredhelp();

            $oh->help_id = $h->id;
            $oh->offer_id = $o->id;
            $oh->token = $token;

            $oh->save();

            Mail::to($h->email)->send(new OfferToCaller($h, $o, $u, $token));
            Mail::to($u->email)->send(new OfferToOfferer($h, $o, $u)); 
        }
    }
}
