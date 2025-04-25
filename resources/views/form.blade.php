<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitar Crédito</title>
</head>
<body>
    <h1>Solicitar Crédito para Celular</h1>
    
    <form action="{{ route('credit.store') }}" method="POST">
        @csrf
        <div>
            <label for="client_id">Cliente:</label>
            <select name="client_id" id="client_id" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="phone_id">Modelo de Celular:</label>
            <select name="phone_id" id="phone_id" required>
                @foreach($phones as $phone)
                    <option value="{{ $phone->id }}">{{ $phone->model }} - ${{ $phone->price }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="term_months">Plazo (Meses):</label>
            <input type="number" name="term_months" id="term_months" required min="1" max="36">
        </div>

        <div>
            <button type="button" onclick="simularCuota()">Ver Simulación de Cuota</button>
        </div>

        <div id="simulacion">
            <!-- Aquí se mostrará la simulación de cuotas -->
        </div>

        <div>
            <button type="submit">Confirmar Solicitud</button>
        </div>
    </form>

    <script>
        function simularCuota() {
            const phoneId = document.getElementById('phone_id').value;
            const termMonths = document.getElementById('term_months').value;

            fetch(`/api/simular-cuota?phone_id=${phoneId}&term_months=${termMonths}`)
                .then(response => response.json())
                .then(data => {
                    const cuotaDiv = document.getElementById('simulacion');
                    if (data.error) {
                        cuotaDiv.innerHTML = `<p>${data.error}</p>`;
                    } else {
                        cuotaDiv.innerHTML = `
                            <h3>Simulación de Cuota</h3>
                            <p>Importe mensual: $${data.amount}</p>
                            <p>Total a pagar: $${data.total}</p>
                        `;
                    }
                });
        }
    </script>
</body>
</html>
