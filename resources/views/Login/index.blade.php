
@extends('layout')

@section('content')

<div class="well">
    @switch($request_content_class)
        @case(1)
            <button type="button" class="btn btn-danger btn-lg btn-block" ><strong>商品不良等</strong></button>
            @break
    
        @case(3)
            <button type="button" class="hidden-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<small>（安全靴、作業靴、ユニフォームのサイズ交換）</small></button>
            <button type="button" class="visible-xs btn btn-info btn-lg btn-block" ><strong>サイズ交換</strong>  　<br><small>（安全靴、作業靴、<br>ユニフォームのサイズ交換）</small></button>
            @break
    
        @case(4)
            <button type="button" class="btn btn-warning btn-lg btn-block" ><strong>お客様都合　返品</strong></button>
            @break
    
        @default
            
    @endswitch

    <br><br>

    @include('errorList')

    <form action="/login/check/{{ $login_id }}" id="" method="post" accept-charset="utf-8">
        @csrf
        
        <?php echo $message->comment1; ?>

        <div class="clearfix"></div>
        <main id="form-main" role="form-main" class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
            <div class="entry-content">
                <div class="form_table">
                    <table>
                    <tr>
                        <th >認証パスワードを入力下さい </th>
                        <td><input name="password" type="text" id="password" value="{{ old('password') }}" class="form-control" size="30" style="ime-mode: inactive;">                
                        </td>
                    </tr>
                    </table>

                </div>
            </div>
        </main>
        <div class="clearfix"></div>

        <?php echo $message->comment2; ?>

        <div class="text-center" style="margin-top:10px;">
            <button type="submit" class="btn btn-success btn-lg " >認証チェック</button>
        </div>
    </form>

    <?php echo $message->comment3; ?>

</div>

@endsection
