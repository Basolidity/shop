@extends('layout.admins')
@section('center')
    <body>
    <div class="x-nav">
        <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a>
                <cite>管理员列表</cite></a>
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
                                <input type="text" name="search" placeholder="请输入用户名" autocomplete="off" class="layui-input" value="{{ $req }}"></div>
                            <div class="layui-inline layui-show-xs-block">
                                <button class="layui-btn" lay-submit="" lay-filter="searchu">
                                    <i class="layui-icon">&#xe615;</i></button>
                            </div>
                        </form>
                    </div>
                    <div class="layui-card-header">
                        <button class="layui-btn" onclick="xadmin.open('添加用户','{{ url('admin/adminuser/create') }}',630,480)">
                            <i class="layui-icon"></i>添加</button></div>
                    <div class="layui-card-body ">
                        <table class="layui-table layui-form">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>昵称</th>
                                    <th>手机号</th>
                                    <th>角色</th>
                                    <th>加入时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                            <tbody>
                                <!-- 遍历用户 -->
                                @if(!empty($users))
                                @foreach($users as $k => $v)
                                <tr>
                                    <td >{{ $i++ }}</td>
                                    <td id="uid" style="display:none">{{ $v['id'] }}</td>
                                    <td>{{ $v['nick'] }}</td>
                                    <td>{{ $v['phone'] }}</td>
                                    <td>{{ $v['role']['rname'] }}</td>
                                    <td>{{ $v['time'] }}</td>
                                    <td>
                                        <input id="switch" type="checkbox" name="switch"  lay-text="开启|停用"  {{$v['status']?'checked':''}} lay-skin="switch" lay-filter="switchTest" value="{{$v['status']?'1':'0'}}">
                                    </td>
                                    <td class="td-manage">
                                            <button class="layui-btn layui-btn layui-btn-xs"  onclick="xadmin.open('编辑','{{url('admin/adminuser/'.$v['id'].'/edit')}}',600,400)" ><i class="layui-icon">&#xe642;</i>编辑</button>
                                            <button class="layui-btn layui-btn-warm layui-btn-xs"  onclick="xadmin.open('修改密码','{{url('admin/adminuser/pass/'.$v['id'])}}',500,400)" ><i class="layui-icon">&#xe642;</i>修改密码</button>
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
                        <div id="userPage" style="margin-left:150px">
                            {{ $paginator }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    //状态的启用停用
    layui.use(['form'], function(){
            form = layui.form;
            
            form.on('switch(switchTest)', function (data) {
            if(data.elem.checked){
                    $(this).val('1');
                    var id= $(this).parents("tr").find('#uid').text();
                $.ajax({
                          type:'GET',
                          url:'/admin/adminuser/status/'+id,
                          datatype:'json',
                          data:{status:1},
                          success:function(res){
                            //console.log(res);
                            if(res.status=='success'){
                               layer.msg("修改成功", {
                                        icon: 6
                                    });
                            }else{
                                 layer.msg(res.msg,{icon:2});
                            }
                          }})
            }else{
                $(this).val('0');
                  var id= $(this).parents("tr").find('#uid').text();
                $.ajax({
                          type:'GET',
                          url:'/admin/adminuser/status/'+id,
                          datatype:'json',
                          data:{status:0},
                          success:function(res){
                            // console.log(res);
                            if(res.status=='success'){
                               layer.msg("修改成功", {
                                        icon: 6
                                    });
                            }else{
                                 layer.msg(res.msg,{icon:2});
                            }
                          }})
            }
        })
          });

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
    layui.use(['element', 'layer', 'laypage'],
    function() {
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
            elem: 'userPage',
            curr: cur_page,
            count: count,
            limit: limit,
            txt: txt,
            layout: ['count', 'prev', 'page', 'next', 'limit', 'refresh', 'skip'],
            jump: function(obj, first) {
                // console.log(txt);
                url = window.location.pathname; //当前页url不带参
                var params = {
                    page: obj.curr,
                    per_num: obj.limit
                };
                if (txt != null) {
                    params['searchq'] = txt; //这个是搜索 参数
                }
                // url = http_build_query(url, params);
                url = '?page=' + params['page'] + '&per_num=' + params['per_num'] + '&searchq=' + params['searchq'];
                // console.log(url);
                if (!first) { //跳转必须放在这个里边，不然无限刷新
                    window.location.href = url; //跳转
                }
            }
        });
    });

    /*用户-删除*/
    function member_del(obj, id) {
        // console.log(id);
        layer.confirm('确认要删除吗？',
        function(index) {
            //发异步删除数据
            $.post("/admin/info/" + id, {
                // 网址、数据、成功后操作
                "_token": "{{ csrf_token() }}",
                "_method": "delete"
            },
            function(data) {
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
        layer.confirm('确认要删除吗？',
        function(index) {
            //捉到所有被选中的，发异步进行删除
            $.get("/admin/batch", {
                arr: data
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
@stop