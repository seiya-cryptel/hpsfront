<?php 
    require_once(env('APPLICATION_PATH') . '/app/Helpers/myform_helper.php');
?>

@extends('layout')

@section('content')

<div class="well">
	<button type="button" class="hidden-xs btn btn-danger btn-lg btn-block" ><strong>商品不良等</strong>  　<small>（不良品/備品不備/注文した商品と異なる/破損、傷、汚れ等）</small></button>
	<button type="button" class="visible-xs btn btn-danger btn-lg btn-block" ><strong>商品不良等</strong>  　<br><small>（不良品/備品不備/<br>注文した商品と異なる/<br>破損、傷、汚れ等）</small></button>


    <script language="javascript" type="text/javascript">
    <!--
    function input_show(Obj,tid)
    { 
        index_nub = Obj.selectedIndex; //選択された項目番号を取得する
        O_value=Obj.options[Obj.selectedIndex].value; //選択された項目の値を取得する

        if(O_value=="-1"){
            $('#'+tid).css('display', '');
        }else{

            $('#'+tid).val('');
            $('#'+tid).css('display', 'none');
        }
    } 
    -->
    </script>

    <?php echo $message->comment1; ?>

    @include('errorList')

    {{ Form::open(['url' => '/' . $urlController . '/confirm/' . $select . '/', 'id' => "f", 'name' => "f", 'method' => "post", 'accept-charset' => "utf-8"]) }}
        <input type="hidden" name="select" value="{{ $select }}" />
        <input type="hidden" name="order_id" value="{{ $order_id }}" />

        <main id="form-main" role="form-main" class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
            <div class="entry-content">
                <div class="form_table">
                    <table>
                    <tr>
                        <th  colspan="3">オーダＩＤ </th>
                        <td  colspan="1">{{ $order_id }}
                        </td>
                    </tr>

                    @foreach ( $orderDetails as $orderDetail )
                        
                    <tr>
                        @if($loop->first)
                        <th rowspan="{{ count($orderDetails) * 3 }}" >商品明細</th>     
                        @endif           
                        <th rowspan="3" class="form_table_no">No.{{ $orderDetail->row_no }}</th>
                        <th>商品名</th>
                        <td >{{ $orderDetail->product_nm }}</td>
                    </tr>

                    <tr>
                        <th >購入数量</th>
                        <td >{{ $orderDetail->amount }}</td>
                    </tr>

                    <tr>
                        <th class="">交換数量</th>
                        <td >
                            <?php
                                $s_no = 's_' . $orderDetail->row_no;
                                $t_no = 't_' . $orderDetail->row_no;
                                if(empty($$s_no))       $$s_no = null;
                                if(empty($$t_no))       $$t_no = null;
                                if(empty($dat_returns)) $dat_returns = null;
                                if(empty($dat_exchange)) $dat_exchange = null;

                                echo show_select_amount(
                                        $select,
                                        $s_no,
                                        old($s_no, $$s_no),
                                        $_POST[$s_no] ?? null,
                                        $orderDetail->amount,
                                        $orderDetail->kbn_return,
                                        $orderDetail->kbn_exchange,
                                        $dat_returns,
                                        $dat_exchange,
                                        'onChange="input_show(this,'."'".$t_no."'".');"'
                                    ); 
                                if($orderDetail->amount >= 10)
                                {
                                    echo show_text_amount(
                                        $select,
                                        $t_no,
                                        old($t_no, $$t_no),
                                        $_POST[$t_no] ?? null,
                                        old($s_no, $$s_no),
                                        $_POST[$s_no] ?? null,
                                        $orderDetail->amount,
                                        $orderDetail->kbn_return,
                                        $orderDetail->kbn_exchange,
                                        $dat_returns,
                                        $dat_exchange
                                    );
                                }
                                if(! empty($msg[$s_no]))   echo show_thismsg($msg[$s_no]);
                                if(! empty($msg[$t_no]))   echo show_thismsg($msg[$t_no]);
                            ?>
                        </td>
                    </tr>

                    @endforeach

                    <tr>
                        <th rowspan="6">集荷先情報</th>
                        <th colspan="2">郵便番号</th>
                        <td >〒<input  name="post1" style="ime-mode: disabled;" type="post1" size="3" id="post1" value="{{ old('post1', $post1 ?? ($_POST['post1'] ?? null)) }}">
                            -<input  name="post2" style="ime-mode: disabled;" type="tel" size="4" id="post2" value="{{ old('post2', $post2 ?? ($_POST['post2'] ?? null)) }}"><span class="notes">（半角数字）　例.486-0012</span>
                            @error('post1')
                                <code>{{ $message }}</code><br>
                            @enderror
                            @error('post2')
                                <code>{{ $message }}</code>
                            @enderror
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">住所</th>
                        <td ><input name="address" type="text" id="address" value="{{ old('address', $address ?? ($_POST['address'] ?? null)) }}" MAXLENGTH="200"  size="80" >
                            @error('address')
                                <code>{{ $message }}</code>
                            @enderror
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">会社名</th>
                        <td ><input name="company" type="text" id="company" value="{{  old('company', $company ?? ($_POST['company'] ?? null)) }}" MAXLENGTH="200"  size="80" >
                            @error('company')
                                <code>{{ $message }}</code>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">部署名</th>
                        <td ><input name="division" type="text" id="division" value="{{ old('division', $division ?? ($_POST['division'] ?? null)) }}" MAXLENGTH="200"  size="80" >
                            @error('division')
                                <code>{{ $message }}</code>
                            @enderror
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">電話番号</th>
                        <td  ><input name="shipping_tel" type="tel" id="shipping_tel" value="{{ old('shipping_tel', $shipping_tel ?? ($_POST['shipping_tel'] ?? null)) }}"  MAXLENGTH="20" size="20"   style="ime-mode: inactive;" >
                            <span class="notes">（半角数字）例.03-1234-5678</span>
                            @error('shipping_tel')
                                <code>{{ $message }}</code>
                            @enderror
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">集荷先名</th>
                        <td ><input name="shipping_name" type="text" id="shipping_name" value="{{ old('shipping_name', $shipping_name ?? ($_POST['shipping_name'] ?? null)) }}" MAXLENGTH="100"  size="80" >
                            @error('shipping_name')
                                <code>{{ $message }}</code>
                            @enderror
                        </td>
                    </tr>

                    @if($select == 2)
                    <tr>
                        <th   colspan="3">集荷日情報</th>
                        <td  colspan="1"><span class="notes">※お手元の商品を配送会社より伝票をお持ちしてお引取りに伺わせていただきます。入力翌日より、当社2営業日目以降にて日程よりご都合の宜しい日時をご指定下さい。</span><br>
                        日程{{ Form::select('pickup_date', $pickupDays, old('pickup_date', $pickup_date ?? ($_POST['pickup_date'] ?? null)), []) }}<br>
                        @error('pickup_date')
                            <code>{{ $message }}</code><br>
                        @enderror
                        時間{{ Form::select('pickup_time', $pickupTimes, old('pickup_time', $pickup_time ?? ($_POST['pickup_time'] ?? null)), []) }}<br>
                        @error('pickup_time')
                            <code>{{ $message }}</code>
                        @enderror
                        </td>
                    </tr>
                    @endif
                </table>

                    <div class="form_table">
                        <table>
                        <tr>
                            <th colspan="2">不良理由/ご意見</th>
                            <td><textarea name="comment" rows="5" id="comment" placeholder="不良個所・現象/ご意見等ございましたらご記入ください。">{{ old('comment', $_POST['comment'] ?? null) }}</textarea>
                                @error('comment')
                                    <code>{{ $message }}</code>
                                @enderror
                            </td>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <div class="clearfix"></div>

        <?php echo $message->comment2; ?>

        <div class="hidden-xs text-center" style="margin-top:30px;">
            <button type="button" class="btn btn-success btn-lg "  onclick="location.href='/{{  $urlController }}/';" >前のページに戻る</button>
            <button type="submit" class="btn btn-success btn-lg " >　　　次へ　　　</button>
        </div>
        <div class="visible-xs text-center" style="margin-top:30px;">
            <button type="button" class="btn btn-success btn-lg "  onclick="location.href='/{{  $urlController }}/';" >前のページに戻る</button><br><br>
            <button type="submit" class="btn btn-success btn-lg " >　　　次へ　　　</button>
        </div>
    {{ Form::close() }}

    <?php echo $message->comment3; ?>

</div>


@endsection
