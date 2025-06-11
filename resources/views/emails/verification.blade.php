<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Cuenta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333;
            font-size: 24px;
        }
        p {
            font-size: 18px;
            color: #555;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            color: #fff;
            background: #007BFF;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido a nuestra plataforma</h1>
        <p>Gracias por registrarte. Usa el siguiente código para verificar tu cuenta:</p>
        <div class="code">{{ $verificationCode }}</div>
        <p>Ingresa este código en la aplicación para activar tu cuenta.</p>
        <p class="footer">Si no solicitaste este código, puedes ignorar este mensaje.</p>
    </div>
</body>
</html>