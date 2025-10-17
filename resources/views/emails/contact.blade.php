<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nova mensagem de contato</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #1e40af; color: white; padding: 20px; text-align: center; }
        .content { background: #f8fafc; padding: 20px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #374151; }
        .value { margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nova mensagem de contato</h1>
        </div>
        
        <div class="content">
            <div class="field">
                <div class="label">Nome:</div>
                <div class="value">{{ $data['name'] }}</div>
            </div>
            
            <div class="field">
                <div class="label">Email:</div>
                <div class="value">{{ $data['email'] }}</div>
            </div>
            
            @if($data['subject'])
            <div class="field">
                <div class="label">Assunto:</div>
                <div class="value">{{ $data['subject'] }}</div>
            </div>
            @endif
            
            <div class="field">
                <div class="label">Motivo do contato:</div>
                <div class="value">{{ ucfirst(str_replace('_', ' ', $data['contact_reason'])) }}</div>
            </div>
            
            <div class="field">
                <div class="label">Mensagem:</div>
                <div class="value">{{ $data['message'] }}</div>
            </div>
        </div>
    </div>
</body>
</html>
