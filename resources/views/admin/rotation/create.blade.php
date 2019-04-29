
@extends('layout.admins')
@section('center')
<script type="text/javascript" charset="utf-8" src="{{asset('/lib/utf8-php/ueditor.config.js')}}"></script>
<script type="text/javascript" charset="utf-8" src="{{asset('/lib/utf8-php/ueditor.all.min.js')}}"> </script>
<script type="text/javascript" charset="utf-8" src="{{asset('/lib/utf8-php/lang/zh-cn/zh-cn.js')}}"></script>
<style type="text/css">
  .layui-form-item{width:90%;}
  .layui-form-select dl{max-height:160px;}
</style>
<div class="x-nav">
        <span class="layui-breadcrumb" style="visibility: visible;">
            <a href="">首页</a><span lay-separator="">/</span>
            <a>
                <cite>添加产品</cite></a>
        </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
        </a>
    </div>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                   
    <form class="layui-form" action="/admin/rotation" method="post">
  {{csrf_field()}}
  <div class="layui-form-item">
    <label class="layui-form-label">描述</label>
    <div class="layui-input-block">
      <input type="text" name="describe" lay-verify="title" autocomplete="off" placeholder="请输入图片描述" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">url</label>
    <div class="layui-input-block">
      <input type="text" name="url" lay-verify="title" autocomplete="off" placeholder="请输入图片链接地址" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
      <label class="layui-form-label">商品图片</label>
      <div class="layui-upload">
        <button type="button" name="img_upload" class="layui-btn btn_upload_img">
          <i class="layui-icon">&#xe67c;</i>上传图片
        </button>
          <img style="" class="layui-upload-img img-upload-view" src="" >
          <input type="hidden" name="pic" class="pic" value="<?php echo csrf_token(); ?>">  
          <p id="demoText"></p>
      </div>
  </div>
  
  
 
  
  
  
  
  
  
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
      
    </div>
  </div>
</form>
</div></div></div></div>
<script>
 var ue = UE.getEditor('editor');
layui.use(['form', 'layedit', 'laydate','upload'], function(){
  var form = layui.form
  ,layer = layui.layer
  ,layedit = layui.layedit
  ,laydate = layui.laydate;
   var upload = layui.upload;         
  //创建一个编辑器
  var editIndex = layedit.build('LAY_demo_editor');
 
  //自定义验证规则
  form.verify({
    title: function(value){
      if(value.length < 2){
        return '标题至少得2个字符啊';
      }
    }
    
    ,content: function(value){
      layedit.sync(editIndex);
    }
  });
  

  //普通图片上传
            var uploadInst = upload.render({
                elem: '.btn_upload_img'
                ,type : 'images'
                ,exts: 'jpg|png|gif|jpeg' //设置一些后缀，用于演示前端验证和后端的验证
                 ,auto:false //选择图片后是否直接上传
              
               ,multiple:true
               ,choose: function(obj){
                  //将每次选择的文件追加到文件队列
                  var files = obj.pushFile();
                  
                  //预读本地文件，如果是多文件，则会遍历。(不支持ie8/9)
                  obj.preview(function(index, file, result){
                   
                   // console.log(result); //得到文件base64编码，比如图片
                    $('.img-upload-view').attr('src', result);
                    $('.pic').val(result);
                   
                  });
                }
            });
 

  
  
});
</script>
@stop
