<?php

namespace App\Http\Middleware;
use App\Containers\SharedSection\Network\Models\CompanyNetworkModel;
use Closure;
use Illuminate\Http\Request;

class CheckCompanyIp
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (app()->environment('production')) {
            // IP thật ngoài production
            $clientIp = $request->ip();
        } else {
            // Local / dev / staging cho phép override IP
            $clientIp = $request->header('X-Company-IP') ?? $request->ip();
        }
        $clientLong = ip2long($clientIp);

        // Lấy tất cả dải IP active từ DB
        $networks = CompanyNetworkModel::where('is_active', true)->get();

        $allowed = false;
        foreach ($networks as $network) {
            $start = ip2long($network->ip_range_start);
            $end = ip2long($network->ip_range_end);
            if ($clientLong >= $start && $clientLong <= $end) {
                $allowed = true;
                break;
            }
        }

        if (!$allowed) {
            return response()->json([
                'message' => 'Bạn phải có mặt tại công ty để chấm công.'
            ], 403);
        }

        return $next($request);
    }
}
