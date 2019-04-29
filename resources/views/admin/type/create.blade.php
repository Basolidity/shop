
@extends('layout.admins')
@section('center')
<body>
   <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form" action="{{url('admin/type/'.$res['id'])}}" method="post">
                {{csrf_field()}}
                {{method_field('put')}}
                  <div class="layui-form-item">
                      <label for="username" class="layui-form-label">
                          <span class="x-red">*</span>分类名称
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="username" name="tname" required="" lay-verify="required"
                          autocomplete="off" class="layui-input" value="{{$res['tname']}}">
                      </div>
                      
                  </div>
                  <div class="layui-form-item">
                      <label for="username" class="layui-form-label">
                          <span class="x-red"></span>是否开启
                      </label>
                      <div class="layui-input-inline">
                         <input id="switch" type="checkbox" name="switch"  lay-text="开启|停用"  {{$res['status']?'checked':''}} lay-skin="switch" lay-filter="switchTest" value="1">
                      </div>
                      
                  </div>
                   
                  <div class="layui-form-item">
                      <label for="L_repass" class="layui-form-label">
                      </label>
                      <button  class="layui-btn" lay-filter="add" lay-submit="">
                          修改
                      </button>
                  </div>
              </form>
            </div>
        </div>
        <script>layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;
               
 form.on('switch(switchTest)', function (data) {
            if(data.elem.checked){
                    $('#switch').val('1');
            }else{
                $('#switch').val('0');
            }
            //console.log(data.elem.checked); //开关是否开启，true或者false
        })
                //监听提交
                form.on('submit(add)',
                function(data) {
                 var _token = "{{csrf_token()}}";
                var tname = $('#username').val();
                var status = $('#switch').val();
                                     //console.log(data);
                                    //发异步，把数据提交给php
                   
                    $.ajax({
                          type:'PUT',
                          url:'/admin/type/'+{{$res['id']}},
                          datatype:'json',
                          data:{_token,tname,status},
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
       
    </body>
@stop
