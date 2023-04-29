
@extends('layout')

@section('content')

<div class="well">
  <button type="button" class="hidden-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<small>（安全靴、作業靴、ユニフォームのサイズ交換）</small></button>
  <button type="button" class="visible-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<br><small>（安全靴、作業靴、<br>ユニフォームのサイズ交換）</small></button>

  <?php echo $message->comment1; ?>

  @include('pwd');

  <?php echo $message->comment2; ?>

</div>

@endsection
