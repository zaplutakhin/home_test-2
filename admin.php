<?php
  if (!empty($_FILES) && array_key_exists('test', $_FILES)) {
  $filename=date("G-i-s");
  if (move_uploaded_file($_FILES['test']['tmp_name'], "./tests/$filename.json")) header('Location: list.php');
 }
 echo "<p><h3>Список тестов:</h3></p>";
 $dir = 'tests';
 $tests = scandir($dir);
 foreach ($tests as $test){
     if ($test !=='..' and $test!=='.' and $test!=='test.php'){
        $testname=json_decode(file_get_contents('tests/'.urlencode($test)), true);
        $name=$testname['0']['testname'];
        echo "<p><a href='test.php?test=$test'> $name </a></p>";
 }
 }
?>

<html lang="ru">
  <head>
    <title>Загрузка тестов</title>
    <meta charset="utf-8">
  </head>
<body>
<p><h3>Загрузить тест:</h3></p>
<form action=admin.php method=post enctype=multipart/form-data>
<div>
<input type="file" name="test">
</div>
<input type="submit" name="test">
</form>
</body>
</html>