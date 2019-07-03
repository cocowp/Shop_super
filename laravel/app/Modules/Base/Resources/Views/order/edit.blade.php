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
    <script type="text/javascript" src="{{ URL::asset('static/lib/layui/layui.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ URL::asset('static/js/xadmin.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('static/js/cookie.js') }}"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-body">
    <form class="layui-form" method="post" action="{{route('order/edit')}}">
        @csrf
        <input type="hidden" name="id" value="{{$order['id']}}">
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>创建用户
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="user_id" value="{{$order['user_id']}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input layui-disabled"  readonly="readonly">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>收货人姓名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="consihnee" value="{{$order['consihnee']}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="phone" class="layui-form-label">
                <span class="x-red">*</span>订单状态
            </label>
            <div class="layui-input-inline">
                <select id="shipping" name="order_status" class="valid">
                    <option value="-3" {{$order['order_status']=='用户拒收'?'selected':''}}>用户拒收</option>
                    <option value="-2" {{$order['order_status']=='未付款'?'selected':''}}>未付款</option>
                    <option value="-1" {{$order['order_status']=='用户取消'?'selected':''}}>用户取消</option>
                    <option value="0" {{$order['order_status']=='待发货'?'selected':''}}>待发货</option>
                    <option value="1" {{$order['order_status']=='配送中'?'selected':''}}>配送中</option>
                    <option value="2" {{$order['order_status']=='用户确认收货'?'selected':''}}>用户确认收货</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="phone" class="layui-form-label">
                <span class="x-red">*</span>手机
            </label>
            <div class="layui-input-inline">
                <input type="text" id="phone" name="mobile" value="{{$order['mobile']}}" required="" lay-verify="phone"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>收货地址
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="address" value="{{$order['address']}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>配送物流
            </label>
            <div class="layui-input-inline">
                <select id="shipping" name="shipping_name" class="valid">
                    <option value="申通物流" {{$order['shipping_name'] == '申通物流'?'selected':''}}>申通物流</option>
                    <option value="顺丰物流" {{$order['shipping_name'] == '顺丰物流'?'selected':''}}>顺丰物流</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>支付方式
            </label>
            <div class="layui-input-inline">
                <select name="pay_name">
                    <option value="1">支付宝</option>
                    <option value="2">微信</option>
                    <option value="3">货到付款</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                <span class="x-red">*</span>发票抬头
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_email" name="invoice_title" value="{{$order['invoice_title']}}" required=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label for="desc" class="layui-form-label">
                商品增加
            </label>
            <div class="layui-input-block">
                <table class="layui-table">
                    <tbody>
                    <tr>
                        <td>haier海尔 BC-93TMPF 93升单门冰箱</td>
                        <td>0.01</td>
                        <td>984</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>haier海尔 BC-93TMPF 93升单门冰箱</td>
                        <td>0.01</td>
                        <td>984</td>
                        <td>1</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label for="desc" class="layui-form-label">
                描述
            </label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" id="desc" name="admin_note" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" type="submit">
                修改
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;
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