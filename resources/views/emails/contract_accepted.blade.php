<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contrato Aceptado</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px;">

    <div style="
        max-width: 600px;
        margin: auto;
        background: white;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    ">

        <!-- Encabezado -->
        <h2 style="color: #2C0E06; text-align: center; margin-top: 0;">
            ¡Tu contrato ha sido aceptado!
        </h2>

        <!-- Saludo -->
        <p style="font-size: 15px; color: #333;">
            Hola <strong>{{ $user->name }} {{ $user->lastname }}</strong>,
        </p>

        <!-- Mensaje -->
        <p style="font-size: 15px; color: #333;">
            El carpintero 
            <strong style="color: #2C0E06;">
                {{ $contract->trabajador->user->name }} {{ $contract->trabajador->user->lastname }}
            </strong>
            ha <strong>aceptado</strong> tu solicitud de contrato.
        </p>

        <!-- Caja de información (opcional) -->
        <div style="
            background: #FAF4F2;
            padding: 12px 15px;
            border-left: 4px solid #2C0E06;
            margin: 20px 0;
        ">
            <p style="margin: 5px 0; font-size: 15px; color: #444;">
                Ya puedes revisar los detalles completos del contrato.
            </p>
        </div>

        <!-- Botón -->
        <div style="text-align: center; margin-top: 25px;">
            <a href="{{ config('urls.current_app') }}workers/workerProfile/{{ $contract->trabajador->id }}"
               style="
                    background-color: #2C0E06;
                    color: #fff;
                    padding: 12px 20px;
                    text-decoration: none;
                    border-radius: 6px;
                    font-size: 16px;
                    display: inline-block;
               ">
                Ver contrato
            </a>
        </div>

        <!-- Footer -->
        <p style="margin-top: 30px; font-size: 14px; color: #555; text-align: center;">
            Gracias por confiar en nuestra plataforma.
        </p>

    </div>

</body>
</html>



