<?php
require_once '../PHPWord.php';

$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('Leihschein_Template.docx');

$document->setValue('name' , 'Dominik Bartl' );
$document->setValue('abteilung' , 'HR');
$document->setValue('gegenstand' , 'Laptop 345');
$document->setValue('seriennummer' , '34BDH34');
$document->setValue('leihdauer' , '3 Wochen');
$document->setValue('leihgrund' , '');
$document->setValue('zeile1' , 'Tasche + Akku + Chipkarte');
$document->setValue('zeile2' , '');
$document->setValue('zeile3' , '');
$document->setValue('datum' , date('d.m.Y') );

/*
$document->setValue('Value1', 'Sun');
$document->setValue('Value2', 'Mercury');
$document->setValue('Value3', 'Venus');
$document->setValue('Value4', 'Earth');
$document->setValue('Value5', 'Mars');
$document->setValue('Value6', 'Jupiter');
$document->setValue('Value7', 'Saturn');
$document->setValue('Value8', 'Uranus');
$document->setValue('Value9', 'Neptun');
$document->setValue('Value10', 'Pluto');

$document->setValue('weekday', date('l'));
$document->setValue('time', date('H:i'));
*/

$document->save('Leihschein.docx');
?>