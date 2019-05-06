@extends('layout.person.per')
@section('title','尤洪-我的订单')

@section('center')
    <div class="m_right">
    <p>
    </p>
    <div class="mem_tit">我的订单</div>
    <table border="0" class="order_tab" style="width:930px; text-align:center; margin-bottom:30px;" cellspacing="0" cellpadding="0">
        <tr>
            <td width="20%">订单号</td>
            <td width="25%">下单时间</td>
            <td width="15%">订单总金额</td>
            <td width="25%">订单状态</td>
            <td width="15%">操作</td></tr>
        <tr>
            <td>
                <font color="#ff4e00">2015092823056</font></td>
            <td>2015-09-26 16:45:20</td>
            <td>￥456.00</td>
            <td>未确认，未付款，未发货</td>
            <td>取消订单</td></tr>
        
    </table>
    
</div>
@stop