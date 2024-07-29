<?php
session_start();
require_once '../db/config.php'; 

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit();
}

// Credenciales API
$user = 'mariana.mastropietro.eventos_api1.gmail.com';
$pwd = 'AHMMWVDUXZL8BFG2';
$signature = 'AivkqA-4YffFBBGV3wGe3au-MPQxABr91Vusm2sIZ7iH2sOcWeW7mBbI';

// Endpoint de la API de PayPal
$endpoint = "https://api-3t.sandbox.paypal.com/nvp"; // Cambia a https://api-3t.paypal.com/nvp para producción
$version = "204.0";

// Obtener el token y PayerID de la URL de redirección de PayPal
if (isset($_GET['token']) && isset($_GET['PayerID'])) {
    $token = htmlspecialchars($_GET['token']);
    $payerId = htmlspecialchars($_GET['PayerID']);

    // Preparar la solicitud para GetExpressCheckoutDetails
    $data = [
        'METHOD' => 'GetExpressCheckoutDetails',
        'VERSION' => $version,
        'USER' => $user,
        'PWD' => $pwd,
        'SIGNATURE' => $signature,
        'TOKEN' => $token
    ];

    $queryString = http_build_query($data);

    // Enviar la solicitud usando cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error en cURL: ' . curl_error($ch);
        curl_close($ch);
        exit();
    }

    curl_close($ch);

    parse_str($response, $parsedResponse);

    if (isset($parsedResponse['ACK']) && $parsedResponse['ACK'] == 'Success') {
        // Obtener detalles del pago
        $amount = $parsedResponse['AMT'];
        $currency = $parsedResponse['CURRENCYCODE'];

        // Preparar la solicitud para DoExpressCheckoutPayment
        $data = [
            'METHOD' => 'DoExpressCheckoutPayment',
            'VERSION' => $version,
            'USER' => $user,
            'PWD' => $pwd,
            'SIGNATURE' => $signature,
            'TOKEN' => $token,
            'PAYERID' => $payerId,
            'PAYMENTREQUEST_0_AMT' => $amount,
            'PAYMENTREQUEST_0_CURRENCYCODE' => $currency,
            'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale'
        ];

        $queryString = http_build_query($data);

        // Enviar la solicitud usando cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error en cURL: ' . curl_error($ch);
            curl_close($ch);
            exit();
        }

        curl_close($ch);

        parse_str($response, $parsedResponse);

        if (isset($parsedResponse['ACK']) && $parsedResponse['ACK'] == 'Success') {
            // El pago se realizó con éxito
            echo "Pago realizado con éxito. ID de la transacción: " . $parsedResponse['PAYMENTINFO_0_TRANSACTIONID'];

            // Obtener el user_id y course_id (de alguna manera estos valores deben ser obtenidos o pasados a este script)
            $user_id = $_SESSION['user_id']; // Supongamos que el ID del usuario está en la sesión
            $course_id = $_SESSION['course_id']; // Supongamos que el ID del curso está en la sesión

            // Asigna el curso al usuario en la base de datos
            try {
                // Insertar en user_courses
                $stmt = $conn->prepare("INSERT INTO user_courses (user_id, course_id) VALUES (:user_id, :course_id)");
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':course_id', $course_id);
                $stmt->execute();

                // Insertar en compras_cursos
                $stmt2 = $conn->prepare("INSERT INTO compras_cursos (user_id, course_id) VALUES (:user_id, :course_id)");
                $stmt2->bindParam(':user_id', $user_id);
                $stmt2->bindParam(':course_id', $course_id);
                $stmt2->execute();

                // Redirige al usuario a escritorioDelAlumno.php
                header('Location: ../Pages/escritorioDelAlumno.php');
                exit();
            } catch (PDOException $e) {
                // Maneja el error y responde con un 500 Internal Server Error
                error_log("Error al asignar el curso: " . $e->getMessage());
                http_response_code(500);
                echo "Error al procesar el pago.";
            }
        } else {
            echo "Error en la respuesta de PayPal: " . $response;
        }
    } else {
        echo "Error en la respuesta de PayPal: " . $response;
    }
} else {
    echo "Faltan parámetros en la solicitud.";
}
?>
