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
            background-color:#3A6A7E ;
            /* #3490dc; */
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
        <div class="header">
            <h1>REPONSE CANDIDATURE</h1>
        </div>
        <div class="content">
            <h3>Bonjour {{$candidat->prenom}}  {{$candidat->nom}}!</h3>
            <p>Nous vous informons que votres candidature n'a pas ete retenu. <br>
                Nous vous encourageons a postuler d'avantage. <br>
                Nous sommes certain que vous touvez l'emploi qui vous convient <br>
                Cordialement, L'equipe KER GUI SERVICE.
            </p>
        </div>
    </div>
</body>
</html>
