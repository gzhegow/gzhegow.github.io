<div id="index" class="page line">
  <div style="width: 1200px;" class="centered">
    <div class="sheet line">
      <div class="begin line">
        <div class="photoborder"></div>
        <input id="photo" type="checkbox" name="photo" class="photo-input">
        <label for="photo" class="photo-label"></label>
        <? echo $sheetheader; ?>
        <? echo $blockquote; ?>
      </div>
      <div class="hello line">
        <div class="row line">
          <div class="row-header line">
            <h2>Добро пожаловать!</h2>
          </div>
          <div class="row-content line">
            <span>Вы находитесь на странице с моим резюме.<br />
            На этой странице можно немного узнать обо мне перед тем, как задать вопрос, передумать или предложить мне сотрудничество.<br />
            Я совершенно искренне считаю, что человек способен доверять только самому себе. А доверять другим только тогда, когда <u>он лично</u> решит, что убеждения другого человека похожи на его собственные.<br />
            <br />
            Что ж, здесь можно найти мои убеждения. По мере того, как нахожу еще одни <em>грабли в поле</em>, я добавляю сюда пункты, думаю вы тоже так делаете в своей жизни.<br />
            Очень надеюсь, что если мы будем сотрудничать, у нас с Вами будет много общего!</span>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-contents slider line">
        <div class="controls">
          <div data-page="0" class="tab-label abscontrol"><span><strong>Обо мне</strong></span></div>
          <div data-page="1" class="tab-label abscontrol"><span><strong>Опыт работы</strong></span></div>
          <div data-page="2" class="tab-label abscontrol"><span><strong>Принципы работы</strong></span></div>
          <div data-page="3" class="tab-label abscontrol"><span><strong>Последние работы</strong></span></div>
          <div data-page="4" class="tab-label abscontrol"><span><strong>Ваши отзывы</strong></span></div>
          <div data-page="5" class="tab-label abscontrol"><span><strong>Задать вопрос</strong></span></div>
          <div data-page="6" class="tab-label abscontrol"><span><strong>Оставить отзыв</strong></span></div>
        </div>
        <div class="sheet line">
          <div class="scene line">
            <div data-page="0" class="tab-content item line">
              <? echo $page_about; ?>
            </div>
            <div data-page="1" class="tab-content item line">
              <? echo $page_skills; ?>
            </div>
            <div data-page="2" class="tab-content item line">
              <? echo $page_principles; ?>
            </div>
            <div data-page="3" class="tab-content item line">
              <? echo $page_works; ?>
            </div>
            <div data-page="4" class="tab-content item line">
              <? echo $page_responses; ?>
            </div>
            <div data-page="5" class="tab-content item line">
              <? echo $page_askme; ?>
            </div>
            <div data-page="6" class="tab-content item line">
              <? echo $page_responseme; ?>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>