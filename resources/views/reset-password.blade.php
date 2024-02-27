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
        
           
            <h3>Modification de mot de passe</h3>
            <!-- resources/views/auth/reset-password.blade.php -->

                <form method="POST" action="{{route('user.ModifierLePasse')}}">
                    @csrf
                    <!-- <input type="hidden" name="token" value="{{ $token }}"> -->
                    
                    <!-- <div>
                        <label for="email">Adresse e-mail</label>
                        <input id="email" type="email" name="email" required autofocus>
                    </div> -->

                    <div>
                        <label for="password">Nouveau mot de passe</label>
                        <input id="password" type="password" name="password" required>
                    </div>

                    <div>
                        <label for="password_confirmation">Confirmer le mot de passe</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required>
                    </div>

                    <div>
                        <button type="submit">
                            Réinitialiser le mot de passe
                        </button>
                    </div>
                </form>

            
        </div>
    </div>
</body>
</html>
