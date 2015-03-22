<?
class AskmeAction extends MyAction
{
  public function run()
  {
    $controller = $this->getController();
    $controller->run('loadconfig');
    $settings = $controller['settings'];

    $contact = MyGetters::make()->add($_POST['contact']);
    if (!$contact->have()) $this->abort('Чтобы я мог ответить вам, вам нужно указать Skype, телефон или электронный адрес.');
    $contact = $contact->get();

    $username = MyGetters::make()->add($_POST['username'])->push('Аноним')->get();

    $help = MyGetters::make()->add($_POST['help'])->push(0)->get();
    $referrer = MyGetters::make()->add($_POST['referrer'])->push(0)->get();
    $already = MyGetters::make()->add($_POST['already'])->push(0)->get();

    $already = ($already) ? 'Да' : 'Нет';

    foreach ($settings['selects']['referrer'] as $option) {
      if ( (string) $option['value'] === (string) $referrer) {
        $referrer = $option['title'];
        break;
      }
    }

    foreach ($settings['selects']['help'] as $option) {
      if ( (string) $option['value'] === (string) $help) {
        $help = $option['title'];
        break;
      }
    }

    $is_email = false;
    $is_skype = false;
    $is_phone = false;

    $contact_type = 'Собственное имя';
    if ($is_email = MyValid::is_valid('email', $contact)) $contact_type = 'Электронный адрес';
    if ($is_skype = MyValid::is_valid('skype', $contact)) $contact_type = 'Скайп';
    if ($is_phone = MyValid::is_valid('phone', $contact)) $contact_type = 'Телефон';

    $data = array();

    $data['contact'] = $contact;
    $data['contact_type'] = $contact_type;
    $data['username'] = $username;
    $data['help'] = $help;
    $data['referrer'] = $referrer;
    $data['already'] = $already;

    Yii::app()->mailer->isHTML(true);

    if ($is_email) {
      Yii::app()->mailer->AddAddress($contact); // USER EMAIL ADRESS
      Yii::app()->mailer->Subject = '[Григорий Васильков] Спасибо за проявленный интерес';
      Yii::app()->mailer->Body = $controller->view('//main/email/askme_user', $data);
      Yii::app()->mailer->AltBody = $controller->view('//main/email/askme_user_text', $data);

      if (!Yii::app()->mailer->send()) $this->abort('Сайту не удалось отправить оповещение на вашу почту.');
      Yii::app()->mailer->ClearAllRecipients();
    }

    $email = $controller['settings']['admin']['email'];
    if (!is_var($email)) $this->abort('В настройках не указан адрес администратора. Пожалуйста, позвоните по телефону вверху страницы.');

    Yii::app()->mailer->addAddress($controller['settings']['admin']['email']); // ADMIN EMAIL ADRESS
    Yii::app()->mailer->Subject = '[Сайт Резюме] Зарегистрирован новый вопрос';
    Yii::app()->mailer->Body = $controller->view('//main/email/askme_admin', $data);
    Yii::app()->mailer->AltBody = $controller->view('//main/email/askme_admin_text', $data);

    if (!Yii::app()->mailer->send()) $controller->error('Сайту не удалось отправить письмо на мою почту. Пожалуйста, перезвоните мне по телефону вверху страницы.');
    Yii::app()->mailer->ClearAllRecipients();

    $this->complete('Я получил ваше письмо. Как только буду в сети, сразу же вам отвечу.');
  }
}