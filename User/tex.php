 <?php //Ejemplo aprenderaprogramar.com
/*
$file = fopen("text.txt", "r");

$var= fgets($file);

echo $var+1;

$file = fopen("text.txt", "w");

fwrite($file, '1111'. PHP_EOL);

fclose($file);
*/
//$var = 0;
$names=file('text.txt');
// To check the number of lines
 //count($names).'<br>';
foreach($names as $name)
{
   echo $var = $name;
}

 $var= is_numeric($var)+1;




?>