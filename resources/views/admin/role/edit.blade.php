
@extends('layout.admins')
@section('center')
   
    <body>
        <div class="x-body">
            <form class="layui-form" action="javascript:;" id="formdate">
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>角色名</label>
                    <div class="layui-input-inline">
                        <input type="text" id="rname" name="rname"  lay-verify="required" autocomplete="off" class="layui-input" value="{{ $rol->rname }}">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>拥有权限
                    </label>
                    <table  class="layui-table layui-input-block">
                        <tbody>
                            @foreach($rs as $v)
                            @if(substr_count($v['path'],',') == 1)
                            <tr>
                                <td>
                                    <input type="checkbox" name="per[]"  lay-skin="primary" lay-filter="father" title="{{ $v['pername'] }}" value="{{ $v['id'] }}">
                                </td>
                                <td>
                                    <div class="layui-input-block">
                                        @foreach($rs as $val)
                                            @php
                                                $arr = explode(",",$val['path']);
                                            @endphp
                                            @if(in_array($v['id'],$arr))
                                                <input name="per[]" lay-skin="primary" type="checkbox" title="{{ $val['pername'] }}" value="{{ $val['id'] }}"
                                                @foreach($rol->per as $r)
                                                {{ $r['id'] == $val['id'] ? 'checked' : ''}}
                                                @endforeach
                                                >
                                            @endif
                                        @endforeach

                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label"></label>
                    <button class="layui-btn" lay-filter="add" lay-submit="">修改</button></div>
                    {{csrf_field()}}
                    {{ method_field('PUT') }}
            </form>
        </div>
        <script>
            layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;

                //自定义验证规则
                form.verify({
                    
                    required: function(value){ 
                    //value：表单的值
                        if (value.length < 2) {
                            return '角色名至少得2个字符';
                        }
                        if(/^\S$/.test(value)){
                          return '角色名不能为空';
                        }
                    },
                });

                //控制全选
                form.on('checkbox(father)', function(data){
                    if(data.elem.checked){
                        $(data.elem).parent().siblings('td').find('input').prop("checked", true);
                        form.render(); 
                    }else{
                       $(data.elem).parent().siblings('td').find('input').prop("checked", false);
                        form.render();  
                    }
                });
                
            });
           $(document).ready(function(){
                $('.layui-btn').click(function(){
                    $.ajax({
                        url: '/admin/role/{{ $rol->id }}',  
                        data: $('#formdate').serialize(),
                        dataType: 'json',    
                        type: 'POST',    
                        success: function(data){
                            if(data == 1){
                                layui.use(['form', 'layer'],
                                function() {
                                    $ = layui.jquery;
                                    var form = layui.form,
                                    layer = layui.layer;
                                    layer.alert("修改成功", {icon: 6},function () {
                                        // 获得frame索引
                                        var index = parent.layer.getFrameIndex(window.name);
                                        // 关闭窗口刷新父页面
                                        window.parent.location.reload();
                                        //关闭当前frame
                                        parent.layer.close(index);
                                    });
                                });
                            }
                            if(data == 0){
                                layui.use(['form', 'layer'],
                                function() {
                                    $ = layui.jquery;
                                    var form = layui.form,
                                    layer = layui.layer;
                                    layer.alert("修改失败", {icon: 5});
                                });
                            }
                            if(data == 3){
                                layui.use(['form', 'layer'],
                                function() {
                                    $ = layui.jquery;
                                    var form = layui.form,
                                    layer = layui.layer;
                                    layer.alert("保存成功", {icon: 6},function () {
                                        // 获得frame索引
                                        var index = parent.layer.getFrameIndex(window.name);
                                        // 关闭窗口刷新父页面
                                        window.parent.location.reload();
                                        //关闭当前frame
                                        parent.layer.close(index);
                                    });
                                });
                            }
                        },            
                        async: false    
                    })
                });
            });

        </script>
        <script>
            var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
    </body>
@stop
