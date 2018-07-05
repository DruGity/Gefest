<?=getHead($meta)?>
<?=getHeader()?>
<?php
loadHelper(TEMPLATE);
?>
    <!-- banner -->
    <div class="banner-main container">
      <img class="banner -desktop" src="/assets/img/banners/banner-0.jpg" alt="Июльские скидки">
      <img class="banner -mobile" src="/assets/img/banners/banner-1.jpg" alt="Июльские скидки">
      <a href="#" class="btn -red">Узнать подробнее</a>
    </div>
    <!-- banner -->
    <!-- form -->
    <div class="container">
      <div class="title-form -mobile js-open-form">
        <h1 class="title">Подберите себе жилье</h1>
        <i class="fa fa-angle-down icon" aria-hidden="true"></i>
      </div>
      <div class="wrap-fit-object">
        <form class="fit-object form" action="" method="POST">
          <div class="half">
            <div class="title-form -desktop">
              <h1 class="title">Подберите себе жилье</h1>
            </div>
            <div class="wrap-fields">
              <!-- жк -->
              <div class="field-block js-step" data-next-step=".js-second-step">
                <p class="label">Выберите ЖК</p>
                <div class="select-block field">
                  <p class="selected-itm js-toggle-dropdown">ЖК "Акрополь"</p>
                  <ul class="select-list dropdown-list">
                    <li class="itm js-select-itm js-show-object" data-target="/assets/img/objects/object-1.jpg">ЖК "Акрополь"</li>
                    <li class="itm js-select-itm js-show-object" data-target="/assets/img/objects/object-2.jpg">ЖК "Родос"</li>
                    <li class="itm js-select-itm js-show-object" data-target="/assets/img/objects/object-3.jpg">ЖК "Милос"</li>
                    <li class="itm js-select-itm js-show-object" data-target="/assets/img/objects/object-4.jpg">ЖК "Корфу"</li>
                    <li class="itm js-select-itm js-show-object" data-target="/assets/img/objects/object-5.jpg">ЖК "Лимнос"</li>
                    <li class="itm js-select-itm js-show-object" data-target="/assets/img/objects/object-6.jpg">ЖК "Миконос"</li>
                  </ul>
                  <input type="hidden" name="type">
                </div>
              </div>
              <!-- жк -->
              <!-- картинки -->
              <div class="gallery-block js-gallery">
                <img class="itm hidden" src="/assets/img/objects/object-1.jpg" alt="ЖК “Милос”">
                <img class="itm target" src="/assets/img/objects/object-2.jpg" alt="ЖК Родос">
              </div>
              <!-- картинки -->
              <!-- тип -->
              <div class="field-block js-step js-second-step" data-next-step=".js-third-step">
                <p class="label">Тип помещения</p>
                <div class="select-block field">
                  <p class="selected-itm js-toggle-dropdown disabled">Жилое</p>
                  <ul class="select-list dropdown-list">
                    <li class="itm js-select-itm">Жилое</li>
                    <li class="itm js-select-itm">Офисное</li>
                    <li class="itm js-select-itm">Техническое</li>
                  </ul>
                  <input type="hidden" name="name">
                </div>
              </div>
              <!-- тип -->
              <!-- площади -->
              <div class="field-block js-step js-third-step">
                <p class="label">Выбор площади</p>
                <div class="select-block field">
                  <p class="selected-itm js-toggle-dropdown disabled">20<span> кв.м.</span></p>
                  <ul class="select-list dropdown-list">
                    <li class="itm js-select-itm">20<span> кв.м.</span></li>
                    <li class="itm js-select-itm">25<span> кв.м.</span></li>
                    <li class="itm js-select-itm">15<span> кв.м.</span></li>
                  </ul>
                  <input type="hidden" name="square">
                </div>
              </div>
            </div>
          </div>
          <div class="full">
            <!-- phone -->
            <div class="field-block col">
              <p class="label">Ваш телефон</p>
              <div class="input-block field">
                <input type="text" name="phone" id="phone" class="input -red" placeholder="+380(__) ___-__-__">
              </div>
            </div>
            <!-- name -->
            <div class="field-block col">
              <p class="label">Ваше имя</p>
              <div class="input-block field">
                <input type="text" name="clientName" class="input">
              </div>
            </div>
            <!-- submit -->
            <div class="field-block col">
              <div class="submit-block field">
                <input type="submit" class="submit btn -red">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- form -->
    <!-- objects -->
    <section class="object-list">
      <h3 class="title-main bg-decore">Объекты</h3>
      <!-- objects list -->
      <div class="container">
        <div class="wrap-objects">
          <!-- object -->
          <div class="itm-object col">
            <h4 class="title">жк «Акрополь»</h4>
            <div class="photo labeled">
              <div class="label">Реализованный</div>
              <img src="/assets/img/objects/object-1.jpg" alt="жк «Акрополь»">
            </div>
            <div class="wrap-desc">
              <div class="desc-block">
                <span class="strong">Адрес: </span>Фонтанская дорога, 25 (Тополевый, 17А)
              </div>
              <div class="desc-block">
                <span class="strong">Срок сдачи: </span>IV квартал 2019 г.
              </div>
            </div>
            <div class="wrap-btn">
              <a href="#" class="btn -red -small">Подробнее</a>
            </div>
          </div>
          <!-- object -->
          <div class="itm-object col">
            <h4 class="title">жк "Родос"</h4>
            <div class="photo labeled">
              <div class="label">Реализованный</div>
              <img src="/assets/img/objects/object-2.jpg" alt="жк «Акрополь»">
            </div>
            <div class="wrap-desc">
              <div class="desc-block">
                <span class="strong">Адрес: </span>Фонтанская дорога, 25 (Тополевый, 17А)
              </div>
              <div class="desc-block">
                <span class="strong">Срок сдачи: </span>IV квартал 2019 г.
              </div>
            </div>
            <div class="wrap-btn">
              <a href="#" class="btn -red -small">Подробнее</a>
            </div>
          </div>
          <!-- object -->
          <div class="itm-object col">
            <h4 class="title">жк «Милос»</h4>
            <div class="photo labeled">
              <div class="label">Реализованный</div>
              <img src="/assets/img/objects/object-3.jpg" alt="жк «Акрополь»">
            </div>
            <div class="wrap-desc">
              <div class="desc-block">
                <span class="strong">Адрес: </span>Фонтанская дорога, 25 (Тополевый, 17А)
              </div>
              <div class="desc-block">
                <span class="strong">Срок сдачи: </span>IV квартал 2019 г.
              </div>
            </div>
            <div class="wrap-btn">
              <a href="#" class="btn -red -small">Подробнее</a>
            </div>
          </div>
          <!-- object -->
          <div class="itm-object col">
            <h4 class="title">жк «Корфу»</h4>
            <div class="photo labeled">
              <div class="label">Реализованный</div>
              <img src="/assets/img/objects/object-4.jpg" alt="жк «Акрополь»">
            </div>
            <div class="wrap-desc">
              <div class="desc-block">
                <span class="strong">Адрес: </span>Фонтанская дорога, 25 (Тополевый, 17А)
              </div>
              <div class="desc-block">
                <span class="strong">Срок сдачи: </span>IV квартал 2019 г.
              </div>
            </div>
            <div class="wrap-btn">
              <a href="#" class="btn -red -small">Подробнее</a>
            </div>
          </div>
          <!-- object -->
          <div class="itm-object col">
            <h4 class="title">жк «Лимнос»</h4>
            <div class="photo labeled">
              <div class="label">Реализованный</div>
              <img src="/assets/img/objects/object-5.jpg" alt="жк «Акрополь»">
            </div>
            <div class="wrap-desc">
              <div class="desc-block">
                <span class="strong">Адрес: </span>Фонтанская дорога, 25 (Тополевый, 17А)
              </div>
              <div class="desc-block">
                <span class="strong">Срок сдачи: </span>IV квартал 2019 г.
              </div>
            </div>
            <div class="wrap-btn">
              <a href="#" class="btn -red -small">Подробнее</a>
            </div>
          </div>
          <!-- object -->
          <div class="itm-object col">
            <h4 class="title">жк «Миконос»</h4>
            <div class="photo labeled">
              <div class="label">Реализованный</div>
              <img src="/assets/img/objects/object-6.jpg" alt="жк «Акрополь»">
            </div>
            <div class="wrap-desc">
              <div class="desc-block">
                <span class="strong">Адрес: </span>Фонтанская дорога, 25 (Тополевый, 17А)
              </div>
              <div class="desc-block">
                <span class="strong">Срок сдачи: </span>IV квартал 2019 г.
              </div>
            </div>
            <div class="wrap-btn">
              <a href="#" class="btn -red -small">Подробнее</a>
            </div>
          </div>
        </div>
        <div class="wrap-btn">
          <a href="#" class="btn -grey -small">Все объекты</a>
        </div>
      </div>
      <!-- objects list -->
    </section>
    <!-- objects -->
    <!-- sale -->
    <div class="sale-block">
      <div class="container">
        <p class="text col">
          Рассрочка с первым взносом всего от 10%
        </p>
        <div class="col">
          <a href="#" class="btn -white">Узнать больше</a>
        </div>
      </div>
    </div>
    <!-- sale -->
    <!-- about -->
    <section class="about-block">
      <h3 class="title-main bg-decore">Объекты</h3>
      <div class="container">
        <div class="content">
          <p>
            Вот уже более 20 лет строительная компания «Гефест» строит в Одессе многоэтажные комфортабельные жилые дома. За это время были построены такие жил массивы как: ЖК «Милос» - дом на Клубничном переулке, ЖК «Лимнос» -  дом на Педагогической, ЖК «Корфу» - дом на 10 станции Большого Фонтана, ЖК «Акрополь» - дом на 5 станции Большого Фонтана, ЖК «Родос» - дом на Генуэзской, ЖК «Миконос», ЖК «Санторини». Выбирая СК «Гефест», Вы выбираете выгодное предложение о покупке недвижимости по выгодной цене, а так же высокое качество материалов, в сроки сданный проект и эргономичную планировку.  По вопросам приобретения недвижимости в городе Одесса, Вы всегда можете обратить в СК Гефест отдел продаж, где Вам подробно ответят на все интересующие Вас вопросы и Вы сможете сделать взвешенный выбор. СК «Гефест» в Одессе – это прозрачная сделка строителя с покупателем. Так же более подробную информацию о СК «Гефест» и сданных домах можно получить на сайте «Гефест» Одесса либо непосредственно обратившись в наш офис».
          </p>
          <div class="hidden-block" data-target="desc">
            <p>
              Сданные дома от «Гефест» - это по истине украшение города, так как их место положение тщательно выбиралось и продумывалось, а над созданием трудились группа архитекторов и дизайнеров, которые позаботились об эстетике и безопасности здания.  По этому наши дома строятся в самых лучших районах города.
            </p>
            <p>
              ЖК «Милос» от строительной компании «Гефест» расположен в одном из самых удобных безопасных районов города с удобной транспортной развязкой и инфраструктурой. ЖК «Милос» в Одессе построен из высококачественных материалов с соблюдением всех мер безопасности. ЖК «Милос» - это удобная эргономичная планировка, приемлемая цена и выгодные условия рассрочки.
            </p>
            <p>
              ЖК «Лимнос» в Одессе будет построен в одном из лучших мест в городе, роскошная планировка, выгодные цены, все это от СК «Гефест». Вы сможете наслаждаться греческой атмосферой и стилем в самом сердце Одессы, совсем недалеко от моря.
            </p>
            <p>
              ЖК «Корфу» от строительной компании «Гефест» в Одессе расположен на самом берегу моря. ЖК «Корфу» - это комфортабельное жилье со своей инфраструктурой, ресторанами и кафе. Именно здесь Вы сможете ежедневно наслаждаться морскими пейзажами и чувствовать себя в абсолютной безопасности, все это по самой выгодной цене в Одессе с удобными планировками из самых высококачественных материалов.
            </p>
            <p>
              ЖК «Акрополь» от строительной компании «Гефест» - это жилье, расположенное в парковой зоне на 5 ст. Большого Фонтана. ЖК «Акрополь» в Одессе – это высококлассное жилье по выгодной цене. «Акрополь» в Одессе построен по современным стандартам безопасности и эргономики, Вы получаете, просторное светлое жилье с удобной планировкой.
            </p>
            <p>
              ЖК «Родос» в Одессе строится в 5 минутах от Аркадии и парка Победы. Это комфортабельное жилье по выгодной цене с лучшими условиями рассрочки и удобной планировкой. Качественные материалы и стильный фасад, удобная развязка и инфраструктура.
            </p>
            <p>
              ЖК «Миконос» от строительной компании «Гефест» в Одессе – это гостинично-жилой комплекс на берегу моря на 10 ст. Большого Фонтана. ЖК «Миконос» от СК «Гефест» - это просторные апартаменты с двухэтажной парковкой, удобной планировкой по выгодной цене. Ежедневно Вы сможете наслаждаться не только морским бризом, но и любоваться прекрасными морскими видами, прямо из окна Вашей квартиры.
            </p>
            <p>
              ЖК «Санторини» в Одессе расположен в парковой зоне на 10 ст. Большого Фонтана. ЖК «Санторини» от СК «Гефест» - это жилье из высококачественных материалов в элитном районе города с удобной планировкой и выгодными ценами. Удобная инфраструктура и транспортная развязка в 5 минутах от моря, что может быть лучше, для счастливой жизни!
            </p>
          </div>
          <div class="wrap-link">
            <a href="#" class="link js-open-text" data-target="desc">Читать далее</a>
          </div>
        </div>
      </div>
    </section>
    <!-- about -->

<?=getFooter()?>