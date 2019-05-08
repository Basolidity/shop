<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="shortcut icon"type="image/x-icon" href="/{{ asset('home/images/icon.jpg') }}"media="screen" />

    <link type="text/css" rel="stylesheet" href="{{asset('home/css/style.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('home/css/layui.css')}}" />
    <script type="text/javascript" src="{{asset('xadmin/js/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('home/js/menu.js')}}"></script>    
    <script type="text/javascript" src="{{asset('home/js/select.js')}}"></script>
    <script type="text/javascript" src="{{asset('lib/layui2/layui.js')}}"></script>
    <script type="text/javascript" src="{{asset('xadmin/js/xadmin.js')}}"></script>
    
<title>@yield('title')</title>
</head>
<body>  
<!--Begin Header Begin-->
@section('center')
<div class="soubg">
    <div class="sou">
        <span class="fr">
            <span class="fl">
                @if(Session::get('qname'))
            <span class="s_city">
                <span>{{Session('qname')}}</span>
                <div class="s_city_bg">
                    <div class="s_city_t"></div>
                    <div class="s_city_c">
                    <div class="pre_head">
                        <a href="{{ url('home/person') }}">账户管理</a>&nbsp;|&nbsp;
                        <a href="/home/logout">退出</a>&nbsp;&nbsp;&nbsp;
                    </div>
                        @php
                            $res = DB::table('users')->where('uname',session('qname'))->first();
                            $photo = DB::table('users_info')->where('uid',$res->id)->first();
                        @endphp
                    @if(session('qname'))
                        @if( $photo->pic  )
                            <a href="{{ url('home/person') }}"><img  class="pre_img layui-upload-img img-upload-view" src="/{{ $photo->pic }}" ></a>
                        @else
                            <a href="{{ url('home/person') }}"><img  class="pre_img layui-upload-img img-upload-view" src="/upload/1.jpg" ></a>
                        @endif
                    @endif
                    <span style="display:inline-block;">
                        <div style="line-height:25px;">账户余额：￥ {{ $photo->balance }}元</div>
                        <div style="line-height:25px;">普通会员</div>
                        <div style="line-height:25px;"> </div>
                    </span>
                    </div>
                </div>
            </span>
                <!-- 提示登录成功 -->
                @if(Session('tm'))
                    <script>alert('登录成功');</script> 
                @endif
            @else
                <!-- 提示退出登录成功 -->
                @if(Session('tp'))
                    <script>alert('退出登录成功');</script>
                @endif
                请<a href="/home/login">登录</a>&nbsp; 
                <a href="/home/regist" style="color:#ff4e00;">免费注册</a>&nbsp;
            @endif
           &nbsp;|&nbsp;<a href="/">首页</a>&nbsp;|&nbsp;<a href="/">我的订单</a>&nbsp;|
       </span>
            <span class="ss">
                <div class="ss_list">
                    <a href="#">收藏夹</a>
                    <div class="ss_list_bg">
                        <div class="s_city_t"></div>
                        <div class="ss_list_c">
                            <ul>
                                <li><a href="#">我的收藏夹</a></li>
                                <li><a href="#">我的收藏夹</a></li>
                            </ul>
                        </div>
                    </div>     
                </div>
                <div class="ss_list">
                    <a href="#">客户服务</a>
                    <div class="ss_list_bg">
                        <div class="s_city_t"></div>
                        <div class="ss_list_c">
                            <ul>
                                <li><a href="#">客户服务</a></li>
                                <li><a href="#">客户服务</a></li>
                                <li><a href="#">客户服务</a></li>
                            </ul>
                        </div>
                    </div>    
                </div>
                <div class="ss_list">
                    <a href="#">网站导航</a>
                    <div class="ss_list_bg">
                        <div class="s_city_t"></div>
                        <div class="ss_list_c">
                            <ul>
                                <li><a href="#">网站导航</a></li>
                                <li><a href="#">网站导航</a></li>
                            </ul>
                        </div>
                    </div>    
                </div>
            </span>
            <span class="fl">|&nbsp;关注我们：</span>
            <span class="s_sh"><a href="#" class="sh1">新浪</a><a href="#" class="sh2">微信</a></span>
        </span>
    </div>
