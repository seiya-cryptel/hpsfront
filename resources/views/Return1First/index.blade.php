
@extends('layout')

@section('content')

<div class="well">
    <button type="button" class="btn btn-danger btn-lg btn-block" ><strong>商品不良等</strong></button>

<?php echo $message->comment1; ?>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/return1first" id="" method="post" accept-charset="utf-8">

    @include('first')

</form>

<div class="clearfix"></div>
<?php echo $message->comment7; ?>


@endsection
