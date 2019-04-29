@extends('layout.create-edit')
@section('center')
    <script src="{{ asset('home/city-picker/city-picker.data.js') }}"></script>
    <link href="{{ asset('home/city-picker/city-picker.css') }}" rel="stylesheet" />
    <body style="padding:20px 20px">
        <div class="x-body">
            <form class="layui-form layui-col-md12  layui-form-pane"action="javascript:;" id="formdate">
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>收货人</label>
                    <div class="layui-input-inline">
                        <input type="text"  name="lname"  lay-verify="required" autocomplete="off" class="layui-input" ></div>
                        <input type="hidden"  name="uid" autocomplete="off" class="layui-input" value="{{ session('home_id') }}">
                        
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>手机号</label>
                    <div class="layui-input-inline">
                        <input type="text" name="phone"  lay-verify="phone" autocomplete="off" class="layui-input" ></div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>邮编</label>
                    <div class="layui-input-inline">
                        <input type="text" id="uname" name="postal" autocomplete="off" class="layui-input" placeholder="000000"></div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label width_auto text-r"><span class="x-red">*</span>省市县：
                        </label>
                            <div class="layui-input-inline" style="width:350px">
                                <input type="text" autocomplete="on" class="layui-input" id="city-picker" name="area" readonly="readonly" data-toggle="city-picker" placeholder="请选择">
                            </div>
                    </div>     
                </div>     
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>详细地址</label>
                    <div class="layui-input-inline" style="width:500px">
                        <input type="text"  name="path"  lay-verify="required" autocomplete="off" class="layui-input" ></div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn" lay-filter="add" lay-submit="">增加</button></div>
                    {{csrf_field()}}
            </form>
        </div>
        <script>
            layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;
                   //监听提交
            form.on('submit(add)',
            function(data) {
                //console.log(data);
                //发异步，把数据提交给php
                $.ajax({
                        url: '/home/site',  
                        data: $('#formdate').serialize(),
                        dataType: 'json',    
                        type: 'POST',    
                        success: function(data){
                            if(data == 1){
                                layui.use(['form', 'layer'],
                                function() {
                                    $ = layui.jquery;
                                    var form = layui.form,
                                    layer = layui.layer;
                                    layer.alert("增加成功", {icon: 6},function () {
                                        // 获得frame索引
                                        var index = parent.layer.getFrameIndex(window.name);
                                        // 关闭窗口刷新父页面
                                        window.parent.location.reload();
                                        //关闭当前frame
                                        parent.layer.close(index);
                                    });
                                });
                            }
                            if(data == 0){
                                layui.use(['form', 'layer'],
                                function() {
                                    $ = layui.jquery;
                                    var form = layui.form,
                                    layer = layui.layer;
                                    layer.alert("增加失败", {icon: 5});
                                });
                            }
                            if(data == 2){
                                layui.use(['form', 'layer'],
                                function() {
                                    $ = layui.jquery;
                                    var form = layui.form,
                                    layer = layui.layer;
                                    layer.alert("最多存储10条地址哦！", {icon: 4},function () {
                                        // 获得frame索引
                                        var index = parent.layer.getFrameIndex(window.name);
                                        //关闭当前frame
                                        parent.layer.close(index);
                                    });
                                });
                            }
                        },            
                        async: false    
                    })

                return false;
            });
                
            });
            // 城市联动
            layui.config({
                base: '/layuiadmin/' //静态资源所在路径
            }).extend({
                index: 'lib/index' //主入口模块
                , citypicker: '{/}/home/city-picker/city-picker' // {/}的意思即代表采用自有路径，即不跟随 base 路径
            }).use(['jquery', 'index', 'table', 'citypicker'], function () {
                var $ = layui.$
                    , table = layui.table
                    , form = layui.form
                    , cityPicker = layui.citypicker;

               var currentPicker = new cityPicker("#city-picker", {
                    provincename:"provinceId",
                    cityname:"cityId",
                    districtname: "districtId",
                    level: 'districtId',// 级别
                });
                currentPicker.setValue("河南省/信阳市/新县");
            });
        </script>
        <script>
            var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
    </body>
@stop
