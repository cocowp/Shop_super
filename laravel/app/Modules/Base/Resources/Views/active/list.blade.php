<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.1</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="{{ URL::asset('static/css/font.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('static/css/xadmin.css') }}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('static/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ URL::asset('static/js/xadmin.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('static/js/cookie.js')}}"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">活动管理</a>
        <a>
          <cite>活动列表</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
            <input class="layui-input" placeholder="开始日" name="start" id="start" value="{{isset($search['start'])?$search['start']:''}}">
            <input class="layui-input" placeholder="截止日" name="end" id="end" value="{{isset($search['end'])?$search['end']:''}}">
            <input type="text" name="name"  placeholder="活动名称" autocomplete="off" class="layui-input" value="{{isset($search['name'])?$search['name']:''}}">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <xblock>
        <button class="layui-btn" onclick="x_admin_show('添加活动','{{route('active/create')}}')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{$count}} 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>活动名称</th>
            <th>活动介绍</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>状态</th>
            <th>操作</th>
        </thead>
        <tbody>
        @foreach($active as $value)
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td>{{$value['name']}}</td>
                <td>{{$value['desc']}}</td>
                <td>{{$value['start_time']}}</td>
                <td>{{$value['end_time']}}</td>
                <td class="td-status">
                    <span class="layui-btn layui-btn-normal layui-btn-mini {{$value['status'] == 0? 'layui-btn-disabled':''}}">{{$value['status'] == 1? '已开启':'已取消'}}</span></td>
                <td class="td-manage">
                    <a onclick="member_stop(this,'{{$value['id']}}')" href="javascript:;"  title="{{$value['status'] == 1? '开启':'取消'}}">
                        <i class="layui-icon">&#xe601;</i>
                    </a>
                    <a title="编辑"  onclick="x_admin_show('编辑','{{route('active/edit',['id'=>$value['id']])}}')" href="javascript:;">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a title="删除" onclick="member_del(this,'{{$value['id']}}')" href="javascript:;">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="page">
        <div>
{{--            {{$data->links()}}--}}
        </div>
    </div>

</div>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });

    /*用户-停用*/
    function member_stop(obj,id){
            if($(obj).attr('title')=='开启'){

                $.ajax({
                    url : '{{route('active/edit_status')}}',
                    type : 'get',
                    data : {
                        id : id,
                        status : 0
                    },
                    dataType : 'json',
                    success:function (res) {
                        if(res.code == '1000'){
                            layer.msg('已取消!',{icon:1,time:1000});
                        }else
                        {
                            layer.msg('修改失败!',{icon:1,time:1000});
                        }
                    }
                })
                //发异步把用户状态进行更改
                $(obj).attr('title','取消')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已取消');
                layer.msg('已停用!',{icon: 6,time:1000});

            }else{
                $.ajax({
                    url : '{{route('active/edit_status')}}',
                    type : 'get',
                    data : {
                        id : id,
                        status : 1
                    },
                    dataType : 'json',
                    success:function (res) {
                        if(res.code == '1000'){
                            layer.msg('已开启!',{icon:1,time:1000});
                        }else
                        {
                            layer.msg('修改失败!',{icon:1,time:1000});
                        }
                    }
                })
                $(obj).attr('title','开启')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已开启');
                layer.msg('已开启!',{icon: 6,time:1000});
            }

    }

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $.ajax({
                url : '{{route('active/del')}}',
                type : 'get',
                data : { id : id},
                dataType : 'json',
                success:function (res) {
                    if(res.code == '1000'){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    }else
                    {
                        layer.msg('删除失败!',{icon:1,time:1000});
                    }
                }
            })
        });
    }



    function delAll (argument) {

        var data = tableCheck.getData();

        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
    }
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>