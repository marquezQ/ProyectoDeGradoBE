<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Solicitud de Contrato</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px;">

    <div style="max-width: 600px; margin: auto; background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

        <!-- Encabezado -->
        <h2 style="color: #2C0E06; text-align: center; margin-top: 0;">
            ¡Tienes una nueva solicitud de contrato!
        </h2>

        <!-- Contenido -->
        <p style="font-size: 15px; color: #333;">
            Hola <strong>{{ $trabajador->user->name }} {{ $trabajador->user->lastname }}</strong>,
        </p>

        <p style="font-size: 15px; color: #333;">
            El usuario 
            <strong style="color: #2C0E06;">{{ $cliente->name }} {{ $cliente->lastname }}</strong> 
            ha creado una nueva solicitud de contrato para ti.
        </p>

        <div style="background: #FAF4F2; padding: 12px 15px; border-left: 4px solid #2C0E06; margin: 20px 0;">
            <p style="margin: 5px 0; font-size: 15px; color: #444;">
                <strong>Título del contrato:</strong> {{ $contract->title }}
            </p>
            <p style="margin: 5px 0; font-size: 15px; color: #444;">
                <strong>Fecha de inicio:</strong> {{ $contract->start_date }}
            </p>
            <p style="margin: 5px 0; font-size: 15px; color: #444;">
                <strong>Fecha de finalización:</strong> {{ $contract->end_date }}
            </p>
        </div>

        <!-- Botón -->
        <div style="text-align: center; margin-top: 25px;">
            <a href="https://app.servicapp.me/workers/workerProfile/{{ $trabajador->id }}"
               style="background-color: #2C0E06; color: #fff; padding: 12px 20px; text-decoration: none; 
                      border-radius: 6px; font-size: 16px; display: inline-block;">
                Ver contrato
            </a>
        </div>

        <!-- Footer -->
        <p style="margin-top: 30px; font-size: 14px; color: #555; text-align: center;">
            Gracias por usar nuestra plataforma.
        </p>

    </div>

</body>
</html>

