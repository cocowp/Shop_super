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
        <form class="layui-form" action="attr_add_do" method="get">
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>属性名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="username" name="name" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>分类名称
              </div>
          </div>

            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>父级属性
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="username" name="is_parent" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>父级属性的id
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">属于商品分类</label>
                <div class="layui-input-inline">
                    <select name="" lay-filter="province" class="change">
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
             var imgs = document.getElementById("imgs").files[0];
             var formData = new FormData();
             formData.append('_token','{{csrf_token()}}');
             formData.append('imgs',imgs);
             formData.append('name',data.field.name);
             formData.append('classify',pid);
             formData.append('brand',data.field.brand)
             formData.append('desc',data.field.desc);
             formData.append('is_gift',data.field.is_gify);
             formData.append('is_status',data.field.is_status)
             formData.append('prices',data.field.price);
             formData.append('prices_hua',data.field.price_hua);
             formData.append('repertory',data.field.repertory);
             console.log(imgs);
            console.log(data);
            //发异步，把数据提交给php
              $.ajax({
                  url : "attribute_add",
                  type : 'post',
                  cache: false,
                  contentType: false,
                  processData: false,
                  mimeType: "multipart/form-data",
                  data : formData,
                  dataType : "json",
                  success:function (result) {
                      console.log(result);return
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