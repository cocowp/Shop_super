<!DOCTYPE html>
<html class="x-admin-sm">
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.1</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
      <meta name="csrf-token" content="{{ csrf_token() }}" />
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
        <form class="layui-form">
            @csrf
          {{--<div class="layui-form-item">--}}
              {{--<label for="username" class="layui-form-label">--}}
                  {{--<span class="x-red">*</span>属性名称--}}
              {{--</label>--}}
              {{--<div class="layui-input-inline">--}}
                  {{--<input type="text" id="name" name="name" required="" lay-verify="required"--}}
                  {{--autocomplete="off" class="layui-input">--}}
              {{--</div>--}}
              {{--<div class="layui-form-mid layui-word-aux">--}}
                  {{--<span class="x-red">*</span>属性名称--}}
              {{--</div>--}}
          {{--</div>--}}
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>属性名
                </label>
                <div class="layui-input-inline">
                    {{--<input type="text" id="parent_id" name="parent_id" required="" lay-verify="required"--}}
                           {{--autocomplete="off" class="layui-input">--}}
                    <select name="attr_id" id="attr_id" lay-filter="" class>
                        <option value="">请选择属性</option>
                        @foreach($attr as $val)
                            <option value="{{$val->id}}">
                                {{$val->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>必选
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">属于商品分类</label>
                <div class="layui-input-inline">
                    <select name="cat_id" id="" lay-filter="province" class="change">
                        @foreach($classify as $val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>商品分类
                </div>
            </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" type="button" lay-filter="add" lay-submit="">
                  <a href="">增加</a>
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          var pid = 0
          ,layer = layui.layer;


            form.on('select(province)',function (data) {
                that = $(this);
                var id = data.value;
                pid = id;
                that.parent().parent().parent().nextAll('div').remove();

                if(id != '')
                {
                    $.ajax({
                        url : "getchild",
                        type : "get",
                        dataType : "json",
                        data : {id : id},
                        success:function (result) {
                            var str = "<div class='layui-input-inline'>\
                              <select name='province[]' id='cat_id' lay-filter='province' class='change'>\
                                  <option value=''>请选择下级</option>";
                            if(result.status == 200)
                            {
                                $(result.data).each(function (i,v) {
                                    str += "<option value="+v.id+">"+v.name+"</option>";
                                })
                                str += "</select>\
                                  </div>";
                                that.parent().parent().parent().after(str)
                                form.render('select')
                            }
                        }
                    })
                }

            })

          //自定义验证规则

          //监听提交
            form.on('submit(add)', function(data){
                var attr_id = $("#attr_id").val();
                var cat_id = $('[name="province[1]"]').val();
                // console.log(data);
                //发异步，把数据提交给php
                $.ajax({
                    url: "{{'attr_add_do'}}",
                    data: {attr_id:attr_id,cat_id:cat_id,'_token':'{{csrf_token()}}'},
                    dataType: 'json',
                    type: 'post',
                    success:function (e) {
                        if (e.code == 1)
                        {
                            // console.log(e.data);
                            alert(e.msg);
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                        }
                        else if(e.code == 0)
                        {
                            alert(e.msg);
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