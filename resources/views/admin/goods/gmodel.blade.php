
@extends('layout.admins')
@section('center')
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
<form class="layui-form layui-form-pane" action="">
  <div class="layui-form-item " style="padding-top:30px">
    <label class="layui-form-label">商品型号</label>
    <div class="layui-input-inline">
      <input type="text" name="type" autocomplete="off" placeholder="请输入商品型号" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">颜色</label>
    <div class="layui-input-inline">
      <input type="text" name="color" lay-verify="required" placeholder="请输入颜色" autocomplete="off" class="layui-input">
    </div>
  </div>
 
  <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">价格</label>
      <div class="layui-input-inline" >
        <input type="text" name="price" placeholder="￥" autocomplete="off" class="layui-input">
      </div>
     
    </div>
  </div>
   <div class="layui-form-item">
    <label class="layui-form-label">库存</label>
    <div class="layui-input-inline">
      <input type="text" name="num" lay-verify="required" placeholder="请输入库存" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <button class="layui-btn" lay-submit="" lay-filter="demo2">提交</button>
  </div>
</form>
</div></div></div></div>
<script>
 layui.use(['form', 'layedit', 'laydate'], function(){
  var form = layui.form
  ,layer = layui.layer
  ,layedit = layui.layedit
  ,laydate = layui.laydate;

   form.on('submit(demo2)',function(data) {
      var _token = "{{csrf_token()}}";
      var type = $('input[name="type"]').val();
      var color = $('input[name="color"]').val();
      var price = $('input[name="price"]').val();
      var num = $('input[name="num"]').val();

                                     //console.log(data);
                                    //发异步，把数据提交给php
                    $.ajax({
                          type:'post',
                          url:'/admin/goods/gmodel/'+{{$id}},
                          datatype:'json',
                          data:{_token,type,color,price,num},
                          success:function(res){
                            //console.log(res);
                            if(res.status=='success'){
                               layer.alert(res.msg, {
                                        icon: 6
                                    },function() {
                                        var index = parent.layer.getFrameIndex(window.name);
                                      
                                         //关闭当前frame
                                        parent.layer.close(index);
                                    });
                            }else{
                                 layer.msg(res.msg,{icon:2});
                            }
                          }
                      })
                    return false;
   })
  //自定义验证规则
  form.verify({
    title: function(value){
      if(value.length < 5){
        return '标题至少得5个字符啊';
      }
    }
    
  });  
});
</script>
@stop
