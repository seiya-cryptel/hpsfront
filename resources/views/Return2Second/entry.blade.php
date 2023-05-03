<?php 
    require_once(env('APPLICATION_PATH') . '/app/Helpers/myform_helper.php');
?>

@extends('layout')

@section('content')

<div class="well">
    <button type="button" class="btn btn-warning btn-lg btn-block" ><strong>お客様都合　返品</strong></button>

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
                        <th class="">返品数量</th>
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
                                        $$s_no,
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
                                        $$t_no,
                                        $_POST[$t_no] ?? null,
                                        $$s_no,
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
                    </table>

                    <div class="form_table">
                        <table>
                        <tr>
                            <th colspan="2">返品理由/ご意見</th>
                            <td><textarea name="comment" rows="5" id="comment" placeholder="不良個所・現象/ご意見等ございましたらご記入ください。">{{ old('comment') }}</textarea>
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
