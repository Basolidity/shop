@extends('layout.home')
@section('center')
<link rel="stylesheet" type="text/css" href="{{asset('/home/css/ShopShow.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('/home/css/MagicZoom.css')}}" />
     <script type="text/javascript" src="{{asset('/home/js/MagicZoom.js')}}"></script>
    <script type="text/javascript" src="{{asset('/home/js/n_nav.js')}}"></script>
    <script type="text/javascript" src="{{asset('/home/js/num.js')}}">
        var jq = jQuery.noConflict();
    </script>

 
    
    <script type="text/javascript" src="{{asset('/home/js/shade.js')}}"></script>

@include('layout.hometype')

<div class="i_bg"> 
   @if(empty($carts))
  <img src="{{asset('images/gwc.jpg')}}" style="width:100%">
  @else
  
  
    <div class="content mar_20">
      <img src="images/img2.jpg" />        
    </div>
    
    <!--Begin 第二步：确认订单信息 Begin -->
    <div class="content mar_20">
      <div class="two_bg">
          <div class="two_t">
              <span class="fr"><a href="#">  </a></span>商品列表
            </div>
            <table border="0" class="car_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
              <tr>
                <td class="car_th" width="550">商品名称</td>
                <td class="car_th" width="140">属性</td>
                <td class="car_th" width="150">购买数量</td>
                <td class="car_th" width="130">小计</td>
                
              </tr>
                @foreach($carts as $k=>$v)
              <tr class="jiage">
                <td>
                    <div class="c_s_img"><img src="{{$v->pic}}" width="73" height="73" /></div>
                    {{$v->gname}}
                </td>
                <td align="center">型号：{{$v->type}}</td>
                <td align="center" class="shuliang">{{$v->num}}</td>
                <td align="center" style="color:#ff4e00;">￥<span class="car_ipt">{{$v->price}}</span></td>
                
              </tr>
                @endforeach
              
              <tr>
                <td colspan="5" align="right" style="font-family:'Microsoft YaHei';">
                    商品总价：￥<span class="zhongjiage">1899.00 </span>；
                </td>
              </tr>
            </table>
            
            <div class="two_t">
              <span class="fr"><a href="javascript:;" onclick="xadmin.open('修改','{{ url('home/order/edit') }}',1000,500)">修改</a></span>收货人信息
            </div>

            @if(!empty($xz))
            <table border="0" class="peo_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
              <tr>
                <td class="p_td" width="160">收货人</td>
                <td width="395">{{ $xz->lname }}</td>
                <td class="p_td">手机</td>
                <td>{{ $xz->phone }}</td>
              </tr>
              <tr>
                <td class="p_td">详细信息</td>
                <td>{{ $xz->area .' '. $xz->path }}</td>
                <td class="p_td">邮政编码</td>
                <td>{{ $xz->postal }}</td>
              </tr>
            </table>
            @else
            <table border="0" class="peo_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
              <tr>
                <td class="p_td" width="160">收货人</td>
                <td width="395">{{ $site->lname }}</td>
                <td class="p_td">手机</td>
                <td>{{ $site->phone }}</td>
              </tr>
              <tr>
                <td class="p_td">详细信息</td>
                <td>{{ $site->area .' '. $site->path }}</td>
                <td class="p_td">邮政编码</td>
                <td>{{ $site->postal }}</td>
              </tr>
            </table>
            @endif
          
            
            <div class="two_t">
              支付方式
            </div>
            <ul class="pay">
                <li class="checked">余额支付<div class="ch_img"></div></li>
                <!-- <li>银行亏款/转账<div class="ch_img"></div></li>
                <li>货到付款<div class="ch_img"></div></li>
                <li>支付宝<div class="ch_img"></div></li> -->
            </ul>
            
           
            
            
            
            <div class="two_t">
              其他信息
            </div>
            <table border="0" class="car_tab" style="width:1110px;" cellspacing="0" cellpadding="0">
              
              <tr valign="top">
                <td align="right" style="padding-right:0;"><b style="font-size:14px;">订单附言：</b></td>
                <td style="padding-left:0;"><textarea class="add_txt" style="width:860px; height:50px;"></textarea></td>
              </tr>
              
            </table>
            
            <table border="0" style="width:900px; margin-top:20px;" cellspacing="0" cellpadding="0">
              <tr>
               
              </tr>
              <tr height="70">
                <td align="right">
                  <b style="font-size:14px;">应付款金额：<span style="font-size:22px; color:#ff4e00;" class="zhongjiage zhongjia">￥2899</span></b>
                </td>
              </tr>
              <tr height="70">
                <td align="right"><a href="javascript:void;" onclick="jieshuan()"><img src="images/btn_sure.gif" /></a></td>
              </tr>
            </table>

            
          
        </div>
    </div>
    @endif
  <!--End 第二步：确认订单信息 End-->
    
    
    <!--Begin Footer Begin -->
    <div class="b_btm_bg bg_color">
        <div class="b_btm">
            <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="images/b1.png" width="62" height="62" /></td>
                <td><h2>正品保障</h2>正品行货  放心购买</td>
              </tr>
            </table>
      <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="images/b2.png" width="62" height="62" /></td>
                <td><h2>满38包邮</h2>满38包邮 免运费</td>
              </tr>
            </table>
            <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="images/b3.png" width="62" height="62" /></td>
                <td><h2>天天低价</h2>天天低价 畅选无忧</td>
              </tr>
            </table>
            <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="images/b4.png" width="62" height="62" /></td>
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
            <div class="b_er_c"><img src="images/er.gif" width="118" height="118" /></div>
            <img src="images/ss.png" />
        </div>
    </div>    
    <div class="btmbg">
    <div class="btm">
          备案/许可证编号：蜀ICP备12009302号-1-www.dingguagua.com   Copyright © 2015-2018 尤洪商城网 All Rights Reserved. 复制必究 , Technical Support: Dgg Group <br />
            <img src="images/b_1.gif" width="98" height="33" /><img src="images/b_2.gif" width="98" height="33" /><img src="images/b_3.gif" width="98" height="33" /><img src="images/b_4.gif" width="98" height="33" /><img src="images/b_5.gif" width="98" height="33" /><img src="images/b_6.gif" width="98" height="33" />
        </div>      
    </div>
    <!--End Footer End -->    
</div>
<script type="text/javascript">
  function zongji(){
      var sum=0;
      $('.jiage').each(function(){
        var pic = parseInt($(this).find('.car_ipt').text());
        var num = parseInt($(this).find('.shuliang').text());
       
          sum +=pic*num;
      })
       $('.zhongjiage').text(sum);

    }
   zongji();

   //查询够不够钱买单
  function jieshuan(){
    var _token="{{csrf_token()}}";
    var total = $('.zhongjia').text();
    var msg = $('.add_txt').val();
    layui.use(['form', 'layedit', 'laydate','upload'], function(){
      var _token = "{{csrf_token()}}";
              var form = layui.form
              ,layer = layui.layer
              ,layedit = layui.layedit
              ,laydate = layui.laydate;
    $.ajax({
                          type:'post',
                          url:'/home/settlement',
                          datatype:'json',
                          data:{_token,total,msg},
                          success:function(res){
                            //console.log(res);
                           if(res.status == 'success')
                           {
                              location.href="/home/settlements/"+res.oid;
                           }else{
                              layer.msg(res.msg,{icon:2});
                           }
                          }
                      })
      })
    }
</script>
</body>
@stop