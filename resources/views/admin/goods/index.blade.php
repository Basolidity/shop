@extends('layout.admins')
@section('center')

     <body>
        <div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a href="">演示</a>
            <a>
              <cite>导航元素</cite></a>
          </span>
          <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form layui-col-space5">
                                <div class="layui-inline layui-show-xs-block">
                                    <input class="layui-input"  autocomplete="off" placeholder="开始日" name="start" id="start">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input class="layui-input"  autocomplete="off" placeholder="截止日" name="end" id="end">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                                </div>
                            </form>
                        </div>
                        <div class="layui-card-header">
                            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
                            <button class="layui-btn" onclick="xadmin.open('添加用户','./admin-add.html',600,400)"><i class="layui-icon"></i>添加</button>
                        </div>
                        <div class="layui-card-body ">
                            <table class="layui-table layui-form">
                              <thead>
                                <tr>
                                  <th>
                                    <input type="checkbox" name=""  lay-skin="primary">
                                  </th>
                                  <th>编号</th>
                                  <th>名称</th>
                                  <th>展视图</th>
                                 
                                  <th>加入时间</th>
                                  <th>状态</th>
                                  <th>操作</th>
                              </thead>
                              <tbody>
                              @foreach($res as $k =>$v)
                                <tr>
                                  <td>
                                    <input type="checkbox" name=""  lay-skin="primary">
                                  </td>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{$v->gname}}</td>
                                  <td><img src="{{$v->pic}}"></td>
                                  
                                  <td>{{date('Y-m-d H:i:s',$v->addtime)}}</td>
                                  <td class="td-status">
                                  @if($v->status)
                                    <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td>
                                  @else
                                  <span id="sta" class="layui-btn layui-btn-normal layui-btn-mini layui-btn-disabled">已停用</span>
                                  @endif
                                  <td class="td-manage">
                                   <a onclick="member_stop(this,'{{ $v->id }}')" href="javascript:;" title="{{ $v->status ? '启用':'停用' }}">

                                            <i class="layui-icon">{{ $v->status ? '&#xe601;':'&#xe62f;'  }}</i>
                                            </a>
                                    <a title="编辑"  onclick="xadmin.open('编辑','{{url('admin/goods/'.$v->id.'/edit')}}')" href="javascript:;">
                                      <i class="layui-icon">&#xe642;</i>
                                    </a>
                                    <a title="图片上传" onclick="xadmin.open('图片上传','{{url('admin/goods/update/'.$v->id)}}')" href="javascript:;">
                                      <i class="icon iconfont ">&#xe6ab;</i>
                                    </a>
                                    <a title="添加型号" onclick="xadmin.open('商品型号','{{url('admin/goods/gmodel/'.$v->id)}}')" href="javascript:;">
                                      <i class="layui-icon">&#xe6b2;</i>
                                    </a>
                                    <a title="查看所有型号"  onclick="tab_add('{{url('admin/goods/gmodel/list/'.$v->id)}}')">
                                      <i class="icon iconfont ">&#xe806;</i>
                                     
                                    </a>
                                   <!--  <a title="删除" onclick="member_del(this,'要删除的id')" href="javascript:;">
                                      <i class="layui-icon">&#xe640;</i>
                                    </a> -->

                                  </td>
                                </tr>
                              @endforeach
                              </tbody>
                            </table>
                        </div>
                        <div class="layui-card-body ">
                            <div class="page">
                                <div>
                                  <a class="prev" href="">&lt;&lt;</a>
                                  <a class="num" href="">1</a>
                                  <span class="current">2</span>
                                  <a class="num" href="">3</a>
                                  <a class="num" href="">489</a>
                                  <a class="next" href="">&gt;&gt;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </body>
    <script>
      layui.use(['laydate','form'], function(){
        var laydate = layui.laydate;
        var form = layui.form;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

       /*用户-停用*/
      function member_stop(obj,id){

            var obj = $(obj);

              if($(obj).attr('title')=='启用'){
              layer.confirm('确认要停用吗？',function(index){
                //发异步把用户状态进行更改
                $.get('/admin/goods/status/'+id,{status:0},function(data){
                  if(data.status=='success'){
                     obj.attr('title','停用')
                    obj.find('i').html('&#xe62f;');
                    obj.parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                    layer.msg('已停用!',{icon: 5,time:1000});
                  }else{
                    layer.msg(data.msg,{icon: 5,time:1000});
                  }
                 
                })
                
              });
              }else{
                layer.confirm('确认要启用吗？',function(index){
                //发异步把用户状态进行更改
                $.get('/admin/goods/status/'+id,{status:1},function(data){
                  if(data.status=='success'){
                    obj.attr('title','启用')
                    obj.find('i').html('&#xe601;');

                    obj.parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                    layer.msg('已启用!',{icon: 6,time:1000});
                  }else{
                    layer.msg(data.msg,{icon: 5,time:1000});
                  }
                })
                
              });
                
              }
              
         
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }



      function delAll (argument) {

        var data = tableCheck.getData();
  
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }

      function tab_add(url)
      {
        //alert(111);
       location.href = url;

      }
    </script>
@endsection
