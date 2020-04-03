<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Help;

class MapController extends Controller
{
    public function getMarks(Request $request)
    {
        return Help::where('help.active', true)
            ->join('user', 'user.id', '=', 'help.user_id')
            ->having('distance', '<', (50 * $request->zoom))
            ->select([
                DB::raw('(6371 * acos(cos(radians(' . $request->latitude . ')) * cos(radians(user.latitude)) * cos(radians(user.longitude) - radians(' . $request->longitude . ')) + sin(radians(' . $request->latitude . ')) * sin(radians(user.latitude)))) AS distance'),
                'user.latitude',
                'user.longitude',
                'user.name',
                'help.title',
                'help.help',
                'help.id'
            ])
            ->get();
    }
}
