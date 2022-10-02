﻿<?php

/**
 * @charset UTF-8
 *
 * Задание 3
 * В данный момент компания X работает с двумя перевозчиками
 * 1. Почта России
 * 2. DHL
 * У каждого перевозчика своя формула расчета стоимости доставки посылки
 * Почта России до 10 кг берет 100 руб, все что cвыше 10 кг берет 1000 руб
 * DHL за каждый 1 кг берет 100 руб
 * Задача:
 * Необходимо описать архитектуру на php из методов или классов для работы с
 * перевозчиками на предмет получения стоимости доставки по каждому из указанных
 * перевозчиков, согласно данным формулам.
 * При разработке нужно учесть, что количество перевозчиков со временем может
 * возрасти. И делать расчет для новых перевозчиков будут уже другие программисты.
 * Поэтому необходимо построить архитектуру так, чтобы максимально минимизировать
 * ошибки программиста, который будет в дальнейшем делать расчет для нового
 * перевозчика, а также того, кто будет пользоваться данным архитектурным решением.
 *
 */

# Использовать данные:
# любые

/* Решение */
interface Post
{
    public function get_posting_cost($weight);
}

class RussianPost implements Post
{
    public function get_posting_cost($weight)
    {
        return ($weight < 10) ? 100 : 1000;
    }
}

class DHL implements Post
{
    public function get_posting_cost($weight)
    {
        return $weight * 100;
    }
}

$post1 = new RussianPost();
$post2 = new DHL();
$cost1 = $post1->get_posting_cost(20);
$cost2 = $post2->get_posting_cost(20);


//echo $cost1, ' ', $cost2;
