
@extends('layout.admins')
@section('center')
   
    <body>
        <div class="x-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>登录名</label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="uname"  lay-verify="required" autocomplete="off" class="layui-input" datatype="/^[a-zA-Z0-9_]{6,16}$/" errormsg="格式不正确"></div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span> 6到16位（字母，数字，下划线）</div></div>
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>昵称</label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="name"  lay-verify="name" autocomplete="off" class="layui-input" datatype="/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_-]{3,32}/"></div>
                    <div class="layui-form-mid layui-word-aux" errormsg="格式不正确">
                        <span class="x-red">*</span> 3到32位字符<br>&nbsp;&nbsp;支持（中文，字母，数字，下划线）</div></div>
                <div class="layui-form-item">
                    <label for="phone" class="layui-form-label">
                        <span class="x-red">*</span>手机</label>
                    <div class="layui-input-inline">
                        <input type="text" id="phone" name="phone"  lay-verify="phone" autocomplete="off" class="layui-input" datatype="m" errormsg="请填写正确手机号"></div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span></div></div>
                <div class="layui-form-item">
                    <label for="L_email" class="layui-form-label">
                        <span class="x-red">*</span>邮箱</label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_email" name="email"  lay-verify="email" autocomplete="off" class="layui-input" datatype="e" errormsg="请填写正确邮箱号"></div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span></div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>角色</label>
                    <div class="layui-input-block">
                        <input type="radio" name="role" value="0" lay-skin="primary" title="普通会员" checked="" >
                        <input type="radio" name="role" value="1" lay-skin="primary" title="管理员" >
                        <input type="radio" name="role" value="2" lay-skin="primary" title="超级管理员" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">
                        <span class="x-red">*</span>密码</label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_pass" name="pass"  lay-verify="pass" autocomplete="off" class="layui-input" datatype="/^[\w_-]{6,16}$/" errormsg="密码格式不正确" ></div>
                    <div class="layui-form-mid layui-word-aux"><span class="x-red">*</span> 6到16位字符<br> &nbsp;&nbsp;支持（字母，数字，下划线）</div></div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                        <span class="x-red">*</span>确认密码</label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_repass" name="repass" lay-verify="repass" autocomplete="off" class="layui-input"  datatype="*" recheck="pass"></div><div class="layui-form-mid layui-word-aux"><span class="x-red">*</span>两次密码必须一致</div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label"></label>
                    <button class="layui-btn" lay-filter="add" lay-submit="">增加</button></div>
            </form>
        </div>
        <script>layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;

                //自定义验证规则
                form.verify({
                    nikename: function(value) {
                        if (value.length < 5) {
                            return '昵称至少得5个字符啊';
                        }
                    },
                    pass: [/(.+){6,12}$/, '密码必须6到12位'],
                    repass: function(value) {
                        if ($('#L_pass').val() != $('#L_repass').val()) {
                            return '两次密码不一致';
                        }
                    }
                });

                //监听提交
                form.on('submit(add)',
                function(data) {
                    console.log(data);
                    //发异步，把数据提交给php
                    layer.alert("增加成功", {
                        icon: 6
                    },
                    function() {
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前frame
                        parent.layer.close(index);
                    });
                    return false;
                });

            });</script>
        <script>var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
    </body>
@stop

    <script>
        $('.layui-form').Validform({
            tiptype:4
        });
    </script>
