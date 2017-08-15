<?php

	ini_set('display_errors',1);
	error_reporting(E_ALL);

	//Логика
	
	//Массив с континентами. Каждое значение континента — массив с животными
	$animals = array (
		'Africa' => array('Achatina Fulica','Acinonyx Jubatus'),
		'Antartica' => array('Aegypius Monachus','Aepyceros Melampus'),
		'Asia' => array('Balaenoptera Acutorostrata','Panthera Tigris Sumatrae'),
		'Australia' => array('Canis Rufus','Homo Sapiens Neanderthalensis'),
		'Europe' => array('Gorilla Berengei','Gynnidomorpha Alisman'),
		'North America' => array('Lemur Catta','Leptailurus Serval'),
		'South America' => array('Moloch Horridus','Neofelis Nebulosa'),
	);
	
	//Выбираем из полного списка всех животных, чьи названия состоят из двух слов и создаём новый массив (animalsBy2))
	foreach ($animals as $continent) {
		foreach ($continent as $animal) {
			if (count(explode(' ', $animal)) === 2) {
				$animalsBy2[] = $animal; // новый массив
			}
		}
	}

	// Разбиваем названия животных на отдельные слова и создаём из них новый массив
	foreach ($animalsBy2 as $newAnimal) {
		$parts = explode (' ', $newAnimal);
		foreach ($parts as $part) {
			$partsOfNewAnimals[] = $part; // новый массив, part — слово-кусочек из названия животного
		}
	}
	
	//Перемешиваем массив
	shuffle($partsOfNewAnimals);
	
	//Создаём из кусочков названий животных новый массив с новыми названиями животных, где название состоит из двух идущих подряд кусочков
	for ($i=0; $i < count ($partsOfNewAnimals); $i++) {
		if ($i % 2) {} else { 
			$reallyNewAnimals[] = $partsOfNewAnimals[$i] . " " . $partsOfNewAnimals[$i+1]; //массив с новыми фантастическими животными
		}
	}
	
	//Распределяем новых животных по старым континентам. Принадлежность нового зверя определим по изначальной принаждлежности первого кусочка названия животного.
	$withNewHome = array ();
	foreach ($reallyNewAnimals as $element) {
		$words = explode (' ', $element);
		foreach ($animals as $key=>$value) {
			foreach ($value as $valuee) {
				$alls = explode (' ', $valuee);
				if ($words[0]==$alls[0] or $words[0]==$alls[1]) {
					$withNewHome[$key][] = $element;
	}}}}				
	
	//Функции для вывода
	
	//Вывод животных на экран для двухмерного массива массива в виде отдельных строчек в таблице
	function AnimalsOnTheScreen2x ($array) {
		echo "<table class=\"table\">";
			echo "<tr>";
			foreach ($array as $key=>$value) {
				echo "<td><b>" . $key . "</b><br/>";
				foreach ($value as $element) {
					if (str_word_count($element) == 2) {
						echo $element;
						echo '<br/>';
					} else {
						echo $element . "*"; //подсказка: тут звёздочкой отмечаются животные, чьи названия состоят из 3 слов. В работе преобразований они не участвуют.
						echo '<br/>';
					}
				}
				echo "</td>";
			}
			echo "</tr>";
		echo "<table>";
	}
	
	//Вывод животных на экран для двухмерного массива массива в одной строке
	function AnimalsOnTheScreen2xString ($array) {
		foreach ($array as $key=>$value) {
			echo "<p><b>" . $key . "</b> → ";
			$string = implode (', ', $value);
			echo $string;
			echo "</p>";
			}
		}
	
	//Вывод животных на экран для одномерного массива
	function AnimalsOnTheScreen1x ($array) {
		foreach ($array as $element) {
			echo $element;
			echo '<br/>';
		}
	}

?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Жестокое обращение с животными</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<hr>
				<img src="image.jpg" class="img-responsive">
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<h4>Список животных</h4>
				<?php echo AnimalsOnTheScreen2x($animals); ?>
						</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4>Создаем новый массив</h4>
				<p><em>Теперь найдите всех зверей, название которых состоит из двух слов.</em></p>
				<table class="table">
					<tr>
						<td>
						<p><b>вот обычные животные</b></p>
						<?php echo AnimalsOnTheScreen1x($animalsBy2); ?>
						</td>
						<td>
						<p><b>все животные разлетаются на кусочки<br/>и перемешиваются</b></p>
						<?php echo AnimalsOnTheScreen1x($partsOfNewAnimals); ?>
						</td>
						<td>
						<p><b>из кусочков старых животных<br/>создаются новые</b></p>
						<?php echo AnimalsOnTheScreen1x($reallyNewAnimals); ?>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4>Принадлежность животного</h4>
				<p><em>Правило следующее принадлежность нового зверя определим по изначальной принаждлежности первого кусочка названия животного:</em></p>
				<?php echo AnimalsOnTheScreen2xString($withNewHome); ?>
			</div>
		</div>
	</div>
    <footer class="footer">
      <div class="container">
        <p class="text-muted">Конец</p>
      </div>
    </footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>
