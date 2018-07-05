<!DOCTYPE html>
<html lang="ru">
<?=getHead()?>
<body>
<?=getHeader()?>
<div class="ocean">
  <div class="fish-1"></div>
  <div class="fish-2"></div>
  <div class="fish-3"></div>
  <div class="bottom-1">
    <div class="bush-small bush-small-1"></div>
    <div class="bush-small bush-small-2"></div>
    <div class="bush-small bush-small-3"></div>
  </div>
  <div class="bottom-2">
    <div class="ship"></div>
    <div class="bush-middle bush-middle-1"></div>
    <div class="bush-middle bush-middle-2"></div>
    <div class="bush-middle bush-middle-3"></div>
    <div class="bubble bubble-1"></div>
    <div class="bush-big bush-big-1"></div>
    <div class="anchor"></div>
    <div class="bubble bubble-2"></div>
  </div>
  <div class="bottom-3">
    <div class="crab"></div>
    <div class="stone"></div>
    <div class="bush-big bush-big-2"></div>
  </div>
</div>
<!-- main -->
<div class="page-error bordered">
  <div class="container">
    <p class="desc">ой, шо это?</p>
    <div class="title">404 ошибка</div>
    <p class="desc">Вы таки не туда попали</p>
    <div class="wrap-btn">
      <a href="/" class="btn-main">Лучше перейдите на главную</a>
    </div>
  </div>
</div>
<!-- main -->
<!-- footer -->
<div class="footer not-found">
  <div class="container">
    <!-- logo -->
    <div class="company-logo col">
      <a href="/"><img src="/assets/img/logo/small_white_logo.png" alt="Santorini. Самый вкусный вид на море."></a>
    </div>
    <!-- logo -->
    <!-- socials -->
    <div class="col wrap-socials">
      <p class="title"><?=getLine('Подписывайтесь на нас в соц.сетях:')?></p>
      <ul class="social-list">
        <li class="itm"><a href="<?=getOption('link_instagram')?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        <li class="itm"><a href="<?=getOption('link_facebook')?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li class="itm"><a href="<?=getOption('link_googleplus')?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
        <li class="itm"><a href="<?=getOption('trip-advisor')?>" target="_blank"><i class="fa fa-tripadvisor" aria-hidden="true"></i></a></li>
        </ul>
    </div>
    <!-- socials -->
    <!-- fabrika -->
    <div class="fabrika col">
      <a href="#">
        <span class="desc"><?=getLine('Сайт разработан')?></span>
        <img class="logo" src="/assets/img/fabrika-logo.png" alt="Веб-студия Фабрика идей">
      </a>
    </div>
    <!-- fabrika -->
  </div>
  <footer class="copyright"><p>© 2018 Santorini. All right reserved</p></footer>
</div>
<!-- footer -->
<?=getScripts()?>
</body>
</html>