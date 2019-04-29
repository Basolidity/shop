
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
                   
    <form class="layui-form" action="{{url('/admin/goods/'.$re['id'])}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="layui-form-item">
    <label class="layui-form-label">商品名称</label>
    <div class="layui-input-block">
      <input type="text" name="gname" lay-verify="title" autocomplete="off" placeholder="请输入商品名称" class="layui-input" value="{{$re['gname']}}">
    </div>
  </div>

   <div class="layui-form-item">
      <label class="layui-form-label">分类选择框</label>
      <div class="layui-input-block">
        <select name="tid" lay-verify="required" lay-search="">
          <option value="">请选择分类</option>
          @foreach($res as $rs)
            @if($rs['pid'] == 0)
            <optgroup label="{{$rs['tname']}}">
            @elseif($rs['pid'] != 0)
              <option value="{{$rs['id']}}" {{($rs['id']== $re['tid'])?'selected':''}}>{{$rs['tname']}}</option>
            @endif
            </optgroup>
          @endforeach
          
        </select>
        <div class="layui-unselect layui-form-select">
        <div class="layui-select-title">
        <input type="text" placeholder="请选择问题" value="" readonly="" class="layui-input layui-unselect"><i class="layui-edge">
        </i>
        </div>
        <dl class="layui-anim layui-anim-upbit layui-select-group" style="max-height:160px">
        
        </dl>
        </div>
      </div>
  </div>
  
  

  <div class="layui-form-item">
      <label class="layui-form-label">商品图片</label>
      <div class="layui-upload">
        <button type="button" name="img_upload" class="layui-btn btn_upload_img">
          <i class="layui-icon">&#xe67c;</i>上传图片
        </button>
       
          <img style="width:150px;height:150px;border-radius:50%;" class="layui-upload-img img-upload-view" src="{{$re['pic']}}" >
        
          <input type="hidden" name="pic" class="pic" value="{{$re['pic']}}">  
          <p id="demoText"></p>
      </div>
  </div>
  
  
 
  
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">普通文本域</label>
    <div class="layui-input-block">
       <script id="editor" name="descr" type="text/plain" style="width:100%;height:500px;">{{$re['descr']}}</script>
    </script>
    </div>
  </div>
  
  <div class="layui-form-item">
    <label class="layui-form-label">开关</label>
    <div class="layui-input-block">
      <input   type="checkbox"   lay-text="开启|停用" {{$re['status']?'checked':''}}  lay-skin="switch" lay-filter="switchTest" >
      <input id="switch" type="hidden" name="status" value="{{$re['status']?'1':'0'}}">
    </div>
  </div>
  <!--<div class="layui-form-item layui-form-text">
    <label class="layui-form-label">编辑器</label>
    <div class="layui-input-block">
      <textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="LAY_demo_editor"></textarea>
    </div>
  </div>-->
  
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
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
 
  @if (session('success')==='1')
    var index = parent.layer.getFrameIndex(window.name);
    // 关闭窗口刷新父页面
    window.parent.location.reload();
    //关闭当前frame
    parent.layer.close(index);
  @elseif(session('error')==='0')
    layer.msg('修改失败',{icon:2});
  @endif

  //自定义验证规则
  form.verify({
    title: function(value){
      if(value.length < 2){
        return '标题至少得2个字符啊';
      }
    }
    
  });
  
  //监听指定开关
  form.on('switch(switchTest)', function (data) {
                          if(data.elem.checked){
                                  $('#switch').attr('value','1');
                          }else{
                              $('#switch').attr('value','0');
                          }
                          
                      })
  //普通图片上传
            var uploadInst = upload.render({
                elem: '.btn_upload_img'
                ,type : 'images'
                ,exts: 'jpg|png|gif|jpeg' //设置一些后缀，用于演示前端验证和后端的验证
                 ,auto:false //选择图片后是否直接上传
                //,accept:'images' //上传文件类型
               // ,url: ''
               // ,data:{}
               ,multiple:true
               ,choose: function(obj){
    //将每次选择的文件追加到文件队列
    var files = obj.pushFile();
    
    //预读本地文件，如果是多文件，则会遍历。(不支持ie8/9)
    obj.preview(function(index, file, result){
      //console.log(index); //得到文件索引
      //console.log(file); //得到文件对象
      //console.log(result); //得到文件base64编码，比如图片
      $('.img-upload-view').attr('src', result);
      $('.pic').val(result);
      //obj.resetFile(index, file, '123.jpg'); //重命名文件名，layui 2.3.0 开始新增
      
      //这里还可以做一些 append 文件列表 DOM 的操作
      
      //obj.upload(index, file); //对上传失败的单个文件重新上传，一般在某个事件中使用
      //delete files[index]; //删除列表中对应的文件，一般在某个事件中使用
    });
  }
                // ,before: function(obj){
                //     //预读本地文件示例，不支持ie8
                //     obj.preview(function(index, file, result){
                //         $('.img-upload-view').attr('src', result); //图片链接（base64）
                //     });
                // }
                // ,done: function(res){
                //     //如果上传失败
                //     if(res.status == 1){
                //         return layer.msg('上传成功');
                //     }else{//上传成功
                //         layer.msg(res.message);
                //     }

                // }
            });
 

  
  
});
</script>
@stop
