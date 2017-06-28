<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Url : PTP6.Com
 * Date: 2017/6/25
 * Time: 23:53
 */
namespace App\Http\Controllers;

use App\Member;
use App\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class MemberController extends Controller
{

    public function info ()
    {
//            return Member::MemberInfo()
//        return 'MemberController@info';
//        //新增
//        $bool = DB::insert('insert into student(name,age) values(?,?)',['xiaobai',30]);
//        var_dump($bool);
//        //修改，返回修改了几行
//         $num = DB::update('update student set age = ? where name = ?',['26','rookie']);
//         dd($num);
//            //查询
//            $result = DB::select('select * from student');
//            dd($result);
//            //删除
//            $num = DB::delete('delete from student where id > ?',[1]);
//            dd($num);
    }

    /**
     * 构造器
     */
    public function query1 ()
    {
        //插入数据，返回布尔值
        $bool = DB::table('student')->insert(
            ['name' => 'xiaohei','age'  =>  37]
        );

        //插入数据，返回ID键值
        $id = DB::table('student')->insertGetId(
            ['name' =>  'sky','age' =>  100]
        );

        //插入多条数据
        $bool = DB::table('student')->insert([
            ['name' =>  'xiaoxiaobai','age' =>  12],
            ['name' =>  'xiaoj','age'   =>  18]
        ]);


       // 自增,默认是1，后面可以跟置顶值，如：increment('age',3)，那么会自增3
        $num = DB::table('student')->increment('age');

        //自减
        $num = DB::table('student')->decrement('age');

        //带条件的自减
        $num = DB::table('student')
            ->where('id',1)
            ->decrement('age');

       // 在自减的同时修改name值
        $num = DB::table('student')
            ->where('id',1)
            ->decrement('age',2,['name'=>'updateok']);

        //删除置顶数据
        $num = DB::table('student')
            ->where('id',6)
            ->delete();

       // 带判断的条件删除
        $num = DB::table('student')
            ->where('id','>=',4)
            ->delete();

        //清空数据表，不返回任何值
        DB::table('student')->truncate();

        //查询全部
        $result = DB::table('student')->get();

        //查询一条
        $result = DB::table('student')
            ->orderBy('id','desc')
            ->first();
       // 条件查询
        $result = DB::table('student')
            ->where('id','>=',1)
            ->get();
       // 多条件查询
        $result = DB::table('student')
            ->whereRaw('id >= ? and age > ?',[1,23])
            ->get();
       // 查询单个字段
        $result = DB::table('student')
            ->pluck('name');
       // 查询指定字段，并使用ID作为下标
        $result = DB::table('student')
            ->lists('name','id');
           // 查询指定字段
            $result = DB::table('student')
                ->select('id','name','age')
                ->get();
       // 分段查询数据。如果要结束查询只要return false
        DB::table('student')->chunk(1,function($result){
                dd($result);
        });
            //统计多少条数据
            $num = DB::table('student')->count();
            //查询指定字段的最大值
            $num = DB::table('student')->max('age');
            //查询指定字段的最小值
            $num = DB::table('student')->min('age');
            //统计指定字段的平均值
            $num = DB::table('student')->avg('age');
            //统计自定字段的总和
            $num = DB::table('student')->sum('age');

    }

    public function query2()
    {

        //ORM 查询全部
        $ret = Student::all();
        //ORM查询指定id
        $ret = Student::find(1);
        //ORM查询指定ID 如果没找到则抛出错误
        $ret = Student::findOrFail(9);
        //ORM配合构造器使用
        $ret = Student::where('id','>',1)
            ->orderBy('age','desc')
            ->first();

        //使用模型新增数据
        $model = new Student();
        $model->name = 'xiaok';
        $model->age = 80;
        $ret = $model->save();
        //根据ID查询
        $ret = Student::find(4);
        //如果是这样的话会报错，系统禁止批量插入。需要在对应的模型里面增加$fillable属性
        $ret = Student::create(
            ['name' =>  'new','age' =>  1]
        );
        //根据条件查询对应的数据，如果没有则直接新增。
        $ret = Student::firstOrCreate(
            ['name' =>  'xiaobai']
        );
            //根据条件查询，如果没有则返回查询的条件内容
            $ret = Student::firstOrNew(
                ['name' =>  'xiaobaik']
            );
            //配合save也可以达到新增
            $ret->save();

            //通过模型更新数据
        $student = Student::find(5);
        $student->age = 11;
        $ret = $student->save();
        //配合构造器更新数据
        $ret = Student::where('id','>',4)->update(
            ['age'  =>  86]
        );

            //通过模型删除数据
        $student = Student::find(6);
        $ret = $student->delete();

            //通过主键删除
        $ret = Student::destroy(5);
        //可是直接写
        $ret = Student::destroy(5,6);
        //可以是数组
        $ret = Student::destroy([5,6]);
        //配合构造器使用
        $ret = Student::where('id','>=',4)->delete();

    }

    public function test(Request $request)
    {
        //取值
        echo $request->input('name');
        echo $request->input('sex','数据不存在');

        if ($request->has('sex')) {
            echo $request->input('sex');
        }else{
            echo '没有这个参数';
        }
        //获取全部数据
        $res = $request->all();


        //请求类型
        echo $request->method();

        //判断请求类型
        if ($request->isMethod('post')) {
            echo 'yes';
        }else{
            echo 'no';
        }
        //判断请求类型是否为ajax
        $res = $request->ajax();
        var_dump($res);
        //判断请求路径是否符合指定规则
        $res = $request->is('member/*');
        var_dump($res);


    }

    public function muban ()
    {
        $data = ['name' =>  'xiaobai','age' =>  29];
        $name = 'xiaobai';
        $list = Student::get();
        return view('demo.muban',[
            'info'    =>  $data,
            'name'    =>  $name,
            'list'    =>  $list
        ]);
    }


    public function session1 (Request $request)
    {
        //1.http request session
        $request->session()->put('key1','value1');
        $request->session()->get('key1');

        //2.session()帮助函数
        session()->put('key2','value2');
        session()->get('key2');

        //3.session 需要引入use Illuminate\Support\Facades\Session;
        Session::put('key3','value3');
        //如果key3不存在则返回default
        echo Session::get('key3','default');
        //以数组的形式存数据
        Session::put(['key4'    =>  'value4']);

        //存入数组

        Session::push('name','xiaobai');
        $res = Session::get('name');
        //取出数据后删除该条数据
       $res = Session::pull('age',18);
        //取出所有记录
        $res = Session::all();
        //判断key是否存在
        if (Session::has('key1')) {
            echo '存在';
        }else{
            echo '不存在';
        }
        //删除指定key
        Session::forget('key1');
        //清空session
        Session::flush();
        //暂存数据  存储后，只要访问一次就会自动销毁
        Session::flash('num','2');


        //echo Session::get('key4','default');

    }



    public function reponse ()
    {
        $data = ['name'=>'xiaobai','age'=>18,'sex'=>'男'];
        //返回json类型数据
        return response()->json($data);


        //重定向，页面跳转
        //传入网址跳转
        return redirect('muban');

        //带参数跳转
        return redirect('muban')->with('message','这里是数据');

        //跳转到指定方法里面
        return redirect()->action('MemberController@session1');
        //跳转到指定别名
        return redirect()->route('session1')->with('message','这里是数据');
        //返回来源页
        return redirect()->back();
    }


    public function huodong ()
    {
        return '活动宣传页面';
    }


    public  function huodong1()
    {
        return '活动参与页面';
    }


}