
@extends('layout')

@section('content')

<div class="well">
    <button type="button" class="btn btn-warning btn-lg btn-block" ><strong>お客様都合　返品</strong></button>

    <?php echo $message->comment1; ?>

    @include('errorList')
    
    <form action="/return2first" id="" method="post" accept-charset="utf-8">

        @include('first')

    </form>

    <div class="clearfix"></div>
    <?php echo $message->comment7; ?>

</div>

@endsection
