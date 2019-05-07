@extends('layout.admins')
@section('center')
    <body>
    <div class="x-nav">
        <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a>
                <cite>会员列表</cite></a>
        </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
        </a>
    </div>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body ">
                        <form class="layui-form layui-col-space5">
                            <div class="layui-inline layui-show-xs-block">
                                <input class="layui-input" autocomplete="off" placeholder="开始日" name="start" id="start"></div>
                            <div class="layui-inline layui-show-xs-block">
                                <input class="layui-input" autocomplete="off" placeholder="截止日" name="end" id="end"></div>
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="search" placeholder="订单号" autocomplete="off" class="layui-input" value=" "></div>
                            <div class="layui-inline layui-show-xs-block">
                                <button class="layui-btn" lay-submit="" lay-filter="searchu">
                                    <i class="layui-icon">&#xe615;</i></button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="layui-card-body ">
                        <table class="layui-table layui-form">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>订单号</th>
                                    <th>加入时间</th>
                                    <th>订单总价</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                             <tbody>
                                <!-- 遍历用户 -->
                                @if(!empty($orders))
                                @foreach($orders as $k => $v)
                                <tr>
                                    
                                    <td >{{$orders->firstItem()+$loop->iteration-1 }}</td>
                                    <td >{{ $v->number }}</td>
                                    <td>{{ date('Y-m-d H:i:s',$v->addtime) }}</td>
                                    <td>￥{{ $v->total }}</td>
                                    <td>
                                        @switch($v->status)
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
                                    </td>
                                    
                                    <td class="td-manage">
                                        @if($v->status == 0)
                                            <button type="button"  class="layui-btn layui-btn layui-btn-xs"  onclick="fahuo(this,{{$v->id}})" ><i class="layui-icon">&#xe642;</i>发货</button>
                                        @elseif($v->status == 4)
                                            <button class="layui-btn layui-btn layui-btn-xs"   >订单完成</button>
                                         @else
                                           <button class="layui-btn layui-btn layui-btn-xs"  >以发货</button>
                                        @endif
                                            <button class="layui-btn layui-btn-warm layui-btn-xs"  onclick="xadmin.open('添加用户','{{ url('admin/order_info/'.$v->id) }}',600,400)" ><i class="layui-icon">&#xe642;</i>查看详情</button>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr><td colspan="8" style="text-align:center;">- -- >暂无数据< -- -</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                   <div class="layui-card-body ">
                            <div class="page">
                                <div>
                            {{ $orders->links() }}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
  

    layui.use('laydate',
    function() {
        var laydate = layui.laydate;
        var endDate = laydate.render({
            elem: '#end',
            //选择器结束时间
            type: 'datetime',
            min: "1970-1-1",
            //设置min默认最小值
            done: function(value, date) {
                startDate.config.max = {
                    year: date.year,
                    month: date.month - 1,
                    //关键
                    date: date.date,
                    hours: 0,
                    minutes: 0,
                    seconds: 0
                }
            }
        });
        //日期范围
        var startDate = laydate.render({
            elem: '#start',
            type: 'datetime',
            max: "2099-12-31",
            //设置一个默认最大值
            done: function(value, date) {
                endDate.config.min = {
                    year: date.year,
                    month: date.month - 1,
                    //关键
                    date: date.date,
                    hours: 0,
                    minutes: 0,
                    seconds: 0
                };
            }
        });

    });
    
   
    function fahuo(obj,id){

        var obj = $(obj);
        $.get("/admin/order/"+id, {},function(data) {
                console.log(data);
                if (data.status == 'success') {
                   layer.msg(data.msg);
                   obj.text('已发货');
                   obj.attr('disabled','disabled');
                } else {
                   layer.msg(data.msg,{icon:2});
                }
            });
        return false;
    }

  
    </script>
@stop