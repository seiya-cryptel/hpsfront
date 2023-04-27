
@extends('layout')

@section('content')

<div class="well">

    <?php echo $message->comment1; ?>

    <button type="button" class="hidden-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<small>（安全靴、作業靴、ユニフォームのサイズ交換）</small></button>
    <button type="button" class="visible-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<br><small>（安全靴、作業靴、<br>ユニフォームのサイズ交換）</small></button>

    <?php echo $message->comment2; ?>

    <div class="hidden-xs text-center" style="margin-top:30px;">
        <button type="submit" class="btn btn-success btn-lg "  onclick="location.href='/sizeexchangesecond/no/';">いいえ</button>
        <button type="submit" class="btn btn-success btn-lg " onclick="location.href='/sizeexchangesecond/entry/3/';" >はい</button>
    </div>

    <div class="visible-xs text-center" style="margin-top:30px;">
        <button type="submit" class="btn btn-success btn-lg  btn-block"  onclick="location.href='/sizeexchangesecond/no/';">いいえ</button>
        <button type="submit" class="btn btn-success btn-lg  btn-block" onclick="location.href='/sizeexchangesecond/entry/3/';" >はい</button>
    </div>
</div>

@endsection
