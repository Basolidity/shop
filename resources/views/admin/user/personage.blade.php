@extends('layout.admins')
@section('center')
   <body>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">设置我的资料</div>
                    <div class="layui-card-body" pad15>
                        <div class="layui-form" lay-filter="">
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
                                    <input type="text" name="username" value="{{ $rs->uname }}"  class="layui-input"></div>
                                <div class="layui-form-mid layui-word-aux"></div></div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">昵称</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="nickname" value="{{ $rs->usersinfo->name }}" lay-verify="nickname" autocomplete="off" placeholder="请输入昵称" class="layui-input"></div>
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
                                    <img class="layui-upload-img img-upload-view" src="/upload/2.jpg">
                                    <input type="hidden" name="_token" class="tag_token" value="<?php echo csrf_token(); ?>">  
                                    <p id="demoText"></p>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">手机</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="cellphone" value="{{ $rs->usersinfo->phone}}" placeholder="请填写手机号"lay-verify="phone" autocomplete="off" class="layui-input" ></div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">邮箱</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="email" value="{{ $rs->usersinfo->email}}" placeholder="请填写邮箱" lay-verify="email" autocomplete="off" class="layui-input"></div>
                            </div>
                            <!-- <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">备注</label>
                                <div class="layui-input-block">
                                    <textarea name="remarks" placeholder="请输入内容" class="layui-textarea"></textarea>
                                </div>
                            </div> -->
                            {{ csrf_field() }}
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit lay-filter="setmyinfo">确认修改</button>
                                    <button type="reset" class="layui-btn layui-btn-primary">重新填写</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('xadmin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script>
        layui.use('upload', function(){
            var upload = layui.upload;
            var tag_token = $(".tag_token").val();
            //普通图片上传
            var uploadInst = upload.render({
                elem: '.btn_upload_img'
                ,type : 'images'
                ,exts: 'jpg|png|gif' //设置一些后缀，用于演示前端验证和后端的验证
                // ,auto:false //选择图片后是否直接上传
                //,accept:'images' //上传文件类型
                ,url: '/admin/upload'
                ,data:{'_token':tag_token,id:{{ $rs->usersinfo->uid}}}
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
                // ,error: function(){
                //     //演示失败状态，并实现重传
                //     return layer.msg('上传失败,请重新上传');
                // }
            });
        });

        layui.config({
            base: '/layuiadmin/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'set']);</script>
</body>
    
@stop
