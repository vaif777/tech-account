<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Подтвердите свой адрес электронной почты</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
        <div class="lockscreen-name">Подтвердите свой адрес электронной почты</div>
        @if (session('resent'))
        <div class="help-block text-center">
            На ваш адрес электронной почты была отправлена новая ссылка для подтверждения.
        </div>
        @else
        <p class="help-block text-center">Прежде чем продолжить, пожалуйста, проверьте свою электронную почту на наличие ссылки для подтверждения.</p>
        @endif
        <p class="help-block text-center"> Если вы не получили электронное письмо,</p>

        <form class="help-block text-center" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link align-center">нажмите здесь, чтобы запросить
                другой.
            </button>
        </form>
    </div>
    <!-- /.center -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>