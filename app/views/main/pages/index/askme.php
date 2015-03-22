<div class="line">
  <div class="row line">
    <div class="row-header line">
      <h2>Задать вопрос</h2>
    </div>
    <div class="row-content line">
      <span>Если вы:<br />
      - нуждаетесь в услугах программиста<br />
      - имеете предложения по совместным проектам<br />
      - вас интересует вопрос, связанный с программированием в интернет<br />
      вы <em>можете отправить свой запрос</em> мне прямо здесь.<br />
      <br />
      Как только я выйду в сеть, я немедленно отвечу Вам.</span>
    </div>
  </div>
  <form name="askmeform" action="/askme" class="row line">
    <div class="columnslot line">
      <div class="columns line columns3">
        <div class="column">
          <div class="input">
            <input type="text" name="username" placeholder="Как Вас зовут?"/>
          </div>
          <div class="input">
            <? echo $help_select; ?>
          </div>
        </div>
        <div class="column">
          <div class="input">
            <div class="checkbox">
              <div class="label">
                <table class="e-center">
                  <tr>
                    <td>
                      <label class="dotted" for="askmeform-checkbox-already">Я уже создавал проекты с другими фрилансерами</label>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="field">
                <input id="askmeform-checkbox-already" checked="checked" value="1" name="already" type="checkbox"/>
                <label for="askmeform-checkbox-already"></label>
                <div class="checked"></div>
              </div>
            </div>
          </div>
          <div class="input">
            <? echo $referrer_select; ?>
          </div>
        </div>
        <div class="column">
          <div class="input">
            <input type="text" name="contact" placeholder="Телефон, E-mail или Skype"/>
          </div>
          <div class="input">
            <input type="text" name="referrername" placeholder="Кого именно благодарить за рекомендацию?"/>
          </div>
        </div>
      </div>
      <div class="columns columns3">
        <div class="column colspan2">
          <div class="input">
            <textarea style="height: 60px;" name="text" rows="3" placeholder="Кратко по вашему вопросу"></textarea>
          </div>
        </div>
        <div class="column">
          <div class="input">
            <div class="button">
              <div style="height: 60px;" type="button" class="btn" data-button="askme">
                <table class="e-center">
                  <tr>
                    <td><div class="line">
                      <span>Отправить запрос</span>
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