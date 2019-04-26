
@extends('layout.admins')
@section('center')
<script type="text/javascript" charset="utf-8" src="{{asset('/lib/utf8-php/ueditor.config.js')}}"></script>
<script type="text/javascript" charset="utf-8" src="{{asset('/lib/utf8-php/ueditor.all.min.js')}}"> </script>
<script type="text/javascript" charset="utf-8" src="{{asset('/lib/utf8-php/lang/zh-cn/zh-cn.js')}}"></script>

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
                   
  
  <style type="text/css">
  .layui-form-item{width:90%;}
  .layui-form-select dl{max-height:160px;}
  #demo2 ul li{float: left;border: 1px solid #ccc;margin: 5px;position:relative;}
  #demo2 ul li div{position: absolute;top:0px;width:100%;height:20px;opacity:0.8;background: #ccc}
  #demo2 ul li img{width:160px;}
  #demo2 ul li div i{cursor:pointer;width: 20px;height: 20px;display: inline-block;float: right;color: #d84600;margin-right: 10px;}
  .clear{clear:both;}
</style>
<div>
  <div class="layui-upload-list" id="demo2">
    <ul>
  @foreach($res as $k => $v)
      <li><img src="{{$v->pic}}">
      <div>
      <i class="icon iconfont {{$v->id}}" onclick="del({{$v->id}})">&#xe69d;</i>
      </div>
      </li>
  @endforeach
  </ul>
  </div>
</div>

<div class="clear"></div>
   <div class="layui-upload">
  <button type="button" class="layui-btn layui-btn-normal" id="testList">选择多文件</button> 
  <div class="layui-upload-list">
    <table class="layui-table">
      <thead>
        <tr><th>文件名</th>
        <th>大小</th>
        <th>状态</th>
        <th>图片</th>
        <th>操作</th>
      </tr></thead>
      <tbody id="demoList"></tbody>
    </table>
  </div>
  <button type="button" class="layui-btn" id="testListAction">开始上传</button>
</div> 
  



</div></div></div></div>
<script>
function update(){
  $('.layui-upload').show();
layui.use('upload', function(){
  var $ = layui.jquery
  ,upload = layui.upload;
  var _token = "{{csrf_token()}}";
  
  var num = $('#demo2 ul li').length;
  var updata_num = 5-num;
  console.log(updata_num);
  if(updata_num>0){
     //多文件列表示例
  var demoListView = $('#demoList')
  ,uploadListIns = upload.render({
    elem: '#testList'
    ,url: '/admin/goods/update/'+{{$id}}
    ,accept: 'file'
    ,multiple: true
    ,number:updata_num
    ,auto: false
    ,data:{_token}
    ,bindAction: '#testListAction'
    ,choose: function(obj){   
      var files = this.files = obj.pushFile(); //将每次选择的文件追加到文件队列
      //读取本地文件
      obj.preview(function(index, file, result){
        var tr = $(['<tr id="upload-'+ index +'">'
          ,'<td>'+ file.name +'</td>'
          ,'<td>'+ (file.size/1014).toFixed(1) +'kb</td>'
          ,'<td>等待上传</td>'
          ,'<td><img src="'+result+'"></td>'
          ,'<td>'
            ,'<button class="layui-btn layui-btn-xs demo-reload layui-hide">重传</button>'
            ,'<button class="layui-btn layui-btn-xs layui-btn-danger demo-delete">删除</button>'
          ,'</td>'
        ,'</tr>'].join(''));
        
        //单个重传
        tr.find('.demo-reload').on('click', function(){
          obj.upload(index, file);
        });
        
        //删除
        tr.find('.demo-delete').on('click', function(){
          delete files[index]; //删除对应的文件
          tr.remove();
          uploadListIns.config.elem.next()[0].value = ''; //清空 input file 值，以免删除后出现同名文件不可选
        });
        
        demoListView.append(tr);
      });
    }
    ,done: function(res, index, upload){
      if(res.code == 0){ //上传成功
        console.log(res);
        var tr = demoListView.find('tr#upload-'+ index)
        ,tds = tr.children();
        tds.eq(2).html('<span style="color: #5FB878;">上传成功</span>');
        tds.eq(4).html('<button class="layui-btn layui-btn-xs layui-btn-danger" onclick="del('+res.res+')" id="'+res.res+'">删除</button>'); //清空操作
        $('#demo2 ul').append(`<li><img src="${res.tup.pic}"><div><i class="icon iconfont ${res.res}" onclick="del(${res.res})">&#xe69d;</i></div></li>`);
      update();
        return delete this.files[index]; //删除文件队列已经上传成功的文件
      }
      this.error(index, upload);
     
    }
    ,error: function(index, upload){
      var tr = demoListView.find('tr#upload-'+ index)
      ,tds = tr.children();
      tds.eq(2).html('<span style="color: #FF5722;">上传失败</span>');
      tds.eq(4).find('.demo-reload').removeClass('layui-hide'); //显示重传
    }
  });
}else{
  $('.layui-upload').hide();
  //$('#demoList').html('');
}
    //多图片上传
  
  
  // upload.render({
  //   elem: '#test2'
  //   ,url: '/admin/goods/update/'+{{$id}}
  //   ,multiple: true
  //   ,number:5
  //   ,field:'file'
  //   ,data:{_token}
  //   ,before: function(obj){
  //     //预读本地文件示例，不支持ie8
  //     obj.preview(function(index, file, result){
  //       $('#demo2 ul').append('<li><img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img"></li>')
  //     });
  //   }
  //   ,done: function(res){
  //     //上传完毕
  //     console.log(res);
  //   }
  // });

  
 
 
})
}
update();
  function del(id){
     layer.confirm('确认要删除吗？',function(index){
        $.get('/admin/goods/delpic/'+id,{},function(data){
        if(data.status=='success'){
          $('#'+id).parents('tr').remove();
          $('.'+id).parents('li').remove();
          layer.msg('删除成功',{icon: 6,time:1000});
          update();
        }else{
           layer.msg(data.msg,{icon: 5,time:1000});
         }
                 
      })
     })
  }

 
</script>
@stop
