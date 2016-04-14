<?php
/**
 * Created by IntelliJ IDEA.
 * User: nakau
 * Date: 16/04/09
 * Time: 10:34
 */


$in_file_path = $argv[1];
$out_file_path = str_replace(".in",".out" ,$in_file_path);
$text = loadText($in_file_path);

$lines = explode("\n", $text);

$tpl ="Case #%d: %s";
$insomnia = "INSOMNIA";
$out_text = '';
$out_line = '';
foreach($lines as $index => $line){
    if($index == 0) continue;
    $n = trim($line);
    if(!is_numeric($n)) continue;
    //echo "N: $n" . PHP_EOL;
    if($n == 0){
        $out_line = sprintf($tpl, $index , $insomnia);
    }
    else{
        $last = count_digits($n);
        $out_line = sprintf($tpl, $index , $last);
    }
    $out_text .= $out_line . "\n";
}

echo $out_text .PHP_EOL;
file_put_contents($out_file_path, $out_text);


function count_digits($n){
    $tbl = [];
    $i = 1;
    while(count($tbl) < 10){
        $num = bcmul($i , $n);
        $length = strlen($num);
        for($p=0;$p<$length;$p++){
            $digit = substr($num,$p,1);
            echo "N: $num D:".$digit ."count:" .count($tbl).PHP_EOL;
            $tbl[$digit] = true;
        }
        $i++;
    }
    return $num;
}

function loadText($file_path){
    if(!is_file($file_path)){
        echo "$file_path not exists." .PHP_EOL;
        exit;
    }

    $text = file_get_contents($file_path);
    return $text;
}