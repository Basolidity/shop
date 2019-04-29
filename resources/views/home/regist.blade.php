
@extends('layout.home')

@section('title', '注册尤洪')

@section('nameinfo')

  <style type="text/css">
    .cur{
      border:1px solid red;
    }
    .curs{
      border:1px solid green;
    }
  </style>
  <body>
  <!--Begin Header Begin-->
  <div class="soubg">
      <div class="sou">
          <span class="fr">
              <span class="fl">你好，请<a href="/home/login">登录</a>&nbsp; <a href="/home/regist" style="color:#ff4e00;">免费注册</a> </span>
              <span class="fl">|&nbsp;关注我们：</span>
              <span class="s_sh"><a href="#" class="sh1">新浪</a><a href="#" class="sh2">微信</a></span>
              <span class="fr">|&nbsp;<a href="#">手机版&nbsp;<img src="/home/images/s_tel.png" align="absmiddle" /></a></span>
          </span>
      </div>
  </div>
  <!--End Header End--> 
  <!--Begin Login Begin-->
  <div class="log_bg">    
      <div class="top">
          <div class="logo"><a href="Index.html"><img src="/home/images/logo.png" /></a></div>
      </div>
      <div class="regist">
          <div class="log_img"><img src="/home/images/l_img.png" width="611" height="425" /></div>
          <div class="reg_c container" style="height:500px;">
              <form action="/home/formregist" method="post" id="ff" class="demofrom" >
              @if(session('error'))
               {{session('error')}}
              @endif
              <table border="0" style="width:420px; font-size:14px; margin-top:40px;" cellspacing="0" cellpadding="0">
                <tr height="50" valign="top">
                  <td width="95">&nbsp;</td>
                  <td>
                      <span class="fl" style="font-size:24px;">注册</span>
                      <span class="fr">已有商城账号，<a href="/home/login" style="color:#ff4e00;">我要登录</a></span>
                  </td>
                </tr>
                <tr height="50">
                  <td align="right"><font color="#ff4e00">*</font>&nbsp;用户名 &nbsp;</td>
                  <td><input type="text" name="uname" class="l_user" reminder="5到16位（字母，数字，下划线）" /><span></span></td>
                </tr>
                <tr height="50">
                  <td align="right"><font color="#ff4e00">*</font>&nbsp;密码 &nbsp;</td>
                  <td><input type="password" name="pass" value="" class="l_pwd" reminder="6到16位字符支持（字母，数字，下划线）" /><span></span></td>
                </tr>
                <tr height="50">
                  <td align="right"><font color="#ff4e00">*</font>&nbsp;确认密码 &nbsp;</td>
                  <td><input type="password" name="repass" value="" class="l_pwd"reminder="请输入确认密码" /><span></span></td>
                </tr>
                <tr height="50">
                  <td align="right"><font color="#ff4e00">*</font>&nbsp;手机号 &nbsp;</td>
                  <td><input type="text" name="phone"  class="l_tel" reminder="请输入正确的手机号"  /><span></span></td>
                </tr>
                <tr height="50">
                  <td align="right"> <font color="#ff4e00">*</font>&nbsp;校验码 &nbsp;
                  </td>
                  <td>
                      <input type="text" name="code" value="" class="l_ipt" reminder="请输入正确的校验码" /><span></span>&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="javascript:void(0)" class="btn btn-success" style="margin-left:15px;width:108px;font-size:13px;line-height:30px;" id="ss" >获取校证码</a> 
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td style="font-size:12px; padding-top:20px;">
                      <span style="font-family:'宋体';" class="fl">
                          <label class="r_rad"><input type="checkbox" id="gg" name="gtr"  value="0"/></label><label class="r_txt">我已阅读并接受《用户协议》</label>
                      </span>
                  </td>
                </tr>
                <tr height="60">
                  <td>&nbsp;</td>
                  {{csrf_field()}}
                  <td><input type="submit" value="立即注册" class="log_btn" /></td>
                </tr>
              </table>
              </form>
          </div>
      </div>
  </div>
  <!--End Login End--> 
  <!--Begin Footer Begin-->
  <div class="btmbg">
      <div class="btm">
          备案/许可证编号：蜀ICP备12009302号-1-www.dingguagua.com   Copyright © 2015-2018 尤洪商城网 All Rights Reserved. 复制必究 , Technical Support: Dgg Group <br />
          <img src="/home/images/b_1.gif" width="98" height="33" /><img src="/home/images/b_2.gif" width="98" height="33" /><img src="/home/images/b_3.gif" width="98" height="33" /><img src="/home/images/b_4.gif" width="98" height="33" /><img src="/home/images/b_5.gif" width="98" height="33" /><img src="/home/images/b_6.gif" width="98" height="33" />
      </div>      
  </div>
  <!--End Footer End -->    
  </body>
  <script>
    var PHONE=false;
    var CODE=false;
    // alert($);
    //获取每个input  绑定获取焦点事件
    $("input").focus(function(){
      reminder=$(this).attr('reminder');
      $(this).next("span").css('color','red').html(reminder);
      //添加类样式
      $(this).addClass('cur');
      //移除类样式
      $(this).removeClass('curs');
    });

    //获取用户名 绑定失去焦点事件
    $("input[name = 'uname']").blur(function(){
      u = $(this).val();
      n = $(this);
      //正则匹配用户名   match 匹配不到的话 返回null
      if(u.match(/^\w{5,16}$/) == null){
        $(this).next("span").css('color','red').html('不能空为或格式不正确');
        $(this).addClass('cur');
      }else{
        //发送Ajax 用户名是否存在
        $.get("/home/doregist",{u:u},function(data){
          // alert(data);
          if(data == 1){
            //用户已存在
            n.next("span").css('color','red').html('用户名已存在');
            n.addClass('cur');
          }else{
            n.next("span").css('color','green').html('用户名可用');
            n.addClass('curs');
          }
        });
      }
    });

    //获取密码 绑定失去焦点事件
    $("input[name = 'pass']").blur(function(){
      pa = $(this).val();
      //正则匹配密码 match 匹配不到的话 返回null
      if(pa.match(/^[\w_-]{6,16}$/)==null){
        $(this).next("span").css("color","red").html('不能为空或格式不正确');
        $(this).addClass('cur');
      }else{
        $(this).next("span").html('');
        $(this).removeClass('cur');
      }
    });

    //获取确认密码 绑定失去焦点事件
    $("input[name = 'repass']").blur(function(){
      rp = $(this).val();
      r = $(this);
      //正则匹配密码 match 匹配不到的话 返回null
      if(rp.match(/^[\w_-]{6,16}$/)==null){
        $(this).next("span").css("color","red").html('不能为空或格式不正确');
        $(this).addClass('cur');
      }else{
        $(this).next("span").html('');
        $(this).removeClass('cur');
      }
      //对比两次密码
      if(!($("input[name = 'pass']").val()==$("input[name = 'repass']").val())){ 
        r.next("span").css("color","red").html('两次密码必须一致');
        r.addclass('cur');
      }

    });

    //获取手机号 绑定失去焦点事件
    $("input[name = 'phone']").blur(function(){
      p = $(this).val();
      o = $(this);
      //正则匹配 match 匹配不到的话 返回null
      if(p.match(/^\d{11}$/)==null){
        $(this).next("span").css("color",'red').html('不能为空或格式不正确');
        $(this).addClass('cur');
        PHONE=false;
      }else{
        //判断手机号码是否重复
        $.get("/home/checkphone",{p:p},function(data){
          // alert(data);
          if(data==1){
            //手机号码已经注册
            o.next("span").css("color",'red').html('手机号已经注册');
            o.addClass('cur');
            //把获取校验码按钮 设置禁用
            $("#ss").attr('disabled',true);
            PHONE=false;
          }else{
            //手机号码可以使用
            o.next("span").css("color",'green').html('手机号可用');
            o.addClass('curs');
            //把获取校验码按钮 设置激活
            $("#ss").attr('disabled',false);
            PHONE=true;
          }

        });
      }
    });

    //获取发送短信校验码按钮 绑定单击事件
    $("#ss").click(function(){
      t = $(this);
      //获取注册的手机号
      pp = $("input[name='phone']").val();
      //Ajax
      $.get("/home/codephone",{pp:pp},function(data){
        data=JSON.parse(data);
        if(data.code == 000000){
          m = 60;
          //定时器
          mytime = setInterval(function(){
            m--;
            //m赋值按钮
            t.html(m+"秒后重新发送");
            t.attr('disabled',true);
            //判断
            if(m == 0){
              //清除定时器
              clearInterval(mytime);
              t.html("重新发送");
              t.attr('disabled',false);
            }
          },1000);
        }
      });
    });

    //获取输入验证码input
   $("input[name='code']").blur(function(){
    c = $(this);
    //获取输入的校验码
    code = $(this).val();
    //Ajax
    $.get("/home/checkcode",{code:code},function(data){
      if(data==1){
        //校验码一致
        c.next("span").css('color','green').html('校验码一致');
        c.addClass('curs');
        CODE=true;
      }else if(data==2){
        //校验码不一致
        c.next("span").css('color','red').html('校验码有误');
        c.addClass('cur');
        CODE=false;
      }else if(data==3){
        //输入校验码为空
        c.next("span").css('color','red').html('校验码为空');
        c.addClass('cur');
        CODE=false;
      }else if(data==4){
        //验证码过期
        c.next("span").css('color','red').html('校验码已经过期');
        c.addClass('cur');
        CODE=false;
      }
    });
   });

   $('#gg').click(function(){
      if($(this).val()==0){
         $(this).val('1');
      }else{
        $(this).val('0');
      }
   })

   //表单提交
   $("#ff").submit(function(){
    // console.log($("#gg").val());
    //trigger 某个元素触发某个事件
    $("input").trigger("blur");
    if(PHONE && CODE ){
      return true;//成功提交
    }else{
      return false;
    }
   //判断是否点击我已阅读并接受《用户协议》 
   if($("input[name = 'gtr']").val()=="0"){
     return false;
   }
   });
   
  </script>
@stop