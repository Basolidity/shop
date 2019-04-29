

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>{{$title}}</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/admin/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/admin/layuiadmin/style/admin.css" media="all">
  <link rel="stylesheet" href="/admin/layuiadmin/style/login.css" media="all">
</head>
<body>

  <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">

    <div class="layadmin-user-login-main">
      <div class="layadmin-user-login-box layadmin-user-login-header">
        <h2>登录后台</h2>
      </div>

      @if(session('error'))
          <div style="color:red;">
              {{session('error')}}
          </div>
      @endif

      <form action="/admin/dologin" method="post">
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
          <div class="layui-form-item">
            <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
            <input type="text" name="uname"  id="LAY-user-login-username" lay-verify="required" placeholder="用户名" class="layui-input" required>
          </div>
          <div class="layui-form-item">
            <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
            <input type="password" name="pass" id="LAY-user-login-password" lay-verify="required" placeholder="密码" class="layui-input" required>
          </div>
          <div class="layui-form-item">
            <div class="layui-row">
              <div class="layui-col-xs7">
                <label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-vercode"></label>
                <input type="text" name="vercode" id="LAY-user-login-vercode" lay-verify="required" placeholder="图形验证码" class="layui-input" required>
              </div>
              <div class="layui-col-xs5">
                <div style="margin-left: 10px;">
                  <img src="/admin/captcha" alt="" onclick='this.src = this.src+="?1"' class="layadmin-user-login-codeimg" id="LAY-user-get-vercode">
                </div>
              </div>
            </div>
          </div>
          <div class="layui-form-item">

            {{csrf_field()}}
            <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-login-submit">登 录</button>
          </div>
          <div class="layui-trans layui-form-item layadmin-user-login-other">
            <label>社交账号登入</label>
            <a href="javascript:;"><i class="layui-icon layui-icon-login-qq"></i></a>
            <a href="javascript:;"><i class="layui-icon layui-icon-login-wechat"></i></a>
            <a href="javascript:;"><i class="layui-icon layui-icon-login-weibo"></i></a>
            
            <a href="/admin/reg" class="layadmin-user-jump-change layadmin-link">注册帐号</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="/admin/layuiadmin/layui/layui.js"></script>  
  <script>
  layui.config({
    base: '/admin/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'user'], function(){
    var $ = layui.$
    ,setter = layui.setter
    ,admin = layui.admin
    ,form = layui.form
    ,router = layui.router()
    ,search = router.search;

    form.render();

  </script>
</body>
</html>