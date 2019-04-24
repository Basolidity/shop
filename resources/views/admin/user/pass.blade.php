@extends('layout.admins')
@section('center')
   
    <body>
        <div class="x-body" >
            <form class="layui-form" id="formdate">
                <div class="layui-form-item">
                    <label for="L_username" class="layui-form-label">昵称</label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_username" name="username" disabled="" value="{{ $rs->uname }}" class="layui-input"></div>
                </div>
                <div class="layui-form-item">
                    <label for="L_oldpass" class="layui-form-label">
                        <span class="x-red">*</span>旧密码</label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_oldpass" name="pass" required="" lay-verify="oldpass" autocomplete="off" class="layui-input"></div>
                </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">
                        <span class="x-red">*</span>新密码</label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_pass" name="newpass" required="" lay-verify="pass" autocomplete="off" class="layui-input"></div>
                    <div class="layui-form-mid layui-word-aux">6到16个字符</div></div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                        <span class="x-red">*</span>确认密码</label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_repass" name="repass" required="" lay-verify="repass" autocomplete="off" class="layui-input"></div>
                </div>
                    {{ csrf_field() }}
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label"></label>
                    <button class="layui-btn" lay-filter="save" lay-submit="">修改</button></div>
            </form>
        </div>
        <script>layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;
                // 验证
                form.verify({
                    pass: [/^[\w_-]{6,16}$/, '密码必须6到16位'],
                    oldpass: function(value) {
                        if ($('#L_pass').val() == $('#L_oldpass').val()) {
                            return '旧密码和新密码相同';
                        }
                    },
                    repass: function(value) {
                        if ($('#L_pass').val() != $('#L_repass').val()) {
                            return '两次密码不一致';
                        }
                    },
                });
            });


                $(document).ready(function(){
                $('.layui-btn').click(function(){
                    $.ajax({
                        url: '/admin/dopass/{{ $rs->id }}',  
                        data: $('#formdate').serialize(),
                        dataType: 'json',    
                        type: 'POST',    
                        success: function(data){
                            if(data == 3){
                                layui.use(['form', 'layer'],
                                function() {
                                    $ = layui.jquery;
                                    var form = layui.form,
                                    layer = layui.layer;
                                    layer.alert("修改失败", {icon: 5},function () {
                                        // 获得frame索引
                                        var index = parent.layer.getFrameIndex(window.name);
                                        // 关闭窗口刷新父页面
                                        window.parent.location.reload();
                                        //关闭当前frame
                                        parent.layer.close(index);
                                    });
                                });
                            }
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
                                    layer.alert("旧密码不正确", {icon: 5});
                                });
                            }
                        },            
                        async: false    
                    })
                });
            });
        </script>
        <script>var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
    </body>
@stop
