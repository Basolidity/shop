@extends('layout.person.per')
@section('title','尤洪-收货地址')

@section('center')
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
                <div style="background-color: #e3f2fd;border-color: #e3f2fd;border-radius: 3px;box-shadow: none;border-style: solid;border-width:1px;padding: 12px;"><i class="iconfont">&#xe6a4;</i>&nbsp;&nbsp;已保存了{{ $num }}条地址，还能保存{{ 10-$num }}条地址</div>
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
                                <button class="layui-btn layui-btn layui-btn-xs"  onclick="xadmin.open('编辑','{{ url('home/site/'.$v['id'].'/edit') }}',800,500)" >编辑</button>
                                <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="member_del(this,'{{$v['id']}}')" href="javascript:;" >删除</button>
                            </a>
                        </td>
                        <td style="text-align: center;">
                            @if($v->depath == 1)
                            <span style="margin-left:15px;   display:block; width: 80px; height: 30px;line-height: 30px;border: 1px solid #ff5000;border-radius: 3px;background: #ffd6cc;color: #f30;">默认地址</span>
                            @else
                            <a onclick="depath('{{$v['id']}}')" href="javascript:;" >设为默认</a>
                            @endif

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
                    url: '/home/site/depath/' + id,
                    datatype: 'json',
                    success: function(res) {
                        //console.log(res);
                        if (res.status == 'success') {
                            layer.msg("设置成功");
                            window.location.reload();

                        } else {
                            layer.msg("设置失败");
                        }
                    }
                })
            
        }
    </script>
@stop