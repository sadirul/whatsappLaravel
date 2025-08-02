<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\WhatsAppInstance;

class CheckInstanceKey
{
    public function handle(Request $request, Closure $next)
    {
        $instanceKey = $request->query('instanceKey') ?? $request->input('instanceKey');

        if (!$instanceKey) {
            return response()->json([
                'success' => false,
                'message' => 'Instance key is required, please signup!',
                'loginUrl' => route('signup')
            ], 400);
        }

        $instance = WhatsAppInstance::where('api_key', $instanceKey)->first();

        if (!$instance) {
            return response()->json([
                'success' => false,
                'message' => 'Instance not found, please login!',
                'loginUrl' => route('login')
            ], 404);
        }

        return $next($request);
    }
}
