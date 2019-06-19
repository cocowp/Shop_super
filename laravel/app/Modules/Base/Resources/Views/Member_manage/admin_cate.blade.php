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
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>管理员管理</cite></a>
              <a><cite>分配角色</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
           <form action="admin_cate_do" method="post">
               管理员：
               <select name="name">
                <?php foreach ($data1 as $key => $val) { ?>
                   <option value="<?php echo $val->id; ?>"><?php echo $val->name; ?></option>
                <?php } ?>
               </select><br>
               角色：
               <?php foreach ($data as $key => $val) { ?>
                <input type="checkbox" name="role" value="<?php echo $val->id; ?>"><?php echo $val->name; ?>
               <?php } ?><br>
               <input type="submit" name="" value="提交">
           </form>
            
        </div>
        <script src="http://www.supershop.com/start/lib/layui/layui.js" charset="utf-8"></script>
        <script src="http://www.supershop.com/start/js/x-layui.js" charset="utf-8"></script>
        <script>
            layui.use(['element','laypage','layer','form'], function(){
                $ = layui.jquery;//jquery
              lement = layui.element();//面包导航
              laypage = layui.laypage;//分页
              layer = layui.layer;//弹出层
              form = layui.form();//弹出层

              //监听提交
              form.on('submit(*)', function(data){
                console.log(data);
                //发异步，把数据提交给php
                layer.alert("增加成功", {icon: 6});
                $('#x-link').prepend('<tr><td><input type="checkbox"value="1"name=""></td><td>1</td><td>'+data.field.name+'</td><td class="td-manage"><a title="编辑"href="javascript:;"onclick="cate_edit(\'编辑\',\'link-edit.html\',\'4\',\'\',\'510\')"class="ml-5"style="text-decoration:none"><i class="layui-icon">&#xe642;</i></a><a title="删除"href="javascript:;"onclick="cate_del(this,\'1\')"style="text-decoration:none"><i class="layui-icon">&#xe640;</i></a></td></tr>');
                return false;
              });
            })

              //以上模块根据需要引入

            //批量删除提交
             function delAll () {
                layer.confirm('确认要删除吗？',function(index){
                    //捉到所有被选中的，发异步进行删除
                    layer.msg('删除成功', {icon: 1});
                });
             }
            
            

            //-编辑
            function cate_edit (title,url,id,w,h) {
                x_admin_show(title,url,w,h); 
            }
            
            /*删除*/
            function cate_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                });
            }
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