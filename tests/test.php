<?php 
echo "<p><b>Список тестов:</b></p>";
$dir = '.';
$tests = scandir($dir);
foreach ($tests as $test){
    if ($test !=='..' and $test!=='.' and $test!=='test.php'){
       $testname=json_decode(file_get_contents('http://university.netology.ru/user_data/azaplutakhin/php-http/tests/'.urlencode($test)), true);
       $name=$testname['0']['testname'];
       echo "<p><a href='test.php?test=$test'> $name </a></p>";
}
}
echo '<hr>';
if (!$_GET) exit; 
else{
$test=file_get_contents($_GET["test"]);
$test=json_decode($test,true);
$description=$test['0']['testname'];
echo "<h3>$description:</h3>";
$i=1;
?>
<html lang="ru">
  <head>
    <title>Тесты</title>
    <meta charset="utf-8">
  </head>
<body>
<form action="" method="POST">
<p><label>
      Имя:
      <input required type="text" name="name">
</label></p>
<?php foreach ($test as $points){
$rigthanswers[$i]=$points['answer'];
?>

<form action="" method="POST">
       <fieldset>
         <legend> <?php echo $points['question']; ?> </legend>
         <?php foreach ($points['variants'] as $vars) { ?>
          <label><input required type="radio" name="<?php echo $i; ?>" value="<?php echo $vars; ?>"> <?php echo $vars; ?> </label>
          <?php } $i++; ?>
        </fieldset>
<?php } ?>

<p><input type="submit" value="Отправить"></p>
</form>


<?php
$i=1;
$mark=0;
if (!empty($_POST)){
   echo $_POST['name'];
   //echo "<p><h3>Результат:</h3></p>";
   foreach ($rigthanswers as $right){
   if ($_POST[$i]==$right) {$mark++; echo "<p>Ответ на вопрос $i ($_POST[$i]) верный</p>";} else echo "<p>Ответ на вопрос $i ($_POST[$i]) неверный</p>";
    $i++;
} 

$image = imagecreatetruecolor(300,212);
$image_path = '../cert.jpg';
$img = imagecreatefromjpeg($image_path);
$text_name = $_POST['name'];
$i=$i-1;
if ($mark==0 or $i >= 5) $text_mark = "$mark баллов из $i"; 
if ($mark==1) $text_mark = "$mark балл из $i";
if ($mark >= 2 and $i <= 4) $text_mark = "$mark балла из $i";
$font = '../Helvetica.ttf';
$black = imagecolorallocate($image, 0, 0, 0);
$textcolor = imagecolorallocate($image, 80, 80, 80);

imagecopy($image, $img, 0, 0, 0, 0, 300,212);
$bbox_name = imagettfbbox(20, 0, $font, $text_name);
$bbox_mark = imagettfbbox(16, 0, $font, $text_mark);
$x_name = 150 - round(($bbox_name[2] - $bbox_name[0]) / 2);
$x_mark = 150 - round(($bbox_mark[2] - $bbox_mark[0]) / 2);

imagettftext($image, 20, 0, $x_name, 110, $black, $font, $text_name);
imagettftext($image, 16, 0, $x_mark, 150, $black, $font, $text_mark);
imagepng($image, "sertificat.png");
imagedestroy($image);
?>
<img src="sertificat.png"></img>
<?php

}
}
?>
</body>
</html>