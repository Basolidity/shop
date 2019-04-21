@extends('layout.admins')
@section('center')
    <body>
    <div class="x-nav">
        <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a href="">会员管理</a>
            <a>
                <cite>会员列表</cite></a>
        </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
            <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <div class="layui-row">
            <form class="layui-form layui-col-md12 x-so">
                <input class="layui-input" placeholder="开始日" name="start" id="start">
                <input class="layui-input" placeholder="截止日" name="end" id="end">
                <input type="text" name="search" placeholder="请输入用户名" autocomplete="off" class="layui-input" value="{{ $req }}">
                <button class="layui-btn" lay-submit="" lay-filter="searchu">
                    <i class="layui-icon">&#xe615;</i></button>
            </form>
        </div>
        <xblock>
            <button class="layui-btn layui-btn-danger" onclick="delAll()">
                <i class="layui-icon"></i>批量删除</button>
            <button class="layui-btn" onclick="x_admin_show('添加用户','{{ url('admin/info/create') }}',600,400)">
                <i class="layui-icon"></i>添加</button>
            </xblock>
        <table class="layui-table">
            <thead>
                <tr>
                    <th>
                        <div class="layui-unselect header layui-form-checkbox" lay-skin="primary">
                            <i class="layui-icon">&#xe605;</i></div>
                    </th>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>加入时间</th>
                    <th>状态</th>
                    <th>操作</th></tr>
            </thead>
            <tbody>
                <!-- 遍历用户 -->
                @if(!empty($users))
                @foreach($users as $k => $v)
                <tr>
                    <td>
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="{{ $v['id'] }}">
                            <i class="layui-icon">&#xe605;</i></div>
                    </td>
                    <td id="uid">{{ $i++ }}</td>
                    <td>{{ $v['uname'] }}</td>
                    <td>{{ $v['time'] }}</td>
                    <td class="td-status">
                        {!! $v['status'] ? '<span id="sta" class="layui-btn layui-btn-normal layui-btn-mini layui-btn-disabled">已停用</span>' : '<span id="sta" class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>' !!}
                    </td>
                    <td class="td-manage">
                        <a onclick="member_stop(this,'10001')" href="javascript:;" title="更改状态">
                            {!! $v['status'] ? '<i class="layui-icon">&#xe62f;</i>' : '<i class="layui-icon">&#xe601;</i>' !!}
                            
                        </a>
                        <a title="编辑" onclick="x_admin_show('编辑','/admin/info/{{$v['id']}}/edit',600,400)" href="javascript:;">
                            <i class="layui-icon">&#xe642;</i>
                        </a>
                        <a onclick="x_admin_show('修改密码','/admin/pass/{{$v['id']}}',600,400)" title="修改密码" href="javascript:;">
                            <i class="layui-icon">&#xe631;</i>
                        </a>
                        <a title="删除" onclick="member_del(this,'{{$v['id']}}')" href="javascript:;">
                            <i class="layui-icon">&#xe640;</i>
                        </a>
                    </td>
                </tr>
                @endforeach
                @else
                    <tr><td colspan="8" style="text-align:center;">- -- >暂无数据< -- -</td></tr>
                @endif
            </tbody>
        </table>
            <div id="userPage" style="margin-left:150px">
                {{ $paginator }}
            </div>
    </div>

    <script>
        // layui.use('laydate',
        // function() {
        //     var laydate = layui.laydate;
            
        //     //执行一个laydate实例
        //     laydate.render({
        //         elem: '#start' //指定元素
        //     });

        //     //执行一个laydate实例
        //     laydate.render({
        //         elem: '#end' //指定元素
        //     });
            
        // });

    layui.use('laydate', function(){
        var laydate = layui.laydate;
        var endDate= laydate.render({
            elem: '#end',//选择器结束时间
            type: 'datetime',
            min:"1970-1-1",//设置min默认最小值
            done: function(value,date){
                startDate.config.max={
                    year:date.year,
                    month:date.month-1,//关键
                    date: date.date,
                    hours: 0,
                    minutes: 0,
                    seconds : 0
                }
            }
        });
        //日期范围
        var startDate=laydate.render({
            elem: '#start',
            type: 'datetime',
            max:"2099-12-31",//设置一个默认最大值
            done: function(value, date){
                endDate.config.min ={
                    year:date.year,
                    month:date.month-1, //关键
                    date: date.date,
                    hours: 0,
                    minutes: 0,
                    seconds : 0
                };
            }
        });

    });
        layui.use(['element', 'layer','laypage'], function(){
            var element = layui.element;
            var layer = layui.layer;
            var laypage = layui.laypage;
            $ = layui.jquery;

            var count = "{{$total}}";
            // console.log(count);
            var cur_page = "{{$current_page}}";
            var limit = "{{$perPage}}";
            var txt = "{{$txt}}";
            laypage.render({
                elem: 'userPage'
                ,curr:cur_page
                ,count: count
                ,limit:limit
                ,txt:txt
                ,layout: ['count', 'prev', 'page', 'next', 'limit', 'refresh', 'skip']
                ,jump: function(obj,first){
                  // console.log(txt);
                    url = window.location.pathname;//当前页url不带参
                    var params = {page:obj.curr, per_num:obj.limit};
                    if(txt != null){
                        params['searchq']=txt; //这个是搜索 参数
                    }
                    
                    // url = http_build_query(url, params);
                    url = '?page='+ params['page'] + '&per_num=' + params['per_num']  + '&searchq=' + params['searchq'];
                    // console.log(url);
                 if(!first){  //跳转必须放在这个里边，不然无限刷新
                   window.location.href= url; //跳转
                 }
                }
            });

        });
        /*用户-停用*/
        function member_stop(obj, id) {
            var sta =$(obj).parents("tr").find("#sta").text();
            // 获取当前用户的id
            var uid = $(obj).parents("tr").find("#uid").text();
            
            if(sta == '已停用'){
                layer.confirm('确认要开启吗？',
                function(index) {
                    $.get('/admin/status',{s:0,id:uid},function(data){});
                    $(obj).attr('title', '停用');
                    $(obj).find('i').html('&#xe601;');
                    $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                    layer.msg('已启用!', {
                        icon: 6,
                        time: 1000
                    });
                });
            }else{
                layer.confirm('确认要停用吗？',
                function(index) {
                        // 使用ajax改变数据库的用户状态
                        $.get('/admin/status',{s:1,id:uid},function(data){});
                        $(obj).attr('title', '启用');
                        // 上
                        $(obj).find('i').html('&#xe62f;');

                        $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                        layer.msg('已停用!', {
                            icon: 5,
                            time: 1000
                        });
                });
            }
        }

        /*用户-删除*/
        function member_del(obj, id) {
            // console.log(id);
            layer.confirm('确认要删除吗？',
            function(index) {
                //发异步删除数据
                $.post("/admin/info/"+id, { 
                 // 网址、数据、成功后操作
                    "_token": "{{ csrf_token() }}",
                    "_method": "delete"
                }, function(data) {
                   if (data.status == 0) {
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!', {
                            icon: 1,
                            time: 1000
                        });
                    } else {
                        $(obj).parents("tr").remove();
                        layer.msg('删除失败!', {
                            icon: 2,
                            time: 1000
                        });
                    }
                });
            });
        }

        function delAll(argument) {
            var data = tableCheck.getData();
            layer.confirm('确认要删除吗？' + data,
            function(index) {
                //捉到所有被选中的，发异步进行删除
                $.get("/admin/batch", { 
                    arr:data
                }, 
                    function(data) {
                       if (data.status == 0) {
                            layer.msg('已删除!', {
                                icon: 1,
                                time: 1000
                            });
                        $(".layui-form-checked").not('.header').parents('tr').remove();
                        } else {
                            layer.msg('删除失败!', {
                                icon: 2,
                                time: 1000
                            });
                        }
                });


                // layer.msg('删除成功', {
                //     icon: 1
                // });
            });
        }</script>
    <script>var _hmt = _hmt || []; (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();</script>
</body>
@stop