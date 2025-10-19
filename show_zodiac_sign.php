<?php 
    include('layouts/header.php'); 
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-4 text-center">

                    <?php
                    // 2. Verifica se a data de nascimento foi enviada
                    if (isset($_POST['data_nascimento']) && !empty($_POST['data_nascimento'])) {
                        
                        // 3. Pega a data e carrega o XML
                        $data_nascimento = $_POST['data_nascimento']; // [cite: 588]
                        $signos = simplexml_load_file("signos.xml"); // [cite: 592]

                        // 4. Converte a data de nascimento para um formato comparável (MêsDia)
                        // Ex: "1992-05-21" vira o inteiro 521
                        $dataNascObj = new DateTime($data_nascimento);
                        $mesDiaNascimento = (int) $dataNascObj->format('md');

                        $signoEncontrado = null;

                        // 5. Itera sobre cada signo no XML [cite: 593]
                        foreach ($signos->signo as $signo) {
                            // Extrai o dia e mês de início e fim
                            list($diaInicio, $mesInicio) = explode('/', (string)$signo->dataInicio);
                            list($diaFim, $mesFim) = explode('/', (string)$signo->dataFim);

                            // Converte para o mesmo formato (MêsDia)
                            // Ex: "21/03" vira 321
                            $inicio = (int) ($mesInicio . $diaInicio);
                            $fim = (int) ($mesFim . $diaFim);

                            // 6. Lógica de comparação [cite: 595]
                            if ($inicio > $fim) { 
                                // Caso especial: Signos que atravessam o ano (Capricórnio)
                                // Ex: Início 1222 (22/12) e Fim 120 (20/01)
                                if ($mesDiaNascimento >= $inicio || $mesDiaNascimento <= $fim) {
                                    $signoEncontrado = $signo;
                                    break;
                                }
                            } else {
                                // Signos normais
                                // Ex: Início 321 (21/03) e Fim 420 (20/04)
                                if ($mesDiaNascimento >= $inicio && $mesDiaNascimento <= $fim) {
                                    $signoEncontrado = $signo;
                                    break;
                                }
                            }
                        }

                        // 7. Exibe o resultado
                        if ($signoEncontrado) {
                            echo '<h2 class="card-title text-primary">' . $signoEncontrado->signoNome . '</h2>';
                            echo '<p class="card-text fs-5">' . $signoEncontrado->descricao . '</p>';
                        } else {
                            echo '<p class="text-danger">Não foi possível encontrar seu signo.</p>';
                        }

                    } else {
                        echo '<p class="text-danger">Por favor, insira uma data de nascimento.</p>';
                    }
                    ?>

                    <a href="index.php" class="btn btn-secondary mt-4">Voltar</a> </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>