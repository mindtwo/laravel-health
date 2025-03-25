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

        $ipWhitelist = Config::get('health.ip_whitelist', ['127.0.0.1', '::1']);
        $clientIp = request()->ip();
        if (! in_array($clientIp, $ipWhitelist)) {
            return response()->json(['error' => 'Forbidden.'], 403);
        }

        $systemReport = new DummyCheck();

        return response()->json($systemReport->toArray());

    }
}
