@extends('layout.person.per')
@section('title','尤洪-管理中心')

@section('center')
        <!-- 管理中心right部分 -->
        <div class="m_right">
            <div class="m_des">
                <table border="0" style="width:870px; line-height:22px;" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                        <td width="115">
                            <form class="layui-form" action="javascript:;" id="formdate" >
                                <div class="layui-form-item">
                                    <div class="layui-upload">
                                        @if( $photo->pic )
                                            <img style="width:150px;height:150px;border-radius:50%;" class="layui-upload-img img-upload-view" src="/{{$photo->pic }}" >
                                        @else
                                            <img style="width:150px;height:150px;border-radius:50%;" class="layui-upload-img img-upload-view" src="/upload/1.jpg" >
                                        @endif
                                        <input type="hidden" name="_token" class="tag_token" value="<?php echo csrf_token(); ?>">  
                                        <input type="hidden" name="uid" id="uid" value="{{ $photo->id }}"  class="layui-input">
                                        <p id="demoText"></p>　　
                                        <button type="button" name="img_upload" class="layui-btn btn_upload_img">上传图片
                                        </button>
                                    </div>
                                </div>
                                
                        <td>
                            <br>
                            <br>
                            <br>
                            @if( $photo->name  )
                            <div class="m_user">　　　 {{ $photo->name }}</div>
                            @else
                            <div class="m_user">　　　没有填写昵称哦！！</div>
                            @endif
                            <p>　　　 等级：普通用户
                        </td>                        
                    </tr>
                </table>
            </div>
            <div class="mem_t">资产信息</div>
            <table border="0" class="mon_tab" style="width:870px; margin-bottom:20px;" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="33%">用户等级：
                        <span style="color:#555555;">普通会员</span>
                    </td>
                </tr>
                <tr>
                    <td>账户余额：
                        <span>￥{{$photo->balance }}元</span>
                    </td>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">订单提醒：
                        <font style="font-family:'宋体';">待付款(
                            <span>0</span>) &nbsp; &nbsp; &nbsp; &nbsp; 待收货(
                            <span>2</span>) &nbsp; &nbsp; &nbsp; &nbsp; 待评论(
                            <span>1</span>)</font></td>
                </tr>
            </table>
            <div class="mem_t">账号信息</div>
            <table border="0" class="mon_tab" style="width:870px; margin-bottom:20px;" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="40%">用户ID：
                        <span style="color:#555555;"> {{ $res->uname }}</span></td>
                        <td>性&nbsp; &nbsp;别 ：
                        <span style="color:#555555;">
                            <input type="radio" name="sex" value="{{$photo->sex}}" {{$photo->sex == 1 ? 'checked' : ''}}>男
                            <input type="radio" name="sex" value="{{$photo->sex}}" {{$photo->sex == 0 ? 'checked' : ''}}>女
                        </span></td>
                </tr>
                <tr>
                    <td>
                        <div class="layui-form-item">昵&nbsp; &nbsp; 称：
                            <span style="color:#555555;">
                                <input type="text" value="{{ $photo->name }}"  name="name" placeholder="未填写昵称" lay-verify="nickname" autocomplete="off"  id="name">
                            </span>
                        </div>
                    </td>
                    <td>邮&nbsp; &nbsp; 箱：
                        <span style="color:#555555;"><input type="text" value="{{ $photo->email }}" name="email" placeholder="未填写邮箱" lay-verify="email" autocomplete="off"  id="email"></span></td>
                </tr>
                <tr>
                    <td>电&nbsp; &nbsp; 话：
                        <span style="color:#555555;"><input type="text" value="{{ $photo->phone }}" name='phone' placeholder="未填写手机号" lay-verify="phone" autocomplete="off"  id="phone"></span></td>
                    <td>注册时间：
                        <span style="color:#555555;">{{ $res->time }}</span></td>
                </tr>
            </table>
            {{ csrf_field() }}
            <div class="layui-form-item">
                <div class="layui-input-block" style="margin-left:300px">
                    <button class="layui-btn layui-btn-radius" lay-filter="add" lay-submit >确认修改</button>
                </div>
            </div>
            </form>

        </div>
    </div>
    <!--End 用户中心 End-->
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
            ,url: '/home/upload'
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
        
        //监听提交
        form.on('submit(add)',
        function(data) {
            //发异步，把数据提交给php
            $.ajax({
                    url: '/home/person/update/{{ $photo->id }}',  
                    data: $('#formdate').serialize(),
                    dataType: 'json',    
                    type: 'GET',    
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
                        } else if(data == 2){
                            layui.use(['form', 'layer'],
                            function() {
                                $ = layui.jquery;
                                var form = layui.form,
                                layer = layui.layer;
                                layer.alert("修改失败", {icon: 5});
                            });
                        } else if(data == 3){
                            layui.use(['form', 'layer'],
                            function() {
                                $ = layui.jquery;
                                var form = layui.form,
                                layer = layui.layer;
                                layer.alert("信息格式不正确", {icon: 5});
                            });
                        }
                    },            
                    async: false    
                })

            return false;
        });
            
    });

    $("#name").blur(function(){
        var ver = $(this).val();
        var patrn = /^[\w\u4e00-\u9fa5]{3,20}$/;
        if(!patrn.test(ver)) 
        { 
            layer.alert('至少3个字节，汉字，字母，数字，下划线组成 !'); 
            return false; 
        } 
    })
    $("#email").blur(function(){
        var ver = $(this).val();
        var patrn = /^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$|^1[3|4|5|7|8]\d{9}$/;
        if(!patrn.test(ver)) 
        { 
            layer.alert('邮箱格式不正确 !'); 
            return false; 
        } 
    })
    $("#phone").blur(function(){
        var ver = $(this).val();
        var patrn = /^1(3|4|5|7|8)\d{9}$/;
        if(!patrn.test(ver)) 
        { 
            layer.alert('请输入正确手机号 !'); 
            return false; 
        } 
    })
    </script>

@stop