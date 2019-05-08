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
                <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
            </a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form layui-col-space5" action="{{url('admin/type')}}" method="post">
                            {{csrf_field()}}
                                <div class="layui-input-inline layui-show-xs-block">
                                    <input class="layui-input" placeholder="分类名" name="tname"></div>
                                <div class="layui-input-inline layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon"></i>增加</button>
                                </div>
                            </form>
                            <hr>
                            <blockquote class="layui-elem-quote">每个tr 上有两个属性 cate-id='1' 当前分类id fid='0' 父级id ,顶级分类为 0，有子分类的前面加收缩图标<i class="layui-icon x-show" status='true'>&#xe623;</i></blockquote>
                        </div>
                        <div class="layui-card-header">
                            <button class="layui-btn layui-btn-danger" onclick="delAll()">
                                <i class="layui-icon"></i>批量删除</button>
                        </div>
                        <div class="layui-card-body ">
                            <table class="layui-table layui-form">
                              <thead>
                                <tr>
                                  <th width="20">
                                    <input type="checkbox" name="" lay-skin="primary">
                                  </th>
                                  <th width="70">ID</th>
                                  <th>栏目名</th>
                                  <th width="50">排序</th>
                                  <th width="80">状态</th>
                                  <th width="250">操作</th>
                              </thead>
                              <tbody class="x-cate">
                              @foreach($res as $rs)
                                <tr cate-id="{{$rs['id']}}" fid="{{$rs['pid']}}" >
                                  <td>
                                    <input type="checkbox" name="" lay-skin="primary">
                                  </td>
                                  <td>{{$rs['id']}}</td>
                                  <td>
                                  
                                  @if (substr_count($rs['path'],',')==1)
                                   <i class="layui-icon x-show" status='true'>&#xe623;</i>
                                    {{$rs['tname']}}
                                  @elseif (substr_count($rs['path'],',')==2)
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <i class="layui-icon x-show" status='true'>&#xe623;</i>
                                    {{$rs['tname']}}
                                  @elseif (substr_count($rs['path'],',')==3)
                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  
                                   ├{{$rs['tname']}}
                                  @endif
                                    
                                  </td>
                                  <td><input type="text" class="layui-input x-sort" name="order" value="1"></td>
                                  <td>
                                    <input id="switch" type="checkbox" name="switch"  lay-text="开启|停用"  {{$rs['status']?'checked':''}} lay-skin="switch" lay-filter="switchTest" value="{{$rs['status']?'1':'0'}}">
                                  </td>
                                  <td class="td-manage">
                                    <button class="layui-btn layui-btn layui-btn-xs"  onclick="xadmin.open('编辑','{{url('admin/type/'.$rs['id'].'/edit')}}')" ><i class="layui-icon">&#xe642;</i>编辑</button>
                                    <button class="layui-btn layui-btn-warm layui-btn-xs"  onclick="xadmin.open('编辑','{{url('admin/type/childtype/'.$rs['id'])}}')" ><i class="layui-icon">&#xe642;</i>添加子栏目</button>
                                    <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="member_del(this,'{{$rs['id']}}')" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
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
                                    <a class="next" href="">&gt;&gt;</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
          layui.use(['form'], function(){
            form = layui.form;
             form.on('submit(sreach)',function(){
              alert($('.layui-input[nam="tname"]').val())
                if($('.layui-input[nam="tname"]').val()=="" || $('.layui-input[nam="tname"]').val() == undefined){
                  layer.msg('分类名不能为空',{icon:2});
                    return false;
                }
             })
            form.on('switch(switchTest)', function (data) {
            if(data.elem.checked){
                    $(this).val('1');
                    var id= $(this).parents("tr").attr('cate-id');
                $.ajax({
                          type:'GET',
                          url:'/admin/type/status/'+id,
                          datatype:'json',
                          data:{status:1},
                          success:function(res){
                            //console.log(res);
                            if(res.status=='success'){
                               layer.msg("修改成功", {
                                        icon: 6
                                    });
                            }else{
                                 layer.msg(res.msg,{icon:2});
                            }
                          }})
            }else{
                $(this).val('0');
                  var id= $(this).parents("tr").attr('cate-id');
                $.ajax({
                          type:'GET',
                          url:'/admin/type/status/'+id,
                          datatype:'json',
                          data:{status:0},
                          success:function(res){
                            //console.log(res);
                            if(res.status=='success'){
                               layer.msg("修改成功", {
                                        icon: 6
                                    });
                            }else{
                                 layer.msg(res.msg,{icon:2});
                            }
                          }})
            }
            //console.log(data.elem.checked); //开关是否开启，true或者false
        })
          });

           /*用户-删除*/
          function member_del(obj,id){
            var rem = $(obj);
              layer.confirm('确认要删除吗？',function(index){
                  //发异步删除数据
                  // $(obj).parents("tr").remove();
                  // layer.msg('已删除!',{icon:1,time:1000});
                  var _token = "{{csrf_token()}}";
                  $.ajax({
                          type:'DELETE',
                          url:'/admin/type/'+id,
                          datatype:'json',
                          data:{_token},
                          success:function(res){
                            //console.log(res);
                            if(res.status=='success'){
                               layer.msg("删除成功");
                               rem.parents("tr").remove();
                            }else{
                                 layer.msg(res.msg,{icon:2});
                            }
                          }
                      })
              });
          }

          // 分类展开收起的分类的逻辑
          // 
          $(function(){
            $("tbody.x-cate tr[fid!='0']").hide();
            // 栏目多级显示效果
            $('.x-show').click(function () {
                if($(this).attr('status')=='true'){
                    $(this).html('&#xe625;'); 
                    $(this).attr('status','false');
                    cateId = $(this).parents('tr').attr('cate-id');
                    $("tbody tr[fid="+cateId+"]").show();
               }else{
                    cateIds = [];
                    $(this).html('&#xe623;');
                    $(this).attr('status','true');
                    cateId = $(this).parents('tr').attr('cate-id');
                    getCateId(cateId);
                    for (var i in cateIds) {
                        $("tbody tr[cate-id="+cateIds[i]+"]").hide().find('.x-show').html('&#xe623;').attr('status','true');
                    }
               }
            })
          })

          var cateIds = [];
          function getCateId(cateId) {
              $("tbody tr[fid="+cateId+"]").each(function(index, el) {
                  id = $(el).attr('cate-id');
                  cateIds.push(id);
                  getCateId(id);
              });
          }
   
        </script>
    </body>
@endsection
