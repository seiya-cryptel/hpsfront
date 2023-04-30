
@extends('layout')

@section('content')

<div class="well content-print">
    <button type="button" class="btn btn-warning btn-lg btn-block" ><strong>お客様都合　返品</strong></button>


<script language="javascript" type="text/javascript">
<!--

-->
</script>

    <?php echo $message->comment1; ?>

    <div class="text-left" style="margin-top:30px;">
        <button type="button" class="hidden-xs btn btn-success  btn-lg hidden-print"   onClick="Javascript:window.print();" >受付表印刷</button>
        <div class="pull-right"><?php echo $barcode; ?></div>
    </div>

    <div class="clearfix "></div>
    <br><br>
    <div class="hidden-xs row privacy center-block">
        <h2 class="text-left">●受付内容</h2>
        <table class="table table-striped table-bordered table-condensed" >
            <tr>
                <th >①受付番号 </th>
                <td colspan="2" class="text-left">{{ $accept->accept_no }}　（印刷不可能な場合には受付番号を「交換・返品確認書」へご記入ください。）
                </td>
            </tr>
            <tr>
                <th >オーダＩＤ </th>
                <td colspan="2" class="text-left">{{ $order_id }}</td>
            </tr>
            <tr>
                <th >お客様名 </th>
                <td  colspan="2" class="text-left">{{ $accept->name }}　様
                </td>
            </tr>
            <tr>
                <th >メールアドレス</th>
                <td  colspan="2" class="text-left">{{ $accept->email }}　
                </td>
            </tr>
            @foreach($returns as $no => $val)
            <tr>
                @if($loop->first)
                {
                    <th rowspan="{{ count($returns) }}">対象商品</th>
                }
                @endif
                <td  class="text-left">
                    {{ $orderDetails[$no]->product_nm }}
                </td>
                <td  class="text-left">
                    数量：{{ $val }}<br>
                </td>
            </tr>
            @endforeach
            <tr>
                <th >返品理由/ご意見等</th>
                <td  colspan="2" class="text-left">{{ nl2br($accept->comment) }}
                </td>
            </tr>

        </table>

    </div>

    <div class="visible-xs row">
        <h2 class="text-left">●受付内容</h2>
        <table class="table table-striped table-bordered table-condensed" >
            <tr>
                <th >①受付番号 </th>
                <td colspan="2" class="text-left">{{ $accept->accept_no }}　（印刷不可能な場合には受付番号を「交換・返品確認書」へご記入ください。）
                </td>
            </tr>
            <tr>
                <th >オーダＩＤ </th>
                <td colspan="2" class="text-left">{{ $order_id }}</td>
            </tr>
            <tr>
                <th >お客様名 </th>
                <td  colspan="2" class="text-left">{{ $accept->name }}　様
                </td>
            </tr>
            <tr>
                <th >メールアドレス</th>
                <td  colspan="2" class="text-left">{{ $accept->email }}　
                </td>
            </tr>
            @foreach($returns as $no => $val)
            <tr>
                @if($loop->first)
                {
                    <th rowspan="{{ count($returns) }}">対象商品</th>
                }
                @endif
                <td  class="text-left">
                    {{ $orderDetails[$no]->product_nm }}
                </td>
                <td  class="text-left">
                    数量：{{ $val }}<br>
                </td>
            </tr>
            @endforeach
            <tr>
                <th >返品理由/ご意見等</th>
                <td  colspan="2" class="text-left">{{ nl2br($accept->comment) }}
                </td>
            </tr>

        </table>
    </div>

    <div class="clearfix"></div>

    <div class="hidden-xs text-center hidden-print" style="margin-top:30px;">
        <button type="button" class="btn btn-success btn-lg "   onClick="Javascript:window.print();" >受付表印刷</button>
    </div>

</div>


@endsection
