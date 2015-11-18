<?php
/**
 * Created by PhpStorm.
 * User: jia19
 * Date: 2015/11/18
 * Time: 13:54
 */

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class LoginCheck {

    public function handle(Request $request, Closure $next)
    {
        $isLogin = $request->session()->get("isLogin");
        $type = $request->session()->get("type");
        if ($isLogin == true && $type == 0)
        {
            return redirect('admin/home');
        }
        if ($isLogin == true && type == 1)
        {
            return redirect('reader/home');
        }
        return $next($request);
    }


}