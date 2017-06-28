<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Url : PTP6.Com
 * Date: 2017/6/26
 * Time: 00:07
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public static function MemberInfo ()
    {
        return 'my name is Rookie';
    }
}