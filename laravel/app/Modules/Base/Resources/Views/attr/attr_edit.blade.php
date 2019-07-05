<!DOCTYPE html>
<html class="x-admin-sm">
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.1</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <link rel="stylesheet" href="../static/css/font.css">
    <link rel="stylesheet" href="../static/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../static/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="../static/js/xadmin.js"></script>
    <script type="text/javascript" src="../static/js/cookie.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-body">
        <form class="layui-form">
            @csrf
            @foreach($menu as $key=>$vo)
                <input type="hidden" value="{{$vo->id}}" name="id" id="id">
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>属性
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="name" name="name" required=""
                  autocomplete="off" value="{{$vo->name}}" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>属性名是唯一的
              </div>
          </div>
          <div class="layui-form-item">
              <label for="url" class="layui-form-label">
                  <span class="x-red">*</span>
              </label>
              <div class="layui-input-inline">
                  <input type="text" value="{{$vo->url}}" id="url" name="url" required=""
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>
              </div>
          </div>
          <div class="layui-form-item">
                <label class="layui-form-label"><span class="x-red">*</span>是否展示</label>
                <div class="layui-input-block">
                    <input type="hidden" id="val" value="{{$vo->status}}">
                    <input type="radio" name="status" value="1" title="展示">
                    <input type="radio" name="status" value="0" title="不展示">
                    <script type="text/javascript">
                        var sta = $("#val").val();
                        if (sta == 1)
                        {
                            $("input[title='展示']").attr('checked','true');
                        }
                        if (sta == 0)
                        {
                            $("input[title='不展示']").attr('checked','true');
                        }
                    </script>
                </div>
          </div>

          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  保存
              </button>
          </div>
                @endforeach
      </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;


          //监听提交
          form.on('submit(add)', function(data){
              var id = $("#id").val();
              var name = $("#name").val();
              var url = $("#url").val();
              var status = $("input[type='radio']:checked").val();
            console.log(data);
            //发异步，把数据提交给php
              $.ajax({
                 url: "{{'menu_editdo'}}",
                 data: {id:id,name:name,url:url,status:status,'_token':'{{csrf_token()}}'},
                 dataType: 'json',
                 type: 'post',
                 success:function (e) {
                     if (e.code == 1)
                     {
                         alert(e.msg);
                         var index = parent.layer.getFrameIndex(window.name);
                         //关闭当前frame
                         parent.layer.close(index);
                     }
                     else if(e.code == 0)
                     {
                         layer.alert(e.msg);
                     }
                 },
                  error:function (){
                      return false;
                  }
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