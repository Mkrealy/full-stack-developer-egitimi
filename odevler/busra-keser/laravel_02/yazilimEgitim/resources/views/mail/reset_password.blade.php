<p>
    Sayın {{ $user->name }},
</p>
<p>
    Bu mail şifre sıfırlama isteğiniz üzerine almaktasınız.
    <br><br>

    <a href="{{ route('reset.password.showForm', $user->reset_password_token) }}">Şifremi Sıfırla</a>
</p>
