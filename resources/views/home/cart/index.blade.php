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
    <div class="content mar_20">
    	<img src="images/img1.jpg" />        
    </div>
    
    <!--Begin 第一步：查看购物车 Begin -->
    <div class="content mar_20">
    	<table border="0" class="car_tab" style="width:1200px; margin-bottom:50px;" cellspacing="0" cellpadding="0">
          <tr>
            <td class="car_th" width="490">商品名称</td>
            <td class="car_th" width="140">属性</td>
            <td class="car_th" width="150">购买数量</td>
            <td class="car_th" width="130">小计</td>
           
            <td class="car_th" width="150">操作</td>
          </tr>
          @foreach($carts as $k=>$v)
          <tr class="jiage">
            <td>
            	<div class="c_s_img"><img src="{{$v->pic}}" width="73" height="73" /></div>
                {{$v->gname}}
            </td>
            <td align="center">型号：{{$v->type}}</td>
            <td align="center">
            	<div class="c_num">
                    <input type="button" value="" onclick="jianUpdate1(jq(this));" class="car_btn_1" />
                	<input type="text" value="{{$v->num}}" name="" class="car_ipt" onkeyup="maxnum(this)"/> 
                	<input name="kuc" type="hidden" value="{{$v->kc}}"> 
                    <input type="button" value="" onclick="addUpdate1(jq(this));" class="car_btn_2" />
                </div>
            </td>
            <td align="center" style="color:#ff4e00;" >￥<span class="shuliang">{{$v->price}}<span></td>
            
            <td align="center"><a onclick="yichu(this,{{$v->id}})">删除</a>&nbsp; &nbsp;</td>
          </tr>
          @endforeach
          
          
          
          <tr height="70">
          	<td colspan="6" style="font-family:'Microsoft YaHei'; border-bottom:0;">
            	
                <span class="fr">商品总价：<b style="font-size:22px; color:#ff4e00;">￥<em id="zhongjiage">2899</em></b></span>
            </td>
          </tr>
          <tr valign="top" height="150">
          	<td colspan="6" align="right">
            	<a href="#"><img src="images/buy1.gif" /></a>&nbsp; &nbsp; <a href="#"><img src="images/buy2.gif" /></a>
            </td>
          </tr>
        </table>
        
    </div>

    <script type="text/javascript">
    function zongji(){
	    var sum=0;
	    $('.jiage').each(function(){
	      var pic = parseInt($(this).find('.car_ipt').val());
	      var num = parseInt($(this).find('.shuliang').text());
	     
	        sum +=pic*num;
	    })
	     $('#zhongjiage').text(sum);

    }
   zongji();
</script>
	<!--End 第一步：查看购物车 End--> 
    
    
    <!--Begin 弹出层-删除商品 Begin-->
    <div id="fade" class="black_overlay"></div>
    <div id="MyDiv" class="white_content">             
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv('MyDiv','fade')"><img src="images/close.gif" /></span>
            </div>
            <div class="notice_c">
           		
                <table border="0" align="center" style="font-size:16px;" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td>您确定要把该商品移除购物车吗？</td>
                  </tr>
                  <tr height="50" valign="bottom">
                    <td><a href="#" class="b_sure">确定</a><a href="#" class="b_buy">取消</a></td>
                  </tr>
                </table>
                    
            </div>
        </div>
    </div>    
    <!--End 弹出层-删除商品 End-->
    
    
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

</body>
<script src="{{asset('home/js/ShopShow.js')}}"></script>

<script type="text/javascript">
  function maxnum(obj){
        var clear;
        clearTimeout(clear);
       clear = setTimeout(function(){
        var shurk = parseInt($(obj).val());
        var kuc = parseInt($(obj).siblings('input[name="kuc"]').val());
           if(shurk > kuc){
                $(obj).val(kuc);
           }
           zongji();
        },500)
    }
   function yichu(obj,id)
   {
   	var obj = $(obj);
   	 layui.use(['form', 'layedit', 'laydate','upload'], function(){
   	 	var _token = "{{csrf_token()}}";
              var form = layui.form
              ,layer = layui.layer
              ,layedit = layui.layedit
              ,laydate = layui.laydate;
   	 			layer.alert('确定删除这个产品?',function(){
   	 				$.ajax({
                          type:'DELETE',
                          url:'/home/cart/'+id,
                          datatype:'json',
                          data:{_token},
                          success:function(res){
                            //console.log(res);
                            if(res.status=='success'){
                               layer.msg(res.msg, {icon: 6});
                               obj.parents('.jiage').remove();
                               zongji();
                            }else{
                                 layer.msg(res.msg,{icon:2});
                            }
                          }
                      })
   	 			});
   		})
   }
</script>
@stop