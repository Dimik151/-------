<?php 

// Напишите функцию, которая принимает последовательность слов и проверяет, 
// могут ли слова быть организованы в одну непрерывную цепочку слов. 
// Пример: cat -> cot -> coat -> oat -> hat -> hot -> hog -> dog

// Примеры:

// true  == solution(["hat","coat","dog","cat","oat","cot","hot","hog"])
// false  == solution(["cot","hot","bat","fat"])
// false  == solution(["to","top","stop","tops","toss"])
// true  == solution(["spout","do","pot","pout","spot","dot"])
// true  == solution(["share","hares","shares","hare","are"])
// false  == solution(["share","hares","hare","are"])

$arr_taksi = [
    ['Expected' => true,
    'Arguments' => ["share","hares","shares","hare","are"]],
    ['Expected' => true,
    'Arguments' => ["spout","do","pot","pout","spot","dot"]],
    ['Expected' => true,
    'Arguments' => ["hat","coat","dog","cat","oat","cot","hot","hog"]],
    ['Expected' => false,
    'Arguments' => ["share","hares","hare","are"]],
    ['Expected' => false,
    'Arguments' => ["to","top","stop","tops","toss"]],
    ['Expected' => false,
    'Arguments' => ["cot","hot","bat","fat"]],
    ['Expected' => false,
    'Arguments' => ["feeling","quality","exchange","comparison"]],
    ['Expected' => false,
    'Arguments' => ["rest","quality"]],
    ['Expected' => false,
    'Arguments' => ["insurance","push"]],
    ['Expected' => false,
    'Arguments' => ["year","society","discovery"]],
    ['Expected' => false,
    'Arguments' => ["weight","steam","art"]],
    ['Expected' => false,
    'Arguments' => ["art","system","push","land","steam","feeling","year","steam"]],
    ['Expected' => false,
    'Arguments' => ["business","comparison","run","front"]],
    ['Expected' => false,
    'Arguments' => ["meat","front","self","breath","discovery","front","quality"]],
    ['Expected' => false,
    'Arguments' => ["respect","feeling","invention","discovery","steam","year"]],
    ['Expected' => false,
    'Arguments' => ["discovery","business","rule","mind"]],
    ['Expected' => false,
    'Arguments' => ["insurance","prose","regret","self"]],
    ['Expected' => false,
    'Arguments' => ["respect","invention","rain","feeling",
                    "comparison","touch","self","respect"]],
    ['Expected' => false,
    'Arguments' => ["test","comparison","rest","comparison","prose"]],
    ['Expected' => false,
    'Arguments' => ["land","comparison"]],
    ['Expected' => false,
    'Arguments' => ["comparison","comparison","exchange",
                    "business","comparison","self","knowledge"]],
    ['Expected' => false,
    'Arguments' => ["mind","surprise","rest"]],
    ['Expected' => false,
    'Arguments' => ["surprise","touch","insurance","prose","invention"]],
    ['Expected' => false,
    'Arguments' => ["push","push","front","system","knowledge","self","year"]],
    ['Expected' => false,
    'Arguments' => ["land","regret","year","weight","meat"]],
    ['Expected' => false,
    'Arguments' => ["join","learning","self","feeling","damage","self","steam"]],
    ['Expected' => false,
    'Arguments' => ["comparison","society","mind","push"]],
    ['Expected' => false,
    'Arguments' => ["exchange","year","regret"]],
    ['Expected' => false,
    'Arguments' => ["meat","breath"]],
    ['Expected' => false,
    'Arguments' => ["steam","test","wind"]],
];


foreach ($arr_taksi as $key => $value) {
    $array = $value['Arguments'];
    $collect = [];
    $count_word = count($array);
    depthPicker($array, [], $collect, $count_word);
    if ($collect) {
        echo $key + 1 . ' => ' . 'TRUE', PHP_EOL;
    } else {
        echo $key + 1 . ' => ' . 'FALSE', PHP_EOL;
    }
    print_r($collect);
}

// $array = ["hat","coat","dog","cat","oat","cot","hot","hog"];
// $collect = [];
// $count_word = count($array);
// depthPicker($array, [], $collect, $count_word);
// print_r($collect);

/**
 * Поиск всех возможных комбинаций
 *
 * @param array $arr        Массив значение
 * @param array $temp_arr   Временный массив
 * @param array $collect    Коллекция всех вариантов
 * @param int   $count_word Длина изначального массива слов
 * 
 * @return void
 */
function depthPicker(array $arr, array $temp_arr, array &$collect, int $count_word) 
{
    if (! empty($temp_arr)) {
        $arr_res = $temp_arr;
    }

    $count = count($arr);
    for ($i = 0; $i < $count; $i++) {
        $arrcopy = $arr;
        $elem = array_splice($arrcopy, $i, 1); // удаляет и возвращает i-й элемент

        if (count($arrcopy) > 0) {
            if (count($temp_arr) > 0) {
                if (levenshtein($temp_arr[count($temp_arr) - 1], $elem[0]) == 1) {
                    $tester = $temp_arr;
                    $tester[] = $elem[0];

                    depthPicker($arrcopy, $tester, $collect, $count_word);
                } else {
                    continue;
                }
            } else {
                $tester = $temp_arr;
                $tester[] = $elem[0];

                depthPicker($arrcopy, $tester, $collect, $count_word);
            }
        } else {
            if (count($arr_res) == $count_word - 1) {
                if (levenshtein($arr_res[count($arr_res)-1], $elem[0]) == 1) {
                    $arr_res[] = $elem[0];
                    $collect[] = $arr_res;
                }
            }
        }   
    }   
}