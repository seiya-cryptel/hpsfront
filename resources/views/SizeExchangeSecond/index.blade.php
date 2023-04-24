
@extends('layout')

@section('content')

<div class="well">

    <h1>〇サイズ交換について</h1>

    <button type="button" class="hidden-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<small>（安全靴、作業靴、ユニフォームのサイズ交換）</small></button>
    <button type="button" class="visible-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<br><small>（安全靴、作業靴、<br>ユニフォームのサイズ交換）</small></button>

    <ol style="margin-top:30px;">
        <li>次のページにてサイズ交換確認手続きを進めてください。</li>
        <li>サイズ交換が可能な場合には、サイズ交換受付用紙を印刷または、受付番号を商品と同梱されていました「交換・返品確認書」に記入の上、商品と一緒にお送りください。</li>
        <li>初回のサイズ交換につきましては、当社にて送料を負担させていただきますので、次のページにて入力翌日より当社2営業日目以降でお引取りの日時をご指定ください。<br>
            2回目以降交換をご希望の場合は、お客様都合の返品より登録いただきまして、送料はお客様負担で当社返品センターまで送付ください。</li>
        <li>交換商品の在庫がない場合には、ご相談の上、ご返金にて手続きをさせていただく場合もございます。</li>
    </ol>

    <div style="
    border: solid 10px #009900;
    padding: 20px;
    border-radius: 20px;
    -moz-border-radius: 20px;
    -webkit-border-radius: 20px;
    ">

        <h4><strong>ミドリ安全株式会社　通信販売サイト　サイズ交換規約</strong></h4>

        サイズ交換が可能な場合は以下のように定められています。<br>
            <ul>
            　<li>清潔な室内（靴の場合は床面）での試着程度で、着用感（汚れ、擦れ、傷、臭い等）が見られず、外箱（袋）やタグ、内装品等が商品到着時のまますべて揃っている状態</li>
            　<li>特定の企業様向けなど、オーダーメイドで作られた商品でない場合</li>
            　<li>当社通信販売webサイトにおいて、返品不可表示されていない商品</li>
            　<li>ワケアリ商品、セール品、在庫限りの商品でない場合</li>
            </ul><br>
        サイズ交換元の商品が当社へ到着した際に商品の状態を確認致しまして、着用感（汚れ、擦れ、傷、臭い等）や欠損が
        　確認出来た場合には、送料お客様負担にて返送させていただく場合がございます。<br>

    </div>
    <br><br>

    <h3 class="text-center">上記規約に同意いただけますか？</h3>

    <div class="hidden-xs text-center" style="margin-top:30px;">
        <button type="submit" class="btn btn-success btn-lg "  onclick="location.href='sizeexchange_second/no/';">いいえ</button>
        <button type="submit" class="btn btn-success btn-lg " onclick="location.href='sizeexchange_second/entry/3/';" >はい</button>
    </div>

    <div class="visible-xs text-center" style="margin-top:30px;">
        <button type="submit" class="btn btn-success btn-lg  btn-block"  onclick="location.href='sizeexchange_second/no/';">いいえ</button>
        <button type="submit" class="btn btn-success btn-lg  btn-block" onclick="location.href='sizeexchange_second/entry/3/';" >はい</button>
    </div>
</div>

@endsection
