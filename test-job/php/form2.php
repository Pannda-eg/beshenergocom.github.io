<?php
    $msg_box = ""; // в этой переменной будем хранить сообщения формы
    $errors = array(); // контейнер для ошибок
    // проверяем корректность полей
    if($_POST['user_tel'] == "")     $errors[] = "Поле 'Телефон' не заполнено!";

    // если форма без ошибок
    if(empty($errors)) {
        // собираем данные из формы
        $message .= "Телефон пользователя: " . $_POST['user_tel'] . "<br/>";
        send_mail($message); // отправим письмо
        // выведем сообщение об успехе
        $msg_box = "<span style='color: green;'>Сообщение успешно отправлено!</span>";
        http_response_code(200);
    }else{
        // если были ошибки, то выводим их
        $msg_box = "";
        foreach($errors as $one_error){
            $msg_box .= "<span style='color: red;'>$one_error</span><br/>";
        }
        http_response_code(400);
    }

    // делаем ответ на клиентскую часть в формате JSON
    echo json_encode(array(
        'result' => $msg_box
    ));

    // функция отправки письма
    function send_mail($message){
        // почта, на которую придет письмо
        $mail_to = "test1111@mail.ru";
        // тема письма
        $subject = "Письмо с обратной связи";

        // заголовок письма
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
        $headers .= "From: Тестовое письмо <no-reply@test.com>\r\n"; // от кого письмо

        // отправляем письмо
        mail($mail_to, $subject, $message, $headers);
    }

?>