<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8" name="csrf-token" content="{{ csrf_token() }}">
	<title>后台登录-X-admin2.2</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{ URL::asset('static/css/font.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('static/css/login.css') }}">
	  <link rel="stylesheet" href="{{ URL::asset('static/css/xadmin.css') }}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ URL::asset('static/lib/layui/layui.js') }}" charset="utf-8"></script>
    <script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5..minjs"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message">x-admin2.0-管理登录</div>
        <div id="darkbannerwrap"></div>

        <form action="" method="" class="layui-form" >
            <input name="name" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="pwd" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input value="登录" id="TencentCaptcha" data-appid="2033419913" data-cbfn="callback" lay-submit lay-filter="login" style="width:100%;" type="button" class="logins">
            <hr class="hr20" >
        </form>
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
    window.callback = function(res) {
        var name = $('input[name="name"]').val();
//        alert(name);
        var pwd = $('input[name="pwd"]').val();
        if(res.ret === 0){
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: "{{'login_do'}}",
            data: {name: name, pwd: pwd},
            type: 'post',
            dataType: "json",
            success: function (result) {
                if (result.status == 500) {
                    alert(result.msg)
                    return false;

                }
                if (result.status == 201) {
                    alert(result.msg)
                    return false;

                }
                alert(result.msg)
                location.href = "{{'index'}}";

            }
        })
        }else{
            return false;
        }
    }
</script>