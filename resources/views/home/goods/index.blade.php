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

<!--End Menu End--> 
<div class="i_bg">
    <div class="postion">
        <span class="fl">全部 > 美妆个护 > 香水 > 迪奥 > 迪奥真我香水</span>
    </div>    
    <div class="content">
                            
        <div id="tsShopContainer">
            @if(empty($pic))
                <div id="tsImgS"><a href="{{$pic[0]->pic}}" title="Images" class="MagicZoom" id="MagicZoom"><img src="{{$pic[0]->pic}}" width="390" height="390" onerror="javascript:this.src='{{asset('upload/1.jpg')}}';"/></a></div>
             @else
             <div id="tsImgS"><a href="{{$good->pic}}" title="Images" class="MagicZoom" id="MagicZoom"><img src="{{$good->pic}}" width="390" height="390" onerror="javascript:this.src='{{asset('upload/1.jpg')}}';"/></a></div>
               
            @endif
            <div id="tsPicContainer">
                <div id="tsImgSArrL" onclick="tsScrollArrLeft()"></div>
                <div id="tsImgSCon">
                    <ul>
                    @if(empty($pic))
                        @foreach($pic as $k => $val)
                        <li onclick="showPic({{$loop->iteration-1}})" rel="MagicZoom" class="{{$loop->iteration-1?'':'tsSelectImg'}}"><img src="{{$val->pic}}" tsImgS="{{$val->pic}}" width="79" height="79" /></li>
                       @endforeach
                    @else
                        <li onclick="showPic(1)" rel="MagicZoom" class="tsSelectImg"><img src="{{$good->pic}}" tsImgS="" width="79" height="79" /></li>
                    @endif
                    </ul>
                </div>
                <div id="tsImgSArrR" onclick="tsScrollArrRight()"></div>
            </div>
            <!-- <img class="MagicZoomLoading" width="16" height="16" src="/home/images/loading.gif" alt="Loading..." /> -->               
        </div>
        
        <div class="pro_des">
            <div class="des_name">
                <p>{{$good->gname}}</p>
                
            </div>
            <div class="des_price">
                本店价格：
                @foreach($type as $val)
                    @if($val->id == $gid)
                         <b>￥{{$val->price}}</b>
                    @endif
                 @endforeach
                <br />
            </div>
            <div class="des_choice">
                <span class="fl">型号选择：</span>
                <ul>
                @foreach($type as $val)
                    @if($val->id == $gid)
                    <li class="checked"><a href="{{url('home/goods/'.$id.'?gid='.$val->id)}}">{{$val->type}}<div class="ch_img"></div></a></li>
                    @else
                    <li ><a href="{{url('home/goods/'.$id.'?gid='.$val->id)}}">{{$val->type}}<div class="ch_img"></div></a></li>
                    @endif
                @endforeach
                   
                </ul>
            </div>
            <!-- <div class="des_choice">
                <span class="fl">颜色选择：</span>
                <ul>
                    <li>红色<div class="ch_img"></div></li>
                    <li class="checked">白色<div class="ch_img"></div></li>
                    <li>黑色<div class="ch_img"></div></li>
                </ul>
            </div> -->
            <div class="des_share">
                <div class="d_sh">
                    分享
                    <div class="d_sh_bg">
                        <a href="#"><img src="/home/images/sh_1.gif" /></a>
                        <a href="#"><img src="/home/images/sh_2.gif" /></a>
                        <a href="#"><img src="/home/images/sh_3.gif" /></a>
                        <a href="#"><img src="/home/images/sh_4.gif" /></a>
                        <a href="#"><img src="/home/images/sh_5.gif" /></a>
                    </div>
                </div>
                <div class="d_care"><a onclick="ShowDiv('MyDiv','fade')">关注商品</a></div>
            </div>
            <div class="des_join">
                <div class="j_nums">
                    <input type="text" value="1" name="" class="n_ipt" onkeyup="maxnum(this)" />
                    <input type="button" value="" onclick="addUpdate(jq(this));" class="n_btn_1" />
                    <input type="button" value="" onclick="jianUpdate(jq(this));" class="n_btn_2" />   
                </div>
                <span class="fl">
                <em style="color:#3c3c3c;font-style:normal;line-height:45px;margin:0 10px"> (库存
                    @foreach($type as $val)
                    @if($val->id == $gid)
                       <b id='kc'>{{$val->num}}</b> 
                    @endif
                 @endforeach
                 )</em>
                </span>
                <span class="fl"><a onclick="tjiagwuc({{$id}},{{$gid}})"><img src="/home/images/j_car.png" /></a></span>
            </div>            
        </div>    
        
        <div class="s_brand">
            <div class="s_brand_img"><img src="/home/images/sbrand.jpg" width="188" height="132" /></div>
            <div class="s_brand_c"><a href="#">进入品牌专区</a></div>
        </div>    
                    {{csrf_field()}}
        
        
    </div>
    <div class="content mar_20">
        <div class="l_history">
            <div class="fav_t">用户还喜欢</div>
            <ul>
                <li>
                    <div class="img"><a href="#"><img src="/home/images/his_1.jpg" width="185" height="162" /></a></div>
                    <div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                        <font>￥<span>368.00</span></font> &nbsp; 18R
                    </div>
                </li>
                <li>
                    <div class="img"><a href="#"><img src="/home/images/his_2.jpg" width="185" height="162" /></a></div>
                    <div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                        <font>￥<span>768.00</span></font> &nbsp; 18R
                    </div>
                </li>
                <li>
                    <div class="img"><a href="#"><img src="/home/images/his_3.jpg" width="185" height="162" /></a></div>
                    <div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                        <font>￥<span>680.00</span></font> &nbsp; 18R
                    </div>
                </li>
                <li>
                    <div class="img"><a href="#"><img src="/home/images/his_4.jpg" width="185" height="162" /></a></div>
                    <div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                        <font>￥<span>368.00</span></font> &nbsp; 18R
                    </div>
                </li>
                <li>
                    <div class="img"><a href="#"><img src="/home/images/his_5.jpg" width="185" height="162" /></a></div>
                    <div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                        <font>￥<span>368.00</span></font> &nbsp; 18R
                    </div>
                </li>
            </ul>
        </div>
        <div class="l_list">            
            
            <div class="des_border">
                <div class="des_tit">
                    <ul>
                        <li class="current"><a href="#p_attribute">商品属性</a></li>
                       <!--  <li><a href="#p_details">商品详情</a></li> -->
                        <li><a href="#p_comment">商品评论</a></li>
                    </ul>
                </div>
                <div class="des_con" id="p_attribute">
                    {{$good->descr}}
                                                           
                                            
                        
                </div>
            </div>  
            
            <!-- <div class="des_border" id="p_details">
                <div class="des_t">商品详情</div>
                <div class="des_con">
                    <table border="0" align="center" style="width:745px; font-size:14px; font-family:'宋体';" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="265"><img src="/home/images/de1.jpg" width="206" height="412" /></td>
                        <td>
                            <b>迪奥真我香水(Q版)</b><br />
                            【商品规格】：5ml<br />
                            【商品质地】：液体<br />
                            【商品日期】：与专柜同步更新<br />
                            【商品产地】：法国<br />
                            【商品包装】：无外盒 无塑封<br />
                            【商品香调】：花束花香调<br />
                            【适用人群】：适合女性（都市白领，性感，有女人味的成熟女性）<br />
                        </td>
                      </tr>
                    </table>
                    
                    <p align="center">
                    <img src="/home/images/de2.jpg" width="746" height="425" /><br /><br />
                    <img src="/home/images/de3.jpg" width="750" height="417" /><br /><br />
                    <img src="/home/images/de4.jpg" width="750" height="409" /><br /><br />
                    <img src="/home/images/de5.jpg" width="750" height="409" />
                    </p>
                    
                </div>
            </div>   -->
            
            <div class="des_border" id="p_comment">
                <div class="des_t">商品评论</div>
                
                <table border="0" class="jud_tab" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="175" class="jud_per">
                        <p>80.0%</p>好评度
                    </td>
                    <td width="300">
                        <table border="0" style="width:100%;" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="90">好评<font color="#999999">（80%）</font></td>
                            <td><img src="/home/images/pl.gif" align="absmiddle" /></td>
                          </tr>
                          <tr>
                            <td>中评<font color="#999999">（20%）</font></td>
                            <td><img src="/home/images/pl.gif" align="absmiddle" /></td>
                          </tr>
                          <tr>
                            <td>差评<font color="#999999">（0%）</font></td>
                            <td><img src="/home/images/pl.gif" align="absmiddle" /></td>
                          </tr>
                        </table>
                    </td>
                    <td width="185" class="jud_bg">
                        购买过雅诗兰黛第六代特润精华露50ml的顾客，在收到商品才可以对该商品发表评论
                    </td>
                    <td class="jud_bg">您可对已购买商品进行评价<br /><a href="#"><img src="/home/images/btn_jud.gif" /></a></td>
                  </tr>
                </table>
                
                
                                
                <table border="0" class="jud_list" style="width:100%; margin-top:30px;" cellspacing="0" cellpadding="0">
                  @foreach($comment as $k => $v)
                  <tr valign="top">
                    <td width="160"><img src="{{asset($v->pic)}}" width="20" height="20" align="absmiddle" />&nbsp;{{$v->name}}</td>
                    <td width="180">
                       {{$v->content}}
                    </td>
                    <td>
                       
                        <font color="#999999">{{date('Y-m-d H:i:s',$v->addtime)}}</font>
                    </td>
                  </tr>
                  @endforeach
                 
                </table>

                    
                    
                <div class="pages">
                {{ $comment->fragment('p_comment')->links() }}
                   
                </div>
                
            </div>
            
            
        </div>
    </div>
    
    
    <!--Begin 弹出层-收藏成功 Begin-->
    <div id="fade" class="black_overlay"></div>
    <div id="MyDiv" class="white_content">             
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv('MyDiv','fade')"><img src="/home/images/close.gif" /></span>
            </div>
            <div class="notice_c">
                
                <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td width="40"><img src="/home/images/suc.png" /></td>
                    <td>
                        <span style="color:#3e3e3e; font-size:18px; font-weight:bold;">您已成功收藏该商品</span><br />
                        <a href="#">查看我的关注 >></a>
                    </td>
                  </tr>
                  <tr height="50" valign="bottom">
                    <td>&nbsp;</td>
                    <td><a href="#" class="b_sure">确定</a></td>
                  </tr>
                </table>
                    
            </div>
        </div>
    </div>    
    <!--End 弹出层-收藏成功 End-->
    
    
    <!--Begin 弹出层-加入购物车 Begin-->
    <div id="fade1" class="black_overlay"></div>
    <div id="MyDiv1" class="white_content">             
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv_1('MyDiv1','fade1')"><img src="/home/images/close.gif" /></span>
            </div>
            <div class="notice_c">
                
                <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td width="40"><img src="/home/images/suc.png" /></td>
                    <td>
                        <span style="color:#3e3e3e; font-size:18px; font-weight:bold;">宝贝已成功添加到购物车</span><br />
                        购物车共有（3件）宝贝 &nbsp; &nbsp; 
                    </td>
                  </tr>
                  <tr height="50" valign="bottom">
                    <td>&nbsp;</td>
                    <td><a href="#" class="b_sure">去购物车结算</a><a href="#" class="b_buy">继续购物</a></td>
                  </tr>
                </table>
                    
            </div>
        </div>
    </div>    
    <!--End 弹出层-加入购物车 End-->
    
    
    
    <!--Begin Footer Begin -->
    <div class="b_btm_bg bg_color">
        <div class="b_btm">
            <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="/home/images/b1.png" width="62" height="62" /></td>
                <td><h2>正品保障</h2>正品行货  放心购买</td>
              </tr>
            </table>
            <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="/home/images/b2.png" width="62" height="62" /></td>
                <td><h2>满38包邮</h2>满38包邮 免运费</td>
              </tr>
            </table>
            <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="/home/images/b3.png" width="62" height="62" /></td>
                <td><h2>天天低价</h2>天天低价 畅选无忧</td>
              </tr>
            </table>
            <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
              <tr>
                <td width="72"><img src="/home/images/b4.png" width="62" height="62" /></td>
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
            <div class="b_er_c"><img src="/home/images/er.gif" width="118" height="118" /></div>
            <img src="/home/images/ss.png" />
        </div>
    </div>    
    <div class="btmbg">
        <div class="btm">
            备案/许可证编号：蜀ICP备12009302号-1-www.dingguagua.com   Copyright © 2015-2018 尤洪商城网 All Rights Reserved. 复制必究 , Technical Support: Dgg Group <br />
           
        </div>      
    </div>
    <!--End Footer End -->    
