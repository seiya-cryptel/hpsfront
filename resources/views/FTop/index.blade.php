
@extends('layout')

@section('content')

<div class="jumbotron">
    <h2 class="title hidden-xs">サイズ交換・返品受付システム</h2>
    <h3 class="title visible-xs">ミドリ安全通信販売サイト　交換・返品受付フォーム</h3>
    <p class="lead">商品到着後14日以内にお申し込みください。<br>※15日以上経過した場合は、お受けできませんのでご注意ください。
    <br>対象商品金額が10万円を超える場合は本システムをご利用いただけません。<br>
    コールセンターまでお問合せください。</p>
</div>

<div class="well well-info">
    <button type="button" class="hidden-xs btn btn-info btn-lg btn-block" onclick="location.href='{{ url()->current() . '/sizeexchangefirst/' }}'"><strong>サイズ交換</strong>  　<small>こちらをクリックしてください</small></button>
    <button type="button" class="visible-xs btn btn-info btn-lg btn-block" onclick="location.href='{{ url()->current() . '/sizeexchangefirst/' }}'"><strong>サイズ交換</strong>  　<br><small>こちらをクリックしてください</small></button>
    
    <p class="lead"><br><strong>サイズ交換の場合：安全靴、作業靴、ユニフォームのサイズ交換</strong><br>
    次のページ以降にてサイズ交換可能な商品かをご確認いただきまして手続きをお進めください。<span class="t-red">（※交換対象外の商品もあります）</span>（サイズ交換は初回送料無料にて承ります。）</p>
</div>

<div class="well">
    <button type="button" class="hidden-xs btn btn-warning btn-lg btn-block" onclick="location.href='{{ url()->current() . '/return2first/' }}'"><strong>お客様都合　返品</strong>  　<small>こちらをクリックしてください</small></button>
    <button type="button" class="visible-xs btn btn-warning btn-lg btn-block" onclick="location.href='{{ url()->current() . '/return2first/' }}'"><strong>お客様都合　返品</strong>  　<br><small>こちらをクリックしてください</small></button>
    <p class="lead"><br><strong>お客様都合の場合：イメージと異なる/注文を間違えた/不要となった場合等</strong><br>
                次のページ以降にて返品可能な商品かをご確認いただきまして手続きをお進めください。<span class="t-red">（※返品対象外の商品もあります）</span>
    </p>
</div>

<div class="well">
    <button type="button" class="hidden-xs btn btn-danger btn-lg btn-block" onclick="location.href='{{ url()->current() . '/return1first/' }}'" ><strong>商品不良等</strong>  　<small>こちらをクリックしてください</small></button>
    <button type="button" class="visible-xs btn btn-danger btn-lg btn-block" onclick="location.href='{{ url()->current() . '/return1first/' }}'" ><strong>商品不良等</strong>  　<br><small>こちらをクリックしてください</small></button>

    <p class="lead"><br><strong>当社理由の場合：不良品/備品不備/注文した商品,数量と異なる/破損、傷、汚れ等<br>
        <span class="t-red"><u>ご迷惑をお掛け致しまして誠に申し訳ありません。早急にお取替え又は、ご返金させていただきます。</u></span></strong></p>
</div>

<div class="clearfix"></div>
<div class="row privacy">
    <p class="lead text-left">
    <!--
    <span class="t-red">緊急事態宣言を受けコールセンターの受電業務を停止しております。</span><br>
    ◎お問合せ方法<br>
    メール・お問合せフォームによるお問い合わせを、24時間お受けしておりますので、そちらをご利用ください。<br><br>
    <span class="text_data">■お問合せメール</span>：support@midori-anzen.co.jp <br><br>
    <a href="https://ec.midori-anzen.com/shop/contact/contact.aspx" target="_new"><span class="text_data">■お問合せフォーム</span>はこちら>></a>
    -->
    <br>webシステムをご利用いただけない場合は、お電話にての受付も承っておりますので、<br>
    ミドリ安全.comコールセンター　<span class="glyphicon glyphicon-phone-alt"></span> 0120-310-355（平日9時から16時　土日祝、当社指定休業日を除く）までお気軽にご連絡ください。
    </p>
</div>

@endsection
