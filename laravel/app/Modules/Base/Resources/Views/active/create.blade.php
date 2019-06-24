<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>添加活动</title>
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
<div class="x-body">
    <form class="layui-form" method="post" action="{{route('active/create')}}">
        @csrf
        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>活动名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="name" name="name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>

        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>活动简介
            </label>
            <div class="layui-input-inline">
                <textarea name="desc" class="layui-textarea" id="desc" cols="50" rows="30"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                <span class="x-red">*</span>开始时间
            </label>
            <div class="layui-input-inline">
                <input class="layui-input" placeholder="开始时间" name="start_time" id="start">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                <span class="x-red">*</span>结束时间
            </label>
            <div class="layui-input-inline">
                <input class="layui-input" placeholder="结束时间" name="end_time" id="end">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn">
                添加
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;
        layui.use('laydate', function(){
            var laydate = layui.laydate;

            //执行一个laydate实例
            //日期时间选择器
            laydate.render({
                elem: '#start'
                ,type: 'datetime'
            });

            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
                ,type: 'datetime'

            });
        });


    });
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>