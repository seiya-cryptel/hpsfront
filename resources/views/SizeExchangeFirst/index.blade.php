
@extends('layout')

@section('content')

<div class="well">
    <button type="button" class="hidden-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<small>（安全靴、作業靴、ユニフォームのサイズ交換）</small></button>
    <button type="button" class="visible-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<br><small>（安全靴、作業靴、<br>ユニフォームのサイズ交換）</small></button>

    <?php echo $message->comment1; ?>

    <div class="row col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
        @if ($errors->any())
            <div class="alert alert-danger">
                <button class="close" data-dismiss="alert">
                    ×
                </button><strong>ご確認ください!</strong><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <form action="/sizeexchangefirst" id="" method="post" accept-charset="utf-8">

        @include('first')

    </form>

    <div class="clearfix"></div>

    <?php echo $message->comment7; ?>

</div>

@endsection
