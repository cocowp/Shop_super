<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title>
            X-admin v1.0
        </title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="http://www.supershop.com/start/css/x-admin.css" media="all">
    </head>
    <body>

        <div class="x-body">
            <form class="layui-form" action="warehouse_add_do" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="layui-form-item">
                    <label for="L_email" class="layui-form-label">
                        <span class="x-red">*</span>仓库名称
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_email" name="name" required="" lay-verify=""
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_username" class="layui-form-label">
                        <span class="x-red">*</span>仓库编码
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_username" name="encoding" required="" lay-verify=""
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">
                        <span class="x-red">*</span>仓库是否启用
                    </label>
                    <div class="layui-input-inline">

                        <input type="radio" id="L_pass" name="is_start" required="" lay-verify="is_start"
                        autocomplete="off" class="layui-input" value="启用">启用
                        <input type="radio" id="L_pass" name="is_start" required="" lay-verify="is_start"
                        autocomplete="off" class="layui-input" value="未启用">未启用

                    </div>
                </div>
                                <div class="layui-form-item">
                    <label for="L_username" class="layui-form-label">
                        <span class="x-red">*</span>仓库所在地区
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_username" name="in_area" required="" lay-verify=""
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">
                        <span class="x-red">*</span>仓库服务地区
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_pass" name="is_area" required="" lay-verify="is_area"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button  class="layui-btn" lay-filter="" lay-submit="">
                        增加
                    </button>
                </div>
            </form>
        </div>
        <script src="http://www.supershop.com/start/lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="http://www.supershop.com/start/js/x-layui.js" charset="utf-8">
        </script>
        <script>
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;
            
              //自定义验证规则
              form.verify({
                nikename: function(value){
                  if(value.length < 5){
                    return '昵称至少得5个字符啊';
                  }
                }
                ,pass: [/(.+){6,12}$/, '密码必须6到12位']
                ,repass: function(value){
                    if($('#L_pass').val()!=$('#L_repass').val()){
                        return '两次密码不一致';
                    }
                }
              });

              //监听提交
              form.on('submit(add)', function(data){
                console.log(data);
                //发异步，把数据提交给php
                layer.alert("增加成功", {icon: 6},function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    //关闭当前frame
                    parent.layer.close(index);
                });
                return false;
              });
              
              
            });
        </script>
        <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
        </script>
    </body>

</html>