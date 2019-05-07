@extends('layout.person.per')
@section('title','尤洪-我的订单')

@section('center')
    <div class="m_right">
            <p></p>
            <div class="mem_tit">
                <span class="fr" style="font-size:12px; color:#55555; font-family:'宋体'; margin-top:5px;">共发现{{count($goodsmodel)}}件</span>订单详情
            </div>
            <table border="0" class="order_tab" style="width:930px;" cellspacing="0" cellpadding="0">
              <tr>                                                                                                                                       
                <td align="center" width="420">商品名称</td>
                <td align="center" width="180">型号</td>
                <td align="center" width="180">价格</td>
                 <td align="center" width="180">数量</td>
                <td align="center" width="270">操作</td>
              </tr>
              @foreach($order_info as $k => $v)
              <tr>
                <td style="font-family:'宋体';">
                    <div class="sm_img"><img src="{{$goods[$k]->pic}}" width="48" height="48" /></div>{{$goods[$k]->gname}}
                </td>
                <td align="center">{{$goodsmodel[$k]->type}}</td>
                <td align="center">￥{{$goodsmodel[$k]->price}}</td>
                 <td align="center">{{$v->num}}</td>
                 @if($v->evaluate == 0)
                <td align="center"><a href="{{url('home/my/evaluate/'.$v->id)}}">评价</a>&nbsp; &nbsp;  <!-- <a href="#">删除</a> --></td>
                @else
                 <td align="center"><a href="javascript:void;">已评价</a>&nbsp; &nbsp;  <!-- <a href="#">删除</a> --></td>
                @endif
              </tr>
              @endforeach
            </table>
        </div>
@stop