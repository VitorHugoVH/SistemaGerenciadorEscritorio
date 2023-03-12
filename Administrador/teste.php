<?php

// Lê o valor de ponto flutuante da entrada
$valor = (float) fgets(STDIN);

// Array com os valores das notas e moedas disponíveis
$notasMoedas = [
    100.00,
    50.00,
    20.00,
    10.00,
    5.00,
    2.00,
    1.00,
    0.50,
    0.25,
    0.10,
    0.05,
    0.01
];

// Array para armazenar a quantidade de cada nota/moeda usada
$quantidades = [];

// Inicializa todas as quantidades como zero
foreach ($notasMoedas as $valorNotaMoeda) {
    $quantidades[$valorNotaMoeda] = 0;
}

// Percorre todas as notas e moedas disponíveis, verificando quantas vezes cada uma cabe no valor total
foreach ($notasMoedas as $valorNotaMoeda) {
    while ($valor >= $valorNotaMoeda) {
        $valor -= $valorNotaMoeda;
        $quantidades[$valorNotaMoeda]++;
    }
}

// Imprime a quantidade de cada nota/moeda usada
echo "NOTAS:\n";
echo $quantidades[100.00] . " nota(s) de R$ 100.00\n";
echo $quantidades[50.00] . " nota(s) de R$ 50.00\n";
echo $quantidades[20.00] . " nota(s) de R$ 20.00\n";
echo $quantidades[10.00] . " nota(s) de R$ 10.00\n";
echo $quantidades[5.00] . " nota(s) de R$ 5.00\n";
echo $quantidades[2.00] . " nota(s) de R$ 2.00\n";
echo "MOEDAS:\n";
echo $quantidades[1.00] . " moeda(s) de R$ 1.00\n";
echo $quantidades[0.50] . " moeda(s) de R$ 0.50\n";
echo $quantidades[0.25] . " moeda(s) de R$ 0.25\n";
echo $quantidades[0.10] . " moeda(s) de R$ 0.10\n";
echo $quantidades[0.05] . " moeda(s) de R$ 0.05\n";
echo $quantidades[0.01] . " moeda(s) de R$ 0.01\n";
