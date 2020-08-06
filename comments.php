<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 26.07.2020
 * Time: 06:53
 */

include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/connect.php';
include __DIR__ . '/function/addComments.php';

if(isset($_POST['fp_id'])){



        // Считаем кол-во комментариев
        $count = count($_POST['message']) - 1;

        // Получаем данные из формы
        $proxy = $_POST['proxy'];
        $fp_id =  $_POST['fp_id'];
        $ad_id =  $_POST['ad_id'];


        $count = count($_POST['message']) - 1;

    for($i = 0; $i <= $count; $i++) {

        // Выбираем автора
        $author = $db->fetch('SELECT * FROM author WHERE id="'.$_POST['author'][$i].'"');
        $token = $author['token'];

        // Отправляемое сообщение
        $message =  $_POST['message'][$i];


        $addComm = addComments($proxy, $fp_id, $ad_id, $message, $token, $curl); // публикуем комментарий
        if (isset($addComm['id'])) {
            echo 'Комментарий добавлен: ' . $addComm['id'] . '<br>';
        } else {
            echo $addComm;
        }
    }
}
