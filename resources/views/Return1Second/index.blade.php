
@extends('layout')

@section('content')

<div class="well">

    <?php echo $message->comment1; ?>

    <button type="button" class="btn btn-danger btn-lg btn-block" ><strong>商品不良等</strong></button>

    <?php echo $message->comment2; ?>

    <div class="hidden-xs text-center" style="margin-top:30px;">
        <button type="submit" class="btn btn-success btn-lg "  onclick="location.href='/return1second/entry/1/'">１．お取替え</button>
        　　<button type="submit" class="btn btn-success btn-lg " onclick="location.href='/return1second/entry/2/'" >２．返　品　</button>
    </div>

    <div class="visible-xs text-center" style="margin-top:30px;">
        <button type="submit" class="btn btn-success btn-lg  btn-block"  onclick="location.href='/return1second/entry/1/'">１．お取替え
        </button>　　<button type="submit" class="btn btn-success btn-lg  btn-block" onclick="location.href='/return1second/entry/2/'" >２．返　品　</button>
    </div>
</div>

@endsection
