<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Url : PTP6.Com
 * Date: 2017/6/26
 * Time: 02:02
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //指定表
    protected $table = 'student';

    //指定主键
    protected $primaryKey = 'id';

    //自动填充添加时间以及修改时间，也就是created_at 以及 updated_at两个字段  true自动填充，false不填充
    public $timestamps = true;

    //指定允许批量赋值的字段
    protected $fillable = ['name','age'];

    //指定不允许批量赋值的字段
    protected $guarded = [];

    //自动填充的时间格式为时间戳。
    protected function getDateFormat()
    {
       return time();
    }

    //如果不写此方法，查询数据时，系统会自动将created_at 以及 updated_at进行格式化，如果有此方法则会返回原值。
    protected function asDateTime($value)
    {
        return $value;
    }
}