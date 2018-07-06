<?php
loadHelper(TEMPLATE);
?>
<!-- start wrapper -->
<div class="wrap-main">
    <!-- start content -->
  <div class="content page-main">
    <!-- header -->
    <header class="container header-main">
      <!-- list phone -->
      <div class="list-phone">
        <a class="itm-phone -state" href="tel:<?=getOption('nomer-telefona-1')?>"><?=getOption('nomer-telefona-1')?></a>
        <a class="itm-phone -kyivstar" href="tel:<?=getOption('nomer-telefona-2')?>"><?=getOption('nomer-telefona-2')?></a>
        <a class="itm-phone -vodafone" href="tel:<?=getOption('nomer-telefona-3')?>"><?=getOption('nomer-telefona-3')?></a>
      </div>
      <!-- list phone -->
      <!-- toggle mobile menu/menu -->
      <div class="toggle-menu -menu js-toggle-dropdown" data-target="menu">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <!-- toggle mobile menu/phone -->
      <div class="toggle-menu -phone -fixed js-toggle-dropdown" data-target="phone"><i class="fa fa-phone" aria-hidden="true"></i></div>
      <!-- mobile menu / -menu -->
      <div class="dropdown-list menu">
        <i class="fa fa-times close js-close-menu" aria-hidden="true"></i>
        <ul>
          <li class="itm-menu itm -icon-1"><a href="/">Главная</a></li>
          <li class="itm-menu itm -icon-2"><a href="/obyekti/">Объекты</a></li>
          <li class="itm-menu itm -icon-3"><a href="/rassrochka/">Рассрочка</a></li>
          <li class="itm-menu itm -icon-4"><a href="/kontakty/">Контакты</a></li>
        </ul>
      </div>
      <!-- mobile menu / -menu -->
      <div class="dropdown-list phone">
        <i class="fa fa-times close js-close-menu" aria-hidden="true"></i>
        <div>
          <a class="itm-phone itm -state" href="tel:<?=getOption('nomer-telefona-1')?>"><?=getOption('nomer-telefona-1')?></a>
          <a class="itm-phone itm -kyivstar" href="tel:<?=getOption('nomer-telefona-2')?>"><?=getOption('nomer-telefona-2')?></a>
          <a class="itm-phone itm -vodafone" href="tel:<?=getOption('nomer-telefona-3')?>"><?=getOption('nomer-telefona-3')?></a>
        </div>
      </div>
      <!-- logo -->
      <div class="logo-company">
        <a href="/"><img src="<?=getOption('logo')?>" alt=""></a>
      </div>
      <!-- logo -->
    </header>
    <!-- header -->
    <!-- menu -->
    <div class="wrap-menu">
      <ul class="menu-main container">
        <li class="col itm"><a class="itm-menu -icon-1" href="/">Главная</a></li>
        <li class="col itm"><a class="itm-menu -icon-2" href="/obyekti/">Объекты</a></li>
        <li class="col itm"><a class="itm-menu -icon-3" href="/rassrochka/">Рассрочка</a></li>
        <li class="col itm"><a class="itm-menu -icon-4" href="/kontakty/">Контакты</a></li>
      </ul>
    </div>
    <!-- menu -->