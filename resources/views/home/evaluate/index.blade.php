@extends('layout.person.pertwo')
@section('title','尤洪-我的订单')

@section('center')
<script type="text/javascript" src="{{asset('lib/layui2/layui.js')}}"></script>
<link type="text/css" rel="stylesheet" href="{{asset('css/jd2.css')}}" >
 <link  href="{{asset('lib/layui2/css/layui.css')}}">
    
    <div class="m_right">
            
<div id="container">
    <div class="w">
        <div class="mycomment-detail">
            <div class="detail-hd" id="o-info-orderinfo" oid="85864640632" payid="4" ot="0" shipmentid="70" venderid="32+ro+cdrp0=" iscarshoporder="">
                <div class="orderinfo">
                            <h3 class="o-title">评价产品</h3>
                </div>
                
            </div>
            <div class="mycomment-form">
                
        <div class="form-part1">

        <div class="f-cutline"></div>
        <div class="f-item f-goods product-100002287620" voucherstatus="0" catefi="670" catese="699" cateth="700">
            <div class="fi-info">
                <div class="comment-goods">
                    <div class="p-img"><a clstag="pageclick|keycount|fabupingjia_201608055|2" href="{{url('home/goods/'.$order_info->gid)}}" target="_blank">
                    <img src="{{$goods->pic}}" alt="">
                    </a></div>
                    <div class="p-name"><a clstag="pageclick|keycount|fabupingjia_201608055|3" href="{{url('home/goods/'.$order_info->gid)}}" target="_blank">{{$goods->gname}}</a></div>
                    <div class="p-price"><strong>￥{{$goodsmodel->price}}</strong></div>
                    <div class="p-attr">{{$goodsmodel->type}} </div>
                </div>
            </div>
            <div class="fi-operate">
                <div class="fop-item fop-star   z-tip-warn">
                    <div class="fop-label">商品评分</div>
                    <div class="fop-main">
                        
                        <div style="margin-top:-12px;"><div id="test6"><input type="hidden" name="star" value="5"></div></div>
                        <input type="hidden" name="star" value="5">
                    </div>
                    <div class="fop-tip"><i class="tip-icon"></i><em class="tip-text"></em></div>
                </div>
                
                <div class="fop-item ">
                    <div class="fop-label">评价晒单</div>
                    <div class="fop-main">
                        <div class="f-textarea">
                            <textarea name="content" id="" placeholder="分享体验心得，给万千想买的人一个参考~"></textarea>
                            <div class="textarea-ext">还可输入500字</div>
                        </div>
                        
                    </div>
                    <div class="fop-tip"><i class="tip-icon"></i><em class="tip-text"></em></div>
                </div>
                
            </div>
        </div>
    </div>
       
        
        
        <div class="f-btnbox"><form lay-filter="example">
                    <a href="javascript:;" onclick="pinglun()"  clstag="pageclick|keycount|fabupingjia_201608055|1" class="btn-submit" lay-filter="demo1">发表</a>
                    </form>
                </div>  
        </div>

                    
    </div>
    </div>
    </div>
</div>

 <script type="text/javascript" src="{{asset('home/js/jquery-1.8.2.min.js')}}"></script>    
<script>
  layui.use(['form','rate'], function(){
  
  var rate = layui.rate;
  var $ = layui.jquery;
    rate.render({
    elem: '#test6'
    ,value: 5
    ,text: true
    ,setText: function(value){
      this.span.text(value);
      $('input[name="star"]').val(value);
    }
  })

    
})

  function pinglun(){
     var content = $('textarea[name="content"]').val();
     if(content.length < 10){
        alert('评论必须大于10个字符');
        return false;
     }
    var _token = "{{csrf_token()}}";
    var gid = "{{$order_info->gid}}";
    var uid = "{{$order_info->uid}}";
    var id = "{{$order_info->id}}"
    var star = $('input[name="star"]').val();
   
    $.ajax({
                          type:'POST',
                          url:'/home/my/addevaluate',
                          datatype:'json',
                          data:{_token,star,content,gid,uid,id},
                          success:function(res){
                           // console.log(res);
                            if(res.status == 'success'){
                               //layer.msg(res.msg);
                               location.href="{{url('/home/person')}}";
                            }else{
                               // layer.msg(res.msg,{icon:2});
                               alert(res.msg);
                            }
                          }
                      })
  }
</script>
@stop