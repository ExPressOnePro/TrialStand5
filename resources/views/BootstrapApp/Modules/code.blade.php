@extends('BootstrapApp.layouts.guest')
@section('title')
    Meeper
@endsection
@section('content')
<div class="container mt-5 ">
    <div class="card d-flex justify-content-center align-items-center">
        <div class="card-body text-center">
            <h5 class="card-title">Важное уведомление!</h5>
            <p class="card-text" style="font-size: 18px;">Пожалуйста, передайте следующий код ответственному:</p>
            <code id="user-code" style="font-size: 24px;">@isset($user){{$user->code}}@endif</code>
            <hr>
            <div class="mt-3">
                <button class="btn btn-success rounded-4 ml-2" onclick="copyCode()">
                    <i class="fa fa-copy"></i> Копировать
                </button>

                <a href="tg://msg?text=Пожалуйста,+добавь+меня+в+собрание+по+этому+коду:+**@isset($user){{$user->code}}@endif**" class="btn btn-info rounded-4 ml-2">
                    <i class="fa fa-telegram fs-2"></i> отправить в Telegram
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function copyCode() {
        const el = document.createElement('textarea');
        el.value = document.getElementById('user-code').innerText;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    }
</script>
@endsection
