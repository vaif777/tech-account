<x-mail::message>
# Учетная записсь

Для вас создали учетную запись.<br><br>
Логин: {{ $mail }}<br>
Пароль :{{ $password }}

<x-mail::button :url="$url">
Перейти на вход.
</x-mail::button>

<br>
Администрация.
</x-mail::message>
