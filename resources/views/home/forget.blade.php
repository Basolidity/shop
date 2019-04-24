@extends('layout.home')

@section('title', '尤洪')

@section('nameinfo')

    <!--Begin Header Begin-->
    <div class="soubg">
        <div class="sou">
            <span class="fr">
                <span class="fl">你好，请<a href="Login.html">登录</a>&nbsp; <a href="Regist.html" style="color:#ff4e00;">免费注册</a> </span>
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
            <div class="reg_c">
                <form artion="/home/doregist" method="post" >
                <table border="0" style="width:420px; font-size:14px; margin-top:20px;" cellspacing="0" cellpadding="0">
                  <tr height="50" valign="top">
                    <td width="95">&nbsp;</td>
                    <td>
                        <span class="fl" style="font-size:24px;">找回密码</span>
                        <span class="fr"><a href="/home/login" style="color:#ff4e00;">返回登录</a></span>
                    </td>
                  </tr>
                  <tr height="50">
                    <td align="right"><font color="#ff4e00">*</font>&nbsp;用户名 &nbsp;</td>
                    <td><input type="text" value="" class="l_user" required /></td>
                  </tr>
                  <tr height="50">
                    <td align="right"><font color="#ff4e00">*</font>&nbsp;密码 &nbsp;</td>
                    <td><input type="password" value="" class="l_pwd" required /></td>
                  </tr>
                  <tr height="50">
                    <td align="right"><font color="#ff4e00">*</font>&nbsp;确认密码 &nbsp;</td>
                    <td><input type="password" value="" class="l_pwd" /></td>
                  </tr>
                  <tr height="50">
                    <td align="right"><font color="#ff4e00">*</font>&nbsp;手机 &nbsp;</td>
                    <td><input type="text" value="" class="l_tel" /></td>
                  </tr>
                  <tr height="50">
                    <td align="right"> <font color="#ff4e00">*</font>&nbsp;验证码 &nbsp;</td>
                    <td>
                        <input type="text" value="" class="l_ipt" />
                        <a href="#" style="font-size:12px; font-family:'宋体';">换一张</a>
                    </td>
                  </tr>
                  <tr>
                    
                  <tr height="60">
                    <td>&nbsp;</td>

                    {{csrf_field()}}
                    <td><input type="submit" value="找回密码" class="log_btn" /></td>
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
@stop