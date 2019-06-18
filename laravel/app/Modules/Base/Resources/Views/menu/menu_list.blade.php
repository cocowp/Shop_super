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
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">菜单管理</a>
        <a>
          <cite>菜单列表</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so layui-form-pane">
            <input class="layui-input" placeholder="菜单名" name="name" id="name">
            <button class="layui-btn"  lay-submit="" onclick="add_pmenu()"><i class="layui-icon"></i>增加顶级菜单</button>
        </form>
    </div>
    <blockquote class="layui-elem-quote">每个tr 上有两个属性 cate-id='1' 当前分类id fid='0' 父级id ,顶级分类为 0，有子分类的前面加收缩图标<i class="layui-icon x-show" status='true'>&#xe623;</i></blockquote>
    <xblock>
        {{--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>--}}
        <span class="x-right" style="line-height:40px">共有数据：<?php echo count($data); ?> 条</span>
    </xblock>
    <table class="layui-table layui-form">
        <thead>
        <tr>
            <th width="20">
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th width="70">ID</th>
            <th width="100">菜单名称</th>
            <th width="100">创建时间</th>
            <th width="100">修改时间</th>
            <th width="40">父菜单id</th>
            <th width="50">显示状态</th>
            <th width="250">操作</th>
        </thead>
        <tbody class="x-cate">



        <?php foreach($data as $k => $v){ ?>

        <tr cate-id="{{$v->id}}" fid="{{$v->parent_id}}" >
            <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$v->id}}</td>
            <td>
                {{str_repeat("___",$v->level)}}{{$v->name}}
                <i class="layui-icon x-show" status='true'>&#xe623;</i>

            </td>
            <td>{{$v->create_time}}</td>
            <td>{{date('Y-m-d H:i:s', $v->save_time)}}</td>
            <td>{{$v->parent_id}}</td>
            <td>
                <?php if ($v->status==1){ echo '开启'; } else { echo '停用'; } ?>
            </td>
            <td class="td-manage">
                <button class="layui-btn layui-btn layui-btn-xs"  onclick="x_admin_show('菜单编辑','menu_edit?id=<?php echo $v->id ?>')" ><i class="layui-icon">&#xe642;</i>编辑</button>
                @if($v->parent_id == 0)
                    <button class="layui-btn layui-btn-warm layui-btn-xs"  onclick="x_admin_show('添加子菜单','menu_add?id=<?php echo $v->id ?>')" ><i class="layui-icon">&#xe642;</i>添加子菜单</button>
                @endif
                <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="menu_del('<?php echo $v->id ?>', '要删除的id')" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>

            </td>
        </tr>
        <?php } ?>


        </tbody>
    </table>
</div>
<style type="text/css">

</style>
<script>
    layui.use(['form'], function(){
        form = layui.form;

    });


    //删除菜单
    function menu_del(id,obj)
    {
        layer.confirm("确认删除?",{icon:3,title: '正在进行删除操作'},function(index){
            layer.close(index);
            $.ajax({
                url: '{{'menu_delOne'}}',
                data: {id:id},
                dataType: 'json',
                type: 'get',
                success:function (e) {
                    if(e.code==1)
                    {
                        alert(e.message);
                        location.reload();
                    }
                    else if(e.code==0)
                    {
                        alert(e.message);
                    }
                    else if(e.code==2)
                    {
                        layer.alert(e.message);
                    }
                    else if(e.code==3)
                    {
                        alert(e.message);
                    }
                },
                error:function () {
                    alert('ajax没成功');
                }
            });
        });
    }
    function add_pmenu()
    {
        var name = $("#name").val();
        $.ajax({
            url: "{{'add_pmenu'}}",
            data: {name:name,'_token':'{{csrf_token()}}'},
            dataType: 'json',
            type: 'post',
            success:function (e){
                if (e.code == 1)
                {
                    alert(e.msg);
                    location.reload();
                }
                else
                {
                    layer.alert(e.msg);
                }
            },
            error:function ()
            {
                layer.msg('后台报错');
            }
        })
    }



    // function delAll (argument) {
    //
    //     var data = tableCheck.getData();
    //
    //     layer.confirm('确认要删除吗？'+data,function(index){
    //         //捉到所有被选中的，发异步进行删除
    //         layer.msg('删除成功', {icon: 1});
    //         $(".layui-form-checked").not('.header').parents('tr').remove();
    //     });
    // }
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>