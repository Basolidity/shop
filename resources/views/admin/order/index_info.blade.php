@extends('layout.admins')
@section('center')
     <body>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                

                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">订单信息</div>
                        <div class="layui-card-body ">
                            <table class="layui-table">
                                <tbody>
                                    <tr>
                                        <th>订单号</th>
                                        <td>{{$order->number}}</td></tr>
                                    <tr>
                                        <th>购买者</th>
                                        <td>{{$users->uname}}</td></tr>
                                    <tr>
                                        <th>订单总价</th>
                                        <td>{{$order->total}}</td></tr>
                                    <tr>
                                        <th>状态</th>
                                        <td>
                                            @switch($order->status)
                                            @case(0)
                                                新定单
                                                @break

                                            @case(1)
                                                等待卖家发货
                                                @break
                                             @case(2)
                                                已发货
                                                @break
                                             @case(3)
                                                确认收货
                                                @break
                                             @case(4)
                                                订单完成
                                                @break
                                        @endswitch
                                        </td></tr>
                                    <tr>
                                        <th>买家留言</th>
                                        <td>{{$order->msg}}</td></tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">购买物品</div>
                        <div class="layui-card-body ">
                            <table class="layui-table">
                                <thead>
                                    <tr>
                                        
                                        <th>物品图片</th>
                                        <th>物品名称</th>
                                        <th>型号</th>
                                        <th>单价</th>
                                         <th>购买数量</th>
                                        
                                    </tr>
                                    </thead>
                                <tbody>
                                @foreach($order_info as $k => $v)
                                    <tr>
                                        <th><img src="{{$v->pic}}" style="width:60px"></th>
                                        <td>{{$v->gname }}</td>
                                        <td>{{$v->type }}</td>
                                        <td>{{$v->price }}</td>
                                        <td>{{$v->num }}</td>
                                        
                                    </tr>
                                @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <style id="welcome_style"></style>
                <div class="layui-col-md12">
                    <blockquote class="layui-elem-quote layui-quote-nm">感谢layui,百度Echarts,jquery,本系统由x-admin提供技术支持。</blockquote></div>
            </div>
        </div>
        </div>
    </body>
@stop