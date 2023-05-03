<div class="row col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
    @if ($errors->any())
        <div class="alert alert-danger">
            <button class="close" data-dismiss="alert">
                ×
            </button><strong>ご確認ください!</strong><br>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif
</div>
