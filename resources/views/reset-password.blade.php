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
            text-align: center;
        }
        .ajustement {
            /* margin-left: auto; */
            margin-top: 10px;
        }
        button {
            /* margin-left: auto; */
            color:white;
            background-color:green;
        }
    </style>
    <script>
    
</script>
</head>
<body>
    <div class="container">

        <div class="header">
            <h1>Réinitialisation mot de passe</h1>
        </div>
        <div class="content">
        
           
            <h3>Modification de mot de passe</h3>
            <!-- resources/views/auth/reset-password.blade.php -->

                <form method="POST" action="{{ route('user.ModifierLePasse') }}" >
                
                    @csrf 
                    
                    <div class="ajustement">
                        <label for="password" class="form-label" class="container mt-4">Nouveau mot de passe</label><br>
                        <input id="password" type="password" name="password" class="form-control mb-3" placeholder="Entrer nouveau mot de passe" style="width: 300px;height: 40px;">
                    </div>

                    <div class="ajustement">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label><br>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirmation mot de passe" style="width: 300px;height: 40px;">
                    </div>

                    <input type="hidden" value="{{request('reset_password_token')}}" name="token">


                    <div class="ajustement">
                        <button type="submit" style="width: 310px;height: 40px;" >
                            Modifier
                        </button>
                    </div>
                </form>

            
        </div>
    </div>
    <script src="validation.js"></script>
</body>
</html>
