
@extends('layout')

@section('content')

<div class="well">
    <button type="button" class="hidden-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<small>（安全靴、作業靴、ユニフォームのサイズ交換）</small></button>
    <button type="button" class="visible-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<br><small>（安全靴、作業靴、<br>ユニフォームのサイズ交換）</small></button>

    {{ $message->comment1 }}

    <div class="clearfix"></div>
    <br><br>

    <div class="hidden-xs row privacy center-block">
        <h2 class="text-left"><span class="t-red">●受付内容</span></h2>
            <table class="table table-striped table-bordered table-condensed" >
            <tr>
                <th >オーダＩＤ </th>
                <td class="text-left">{{ $order_id }}
                </td>
            </tr>
            <tr>
                <th >ご注文者様 </th>
                <td  class="text-left">{{ $order->order_name }}　様
                </td>
            </tr>
            <tr>
                <th >メールアドレス</th>
                <td  class="text-left">{{ $accept->email }}　
                </td>
            </tr>
            <tr>
                <th >対象商品</th>
                <td  class="text-left">
                <br>
                </td>
            </tr>
            <tr>
                <th >希望交換サイズ/ご意見等</th>
                <td  class="text-left">　
                </td>
            </tr>
            <tr>
                <th >集荷先情報</th>
                <td  class="text-left">〒<br><br>
 様<br>電話番号：
                </td>
            </tr>
            <tr>
                <th >集荷日時</th>
                <td  class="text-left">
                </td>
            </tr>
            </table>

    </div>

    <div class="visible-xs row ">
        <h2 class="text-left"><span class="t-red">●受付内容</span></h2>
        <table class="table table-striped table-bordered table-condensed" >
        <tr>
            <th >オーダＩＤ </th>
            <td class="text-left">
            </td>
        </tr>
        <tr>
            <th >ご注文者様 </th>
            <td  class="text-left">　様
            </td>
        </tr>
        <tr>
            <th >メールアドレス</th>
            <td  class="text-left">　
            </td>
        </tr>
        <tr>
            <th >対象商品</th>
            <td  class="text-left">
            </td>
        </tr>
        <tr>
            <th >不良理由/ご意見</th>
            <td  class="text-left">　
            </td>
        </tr>

        <tr>
            <th >集荷先情報</th>
            <td  class="text-left">〒<br>
様<br>電話番号：
            </td>
        </tr>
        <tr>
            <th >集荷日時</th>
            <td  class="text-left">
            </td>
        </tr>
        </table>

    </div>

    <div class="clearfix"></div>

    <div class="hidden-xs text-center">
        <table border="0" summary="" cellspacing="0" align="center">
        <tr>
            <td>
            </td>
            <td>
            </td>
        </tr>
        </table>
    </div>

    <div class="visible-xs text-center">

    </div>

</div>


@endsection
