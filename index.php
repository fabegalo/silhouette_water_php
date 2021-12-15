<?php

function get_water_silhouette($tamanho, $silhouettes)
{
    $paredeEsquerda = [];
    $paredeDireita = [];
    $aguaAcumulada = [];

    for ($i = 0; $i < $tamanho; $i++) {
        if ($i != 0) {
            $paredeEsquerda[$i] = max(array_slice($silhouettes, 0, $i));
        }

        if ($i != $tamanho - 1) {
            $paredeDireita[$i] = max(array_slice($silhouettes, $i + 1, $tamanho));
        }

        $agua = min($paredeEsquerda[$i] ?? 0, $paredeDireita[$i] ?? 0) - $silhouettes[$i];

        if ($agua >= 1) {
            $aguaAcumulada[$i] = $agua;
        } else {
            $aguaAcumulada[$i] = 0;
        }
    }

    return $aguaAcumulada;
}

$entrada = preg_split('/\r\n|\n|\r/', trim(file_get_contents('entrada.txt')));

$quantidadeEntrada = $entrada[0];

for ($i = 1; $i <= $quantidadeEntrada * 2; $i++) {
    $tamanho = $entrada[$i];
    $i++;
    $silhouettes = $entrada[$i];
    $resultado = get_water_silhouette($tamanho, explode(" ", $silhouettes));
    print_r(array_sum($resultado) . PHP_EOL);
}