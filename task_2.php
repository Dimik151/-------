<?php 


/* 
Проверьте, сбалансированы ли все скобки в выражении. 
Скобки могут быть круглыми: "()", квадратными: "[]", фигурными: "{}" и угловыми: "<>".
 */

// Примеры:

// false  == solution("( {)  } ")
// true  == solution("()[]{}<>")
// true  == solution("<(){[]}>")
// false  == solution("())")
// false  == solution("()(")
// false  == solution("{)][(}")


$arr_task = [
    ['Expected' => true,
    'Arguments' => '<(){[]}>'],
    ['Expected' =>  true,
    'Arguments' => '()[]{}<>'],
    ['Expected' => true,
    'Arguments' => '<>{} '],
    ['Expected'=> true,
    'Arguments' => '() () <>'],
    ['Expected' => true,
    'Arguments' => '{ ([ ])}'],
    ['Expected' => true,
    'Arguments' => '{}( [])'],
    ['Expected' => true,
    'Arguments' => '[] '],
    ['Expected' => true,
    'Arguments' => '< >'],
    ['Expected' => true,
    'Arguments' => '{ ([ ])}'],
    ['Expected' => true,
    'Arguments' => '<> ()[ ]'],
    ['Expected' => true,
    'Arguments' => '<>'],
    ['Expected' => true,
    'Arguments' => '( () {} )'],
    ['Expected' => false,
    'Arguments' => '{)][(}'],
    ['Expected' => false,
    'Arguments' => '()('],
    ['Expected' => false,
    'Arguments' => '())'],
    ['Expected' => false,
    'Arguments' => '( {)  } '],
    ['Expected' => false,
    'Arguments' => '}< )[[](>'],
    ['Expected' => false,
    'Arguments' => '< (['],
    ['Expected' => false,
    'Arguments' => '(]('],
    ['Expected' => false,
    'Arguments' => '[ '],
    ['Expected' => false,
    'Arguments' => '><'],
    ['Expected' => false,
    'Arguments' => '[{><[]} ()]'],
    ['Expected' => false,
    'Arguments' => '[}<] >]]{[['],
    ['Expected' => false,
    'Arguments' => '['],
    ['Expected' => false,
    'Arguments' => '>] [<<>'],
    ['Expected' => false,
    'Arguments' => '<[]>]('],
    ['Expected' => false,
    'Arguments' => '(([ [>]'],
    ['Expected' => false,
    'Arguments' => '[)< < ](>>'],
    ['Expected' => false,
    'Arguments' => '{'],
    ['Expected' => false,
    'Arguments' => ')}'],
];

foreach ($arr_task as $key => $value) {
    if ($value['Expected'] === check($value['Arguments'])) {
        echo $key + 1 . ' => ' . 'TRUE', PHP_EOL;
    } else {
        echo $key + 1 . ' => ' . 'FALSE', PHP_EOL;
    }
}


var_dump(check(')()())'));
/**
 * Проверка правильности скобочной последовательности
 *
 * @param string $str Строка скобок
 * 
 * @return bool 
 */
function check(string $str) : bool
{
    $str = str_replace(' ', '', $str);
    $len = strlen($str);
    
    if ($len == 0 || $len % 2 != 0) {
        return false;
    }

    $bracket_start = ['(','{','<','['];
    $bracket_end = [')','}','>',']'];

    $temp_arr = [];
    
    for ($i = 0; $i < $len; $i++) {
        $val = array_search($str[$i], $bracket_start);
        if ($str[$i] == $bracket_start[$val]) {
            $temp_arr[] = $val;
        } else {
            $val = array_search($str[$i], $bracket_end);
            $last = array_pop($temp_arr);
            if ($val === false || $last !== $val) {
                return false;
            }
        }
    }
    return count($temp_arr) == 0 ? true : false;
}
