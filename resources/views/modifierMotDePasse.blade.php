<!-- resources/views/emails/votre_vue.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Notification</title>
    <style>
        /* Ajoutez vos styles personnalisés ici */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #3A6A7E;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <img src="{{ asset('images/logo.jpg') }}" >

        <div class="header">
            <h1>Réinitialisation de votre mot de passe</h1>
        </div>
        <div class="content">
        
           
            <h3>Bonjour {{$user->prenom}}  {{$user->nom}}!</h3>
            <p>Vous avez récemment demandé la réinitialisation de votre mot de passe.<br>
               Pour procéder à cette réinitialisation, veuillez cliquer sur le lien ci-dessous :<br>
               {{ $lien }}.<br>
               Ce lien expirera dans {{$user->reset_password_token_expire}} minute.<br>
                Si vous n'avez pas demandé cette réinitialisation, vous pouvez ignorer cet email en toute sécurité.<br>
                Cordialement, L'equipe KER GUI SERVICE .<br>
            </p>
        </div>
    </div>
</body>
</html>
