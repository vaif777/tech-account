<x-mail::message>
# Учетная записсь

Для вас создали учетную запись.<br><br>
Логин: {{ $mail }}<br>
Пароль :{{ $password }}

<x-mail::button :url="$url">
Авторизация
</x-mail::button>

<br>
Администрация.
</x-mail::message>
