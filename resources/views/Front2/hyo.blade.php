
@extends('layout')

@section('content')

<div class="well content-print">
    @if($accept["request_content_class"] < 3)
        <button type="button" class="btn btn-danger btn-lg btn-block" ><strong>商品不良等</strong></button>
    @elseif($accept["request_content_class"] == 3)
        <button type="button" class="hidden-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<small>（安全靴、作業靴、ユニフォームのサイズ交換）</small></button>
        <button type="button" class="visible-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<br><small>（安全靴、作業靴、<br>ユニフォームのサイズ交換）</small></button>
    @elseif($accept["request_content_class"] == 4)
        <button type="button" class="btn btn-warning btn-lg btn-block" ><strong>お客様都合　返品</strong></button>
    @endif

    <script language="javascript" type="text/javascript">
    <!--

    -->
    </script>
      
    <div class="text-left" style="margin-top:30px;">
        <button type="button" class="hidden-xs btn btn-success  btn-lg hidden-print" onClick="Javascript:window.print();" >受付表印刷</button>
        <div class="mb-3 pull-right"><?php echo $barcode; ?></div>
    </div>
   
    <div class="clearfix "></div>
    <br><br>
    <div class="row privacy center-block">
        <h2 class="text-left"><span class="t-red">●受付内容</span></h2>
        <table class="table table-striped table-bordered table-condensed" >
            <tr>
                <th width="25%">①受付番号 </th>
                <td colspan="2" class="text-left"><?php echo $accept['accept_no']; ?> 
                </td>
            </tr>
            <tr>
                <th >オーダＩＤ </th>
                <td colspan="2" class="text-left"><?php echo $accept['order_id']; ?>
                </td>
            </tr>
            <tr>
                <th >お客様名 </th>
                <td  colspan="2" class="text-left"><?php echo $accept['name']; ?>　様
                </td>
            </tr>
            <tr>
                <th >メールアドレス</th>
                <td  colspan="2" class="text-left"><?=$accept["email"];?>　
                </td>
            </tr>
            @foreach($returns as $row)
                <tr>
                    @if($loop->first)
                        <th rowspan="{{ count($returns) }}">対象商品</th>
                    @endif
                    <td  class="text-left">
                    NO.{{ $row->row_no }} {{ $row->product_nm }}
                    </td>
                    <td  class="text-left">
                        数量：{{ $row->amount }}<br>
                    </td>
                </tr>
            @endforeach
            <tr>
                <th >交換希望品、ご意見など<br>（お客様ご記入欄）</th>
                <td  colspan="2" class="text-left"><?php echo nl2br($accept->comment); ?>　
                </td>
            </tr>
            <tr>
                <th >対応方法</th>
                <td  colspan="2" class="text-left">{{ $request_method_array[$accept['request_content_class']]; }}　
                </td>
            </tr>
            <tr>
                <th >社内連絡欄</th>
                <td  colspan="2" class="text-left"><?php echo nl2br($accept['comment_cc']); ?>　
                </td>
            </tr>
            <tr>
                <th >集荷先情報</th>
                <td  colspan="2" class="text-left">
                @if($accept['post'] != "-")
                    〒{{ $accept['post']; }}
                @endif
                @if($accept['address'])
                    <br>{{ $accept['address'] }}
                @endif
                @if($accept['company'])
                    <br>{{ $accept['company'] }}
                @endif
                @if($accept['division'])
                    <br>{{ $accept['division'] }}
                @endif
                @if($accept['shipping_name'])
                    <br>{{ $accept['shipping_name'] }} 様
                @endif
                @if($accept['shipping_tel'])
                    <br>電話番号：{{ $accept['shipping_tel'] }}
                @endif
                </td>
            </tr>   
            <tr>
                <th >集荷日時</th>
                <td  colspan="2" class="text-left">
                    {{ $pickup_datetime }}						
                </td>
            </tr>
        </table>
    </div>
   
    <div class="clearfix"></div>   

    <div class="hidden-xs text-center hidden-print" style="margin-top:30px;">
        <button type="button" class="btn btn-success btn-lg " onClick="Javascript:window.print();" >受付表印刷</button>
    </div>
</div>
   
   
   
   @endsection