</div>
<div class="m_top_bg">
    <div class="top">
        <div class="m_logo"><a href="Index.html"><img src="{{ asset('home/images/logo1.png') }}" /></a></div>
        <div class="m_search">
            <form>
                <input type="text" value="" class="m_ipt" />
                <input type="submit" value="搜索" class="m_btn" />
            </form>                      
            <span class="fl"><a href="#">咖啡</a><a href="#">iphone 6S</a><a href="#">新鲜美食</a><a href="#">蛋糕</a><a href="#">日用品</a><a href="#">连衣裙</a></span>
        </div>
    </div>
</div>
<!--End Header End--> 
<div class="i_bg bg_color">
    <!--Begin 用户中心 Begin -->
    <div class="m_content">
        <div class="m_left">
            <div class="left_n">管理中心</div>
            <div class="left_m">
                <div class="left_m_t t_bg1">订单中心</div>
                <ul>
                    <li><a href="{{url('home/myorder')}}">我的订单</a></li>
                    <li><a href="{{url('home/site')}}">收货地址</a></li>
                </ul>
            </div>
            <div class="left_m">
                <div class="left_m_t t_bg2">会员中心</div>
                <ul>
                    <li><a href="{{url('home/person')}}">用户信息</a></li>
                    <li><a href="Member_Collect.html">我的收藏</a></li>
                    <li><a href="Member_Msg.html">我的留言</a></li>
                    <li><a href="#">我的评论</a></li>
                </ul>
            </div>
            <div class="left_m">
                <div class="left_m_t t_bg3">账户中心</div>
                <ul>
                    <li><a href="Member_Safe.html">账户安全</a></li>
                    <li><a href="Member_Packet.html">我的红包</a></li>
                    <li><a href="Member_Money.html">资金管理</a></li>
                </ul>
            </div>
        </div>
    @section('center')

        <div class="m_right">
            <div class="m_des">
                <table border="0" style="width:870px; line-height:22px;" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td width="115"><img src="{{ asset('home/images/user.jpg') }}" width="90" height="90" /></td>
                    <td>
                        <div class="m_user">TRACY</div>
                        <p>
                            等级：注册用户 <br />
                            <font color="#ff4e00">您还差 270 积分达到 分红100</font><br />
                            上一次登录时间: 2015-09-28 18:19:47<br />
                            您还没有通过邮件认证 <a href="#" style="color:#ff4e00;">点此发送认证邮件</a>
                        </p>
                        <div class="m_notice">
                            用户中心公告！
                        </div>
                    </td>
                  </tr>
                </table>    
            </div>
            
            <div class="mem_t">资产信息</div>
            <table border="0" class="mon_tab" style="width:870px; margin-bottom:20px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="33%">用户等级：<span style="color:#555555;">普通会员</span></td>
                <td width="33%">消费金额：<span>￥200元</span></td>
                <td width="33%">返还积分：<span>99R</span></td>
              </tr>
              <tr>
                <td>账户余额：<span>￥200元</span></td></td>
                <td>红包个数：<span style="color:#555555;">3个</span></td></td>
                <td>红包价值：<span>￥50元</span></td></td>
              </tr>
              <tr>
                <td colspan="3">订单提醒：
                    <font style="font-family:'宋体';">待付款(<span>0</span>) &nbsp; &nbsp; &nbsp; &nbsp; 待收货(<span>2</span>) &nbsp; &nbsp; &nbsp; &nbsp; 待评论(<span>1</span>)</font>
                </td>
              </tr>
            </table>

            <div class="mem_t">账号信息</div>
            <table border="0" class="acc_tab" style="width:870px;" cellspacing="0" cellpadding="0">
              <tr>
                <td class="td_l">用户ID： </td>
                <td>12345678</td>
              </tr>
              <tr>
                <td class="td_l b_none">身份证号：</td>
                <td>522124***********8</td>
              </tr>
              <tr>
                <td class="td_l b_none">电  话：</td>
                <td>186****1234</td>
              </tr>
              <tr>
                <td class="td_l">邮   箱： </td>
                <td>*******789@qq.com</td>
              </tr>
              <tr>
                <td class="td_l b_none">注册时间：</td>
                <td>2015/10/10</td>
              </tr>
              <tr>
                <td class="td_l">完成订单：</td>
                <td>0</td>
              </tr>
              <tr>
                <td class="td_l b_none">邀请人：</td>
                <td>邀请人</td>
              </tr>
              <tr>
                <td class="td_l">登录次数：</td>
                <td>3</td>
              </tr>
            </table>
               
            
        </div>
    </div>
    @show
    <!--End 用户中心 End--> 
    <!--Begin Footer Begin -->
    <div class="b_btm_bg b_btm_c">
        <div class="b_btm">
            <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="{{ asset('home/images/b1.png') }}" width="62" height="62" /></td>
                <td><h2>正品保障</h2>正品行货  放心购买</td>
              </tr>
            </table>
            <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>

                <td width="72"><img src="{{asset('home/images/b2.png')}}" width="62" height="62" /></td>

                <td><h2>满38包邮</h2>满38包邮 免运费</td>
              </tr>
            </table>
            <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="{{ asset('home/images/b3.png') }}" width="62" height="62" /></td>
                <td><h2>天天低价</h2>天天低价 畅选无忧</td>
              </tr>
            </table>
            <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="{{ asset('home/images/b4.png') }}" width="62" height="62" /></td>
                <td><h2>准时送达</h2>收货时间由你做主</td>
              </tr>
            </table>
        </div>
    </div>
    <div class="b_nav">
        <dl>                                                                                            
            <dt><a href="#">新手上路</a></dt>
            <dd><a href="#">售后流程</a></dd>
            <dd><a href="#">购物流程</a></dd>
            <dd><a href="#">订购方式</a></dd>
            <dd><a href="#">隐私声明</a></dd>
            <dd><a href="#">推荐分享说明</a></dd>
        </dl>
        <dl>
            <dt><a href="#">配送与支付</a></dt>
            <dd><a href="#">货到付款区域</a></dd>
            <dd><a href="#">配送支付查询</a></dd>
            <dd><a href="#">支付方式说明</a></dd>
        </dl>
        <dl>
            <dt><a href="#">会员中心</a></dt>
            <dd><a href="#">资金管理</a></dd>
            <dd><a href="#">我的收藏</a></dd>
            <dd><a href="#">我的订单</a></dd>
        </dl>
        <dl>
            <dt><a href="#">服务保证</a></dt>
            <dd><a href="#">退换货原则</a></dd>
            <dd><a href="#">售后服务保证</a></dd>
            <dd><a href="#">产品质量保证</a></dd>
        </dl>
        <dl>
            <dt><a href="#">联系我们</a></dt>
            <dd><a href="#">网站故障报告</a></dd>
            <dd><a href="#">购物咨询</a></dd>
            <dd><a href="#">投诉与建议</a></dd>
        </dl>
        <div class="b_tel_bg">
            <a href="#" class="b_sh1">新浪微博</a>            
            <a href="#" class="b_sh2">腾讯微博</a>
            <p>
            服务热线：<br />
            <span>400-123-4567</span>
            </p>
        </div>
        <div class="b_er">
            <div class="b_er_c"><img src="{{ asset('home/images/er.gif') }}" width="118" height="118" /></div>
            <img src="{{ asset('home/images/ss.png') }}" />
        </div>
    </div>    
    <div class="btmbg">
        <div class="btm">
            备案/许可证编号：蜀ICP备12009302号-1-www.dingguagua.com   Copyright © 2015-2018 尤洪商城网 All Rights Reserved. 复制必究 , Technical Support: Dgg Group <br />
            <img src="{{ asset('home/images/b_1.gif') }}" width="98" height="33" /><img src="{{ asset('home/images/b_2.gif') }}" width="98" height="33" /><img src="{{ asset('home/images/b_3.gif') }}" width="98" height="33" /><img src="{{ asset('home/images/b_4.gif') }}" width="98" height="33" /><img src="{{ asset('home/images/b_5.gif') }}" width="98" height="33" /><img src="{{ asset('home/images/b_6.gif') }}" width="98" height="33" />
        </div>      
    </div>
    <!--End Footer End -->    
</div>

</body>


<!--[if IE 6]>
<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
</html>
