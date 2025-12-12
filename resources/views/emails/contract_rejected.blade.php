<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud de contrato rechazada</title>
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
            Solicitud de contrato rechazada
        </h2>

        <!-- Saludo -->
        <p style="font-size: 15px; color: #333;">
            Hola <strong>{{ $user->name }} {{ $user->lastname }}</strong>,
        </p>

        <!-- Mensaje -->
        <p style="font-size: 15px; color: #333;">
            Tu solicitud de contrato con el carpintero 
            <strong style="color: #2C0E06;">
                {{ $contract->trabajador->user->name }} {{ $contract->trabajador->user->lastname }}
            </strong>
            ha sido <strong>rechazada</strong> por el siguiente motivo:
        </p>

        <!-- Caja de motivo -->
        <div style="
            background: #FAF4F2;
            padding: 15px;
            border-left: 4px solid #2C0E06;
            margin: 20px 0;
            border-radius: 6px;
        ">
            <p style="margin: 0; font-size: 15px; color: #444; font-style: italic;">
                "{{ $contract->reason_rejected }}"
            </p>
        </div>

        <!-- Footer -->
        <p style="margin-top: 30px; font-size: 14px; color: #555; text-align: center;">
            Gracias por usar nuestra plataforma.
        </p>

    </div>

</body>
</html>
