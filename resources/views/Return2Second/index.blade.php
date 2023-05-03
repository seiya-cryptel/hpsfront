
@extends('layout')

@section('content')

<div class="well">

    <?php echo $message->comment1; ?>

    <button type="button" class="btn btn-warning btn-lg btn-block" ><strong>お客様都合　返品</strong></button>

    <?php echo $message->comment2; ?>

    <div class="hidden-xs text-center" style="margin-top:30px;">
        <button type="submit" class="btn btn-success btn-lg "  onclick="location.href='/return2second/no/'">いいえ</button>
        　　<button type="submit" class="btn btn-success btn-lg " onclick="location.href='/return2second/entry/4/'" >はい</button>
    </div>

    <div class="visible-xs text-center" style="margin-top:30px;">
        <button type="submit" class="btn btn-success btn-lg   btn-block"  onclick="location.href='/return2second/no/'">いいえ</button>
        　　<button type="submit" class="btn btn-success btn-lg   btn-block" onclick="location.href='/return2second/entry/4/'" >はい</button>
    </div>
</div>

@endsection
