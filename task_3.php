<?php 

/* 
Палиндром - cлово или фраза, которые одинаково читаются слева направо и справа налево. Создайте функцию которая находит наидлиннейший палиндром в строке.
Алгоритм Манакера
Примеры:

"yzzy"  == solution("xyzzy")
"dhfdkjfffhhfffjkdfhd"  == solution("afbbbfjdjklgdfdhfdkjfffhhfffjkdfhdhkyejejfjkd")
"racecar"  == solution("bartarcarracecarbartar")
"46264"  == solution("3.1415926535897932384626433832795028841971") 
*/

$arr_task = [
    ['Expected' => "46264",
    'Arguments:' => "3.1415926535897932384626433832795028841971"],
    ['Expected' => "racecar",
    'Arguments:' => "bartarcarracecarbartar"],
    ['Expected' => "dhfdkjfffhhfffjkdfhd",
    'Arguments:' => "afbbbfjdjklgdfdhfdkjfffhhfffjkdfhdhkyejejfjkd"],
    ['Expected' => "zevnvgyoeoygvnvez",
    'Arguments:' => "xvadtgpoopgtdavxazevnvgyoeoygvnvezcxow"],
    ['Expected' => "omuffumo",
    'Arguments:' => "ajigyomuffumoevey"],
    ['Expected' => "lszfpcmttmcpfzsl",
    'Arguments:' => "alszfpcmttmcpfzslymmqidynfnydiqmyoteqaeeaqetoiafglly"],
    ['Expected' => "teoxlttlxoet",
    'Arguments:' => "teoxlttlxoetduyblton"],
    ['Expected' => "teoxlttlxoet",
    'Arguments:' => "teoxlttlxoetduyblton"],
    ['Expected' => "xobnbvbvbnbox",
    'Arguments:' => "zwxxobnbvbvbnboxtra"],
    ['Expected' => "qmzpuvzvupzmq",
    'Arguments:' => "syplacqmzpuvzvupzmqbw"],
    ['Expected' => "jyyrtsflmlfstryyj",
    'Arguments:' => "jyyrtsflmlfstryyjgvcejgkgjecvgtnwxqcvanuypmvpenpmmpnepvmpjr"],
    ['Expected' => "jyyrtsflmlfstryyj",
    'Arguments:' => "jyyrtsflmlfstryyjgvcejgkgjecvgtnwxqcvanuypmvpenpmmpnepvmpjr"],
    ['Expected' => "tkyvvykt",
    'Arguments:' => "zwsklymuumpudsysdvtkyvvyktem"],
    ['Expected' => "comkokmoc",
    'Arguments:' => "yvevybhcomkokmocqxuomqk"],
    ['Expected' => "olkwewklo",
    'Arguments:' => "blwelgbqnyolkwewklos"],
    ['Expected' => "jyyrtsflmlfstryyj",
    'Arguments:' => "jyyrtsflmlfstryyjgvcejgkgjecvgtnwxqcvanuypmvpenpmmpnepvmpjr"],
    ['Expected' => "teoxlttlxoet",
    'Arguments:' => "teoxlttlxoetduyblton"],
    ['Expected' => "olkwewklo",
    'Arguments:' => "blwelgbqnyolkwewklos"],
    ['Expected' => "omuffumo",
    'Arguments:' => "ajigyomuffumoevey"],
    ['Expected' => "itdlaosbboobbsoaldti",
    'Arguments:' => "dnvoqdoitdlaosbboobbsoaldtiddbejb"],
    ['Expected' => "xzbnuoounbzx",
    'Arguments:' => "kopnjxzbnuoounbzxbsgaxexzhskipvpiks"],
    ['Expected' => "xzbnuoounbzx",
    'Arguments:' => "kopnjxzbnuoounbzxbsgaxexzhskipvpiks"],
    ['Expected' => "crlzmwneenwmzlrc",
    'Arguments:' => "tblwqgogqwlbtcrlzmwneenwmzlrcqhtdmg"],
    ['Expected' => "xzbnuoounbzx",
    'Arguments:' => "kopnjxzbnuoounbzxbsgaxexzhskipvpiks"],
    ['Expected' => "ztjytyjtz",
    'Arguments:' => "cdxztjytyjtzbq"],
    ['Expected' => "yzzy",
    'Arguments:' => "xyzzy"],
    ['Expected' => "oeesfkoggokfseeo",
    'Arguments:' => "usaekxlqkkzoeesfkoggokfseeo"],
    ['Expected' => "hijxkookxjih",
    'Arguments:' => "aeziwonrdsdrnooadtoudcnncduhijxkookxjih"],
    ['Expected' => "oeesfkoggokfseeo",
    'Arguments:' => "usaekxlqkkzoeesfkoggokfseeo"],
    ['Expected' => "pbzyxghoohgxyzbp",
    'Arguments:' => "upguykdeyedkyugekffhjxhfeefhxjhpepbzyxghoohgxyzbp"],
];


foreach ($arr_task as $key => $task) {
    if ($task['Expected'] === longestPalindrome($task['Arguments:'])) {
        echo $key + 1, ' TRUE ', PHP_EOL;
    } else {
        echo $key + 1, ' FALSE ', PHP_EOL;
    }
}


var_dump(longestPalindrome(generateString(1000000)));

/**
 * Функция генерирования случайной строки
 * 
 * @param integer $strength длина строки
 * @param string  $input    входные символы
 * 
 * @return string
 */
function generateString(int $strength = 16, string $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') : string
{
    $input_length = strlen($input);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}

/**
 * Функцию которая находит наидлиннейший палиндром в строке
 *
 * @param string $s строка символов
 * 
 * @return string
 */
function longestPalindrome(string $s) : string
{
    $len_s = strlen($s);

    $s2 = str_pad('', $len_s * 2 + 1, '#');
    for ($i = 0; $i != $len_s; ++$i) {
        $s2[$i * 2 + 1] = $s[$i];
    }

    $len_s2 = strlen($s2);
    $p[] = $len_s2;
    $r = 0;
    $c = 0;
    $index = 0;
    $i_mir = 0;
    $maxLen = 1;

    for ($i = 1; $i != $len_s2 - 1; ++$i) {
        $i_mir = 2 * $c - $i;
        $p[$i] = $r > $i ? min($p[$i_mir], $r - $i) : 0;

        while ($i > $p[$i] && ($i + $p[$i] + 1) < $len_s2 && $s2[$i - $p[$i] - 1] == $s2[$i + $p[$i] + 1]) {
            ++$p[$i];
        }

        if ($p[$i] + $i > $r) {
            $c = $i;
            $r = $i + $p[$i];
        }

        if ($maxLen < $p[$i]) {
            $maxLen = $p[$i];
            $index = $i;
        }
    }
    return substr($s, ($index - $maxLen) / 2, $maxLen);
}