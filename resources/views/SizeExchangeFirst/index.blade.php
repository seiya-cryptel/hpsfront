
@extends('layout')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="well">
    <button type="button" class="hidden-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<small>（安全靴、作業靴、ユニフォームのサイズ交換）</small></button>
    <button type="button" class="visible-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<br><small>（安全靴、作業靴、<br>ユニフォームのサイズ交換）</small></button>     <div class="row col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
    <h4>下記必要項目をご入力いただきまして、手続きをお進めください。<br>
    </h4>
</div>

<form action="/sizeexchangefirst" id="" method="post" accept-charset="utf-8">

    @include('first')

</form>

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
        <br>webフォームをご利用いただけない場合は、お電話にての受付も承っておりますので、<br>
        ミドリ安全.comコールセンター　<span class="glyphicon glyphicon-phone-alt"></span> 0120-310-355（平日9時から16時　土日祝、当社指定休業日を除く）までお気軽にご連絡ください。
        </p>
    </div>
</div>

@endsection
