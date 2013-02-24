<?php
/* Размеры мониторинга */
$width = 165; // Длинна мониторинга
$height = 20; // Высота мониторинга

/* Всякие украшательства */
$border = false; // Рисовать рамку или нет
$radius = 10; // Радиус закругления картинки: 0 - не скруглять, 10 - максимальное скругение
$rate = 2; // Качество сглаживания закругления (чем выше, тем больше затрачиваемые ресурсы)
// Скругление ИМХО не совместимо с рамкой, но если вам понравится =/ пожалуйста

/* Текст */
$capital = true; // Все буквы заглавные
$align = 'center'; // Выравнивание надписи (center / left / right)
$font_size = 10; // Размер шрифта
$updown = 1; // Корректировка положения по высоте (+ вверх - вниз)
$leftright = 0; // Корректировка положения по ширине (+ влево - вправо)

/* Иконка */
$iupdown = 0; // Корректировка положения иконки по высоте (+ вверх - вниз)
$ileftright = 0; // Корректировка положения иконки по ширине (+ вправо - влево)

/* Цвета */
$font_online_color = '1e331e'; // Цвет текста, когда сервер online
$font_full_color = 'ffffff'; // Цвет текста, когда сервер полный
$font_offline_color = 'ffffff'; // Цвет текста, когда сервер offline
$border_color = 'BEBEBE'; // Цвет рамки (если включена)
?>