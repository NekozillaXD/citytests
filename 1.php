﻿<?php

/**
 * @charset UTF-8
 *
 * Задание 1. Работа с массивами.
 *
 * Есть 2 списка: общий список районов и список районов, которые связаны между собой по географии (соседние районы).
 * Есть список сотрудников, которые работают в определённых районах.
 *
 * Необходимо написать функцию для поиска сотрудника, у которого есть полное совпадение по району,
 * если таких сотрудников нет - тогда искать по соседним районам.
 *
 * Функция должна принимать 1 аргумент: название района (строка).
 * Возвращать: логин сотрудника или null.
 *
 */

# Использовать данные:

// Список районов
$areas = array (
		1 => '5-й поселок',
		2 => 'Голиковка',
		3 => 'Древлянка',
		4 => 'Заводская',
		5 => 'Зарека',
		6 => 'Ключевая',
		7 => 'Кукковка',
		8 => 'Новый сайнаволок',
		9 => 'Октябрьский',
		10 => 'Первомайский',
		11 => 'Перевалка',
		12 => 'Сулажгора',
		13 => 'Университетский городок',
		14 => 'Центр',
);

// Близкие районы, связь осуществляется по индентификатору района из массива $areas
$nearby = array (
		1 => array(12,11),
		2 => array(5,7,6,8),
		3 => array(11,13),
		4 => array(10,9,12),
		5 => array(2,6,7,8),
		6 => array(5,2,7,8),
		7 => array(2,5,6,8),
		8 => array(6,2,7,5),
		9 => array(10,14),
		10 => array(9,14,12),
		11 => array(13,3,1,12),
		12 => array(1,10),
		13 => array(11,1,12),
		14 => array(9,10),
);

// список сотрудников
$workers = array (
		0 => array (
				'login' => 'login1',
				'area_name' => 'Октябрьский',
		),
		1 => array (
				'login' => 'login2',
				'area_name' => 'Зарека',
		),
		2 => array (
				'login' => 'login3',
				'area_name' => 'Сулажгора',
		),
		3 => array (
				'login' => 'login4',
				'area_name' => 'Древлянка',
		),
		4 => array (
				'login' => 'login5',
				'area_name' => 'Центр',
		),
);

// Решение

/**
 * Находит работника в указанном или соседнем районе
 * 
 * @param string $area		район, в котором ведется поиск
 * @return string $login	логин найденного работника
 */
function find_worker($area)
{
	global $areas, $nearby, $workers;
	
	/**
	 * Возвращает логин работника в указанном районе
	 * 
	 * @param array $column		список районов, в которых есть работники
	 * @param string $area		район для поиска
	 * @param array $workers	массив с данными о работниках
	 * @return string $login	логин найденного работника
	 */
	function get_worker_login($column, $area, $workers)
	{
		$key = strval(array_search($area, $column));	// Ищем указанный район в списке тех, где есть работники
		if ($key != '')							// Если указанный район найден,
			return $workers[$key]['login'];		// возвращаем логин работника
		else									// иначе возвращаем null
			return null;
	}
	
	$column = array_column($workers, 'area_name'); 		// Список районов, в которых есть работники

	if(($login = get_worker_login($column, $area, $workers)) != null) 	// Если в указанном районе есть работник,
		return $login;													// возвращаем его логин
	else
		$areaKey = strval(array_search($area, $areas));		// Иначе получаем ключ указанного района
		$nearbyAreas = $nearby[$areaKey];					// Находим соседние районы
		foreach($nearbyAreas as $nearbyArea) {				// Выполняем поиск для каждого из соседних районов
			$login = get_worker_login($column, $areas[$nearbyArea], $workers);
			if ($login != null)		// Останавливаем поиск, если работник найден
				break;
		}
	return $login;
}

$login = find_worker('Сулажгора');
//echo $login;
?>
