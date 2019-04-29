<?php
//做支付
function pay(){
    echo "这是支付功能";
}

//发送短信校验码(调用短信接口)
function sendphone($p){
    // echo "this is send phone";
    //初始化必填
    //填写在开发者控制台首页上的Account Sid
    $options['accountsid']='e2c25f0feec2226f22dc90a963f8fa43';
    //填写在开发者控制台首页上的Auth Token
    $options['token']='0bc909e5823fa530fc2d53ff3b6cfe1e';

    //初始化 $options必填
    $ucpass = new Ucpaas($options);
    $appid = "fd0c9a3918424989b5f582e8d73ed2a8";    //应用的ID，可在开发者控制台内的短信产品下查看
    $templateid = "459749";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
    $param = rand(1,10000); //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
    //存储在cookie
    \Cookie::queue('fcode',$param,1);
    $mobile = $p;
    $uid = "";

    //70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。

    echo $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);
}
 ?>