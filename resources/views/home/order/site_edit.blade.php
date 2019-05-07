<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon"type="image/x-icon" href="/images/icon.jpg"media="screen" />
    <script type="text/javascript" src="{{asset('xadmin/js/jquery-3.2.1.min.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{asset('home/css/style.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('home/css/layui.css')}}" />
    <script type="text/javascript" src="{{asset('home/js/menu.js')}}"></script>    
    <script type="text/javascript" src="{{asset('home/js/select.js')}}"></script>
    <script type="text/javascript" src="{{asset('layuiadmin/layui/layui.js')}}"></script>
    <script type="text/javascript" src="{{asset('xadmin/js/xadmin.js')}}"></script>
    
<title>@yield('title')</title>
</head>
<body>  
    <link rel="stylesheet" href="{{asset('xadmin/css/font.css')}}">

    <div class="m_right">
        <p>
        </p>
        <div class="mem_tit"></div>
        <div class="layui-card-header">
            <button class="layui-btn" onclick="xadmin.open('添加用户','{{ url('home/site/create') }}',800,500)">添加
            </button>
        </div>

        <div class="layui-card-body ">
            <table class="layui-table layui-form">
                <thead>
                    <tr >
                        <th style="text-align: center;">收货人</th>
                        <th style="text-align: center;">所在地区</th>
                        <th style="text-align: center;">详细地址</th>
                        <th style="text-align: center;">邮编</th>
                        <th style="text-align: center;">手机</th>
                        <th style="text-align: center;">操作</th>
                        <th></th>
                    </tr>
                    </thead>
                <tbody>
                    <!-- 遍历用户 -->
                    @if(!empty($rs))
                    @foreach($rs as $k => $v)
                    <tr style="text-align: center;">
                        <td>{{ $v->lname }}</td>
                        <td id="uid" style="display:none">{{ $v->id }}</td>
                        <td>{{ $v->area }}</td>
                        <td>{{ $v->path }}</td>
                        <td>{{ $v->postal }}</td>
                        <td>{{ $v->phone }}</td>
                        <td class="td-manage">
                                <button class="layui-btn layui-btn layui-btn-xs"  onclick="xadmin.open('编辑','{{ url('home/site/'.$v->id.'/edit') }}',800,500)" >编辑</button>
                                <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="member_del(this,'{{$v->id}}')" href="javascript:;" >删除</button>
                            </a>
                        </td>
                        <td style="text-align: center;">
                            <a onclick="depath('{{$v->id}}')" href="javascript:;" >选择地址</a>
                        </td>

                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="8" style="text-align:center;">- -- >暂无数据< -- -</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
    <script>
     /*用户-删除*/
        function member_del(obj, id) {
            var rem = $(obj);
            layer.confirm('确认要删除吗？',
            function(index) {
                //发异步删除数据
                var _token = "{{csrf_token()}}";
                $.ajax({
                    type: 'DELETE',
                    url: '/home/site/' + id,
                    datatype: 'json',
                    data: {
                        _token,
                    },
                    success: function(res) {
                        //console.log(res);
                        if (res.status == 'success') {
                            layer.msg("删除成功");
                            rem.parents("tr").remove();
                            window.location.reload();
                        } else {
                            layer.msg(res.msg, {
                                icon: 2
                            });
                        }
                    }
                })
            });
        }
        function depath(id) {
                //发异步删除数据
                $.ajax({
                    type: 'GET',
                    url: '/home/order/depath/' + id,
                    datatype: 'json',
                    success: function(res) {
                        //console.log(res);
                        if (res.status == 'success') {
                            layer.msg("选择成功",function(){
                                var index = parent.layer.getFrameIndex(window.name);
                                        // 关闭窗口刷新父页面
                                        window.parent.location.reload();
                                        //关闭当前frame
                                        parent.layer.close(index);
                                    });

                        } else {
                            layer.msg("选择失败",function(){
                                var index = parent.layer.getFrameIndex(window.name);
                                        // 关闭窗口刷新父页面
                                        window.parent.location.reload();
                                        //关闭当前frame
                                        parent.layer.close(index);
                            });
                        }
                    }
                })
            
        }
    </script>
</body>
</html>