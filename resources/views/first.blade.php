
@csrf

<input type="hidden" name="user_id" value="" />

<main id="form-main" role="form-main" class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
    <div class="entry-content">
        <div class="form_table">
            <table>
            <tr>
                <th >1.オーダＩＤを入力下さい </th>
                <td>
                    <input name="order_id" type="tel" id="order_id" value="{{ old('order_id') }}"  MAXLENGTH="10"  size="20" style="ime-mode: inactive;" class="form-control">
                    <span class="notes">10桁のオーダIDを入力下さい<br>
                    （出荷のご案内に記載されています）<br>
                    （例）1701010001<br>
                    </span>
                    @error('order_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <th >2.注文者電話番号を入力下さい</th>
                <td>
                    <input name="tel" type="tel" id="tel" value="{{ old('tel') }}"  MAXLENGTH="20" size="40"   style="ime-mode: inactive;" class="form-control">
                    <span class="notes">ご注文時のお電話番号を入力下さい<br>
                    ※注文者様の電話番号を入力下さい。<br>
                    配送先の電話番号と異なる場合は、注文者様の電話番号が必須となります。<br>
                    （例）0312340000　ハイフン抜きです。
                    </span>	
                    @error('tel')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <th >3.メールアドレスを入力下さい </th>
                <td>
                    <input name="email" type="text" id="email" value="{{ old('email') }}"  MAXLENGTH="50" size="65"   style="ime-mode: inactive;" class="form-control">
                    <span class="notes">ご連絡可能なメールアドレスを入力下さい<br>
                    （ご注文時と異なるアドレスでも可能です）
                    </span>
                    @error('tel')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <th >4.再度メールアドレスを入力下さい </th>
                <td>
                    <input name="email2" type="text" id="email2" value="{{ old('email2') }}"  MAXLENGTH="50" size="65"  style="ime-mode: inactive;" class="form-control">
                    <span class="notes">【確認用】3.に入力いただきましたメールアドレスを再度入力下さい<br>
                    </span>
                    @error('tel')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </td>
            </tr>

            </table>
        </div>
    </div>
</main>

<?php echo $message->comment2; ?>

<div class="text-center" style="margin-top:10px;">
    <button type="submit" class="btn btn-success btn-lg " >次へ（メール送信）</button>
</div>
<br><br>
