<?php
define('DB_PATH', '../database/chat.txt');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // 1. Pega a mensagem e remove espaços extras do início e do fim
    $message = trim($_POST['message']);

    // 2. Verifica se, após a limpeza, a mensagem não está vazia
    if (!empty($message)) {
        // Se não estiver vazia, salva no arquivo
        file_put_contents(DB_PATH, $message . PHP_EOL, FILE_APPEND);
    }

    // Redireciona o usuário de qualquer forma
    header('Location: /');
    exit; // É uma boa prática adicionar exit() após um redirecionamento
}

$messages = file(DB_PATH, FILE_IGNORE_NEW_LINES);

?>


<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super chat</title>
    <link rel="stylesheet" href="./assets/css/applications.css">
</head>

<body>
    <header>
        <h1>Super chat</h1>
    </header>

    <section class="messages">
        <?php foreach($messages as $index => $message):?>
            <div class="message <?= ['sent', 'recived'][$index % 2]?> ">
                <?= $message ?>
            </div>
        <?php endforeach ?>
    </section>

    <footer>
        <form action="/" method="POST">
            <input id="message" type="text" placeholder="Type a message" name="message" required>
            <input type="submit" value="Enviar">
        </form>
    </footer>
</body>
</html>