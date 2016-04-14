<?php
/**
 * Created by IntelliJ IDEA.
 * User: nakau
 * Date: 16/04/09
 * Time: 12:09
 */

$in_file_path = $argv[1];
$out_file_path = str_replace(".in",".out" ,$in_file_path);
$text = loadText($in_file_path);

$lines = explode("\n", $text);


foreach($lines as $index => $line){
    if($index == 0) continue;
    $pancakes = trim($line);
    if($pancakes == "") continue;
    if(preg_match('/^\++$/',$pancakes)){
        $turn_count = 0;
    }
    else{
        $turn_count = turn_cakes($pancakes);
        $out_line = sprintf($tpl, $index , $last);
    }
    $out_text .= sprintf("Case #%d: %d", $index, $turn_count). "\n";
}


echo $out_text .PHP_EOL;
file_put_contents($out_file_path, $out_text);

function turn_cakes($pancakes){
    $org = $pancakes;
    //echo "$org 0:\t$pancakes" .PHP_EOL;
    $cake_count = strlen($pancakes);
    $count = 0;
    while(!preg_match('/^\++$/',$pancakes) && $pancakes != '') {

        $count++;
        $m_pos = strrpos($pancakes, '-');
        $r_pos = $cake_count - 1 - $m_pos;
        $turned_cakes = substr($pancakes, 0, $m_pos + 1);

        if ($r_pos == 0) {
            $remain = "";
        } else {
            $remain = substr($pancakes, $r_pos * -1);
        }

        $turned_cakes = str_replace('+','*',$turned_cakes);
        $turned_cakes = str_replace('-','+',$turned_cakes);
        $turned_cakes = str_replace('*','-',$turned_cakes);


        $pancakes = $turned_cakes. $remain;

    }
    return $count;
}

function loadText($file_path){
    if(!is_file($file_path)){
        echo "$file_path not exists." .PHP_EOL;
        exit;
    }

    $text = file_get_contents($file_path);
    return $text;
}