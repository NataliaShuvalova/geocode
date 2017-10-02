<?php
require __DIR__ . '/vendor/autoload.php';

$api = new \Yandex\Geo\Api();

$add=$_POST['add'];

// Или можно икать по адресу
$api->setQuery($add);

// Настройка фильтров
$api
  ->setLimit('') // кол-во результатов
   ->setLang(\Yandex\Geo\Api::LANG_US) // локаль ответа
  ->load();

$response = $api->getResponse();
$response->getFoundCount(); // кол-во найденных адресов
$response->getQuery(); // исходный запрос
$response->getLatitude(); // широта для исходного запроса
$response->getLongitude(); // долгота для исходного запроса

$collection = $response->getList();
?>
<html>
	<header>
		<title>Адрес</title>
		<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
		</script>
	</header>
	<body>
		<form action="" method="post">
			<input type="text" name='add'/>
			<input type='submit' value='Ok'/>

			<?php foreach ($collection as $item) : ?>
			<ul>
				<li>
					 <?php echo'широта: '.$item->getLatitude().' долгота: '.$item->getLongitude().'<br/>';?>
				</li>
			</ul>
		</form><?php endforeach;?>
	</body>
</html>