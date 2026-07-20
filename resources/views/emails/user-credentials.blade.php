<!DOCTYPE html>
<html>
<body>
    <h2>Bienvenue {{ $user->name }} 👋</h2>
    <p>Votre compte prospecteur a été créé. Voici vos accès :</p>
    <ul>
        <li><strong>Email :</strong> {{ $user->email }}</li>
        <li><strong>Mot de passe :</strong> {{ $password }}</li>
    </ul>
    <p><a href="{{ url('/') }}">Se connecter</a></p>
    <p>Merci de changer votre mot de passe après la première connexion.</p>
</body>
</html>