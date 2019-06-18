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
    <div class="x-body">
        <form class="layui-form">
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>分类名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="username" name="username" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>将会成为您唯一的登入名
              </div>
          </div>
          <div class="layui-form-item">
              <label class="layui-form-label">父级分类</label>
              <div class="layui-input-inline">
                  <select name="province[]" lay-filter="province" class="change">
                      <option value="">请选择省</option>
                      @foreach($data as $val)
                          <option value="{{$val->id}}">{{$val->name}}</option>
                      @endforeach
                  </select>
              </div>
                 <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>将会成为您唯一的登入名
                  </div>
          </div>
          <div class="layui-form-item">
              <label for="L_pass" class="layui-form-label">
                  <span class="x-red">*</span>排序
              </label>
              <div class="layui-input-inline">
                  <input id="L_pass" name="pass" required=""
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  数值越大越靠前
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" type="button" lay-filter="add" lay-submit="">
                  增加
              </button>
          </div>
      </form>
    </div>
    <script>



        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var pid = 0;
          var form = layui.form
          ,layer = layui.layer;

          form.on('select(province)',function (data) {
              that = $(this);
              var id = data.value;
              pid = id
              that.parent().parent().parent().nextAll('div').remove();

              console.log(id)

              if(id != '')
              {
                  $.ajax({
                      url : "getchild",
                      type : "get",
                      dataType : "json",
                      data : {id : id},
                      success:function (result) {
                          var str = "<div class='layui-input-inline'>\
                              <select name='province[]' lay-filter='province' class='change'>\
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
              $.ajax({
                  url : "addchild",
                  type : 'post',
                  data : {
                      _token : '{{csrf_token()}}',
                      name : data.field.username,
                      sort_order : data.field.pass,
                      parent_id : pid
                  },
                  dataType : "json",
                  success:function (result) {
                      if(result.statue == 201)
                      {
                          layer.alert("添加失败", {icon: 6},function () {
                              // 获得frame索引
                              var index = parent.layer.getFrameIndex(window.name);
                              //关闭当前frame
                              parent.layer.close(index);
                          });
                          return false;
                      }
                      layer.alert("添加成功", {icon: 6},function () {
                          // 获得frame索引
                          var index = parent.layer.getFrameIndex(window.name);
                          //关闭当前frame
                          parent.layer.close(index);
                      });
                      return false;
                  }
              })
//            layer.alert("增加成功", {icon: 6},function () {
//                // 获得frame索引
//                var index = parent.layer.getFrameIndex(window.name);
//                //关闭当前frame
//                parent.layer.close(index);
//                // 可以对父窗口进行刷新
//                x_admin_father_reload();
//            });
//            return false;
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