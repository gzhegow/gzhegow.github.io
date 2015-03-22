<div class="line">
  <div class="row line">
    <div class="row-header line">
      <h2>Оставить отзыв</h2>
    </div>
    <div class="row-content line">
      <span>Если вы остались довольны моей работой,<br />
      напишите свой отзыв. Мне будет приятно, а вам как полагается - цена пониже.<br />
      <br />
      Как только я выйду в сеть, я опубликую отзыв на сайте.</span>
    </div>
  </div>
  <form name="responsesform" action="/askme" class="row line">
    <div class="columnslot line">
      <div class="columns line columns3">
        <div class="column">
          <div class="input">
            <input type="text" name="username" placeholder="Как Вас зовут?"/>
          </div>
        </div>
        <div class="column">
          <div class="input">
            <? echo $fromhelp_select; ?>
          </div>
        </div>
        <div class="column">
          <div class="input">
            <input type="text" name="contact" placeholder="Телефон, E-mail или Skype"/>
          </div>
        </div>
      </div>
      <div class="columns columns3">
        <div class="column colspan2">
          <div class="input">
            <textarea style="height: 60px" name="text" rows="3" placeholder="Текст вашего отзыва"></textarea>
          </div>
        </div>
        <div class="column">
          <div class="input">
            <div class="button">
              <div style="height: 60px" class="btn" data-button="responsesform">
                <table class="e-center">
                  <tr>
                    <td><div class="line">
                      <span>Оставить отзыв</span>
                    </div></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>