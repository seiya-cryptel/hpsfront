
@extends('layout')

@section('content')

<div class="well">
	<button type="button" class="hidden-xs btn btn-danger btn-lg btn-block" ><strong>商品不良等</strong>  　<small>（不良品/備品不備/注文した商品と異なる/破損、傷、汚れ等）</small></button>
	<button type="button" class="visible-xs btn btn-danger btn-lg btn-block" ><strong>商品不良等</strong>  　<br><small>（不良品/備品不備/<br>注文した商品と異なる/<br>破損、傷、汚れ等）</small></button>

    <?php echo $message->comment1; ?>

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
                @foreach($returns as $no=>$val)
                    {{ $orderDetails[$no]->product_nm }}&emsp;&emsp;&emsp;&emsp;数量：{{ $val }}<br>
                @endforeach
            </td>
        </tr>
        <tr>
            <th >不良理由/ご意見</th>
            <td  class="text-left">
                <?php echo nl2br($request['comment']); ?>
            </td>
        </tr>
        <tr>
            <th >集荷先情報</th>
            <td  class="text-left">
                〒{{ $request['post1'] }}-{{ $request['post2'] }}<br>
                {{ $request['address'] }}<br>
                @if($request['company'])
                    {{ $request['company'] }}<br>
                @endif
                @if($request['division'])
                    {{ $request['division'] }}<br>
                @endif
                {{ $request['shipping_name'] }} 様<br>
                電話番号：{{ $request['shipping_tel'] }}
            </td>
        </tr>
        @if($select == 2)
        <tr>
            <th >集荷日時</th>
            <td  class="text-left">
                {{ $pickupDays[$request['pickup_date']] }} {{ $pickupTimes[$request['pickup_time']] }}
            </td>
        </tr>
        @endif
        </table>

    </div>

    <div class="visible-xs row ">
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
                @foreach($returns as $no=>$val)
                    {{ $orderDetails[$no]->product_nm }}&emsp;&emsp;&emsp;&emsp;数量：{{ $val }}<br>
                @endforeach
            </td>
        </tr>
        <tr>
            <th >不良理由/ご意見</th>
            <td  class="text-left">
                <?php echo nl2br($request['comment']); ?>
            </td>
        </tr>
        @if($select == 2)
        <tr>
            <th >集荷先情報</th>
            <td  class="text-left">
                〒{{ $request['post1'] }}-{{ $request['post2'] }}<br>
                {{ $request['address'] }}<br>
                @if($request['company'])
                    {{ $request['company'] }}<br>
                @endif
                @if($request['division'])
                    {{ $request['division'] }}<br>
                @endif
                {{ $request['shipping_name'] }} 様<br>
                電話番号：{{ $request['shipping_tel'] }}
            </td>
        </tr>
        <tr>
            <th >集荷日時</th>
            <td  class="text-left">
                {{ $pickupDays[$request['pickup_date']] }} {{ $pickupTimes[$request['pickup_time']] }}
            </td>
        </tr>
        @endif
        </table>
    </div>

    <div class="clearfix"></div>

    <?php echo $message->comment2; ?>

    <div class="hidden-xs text-center">
        <table border="0" summary="" cellspacing="0" align="center">
            <tr>
                <td>
                    @if($act == 'detail' || $act == 'reg')
                        {{ Form::open(['url' => '/' . $urlController . '/entry/' . $select . '/']) }}
                        {{ Form::hidden('order_id',     $order_id) }}
                        {{ Form::hidden('select', $select) }}
                        {{ Form::hidden('post1', $request->post1) }}
                        {{ Form::hidden('post2', $request->post2) }}
                        {{ Form::hidden('shipping_tel',    $request->shipping_tel) }}
                        {{ Form::hidden('shipping_name',    $request->shipping_name) }}
                        {{ Form::hidden('address', $request->address) }}
                        {{ Form::hidden('company', $request->company) }}
                        {{ Form::hidden('division', $request->division) }}
                        @foreach ($request->input() as $key => $in)
                            @php
                            $h = mb_substr($key, 0, 2);
                            @endphp
                            @if($h == "s_" || $h == "t_")
                            {{ Form::hidden($key, $in) }}
                            @endif
                        @endforeach
                        {{ Form::hidden('comment', $request->comment) }}
                        {{ Form::hidden('pickup_date',    $request->pickup_date) }}
                        {{ Form::hidden('pickup_time', $request->pickup_time) }}
                        &nbsp;<button type="submit" class="btn btn-success btn-lg " >訂正する</button>
                        @if($act == 'detail')
                            &nbsp;	<input type="button" value="削除" onclick="javascript:confirmDelete();" class="btn btn-default" />
                            &nbsp;	<input type="button" value="前のページに戻る" onClick="history.back()" class="btn btn-default" />
                        @endif
                        {{ Form::close() }}
                    @endif
                </td>
                <td>
                    @if($act == 'reg')
                        {{ Form::open(['url' => '/' . $urlController . '/reg/' . $select . '/']) }}
                        {{ Form::hidden('order_id',     $order_id) }}
                        {{ Form::hidden('select', $select) }}
                        {{ Form::hidden('post1', $request->post1) }}
                        {{ Form::hidden('post2', $request->post2) }}
                        {{ Form::hidden('shipping_tel',    $request->shipping_tel) }}
                        {{ Form::hidden('shipping_name',    $request->shipping_name) }}
                        {{ Form::hidden('address', $request->address) }}
                        {{ Form::hidden('company', $request->company) }}
                        {{ Form::hidden('division', $request->division) }}
                        @foreach ($request->input() as $key => $in)
                            @php
                            $h = mb_substr($key, 0, 2);
                            @endphp
                            @if($h == "s_" || $h == "t_")
                            {{ Form::hidden($key, $in) }}
                            @endif
                        @endforeach
                        {{ Form::hidden('comment', $request->comment) }}
                        {{ Form::hidden('pickup_date',    $request->pickup_date) }}
                        {{ Form::hidden('pickup_time', $request->pickup_time) }}
                    &nbsp;<button type="submit" class="btn btn-success btn-lg " >受付表発行（確認メール送信）</button>
                        {{ Form::close() }}
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="visible-xs text-center">
        <table border="0" summary="" cellspacing="0" align="center">
            <tr>
                <td>
                    @if($act == 'detail' || $act == 'reg')
                    {{ Form::open(['url' => '/' . $urlController . '/entry/' . $select . '/']) }}
                    {{ Form::hidden('order_id',     $order_id) }}
                    {{ Form::hidden('select', $select) }}
                    {{ Form::hidden('post1', $request->post1) }}
                    {{ Form::hidden('post2', $request->post2) }}
                    {{ Form::hidden('shipping_tel',    $request->shipping_tel) }}
                    {{ Form::hidden('shipping_name',    $request->shipping_name) }}
                    {{ Form::hidden('address', $request->address) }}
                    {{ Form::hidden('company', $request->company) }}
                    {{ Form::hidden('division', $request->division) }}
                    @foreach ($request->input() as $key => $in)
                        @php
                        $h = mb_substr($key, 0, 2);
                        @endphp
                        @if($h == "s_" || $h == "t_")
                        {{ Form::hidden($key, $in) }}
                        @endif
                    @endforeach
                    {{ Form::hidden('comment', $request->comment) }}
                    {{ Form::hidden('pickup_date',    $request->pickup_date) }}
                    {{ Form::hidden('pickup_time', $request->pickup_time) }}
                    &nbsp;<button type="submit" class="btn btn-success btn-lg " >訂正する</button>
                    @if($act == 'detail')
                        &nbsp;	<input type="button" value="削除" onclick="javascript:confirmDelete();" class="btn btn-default" />
                        &nbsp;	<input type="button" value="前のページに戻る" onClick="history.back()" class="btn btn-default" />
                    @endif
                    {{ Form::close() }}
                @endif
                </td>
                <td>
                    @if($act == 'reg')
                        {{ Form::open(['url' => '/' . $urlController . '/reg/' . $select . '/']) }}
                        {{ Form::hidden('order_id',     $order_id) }}
                        {{ Form::hidden('select', $select) }}
                        {{ Form::hidden('post1', $request->post1) }}
                        {{ Form::hidden('post2', $request->post2) }}
                        {{ Form::hidden('shipping_tel',    $request->shipping_tel) }}
                        {{ Form::hidden('shipping_name',    $request->shipping_name) }}
                        {{ Form::hidden('address', $request->address) }}
                        {{ Form::hidden('company', $request->company) }}
                        {{ Form::hidden('division', $request->division) }}
                        @foreach ($request->input() as $key => $in)
                            @php
                            $h = mb_substr($key, 0, 2);
                            @endphp
                            @if($h == "s_" || $h == "t_")
                            {{ Form::hidden($key, $in) }}
                            @endif
                        @endforeach
                        {{ Form::hidden('comment', $request->comment) }}
                        {{ Form::hidden('pickup_date',    $request->pickup_date) }}
                        {{ Form::hidden('pickup_time', $request->pickup_time) }}
                    &nbsp;<button type="submit" class="btn btn-success btn-lg " >受付表発行（確認メール送信）</button>
                        {{ Form::close() }}
                    @endif
                </td>
            </tr>
        </table>

    </div>

    <?php echo $message->comment3; ?>

</div>


@endsection
