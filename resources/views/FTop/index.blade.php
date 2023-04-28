
@extends('layout')

@section('content')

<?php echo $message->comment1; ?>

<div class="well well-info">
    <button type="button" class="hidden-xs btn btn-info btn-lg btn-block" onclick="location.href='{{ url()->current() . '/sizeexchangefirst/' }}'"><strong>サイズ交換</strong>  　<small>こちらをクリックしてください</small></button>
    <button type="button" class="visible-xs btn btn-info btn-lg btn-block" onclick="location.href='{{ url()->current() . '/sizeexchangefirst/' }}'"><strong>サイズ交換</strong>  　<br><small>こちらをクリックしてください</small></button>
    
    <?php echo $message->comment3; ?>
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

    <?php echo $message->comment2; ?>
</div>

<div class="clearfix"></div>
<?php echo $message->comment7; ?>

@endsection
