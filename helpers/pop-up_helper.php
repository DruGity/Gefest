<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function popupHelper()
{
ob_start();
?>

<form action="" id="contact-popup" class="hide-popup" onSubmit="return false" >
    <div class="container">
        <header class="header-popup bg">
            <h1 class="white-text services-subTitle">
                Заполните форму
            </h1>
            <p>
                Мы с Вами свяжемся в ближайшее время и ответим на все вопросы
            </p>
            <i class="fa fa-times close-popup"></i>
        </header>
        <section class="main-popup">
            <input type="hidden" name="Title" value="" id="hidden_input" >
            <div class="input-wrapper">
                <label for="name">Ваше имя:</label>
                <input type="text" id="name" name = "Name">
                <label for="phone-number">Ваш номер телефона:</label>
                <input type="text" id="phone-number" name = "Phone">
            </div>
            <input type="submit" onclick="send_form2(); return false;" class="main-btn" value="Отправить">
        </section>
    </div>
</form>
<?php
$html = ob_get_contents();
ob_clean();
return $html;
}