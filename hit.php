<?php
$counter_file = 'counter.txt';
$counter_lenght = 8;
$fp = fopen($counter_file, 'r+');
if ($fp){
    if (flock($fp, LOCK_EX)){
        $counter = fgets($fp, $counter_lenght);
        $counter++;
        rewind($fp);
        if (fwrite($fp,  $counter) === FALSE){
            echo "write failed";
        }
        flock($fp, LOCK_UN);
    }
}
fclose($fp);
echo $counter;
?>
