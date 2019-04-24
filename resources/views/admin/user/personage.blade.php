@extends('layout.admins')
@section('center')
   <body>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">设置我的资料</div>
                    <div class="layui-card-body" pad15>
                        <!-- <div class="layui-form" lay-filter="" id="formdate"> -->
                        <form class="layui-form" action="javascript:;" id="formdate" >

                            <!-- <div class="layui-form-item">
                                <label class="layui-form-label">我的角色</label>
                                <div class="layui-input-inline">
                                    <select name="role" lay-verify="">
                                        <option value="1" selected>超级管理员</option>
                                        <option value="2" disabled>普通管理员</option>
                                        <option value="3" disabled>审核员</option>
                                        <option value="4" disabled>编辑人员</option></select>
                                </div>
                                <div class="layui-form-mid layui-word-aux">当前角色不可更改为其它角色
                                </div>
                            </div> -->
                            <div class="layui-form-item">
                                <label class="layui-form-label">用户名</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="uname" value="{{ $rs->uname }}"  class="layui-input" lay-verify="required" autocomplete="off">
                                    <input type="hidden" name="uid" id="uid" value="{{ $rs->usersinfo->uid }}"  class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux"></div></div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">昵称</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="name" value="{{ $rs->usersinfo->name }}" lay-verify="nickname" autocomplete="off" placeholder="请输入昵称" class="layui-input"></div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">性别</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="sex" value="1" title="男" {{ $rs->usersinfo->sex ==1 ? 'checked' : ''}} >
                                    <input type="radio" name="sex" value="0" title="女" {{ $rs->usersinfo->sex ==0 ? 'checked' : ''}} >
                                    <input type="radio" name="sex" value="2" title="保密" {{ $rs->usersinfo->sex  ==2 ? 'checked' : ''}}></div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">头像</label>
                                <div class="layui-upload">
                                    <button type="button" name="img_upload" class="layui-btn btn_upload_img">
                                        <i class="layui-icon">&#xe67c;</i>上传图片
                                    </button>
                                    @if( $rs->usersinfo->pic )
                                        <img style="width:150px;height:150px;border-radius:50%;" class="layui-upload-img img-upload-view" src="/{{$rs->usersinfo->pic }}" >
                                    @else
                                        <img style="width:150px;height:150px;border-radius:50%;" class="layui-upload-img img-upload-view" src="/upload/1.jpg" >
                                    @endif
                                    <input type="hidden" name="_token" class="tag_token" value="<?php echo csrf_token(); ?>">  
                                    <p id="demoText"></p>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">手机</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="phone" value="{{ $rs->usersinfo->phone}}" placeholder="请填写手机号"lay-verify="phone" autocomplete="off" class="layui-input" ></div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">邮箱</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="email" value="{{ $rs->usersinfo->email}}" placeholder="请填写邮箱" lay-verify="email" autocomplete="off" class="layui-input"></div>
                            </div>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn layui-btn-radius" lay-submit >确认修改</button>
                                    <button type="reset" class="layui-btn layui-btn-radius layui-btn-primary">重新填写</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        layui.use('upload', function(){
            var upload = layui.upload;
            var tag_token = $(".tag_token").val();
            var uid = $("#uid").val();
            //普通图片上传
            var uploadInst = upload.render({
                elem: '.btn_upload_img'
                ,type : 'images'
                ,exts: 'jpg|png|gif' //设置一些后缀，用于演示前端验证和后端的验证
                // ,auto:false //选择图片后是否直接上传
                //,accept:'images' //上传文件类型
                ,url: '/admin/upload'
                ,data:{'_token':tag_token,id:uid}
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                        $('.img-upload-view').attr('src', result); //图片链接（base64）
                    });
                }
                ,done: function(res){
                    //如果上传失败
                    if(res.status == 1){
                        return layer.msg('上传成功');
                    }else{//上传成功
                        layer.msg(res.message);
                    }

                }
            });
        });
        

        //ajax提交修改信息
        layui.use(['form', 'layer'],function() {
            $ = layui.jquery;
            var form = layui.form,
            layer = layui.layer;

            //自定义验证规则
            form.verify({
                required: function(value){ 
                //value：表单的值
                    if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                      return '用户名不能有特殊字符';
                    }
                    if (value.length < 5) {
                        return '用户名至少得5个字符啊';
                    }
                    if(/(^\_)|(\__)|(\_+$)/.test(value)){
                      return '用户名首尾不能出现下划线\'_\'';
                    }
                    if(/^\d+\d+\d$/.test(value)){
                      return '用户名不能全为数字';
                    }
                },
                nickname: [/^[\w\u4e00-\u9fa5]{3,20}$/, '昵称格式不正确'],
                phone: [/^1(3|4|5|7|8)\d{9}$/, '请输入正确手机号'],
                email: [/^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$|^1[3|4|5|7|8]\d{9}$/, '邮箱格式不对'],
            });
                
        });

            $(document).ready(function(){
                $('.layui-btn-radius').click(function(){
                    $.ajax({
                        url: '/admin/person/{{ $rs->id }}',  
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
                                    layer.alert("修改成功", {icon: 6});
                                });
                            } else if (data == 0){
                                layui.use(['form', 'layer'],
                                function() {
                                    $ = layui.jquery;
                                    var form = layui.form,
                                    layer = layui.layer;
                                    layer.alert("保存成功", {icon: 6});
                                });
                            }else{
                                layui.use(['form', 'layer'],
                                function() {
                                    $ = layui.jquery;
                                    var form = layui.form,
                                    layer = layui.layer;
                                    layer.alert("修改失败", {icon: 5});
                                });
                            }
                        },            
                        async: false    
                    })
                });
            });


        layui.config({
            base: '/layuiadmin/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'set']);</script>
</body>
    
@stop
