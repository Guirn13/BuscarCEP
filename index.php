<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Service\ViaCEP;

$cep = "";
$viacep = null;

if (isset($_POST['consulta'])) {
    $cep = isset($_POST['cep']) ? filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS) : "";
    $viacep = ViaCEP::consultarCEP($cep);

    if (empty($viacep)) {
        echo '<div class="alert alert-danger alerta" role="alert">CEP não encontrado!
      </div>';
    }

}
?>


<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buscar CEP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    @media (max-width: 576px) {
        .form {
            width: 90%;
        }
    }

    .alerta {
      position: fixed;
      top: 20px;
      left: 50%;
      margin-top: 80;
      transform: translateX(-50%);
      z-index: 9999;
      animation: fadeOut 6s forwards;
    }

    @keyframes fadeOut {
      0% { opacity: 1; }
      100% { opacity: 0; display: none; }
    }
</style>

<body>
    <div class="container">
        <class="row">
            <div class="col-md-6 offset-md-3 form">
                <h1 class="text-center">Consulta de CEP</h1>
                <form method="post" action="">
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-sm col-2" id="cep" name="cep" placeholder="Digite o CEP">
                    </div>
                    <div class="text-center">
                        <button type="submit" name="consulta" class="btn btn-primary">Consultar</button>
                    </div>
                </form>

                <div class="mt-3 alert alert-info">
                    <p><strong>CEP:</strong> <?= $viacep['cep'] ?></p>
                    <p><strong>Logradouro:</strong> <?= $viacep['logradouro'] ?></p>
                    <p><strong>Bairro:</strong> <?= $viacep['bairro'] ?></p>
                    <p><strong>Cidade:</strong> <?= $viacep['localidade'] ?></p>
                    <p><strong>Estado:</strong> <?= $viacep['uf'] ?></p>
                </div>

            </div>

    </div>
</body>

</html>