</div>
<script>
    function ShowDiv_1(show_div,bg_div){
        var _token = "{{csrf_token()}}";
        var gid = '{{ $good->id }}';
        $.post('/home/cart',{_token,id:gid})
        document.getElementById(show_div).style.display='block';
        document.getElementById(bg_div).style.display='block' ;
        var bgdiv = document.getElementById(bg_div);
        bgdiv.style.width = document.body.scrollWidth;
        // bgdiv.style.height = $(document).height();
        $("#"+bg_div).height($(document).height());
    };
</script>

</body>
<script src="{{asset('home/js/ShopShow.js')}}"></script>

<script type="text/javascript">
    //判断输入的值小于等于库存值
    function maxnum(obj){
        var clear;
        clearTimeout(clear);
       clear = setTimeout(function(){
        var shurk = parseInt($(obj).val());
        var kuc = parseInt($('#kc').text());
           if(shurk > kuc){
                $(obj).val(kuc);
           }
        },500)
    }

    function tjiagwuc(gid,gmid){
        var num = $('input.n_ipt').val();
       
        $.get('/home/addcat',{num,gid,gmid},function(data){
            layui.use(['form', 'layedit', 'laydate','upload'], function(){
              var form = layui.form
              ,layer = layui.layer
              ,layedit = layui.layedit
              ,laydate = layui.laydate;
              //console.log(data.msg);
              if(data.status=='success'){
                    layer.msg(data.msg);
              }else{
                layer.msg(data.msg,{icon:2});
              }

          })
        },"json")
    }
</script>
@stop