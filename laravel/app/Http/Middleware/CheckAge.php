<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge{
    
    public function handle(Request $request, Closure $next){
        if ($request->input('age') <= 200) {
            return redirect('info2');//请求不通过
        }
        
        return $next($request);//请求通过
    }
    
}