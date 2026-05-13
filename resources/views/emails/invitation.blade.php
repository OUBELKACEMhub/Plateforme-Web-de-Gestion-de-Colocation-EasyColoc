<h1>Salut !</h1>
<p><strong>{{ $invitation->sender->name }}</strong> vous invite à rejoindre la colocation <strong>"{{ $invitation->colocation->name }}"</strong>.</p>
<p>Pour accepter, connectez-vous à votre compte EasyColoc :</p>
<a href="{{ route('login') }}" style="background: #FF750F; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
    Rejoindre maintenant
</a>