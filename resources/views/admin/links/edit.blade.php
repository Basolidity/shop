
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
                   
    <form class="layui-form" >
 
  <div class="layui-form-item">
    <label class="layui-form-label">描述</label>
    <div class="layui-input-block">
      <input type="text" id="fname" name="fname" value="{{$res['fname']}}" lay-verify="title" autocomplete="off" placeholder="请输入图片描述" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">url</label>
    <div class="layui-input-block">
      <input type="text" id="url" name="url" value="{{$res['url']}}" lay-verify="title" autocomplete="off" placeholder="请输入图片链接地址" class="layui-input">
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
 
  

  
 
             //监听提交
                 form.on('submit(demo1)',
                function(data) {
                 var _token = "{{csrf_token()}}";
                var fname = $('#fname').val();
                 var url = $('#url').val();
                 
                                     //console.log(data);
                                    //发异步，把数据提交给php
                   
                    $.ajax({
                          type:'PUT',
                          url:'/admin/link/'+{{$res['id']}},
                          datatype:'json',
                          data:{_token,fname,url},
                          success:function(res){
                            //console.log(res);
                            if(res.status=='success'){
                               layer.alert("修改成功", {
                                        icon: 6
                                    },function() {
                                        var index = parent.layer.getFrameIndex(window.name);
                                        // 关闭窗口刷新父页面
                                        window.parent.location.reload();
                                         //关闭当前frame
                                        parent.layer.close(index);
                                    });
                            }else{
                                 layer.msg(res.msg,{icon:2});
                            }
                          }


                      })
        
                    return false;
                });
  
  
});
</script>
@stop
