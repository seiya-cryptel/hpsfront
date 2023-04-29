
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
            <td colspan="2" class="text-left">202302047　（印刷不可能な場合には受付番号を「交換・返品確認書」へご記入ください。）
            </td>
        </tr>
        <tr>
            <th >オーダＩＤ </th>
            <td colspan="2" class="text-left">9911124275						</td>
        </tr>
        <tr>
            <th >お客様名 </th>
            <td  colspan="2" class="text-left">test3　様
            </td>
        </tr>
        <tr>
            <th >メールアドレス</th>
            <td  colspan="2" class="text-left">seiya@cryptel.co.jp　
            </td>
        </tr>
        <tr>
            <th rowspan="1">対象商品</th>
            <td  class="text-left">
                NO.1 2105105405 男女兼用　静電作業靴　エレパス　Ｍ１０３　ホワイト　２３．０ｃｍ						
            </td>
            <td  class="text-left">
                数量：1<br>
            </td>
        </tr>
        <tr>
            <th >返品理由/ご意見</th>
            <td  colspan="2" class="text-left">小さいサイズ　
            </td>
        </tr>

        <tr>
            <th >集荷先情報</th>
            <td  colspan="2" class="text-left">〒333-3333<br>大阪府八尾市　3333333<br>
                株式会社bbb test3<br>							aaa test3 様<br>電話番号：00000000003						
            </td>
        </tr>

        <tr>
            <th >集荷日時</th>
            <td  colspan="2" class="text-left">
                2023年4月23日　　 午前中（9時～12時）						
            </td>
        </tr>

        </table>

    </div>

    <div class="visible-xs row">
        <h2 class="text-left">●受付内容</h2>
        <table class="table table-striped table-bordered table-condensed" >
        <tr>
            <th >①受付番号 </th>
            <td colspan="2" class="text-left">202302047　（印刷不可能な場合には受付番号を「交換・返品確認書」へご記入ください。）
            </td>
        </tr>
        <tr>
            <th >オーダＩＤ </th>
            <td colspan="2" class="text-left">9911124275						

            </td>
        </tr>
        <tr>
            <th >お客様名 </th>
            <td  colspan="2" class="text-left">test3　様
            </td>
        </tr>
        <tr>
            <th >メールアドレス</th>
            <td  colspan="2" class="text-left">seiya@cryptel.co.jp　
            </td>
        </tr>
        <tr>
            <td  class="text-left">
                    NO.1 2105105405 男女兼用　静電作業靴　エレパス　Ｍ１０３　ホワイト　２３．０ｃｍ						
            </td>
            <td  class="text-left">
                    数量：1<br>
            </td>
        </tr>
        <tr>
            <th >返品理由/ご意見等</th>
            <td  colspan="2" class="text-left">小さいサイズ　
            </td>
        </tr>
        <tr>
            <th >集荷先情報</th>
            <td  colspan="2" class="text-left">〒333-3333<br>大阪府八尾市　3333333<br>
                株式会社bbb test3<br>							aaa test3 様<br>電話番号：00000000003						
            </td>
        </tr>
        <tr>
            <th >集荷日時</th>
            <td  colspan="2" class="text-left">
                    2023年4月23日　　 午前中（9時～12時）						
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
