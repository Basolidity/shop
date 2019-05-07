@extends('layout.admins')
@section('center')
    <body>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            @php
                                

                            @endphp
                            <blockquote class="layui-elem-quote">欢迎管理员：
                                <span class="x-red">{{$res->nick}}</span>！当前时间:<span id="showDate"></span>
                            <script>
                            function getCurrTime(){
                            var date=new Date();
                            var weekArray=new Array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
                            var str=date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds()+" "+weekArray[date.getDay()];
                            document.getElementById("showDate").innerHTML=str;
                            }
                            setInterval("getCurrTime()",1000);
                            </script>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">数据统计</div>
                        <div class="layui-card-body ">
                            <ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>会员数</h3>
                                        <p>
                                            <cite>{{ $user }}</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>管理员数</h3>
                                        <p>
                                            <cite>{{ $admin }}</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>商品数</h3>
                                        <p>
                                            <cite>{{ $goods }}</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6 ">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>订单总数</h3>
                                        <p>
                                            <cite>{{ $order }}</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6 ">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>前台访问量</h3>
                                        <p>
                                            <cite>{{ $fw->fw }}</cite></p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">开发团队</div>
                        <div class="layui-card-body ">
                            <table class="layui-table">
                                <tbody>
                                    <tr>
                                        <th>版权所有</th>
                                        <td>hacker(hacker)
                                            <a href="http://www.chinahacker.com/" target="_blank">访问官网</a></td>
                                    </tr>
                                    <tr>
                                        <th>开发者</th>
                                        <td>莫伟杰，李春，李旺儒</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <style id="welcome_style"></style>
                <div class="layui-col-md12">
                    <blockquote class="layui-elem-quote layui-quote-nm">感谢兄弟连,本系统由骇客团队提供技术支持。</blockquote></div>
            </div>
        </div>
        </div>
    </body>

@stop
