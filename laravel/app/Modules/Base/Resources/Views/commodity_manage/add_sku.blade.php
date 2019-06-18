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
                    <span class="x-red">*</span>商品价格
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="username" name="price"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>商品最低价格
                </div>
            </div>
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>商品划线价格
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="username" name="price_hua"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>商品划线价格
                </div>
            </div>
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>商品库存
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="username" name="repertory"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>商品库存
                </div>
            </div>
            @foreach($data as $value)
            <div class="layui-form-item">
                <label class="layui-form-label">{{$value->name}}</label>
                <div class="layui-input-block">
                    @foreach($value->fen as $val)
                    <input class="checks" type="checkbox" value="{{$val->name}}" title="{{$val->name}}">
                    @endforeach
                </div>
            </div>
            @endforeach
            <input type="hidden" id="nid" value="{{$id}}}">
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
          var form = layui.form
          var pid = 0
          ,layer = layui.layer;

          $(document).on('click','button',function () {
              var arr = []
              $(":checkbox:checked").each(function () {
                  arr.push($(this).val());
              });
              console.log(arr)

          })

          //监听提交
          {{--form.on('submit(add)', function(data){--}}
             {{--var imgs = document.getElementById("imgs").files[0];--}}
             {{--var formData = new FormData();--}}
             {{--formData.append('_token','{{csrf_token()}}');--}}
             {{--formData.append('imgs',imgs);--}}
             {{--formData.append('name',data.field.name);--}}
             {{--formData.append('classify',pid);--}}
             {{--formData.append('brand',data.field.brand)--}}
             {{--formData.append('desc',data.field.desc);--}}
             {{--formData.append('is_gift',data.field.is_gify);--}}
             {{--formData.append('is_status',data.field.is_status)--}}
             {{--formData.append('prices',data.field.price);--}}
             {{--formData.append('prices_hua',data.field.price_hua);--}}
             {{--formData.append('repertory',data.field.repertory);--}}
             {{--console.log(imgs);--}}
            {{--console.log(data);--}}
            {{--//发异步，把数据提交给php--}}
              {{--$.ajax({--}}
                  {{--url : "attribute_add",--}}
                  {{--type : 'post',--}}
                  {{--cache: false,--}}
                  {{--contentType: false,--}}
                  {{--processData: false,--}}
                  {{--mimeType: "multipart/form-data",--}}
                  {{--data : formData,--}}
                  {{--dataType : "json",--}}
                  {{--success:function (result) {--}}
                      {{--console.log(result);return--}}
                      {{--if(result.statue == 201)--}}
                      {{--{--}}
                          {{--layer.alert("添加失败", {icon: 6},function () {--}}
                              {{--// 获得frame索引--}}
                              {{--var index = parent.layer.getFrameIndex(window.name);--}}
                              {{--//关闭当前frame--}}
                              {{--parent.layer.close(index);--}}
                          {{--});--}}
                          {{--return false;--}}
                      {{--}--}}
                      {{--layer.alert("添加成功", {icon: 6},function () {--}}
                          {{--// 获得frame索引--}}
                          {{--var index = parent.layer.getFrameIndex(window.name);--}}
                          {{--//关闭当前frame--}}
                          {{--parent.layer.close(index);--}}
                      {{--});--}}
                      {{--return false;--}}
                  {{--}--}}
              {{--})--}}
          {{--});--}}
          
          
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