<?php 
/* 
1.	Слова предложения «Я хочу быть программистом»
 разбить на массив
и вывести каждое слово на новой строке
*/
 $a = array('я','хочу','быть','программистом');
$i = 0;
while ($i!=count($a))
{
    echo $a[$i] . '<br>';
    $i++;
}



/*
2.	В чём разница между «=», «==» и «===» ?

Ответ: 
«=» - оператор присваивания. 
«==» оператор сравнения (не строгое, то есть 0 и false принимаются за равные значения)
«===» оператор сравнения (строгое, то есть 0 и false принимаются за разные значения)
3.	Перечислите типы данных.

.1) int - целое число 
.2) float - дробное число 
.3) string - строка 
.4) boolean - логический 
.5) array - массив 

4.	Чем отличается константа от переменной?
Ответ: константа имеет постоянное значение в отличии от переменной.

5.	Объявите переменную «i» и присвойте ей значение 5
*/
$i = 5;

/*
6.	Чем отличается конструкция «if» от «elseif» ?
if - основное условие 
elseif - побочное условие, которое выполняется только
если основное условие равно false и побочное условие равно true 




7.	Для чего используется конструкция «foreach» ?
цикл для работ с массивами 

8.	Для чего используется «break» ?
используется для прерывания цикла 


9.	Чем отличается «include» от «require» ?
include - при ошибке подключения файла выводит ошибку и продолжает работу
require - при ошибке подключения файла выводит критическую ошибку и не продолжает работу

10.	В чем различия между «include» и «include_once»
include - будет подключать любой файл по несколько раз если буду повторные подключения 
include_once - проигнорирует повторные подключения одного и того же файла 

*/






