
@extends('layout')

@section('content')

<div class="well">
    <button type="button" class="btn btn-warning btn-lg btn-block" ><strong>お客様都合　返品</strong></button>

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
    
    <form action="/return2first" id="" method="post" accept-charset="utf-8">

        @include('first')

    </form>

    <div class="clearfix"></div>
    <?php echo $message->comment7; ?>

</div>

@endsection
