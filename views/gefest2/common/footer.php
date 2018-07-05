<?php
  loadHelper(TEMPLATE);
  $noImage = '/noImage.png';
?>
  </div>
  <!--  end content -->
  <!-- footer -->
  <footer class="footer-main footer">
    <div class="wrap-cols container">
      <div class="col logo">
        <!-- logo -->
        <div class="logo-company">
          <a href="/"><img src="<?=getOption('logo')?>" alt=""></a>
        </div>
        <!-- logo -->
      </div>
      <ul class="col menu">
        <li><a href="/obyekti/" class="link">Объекты</a></li>
        <li><a href="/rassrochka/" class="link">Рассрочка</a></li>
        <li><a href="/kontakty/" class="link">Контакты</a></li>
      </ul>
      <ul class="col contacts">
        <li><a class="itm-phone -state" href="tel:0487035355"><?=getOption('nomer-telefona-1')?></a></li>
        <li><a class="itm-phone -kyivstar" href="tel:0681215355"><?=getOption('nomer-telefona-2')?></a></li>
        <li><a class="itm-phone -vodafone" href="tel:0951916555"><?=getOption('nomer-telefona-3')?></a></li>
      </ul>
      <div class="col fabrika-logo">
        <a href="#" class="title">Сайт разработан:</a>
        <a href="#">
          <img src="/assets/img/fabrika-logo.png" alt="Веб-студия Фабрика Идей">
        </a>
      </div>
    </div>
    <div class="copyright-block">
      <p class="title">© <a href="/"><?=$_SERVER['HTTP_HOST']?></a>, <?=date('Y')?></p>
    </div>
  </footer>
  <!-- footer -->
</div>
<!-- end wrapper -->
<?=getScripts()?>
</body>
</html>