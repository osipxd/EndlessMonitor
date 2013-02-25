<?php
/* Стиль мониторинга. 
По умолчанию доступен только Default
Но вы можете добавить свои или скачать стили */
$style = 'Ensemplix'; // Название стиля
$full = false; // Использовать особую катринку если сервер полный (full.png)

// Надписи
$full_mess = 'Full'; // Надпись когда сервер полный
$err_mess = 'Error'; // Надпись при ошибке
$off_mess = 'Сервер недоступен'; // Надпись когда сервер оффлайн 

/* Пути */
$icon_path = '/icons'; // Если вам вдруг приспичит закосить под энсемпликс, пожалуйста
$save_path = '/status'; // Папка, куда сохраняется мониторинг
$style_path = '/styles'; // Папка со стилями

/* Системное */
$interval = 2; // Частота обновления в минутах. Секунды: 37/60(каждые 37 сек) 1/2(каждые 30 сек)
$debug = true; // Отладка

/* Список серверов
 IP серверов ($address['НАЗВАНИЕ_СЕРВЕРА'])
 Порты серверов ($port['НАЗВАНИЕ_СЕРВЕРА']) */
$servers = array(
    'server',
    'server1'
);

// Ваш сервер (server)
$ips['server'] = 'SV1.ENSEMPLIX.RU'; // Сюда ip
$ports['server'] = 25564; // Сюда порт
$maxonline['server'] = 100; // For AllOnline
$infourl['server'] = 'http://mysite.ru/serverinfo'; // For EnsemplixStyle
$mapurl['server'] = 'http://mysite.ru/servermap'; // For EnsemplixStyle

// Еще один сервер (server1)
$ips['server1'] = 'SV1.ENSEMPLIX.RU'; // Сюда ip
$ports['server1'] = 25565; // Сюда порт
$maxonline['server1'] = 100; // For AllOnline
$infourl['server1'] = 'http://mysite.ru/server1info'; // For EnsemplixStyle
$mapurl['server1'] = 'http://mysite.ru/server1map'; // For EnsemplixStyle
// И так сколько угодно серверов...
?>