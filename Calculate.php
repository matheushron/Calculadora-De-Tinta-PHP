<?php

/*
REGRAS de negócio: 
1m² < parede < 50m²;
Janelas < 50% de uma parede;
altura de parede com porta deve ser no minimo 30cm maior que a altura da porta;
cada janela possui tamanho padrão de 2 x 1,2 = 2,4m²;
cada porta possui padrão de 0,8 x 1,9 = 1,52m²;
*/
// latas de tinta de 0,5L / 2,5L / 3,6L / 18L
//cada litro pinta 5m²

$body = json_decode(file_get_contents('php://input'), true);

// area da parede 1.
$height1 = $body['height1'];
$width1 = $body['width1'];
$area1 = $height1 * $width1;

// area da parede 2.
$height2 = $body['height2'];
$width2 = $body['width2'];
$area2 = $height2 * $width2;

// area da parede 3.
$height3 = $body['height3'];
$width3 = $body['width3'];
$area3 = $height3 * $width3;

// area da parede 4.
$height4 = $body['height4'];
$width4 = $body['width4'];
$area4 = $height4 * $width4;

// fazendo a area total das paredes.
$wallsArea = $area1 + $area2 + $area3 + $area4;

// armazenando a area das portas e janelas.
$door = 1.52;
$window = 2.4;

// pegando o numero de portas e janelas.
$number_doors = $body['dor_number'];
$number_window = $body['window_number'];

// multiplicando a quantidade de portas e janelas pela area delas.
$size_of_doors = $number_doors * $door;
$size_of_winodws = $number_window * $window;

// armazenando a medida que eu preciso tirar das portas e das janelas.
$remove = $size_of_winodws + $size_of_doors;

// area final que vai ser pintada.
$total_area = $wallsArea - $remove;


//tintas = [18, 3.6, 2.5, 0.5];
//o numero das tintas representa a posição vetorial no array iniciando em 0.
$ink0 = 0;
$ink1 = 0;
$ink2 = 0;
$ink3 = 0;

// litros necessarios para pintar a parede.
$necessary = ceil($total_area / 5);

// cada looping é para ver o quanto de cada lata de tinta será usado, subtraindo o valor em litros da tinta enquanto o valor total de litros for maior  que o valor da lata de tinta
while ($necessary >= 18) {
    $necessary -= 18;
    $ink0++;
}
while ($necessary >= 3.6) {
    $necessary -= 3.6;
    $ink1++;
}
while ($necessary >= 2.5) {
    $necessary -= 2.5;
    $ink2++;
}
while ($necessary >= 0.5) {
    $necessary -= 0.5;
    $ink3++;
}

// A SEGUIR VIRÃO AS TRATATIVAS DE ERRO:

// ERRO caso a medida da parede seja muito grande ou muito pequena.
if ($area1 < 1 || $area1 > 50) {
    echo (json_encode('Parece que a area da parede 1 é inferior a 1m² ou maior do que 50m², por favor digite as medidas corretamente', JSON_UNESCAPED_UNICODE));
    return;
}
/* -------------------------------------------------------------------------------------------------------------------------------------- */
if ($area2 < 1 || $area2 > 50) {
    echo (json_encode('Parece que a area da parede 2 é inferior a 1m² ou maior do que 50m², por favor digite as medidas corretamente', JSON_UNESCAPED_UNICODE));
    return;
}
/* -------------------------------------------------------------------------------------------------------------------------------------- */
if ($area3 < 1 || $area3 > 50) {
    echo (json_encode('Parece que a area da parede 3 é inferior a 1m² ou maior do que 50m², por favor digite as medidas corretamente', JSON_UNESCAPED_UNICODE));
    return;
}
/* -------------------------------------------------------------------------------------------------------------------------------------- */
if ($area4 < 1 || $area4 > 50) {
    echo (json_encode('Parece que a area da parede 4 é inferior a 1m² ou maior do que 50m², por favor digite as medidas corretamente', JSON_UNESCAPED_UNICODE));
    return;
}
/* -------------------------------------------------------------------------------------------------------------------------------------- */

// ERRO caso a medida da janela seja maior que 50% da area da parede
if (($area1 / 2) <= $size_of_winodws) {
    echo (json_encode('Parece que a area da parede 1 é inferior as medidas que as janelas ocupam, por favor digite as medidas corretamente', JSON_UNESCAPED_UNICODE));
    return;
}
/* -------------------------------------------------------------------------------------------------------------------------------------- */
if (($area2 / 2) <= $size_of_winodws) {
    echo (json_encode('Parece que a area da parede 2 é inferior as medidas que as janelas ocupam, por favor digite as medidas corretamente', JSON_UNESCAPED_UNICODE));
    return;
}
/* -------------------------------------------------------------------------------------------------------------------------------------- */
if (($area3 / 2) <= $size_of_winodws) {
    echo (json_encode('Parece que a area da parede 3 é inferior as medidas que as janelas ocupam, por favor digite as medidas corretamente', JSON_UNESCAPED_UNICODE));
    return;
}
/* -------------------------------------------------------------------------------------------------------------------------------------- */
if (($area4 / 2) <= $size_of_winodws) {
    echo (json_encode('Parece que a area da parede 4 é inferior as medidas que as janelas ocupam, por favor digite as medidas corretamente', JSON_UNESCAPED_UNICODE));
    return;
}
/* -------------------------------------------------------------------------------------------------------------------------------------- */

// ERRO caso a altura da porta tenha uma diferença menor do que 30cm da parede
if (($height1 - 1.9) <= 0.3) {
    echo (json_encode('Parece que a altura da parede 1 é insuficiente, por favor digite as medidas corretamente', JSON_UNESCAPED_UNICODE));
    return;
}
/* -------------------------------------------------------------------------------------------------------------------------------------- */
if (($area2 / 2) <= $size_of_winodws) {
    echo (json_encode('Parece que a altura da parede 2 é insuficiente, por favor digite as medidas corretamente', JSON_UNESCAPED_UNICODE));
    return;
}
/* -------------------------------------------------------------------------------------------------------------------------------------- */
if (($area3) <= $size_of_winodws) {
    echo (json_encode('Parece que a altura da parede 3 é insuficiente, por favor digite as medidas corretamente', JSON_UNESCAPED_UNICODE));
    return;
}
/* -------------------------------------------------------------------------------------------------------------------------------------- */
if (($area4) <= $size_of_winodws) {
    echo (json_encode('Parece que a altura da parede 4 é insuficiente, por favor digite as medidas corretamente', JSON_UNESCAPED_UNICODE));
    return;
}
/* -------------------------------------------------------------------------------------------------------------------------------------- */


// mostra uma mensagem do quanto vai usar de cada lata de tinta
echo (json_encode(['final_message' => "Você vai utilizar:
                   <br> Latas de 18 Litros: {$ink0} 
                   <br> Latas de 3.6 Litros: {$ink1} 
                   <br> Latas de 2.5 Litros: {$ink2} 
                   <br> Latas de 0.5 Litros: {$ink3}"]));
