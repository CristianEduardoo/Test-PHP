<?php
include 'includes/head.php';

// Función para detectar si la URL es de VividSeats o SeatGeek
function detectPlatform($url)
{
    if (strpos($url, 'vividseats.com') !== false) {
        return 'vividseats';
    } elseif (strpos($url, 'seatgeek.com') !== false) {
        return 'seatgeek';
    }
    return null;
}


// Función para obtener el contenido de la URL utilizando cURL
function getUrlContent($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36");
    $html = curl_exec($ch);
    curl_close($ch);

    echo $html; // Visualización de URL protegida por CAPTCHA

    return $html;
}


// Función para obtener las entradas de VividSeats
function getVividSeatsTickets($url)
{
    $html = getUrlContent($url); // Obtiene el contenido de la página

    // Ejemplo de obtención de datos en una expresión regular, supondiendo la estructura HTML
    preg_match_all('/Section ([\w\s]+), Row (\w+), \$([\d,]+)/', $html, $matches);

    $tickets = [];
    for ($i = 0; $i < count($matches[0]); $i++) {
        $tickets[] = [
            'sector' => $matches[1][$i],
            'fila' => $matches[2][$i],
            'precio' => $matches[3][$i]
        ];
    }
    return $tickets;
}

// Función para obtener las entradas de SeatGeek (Ejemplo similar, se puede adaptar según el HTML de SeatGeek)
function getSeatGeekTickets($url)
{
    $html = getUrlContent($url);

    // Ejemplo de obtención de datos en una expresión regular, supondiendo la estructura HTML
    preg_match_all('/Section ([\w\s]+), Row (\w+), \$([\d,]+)/', $html, $matches);

    $tickets = [];
    for ($i = 0; $i < count($matches[0]); $i++) {
        $tickets[] = [
            'sector' => $matches[1][$i],
            'fila' => $matches[2][$i],
            'precio' => $matches[3][$i]
        ];
    }
    return $tickets;
}

// Mostrar los datos en formato tabla
function displayTickets($tickets)
{
    if (empty($tickets)) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'URL protegida por CAPTCHA',
                customClass: {
                    popup: 'swal2-custom-popup',
                },                
            });
            </script>";
        return;
    }
    echo "<table class='ticket-table'>";
    echo "<tr><th>Sector</th><th>Fila</th><th>Precio</th></tr>";
    foreach ($tickets as $ticket) {
        echo "<tr><td>{$ticket['sector']}</td><td>{$ticket['fila']}</td><td>\${$ticket['precio']}</td></tr>";
    }
    echo "</table>";
}

// Lógica principal
if (isset($_POST['url'])) {
    $url = trim(htmlspecialchars($_POST['url'], ENT_QUOTES, 'UTF-8'));
    $platform = detectPlatform($url);

    if ($platform === 'vividseats') {
        $tickets = getVividSeatsTickets($url);
    } elseif ($platform === 'seatgeek') {
        $tickets = getSeatGeekTickets($url);
    } else {
        die("Plataforma no soportada. Las plataformas soportadas son vividseats o seatgeek");
    }

    displayTickets($tickets);
} else {
    echo "Por favor, ingresa una URL.";
}
