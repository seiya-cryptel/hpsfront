
@extends('layout')

@section('content')

<div class="well">
    <button type="button" class="hidden-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<small>（安全靴、作業靴、ユニフォームのサイズ交換）</small></button>
    <button type="button" class="visible-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<br><small>（安全靴、作業靴、<br>ユニフォームのサイズ交換）</small></button>


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

    <div class="row col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
        <h4>対象の商品欄により数量を選択してください。<br>また下段にて集荷先情報の確認、交換理由・ご希望のサイズ等をご入力ください。
        </h4>
    </div>

    <form>
    <main id="form-main" role="form-main" class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
        <div class="entry-content">
            <div class="form_table">
                <table>
                <tr>
                    <th  colspan="3">オーダＩＤ </th>
                    <td  colspan="1"><!-- $order_id; -->
                    </td>
                </tr>

                <tr>
                    <th  rowspan="3" >商品明細</th>
                    <th rowspan="3" class="form_table_no">No.</th>
                    <th>商品名</th>
                    <td ></td>
                </tr>

                <tr>
                    <th >購入数量</th>
                    <td ></td>
                </tr>

                <tr>
		            <th class="">交換数量</th>
                    <td >
                    </td>
                </tr>

                <tr>
                    <th rowspan="6">集荷先情報</th>
                    <th colspan="2">郵便番号</th>
                    <td >〒<input  name="post1" style="ime-mode: disabled;" type="post1" size="3" id="post1" value="">
                        -<input  name="post2" style="ime-mode: disabled;" type="tel" size="4" id="post2" value=""><span class="notes">（半角数字）　例.486-0012</span>
                    </td>
                </tr>

                <tr>
                    <th colspan="2">住所</th>
                    <td ><input name="address" type="text" id="address" value="" MAXLENGTH="200"  size="80" >
                    </td>
                </tr>

                <tr>
                    <th colspan="2">会社名</th>
                    <td ><input name="company" type="text" id="company" value="" MAXLENGTH="200"  size="80" >
                    </td>
                </tr>
                <tr>
                    <th colspan="2">部署名</th>
                    <td ><input name="division" type="text" id="division" value="" MAXLENGTH="200"  size="80" >
                    </td>
                </tr>

                <tr>
                    <th colspan="2">電話番号</th>
                    <td  ><input name="shipping_tel" type="tel" id="shipping_tel" value=""  MAXLENGTH="20" size="20"   style="ime-mode: inactive;" >
                        <span class="notes">（半角数字）例.03-1234-5678</span>
                    </td>
                </tr>

                <tr>
                    <th colspan="2">集荷先名</th>
                    <td ><input name="shipping_name" type="text" id="shipping_name" value="" MAXLENGTH="100"  size="80" >
                    </td>
                </tr>

                <tr>
                    <th   colspan="3">集荷日情報</th>
                    <td  colspan="1"><span class="notes">※お手元の商品を配送会社より伝票をお持ちしてお引取りに伺わせていただきます。入力翌日より、当社2営業日目以降にて日程よりご都合の宜しい日時をご指定下さい。</span><br>
                    日程<br>
                    時間<br>
                    </td>
                </tr>
                </table>

                <div class="form_table">
                    <table>
                    <tr>
                        <th colspan="2">交換理由・希望サイズ</th>
                        <td><textarea name="comment" rows="5" id="comment" placeholder="交換理由・希望サイズをご記入ください。&#13;&#10;（例）小さかったので、H700N　24.5cm->25.0cmへ交換"></textarea>
                        </td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="clearfix"></div>

    <div class="hidden-xs text-center" style="margin-top:30px;">
        <button type="button" class="btn btn-success btn-lg "  onclick="location.href='/sizeexchange_second/';" >前のページに戻る</button>
        <button type="submit" class="btn btn-success btn-lg " >　　　次へ　　　</button>
    </div>
    <div class="visible-xs text-center" style="margin-top:30px;">
        <button type="button" class="btn btn-success btn-lg "  onclick="location.href='/sizeexchange_second/';" >前のページに戻る</button><br><br>
        <button type="submit" class="btn btn-success btn-lg " >　　　次へ　　　</button>
    </div>
    </form>

</div>


@endsection
