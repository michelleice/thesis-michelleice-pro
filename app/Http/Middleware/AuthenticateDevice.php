<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Models\Device;
use Illuminate\Http\Request;

class AuthenticateDevice
{
    public const AUTH_HEADER = 'X-Device-Authentication-Token';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() && !$request->hasHeader('Authorization')) {
            if (!$request->hasHeader(self::AUTH_HEADER)) {
                return abort(401, 'Unauthorized');
            }
            
            $token = $request->header(self::AUTH_HEADER);
            $device = Device::where('device_authentication_token', $token)->first();
            if (!$device) {
                return abort(401, 'Unauthorized');
            }

            $request->attributes->add(['_device' => $device]);
        }

        return $next($request);
    }
}
