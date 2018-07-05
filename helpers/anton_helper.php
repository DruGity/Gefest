<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function getContacts()
{
	ob_start();
	?>
	<div class="contacts-wrapper">
        <div class="contacts-block">
            <div class="contacts-line-opener">
                <?php
                if(isset($_GET['lang']) && $_GET['lang'] == 'en')
                {
                    ?>
                        <img src="/assets/img/contact_me.png" alt="">
                    <?php
                }
                else
                {
                    ?>
                    <img src="/assets/img/callme.png" alt="">
                    <?php
                }
                ?>

                <i class="fas fa-angle-right"></i>
                <!-- <p>Связаться со мной</p> -->
            </div>
            <div class="contacts">
                <div class="c-foto">
                    <img src="/assets/img/anton.jpg" alt="Gumil Anton">
                    <h3 class="c-title">
                        <?=getLine('Мои контакты')?>
                    </h3>
                </div>
                <div class="contacts-body">
                    <h6 class="b-title">
                        <?=getLine('Вы можете')?>
                    </h6>
                    <!-- mob messengers -->
                    <div class="c-mob-messengers">
                        <a class="messenger" href="tel:<?=getOption('nomer-telefona')?>">
                            <img src="/assets/img/i-viber.png" alt="">
                        </a>
                        <a class="messenger" href="whatsapp://send?phone=<?=getOption('nomer-telefona')?>">
                            <img src="/assets/img/i-whatsapp.png" alt="">
                        </a>
                        <a class="messenger" href="tg://resolve?domain=<?=getOption('nickname-telegram')?>">
                            <img src="/assets/img/i-telegram.png" alt="">
                        </a>
                    </div>
                    <!-- mob messengers -->
                    <!-- phones -->
                    <div class="c-tel">
                        <p class="t-title c-subtitle">
                            <i class="fas fa-phone"></i>
                            <?=getLine('Позвонить мне')?>
                        </p>
                        <a href="tel:<?=getOption('nomer-telefona')?>" class="tel"><?=getOption('nomer-telefona')?></a>
                    </div>
                    <!-- phones -->
                    <!-- messengers -->
                    <div class="c-messengers">
                        <p class="m-title c-subtitle">
                            <i class="fas fa-pencil-alt"></i>
                            <?=getLine('или написать в любом удобном для Вас мессенджере(для этого сохраните мой номер):')?>
                            <?=getOption('text'.'_'.$GLOBALS['current_lang'])?>
                            <?php
//                            if($_SERVER['QUERY_STRING'] == 'lang=en'){
//
//                            }

                            ?>

                        </p>
                        <ul class="m-list">
                            -
                            .0
                            <li class="messenger-itm col">
                                <a class="messenger viber" href="tel:<?=getOption('nomer-telefona')?>">Viber</a>
                            </li>
                            <li class="messenger-itm col">
                                <a class="messenger whatsApp" href="whatsapp://send?phone=<?=getOption('nomer-telefona')?>">WhatsApp</a>
                            </li>
                            <li class="messenger-itm col">
                                <a class="messenger telegram" target="_blank" href="https://t.me/<?=getOption('nickname-telegram')?>">Telegram</a>
                            </li>
                        </ul>
                    </div>
                    <!-- messengers -->
                    <!-- emails -->
                    <div class="c-email">
                        <p class="e-title c-subtitle">
                            <i class="fas fa-envelope"></i>
                            <?=getLine('или на почту:')?>
                        </p>
                        <a class="email" href="mailto:<?=getOption('e-mail')?>"><?=getOption('e-mail')?></a>
                    </div>
                    <!-- emails -->
                    <!-- socials -->
                    <div class="c-socials">
                        <p class="s-title c-subtitle">
                            <i class="fas fa-globe"></i>
                            <?=getLine('или в соц.сетях')?>
                        </p>
                        <ul class="s-list">
                            <li class="social-itm instagram col">
                                <a class="social" target="_blank" href="<?=getOption('ssylka---instagram-reklama-i-reportazh')?>"><?=getLine('Реклама и репортаж')?></a>
                            </li>
                            <li class="social-itm instagram col">
                                <a class="social" target="_blank" href="<?=getOption('link_instagram')?>"><?=getLine('Фотосеты')?></a>
                            </li>
                            <li class="social-itm facebook col">
                                <a class="social" target="_blank" href="<?=getOption('link_facebook')?>"><?=getLine('Фотосеты')?></a>
                            </li>
                            <li class="social-itm pinterest col">
                                <a class="social" target="_blank" href="<?=getOption('ssylka---pinterest')?>"><?=getLine('Pinterest')?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- socials -->
                </div>
            </div>
            <div class="contacts-line-close">
                <i class="fas fa-angle-up"></i>
                <p><?=getLine('Свернуть')?></p>
            </div>
        </div>
    </div>
	<?php
    $html = ob_get_contents();
    ob_clean();
    return $html;
}