<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Url : PTP6.Com
 * Date: 2017/6/28
 * Time: 12:20
 */
namespace App\Http\Middleware;

use Closure;

class Huodong
{

    //handle 是固定方法。
    public function handle($request,Closure $next)
    {
       if (time() < strtotime('2017-06-28')) {
            return redirect('member/huodong');
       }
       return $next($request);

       //$next 后面执行的逻辑 叫后置操作。
    }


}