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
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so layui-form-pane">
          <input class="layui-input" placeholder="分类名" name="cate_name">
          <button class="layui-btn" type="button" onclick="x_admin_show('添加分类','catadd')"><i class="layui-icon"></i>添加</button>
        </form>
      </div>
      <blockquote class="layui-elem-quote">每个tr 上有两个属性 cate-id='1' 当前分类id fid='0' 父级id ,顶级分类为 0，有子分类的前面加收缩图标<i class="layui-icon x-show" status='true'>&#xe623;</i></blockquote>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
      </xblock>
      <table class="layui-table layui-form">
        <thead>
          <tr>
            <th width="20">
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th width="70">ID</th>
            <th>栏目名</th>
            <th width="50">排序</th>
            <th width="50">状态</th>
            <th width="250">操作</th>
        </thead>
        <tbody class="x-cate">
        @foreach($data as $val)
          <tr cate-id='{{$val->id}}' fid='{{$val->parent_id}}' >
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$val->id}}</td>
            <td>
              <i class="layui-icon x-show" status='true'>&#xe623;</i>
              {{$val->name}}
            </td>
            <td><input type="text" class="layui-input x-sort" name="order" value="{{$val->sort_order}}"></td>
            <td>
              <input type="checkbox" name="switch"  lay-text="开启|停用"  checked="" lay-skin="switch">
            </td>
            <td class="td-manage">
              <button class="layui-btn layui-btn layui-btn-xs"  onclick="x_admin_show('编辑','admin-edit.html')" ><i class="layui-icon">&#xe642;</i>编辑</button>
              <button class="layui-btn layui-btn-warm layui-btn-xs childen">查看子分类</button>
              <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="member_del(this,'{{$val->id}}')" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <style type="text/css">
      
    </style>
    <script>
      layui.use(['form'], function(){
        form = layui.form;
        
      });

      $(document).on('click','.hchilden',function () {
          var id = $(this).parents('tr').attr('cate-id');
          $('.'+id+'').remove();
          $(this).removeClass('hchilden');
          $(this).addClass('childen');
          $(this).text('查看子分类');

      })

      $(document).on('click','.childen',function () {

          var that = $(this);
          console.log(that);
          var id = $(this).parents('tr').attr("cate-id");

          $.ajax({
              url : "search_child",
              type : "get",
              dataType : "json",
              data : {id : id},
              success:function (result) {
                  var str;
                $(result.data).each(function (i,v) {
                    str += "<tr class="+id+" cate-id="+v.id+" fid="+v.parent_id+" >\
                    <td>\
                    <div class='layui-unselect layui-form-checkbox' lay-skin='primary' data-id="+2+"><i class='layui-icon'>&#xe605;</i></div>\
                    </td>\
                    <td>"+v.id+"</td>\
                    <td>\
                    <i class='layui-icon x-show' status='true'>&nbsp;&nbsp;&#xe623;</i>"+v.name+"</td>\
                    <td><input type='text' class='layui-input x-sort' name='order' value="+v.sort_order+"></td>\
                        <td>\
                        <input type='checkbox' name='switch'  lay-text='开启|停用' checked  lay-skin='switch'>\
                        </td>\
                        <td class='td-manage'>\
                        <button class='layui-btn layui-btn layui-btn-xs'  onclick='x_admin_show('编辑','admin-edit.html')' ><i class='layui-icon'>&#xe642;</i>编辑</button>\
                    <button class='layui-btn layui-btn-warm layui-btn-xs childen'>查看子分类</button>\
                    <button class='layui-btn-danger layui-btn layui-btn-xs'  onclick='member_del(this,"+v.id+")' href='javascript:;' ><i class='layui-icon'>&#xe640;</i>删除</button>\
                    </td>\
                    </tr>"
                })
                  that.parents('tr').after(str)
                  that.removeClass('childen');
                  that.addClass('hchilden');
                  that.text('收起子菜单');

              }
          })

      })

      

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $.ajax({
                  url : "{{'cat_delete'}}",
                  type : "get",
                  dataType : "json",
                  data : {id :id},
                  success:function (result) {
                      if(result.statue == 200)
                      {
                          $(obj).parents("tr").remove();
                          layer.msg('已删除!',{icon:1,time:1000});return false;
                      }
                      layer.msg('删除失败!',{icon:1,time:1000});
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