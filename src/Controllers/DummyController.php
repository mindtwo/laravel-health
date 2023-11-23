<?php

namespace Mindtwo\LaravelHealth\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Mindtwo\LaravelHealth\Checks\DummyCheck;

class DummyController extends Controller
{
    public function show(): JsonResponse
    {
        // If the ip is not in the whitelist, return 403

        $ipWhitelist = Config::get('system-report.ip_whitelist');
        $clientIp = request()->ip();
        if (! in_array($clientIp, $ipWhitelist)) {

            return response()->json(['error' => 'Forbidden.'], 403);
        }
        //dd($ipWhitelist);
        //dd(Config::get('system-report.ip_whitelist'));

        //$output = shell_exec('mysql -V');

        // dd(DB::select('SELECT version()'));

        $systemReport = new DummyCheck();

        return response()->json($systemReport->toArray());

    }
}
