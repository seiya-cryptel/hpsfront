
@extends('layout')

@section('content')

<div class="well">
    <button type="button" class="btn btn-warning btn-lg btn-block" ><strong>お客様都合　返品</strong></button>

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
                <td class="text-left">{{ $order->order_name }}
                </td>
            </tr>
            <tr>
                <th >メールアドレス </th>
                <td class="text-left">{{ $accept->email }}
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
                <th >返品理由/ご意見</th>
                <td  class="text-left">　
                    {{ nl2br($request['comment']) }}
                </td>
            </tr>
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
                <th >返品理由/ご意見</th>
                <td  class="text-left">　
                    {{ nl2br($request['comment']) }}
                </td>
            </tr>
        </table>
    </div>

    <div class="clearfix"></div>

    <?php echo $message->comment2; ?>

    <div class="hidden-xs text-center">
        <table border="0" summary="" cellspacing="0" align="center">
            <tr>
                <td>

                    @if($act == 'detail' || $act == 'reg')
                        {{-- <input type="submit" value="訂正する" class="btn btn-success btn-lg"  /> --}}
                        <input type="button" value="訂正する" onClick="history.back()" class="btn btn-default btn-lg" />
                        @if($act == 'detail')
                        &nbsp;	<input type="button" value="削除" onclick="javascript:confirmDelete();" class="btn btn-default" />
                        &nbsp;	<input type="button" value="前のページに戻る" onClick="history.back()" class="btn btn-default" />
                        @endif
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
                        {{-- <input type="submit" value="訂正する" class="btn btn-success btn-lg"  /> --}}
                        <input type="button" value="訂正する" onClick="history.back()" class="btn btn-default " />
                        @if($act == 'detail')
                        &nbsp;	<input type="button" value="削除" onclick="javascript:confirmDelete();" class="btn btn-default" />
                        &nbsp;	<input type="button" value="前のページに戻る" onClick="history.back()" class="btn btn-default" />
                        @endif
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
