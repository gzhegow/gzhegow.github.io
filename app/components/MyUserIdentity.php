<?php
/**
 * CUserIdentity class file
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * CUserIdentity is a base class for representing identities that are authenticated based on a username and a password.
 *
 * Derived classes should implement {@link authenticate} with the actual
 * authentication scheme (e.g. checking username and password against a DB table).
 *
 * By default, CUserIdentity assumes the {@link username} is a unique identifier
 * and thus use it as the {@link id ID} of the identity.
 *
 * @property string $id The unique identifier for the identity.
 * @property string $name The display name for the identity.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.web.auth
 * @since 1.0
 */
class MyUserIdentity extends CUserIdentity
{
  const ERROR_NONE = 0;
  const ERROR_UNKNOWN = 1;
  const ERROR_INPUTSTRING_NONE = 2;
  const ERROR_PASSWORD_NONE = 3;
  const ERROR_INPUTSTRING_INVALID = 4;
  const ERROR_PASSWORD_INVALID = 5;
  const ERROR_INPUTSTRING_NOTRECOGNIZED = 6;
  const ERROR_NO_USER_FOUND = 7;

  protected $id = null;
	protected $username = null;
	protected $email = null;
  protected $userphone = null;
  protected $phone = null;
  protected $password = null;
  protected $role = null;

  protected $errorCode = 0;

  protected $messages = array();
  protected $errors = array();

  public function addError($_flag = null) {
    if (!$_flag) return false;
    switch ($this->errorCode) {
      case self::ERROR_NONE:
        break;
      case self::ERROR_INPUTSTRING_NONE:
        break;
      case self::ERROR_PASSWORD_NONE:
        break;
      case self::ERROR_INPUTSTRING_INVALID:
        break;
      case self::ERROR_PASSWORD_INVALID:
        break;
      case self::ERROR_INPUTSTRING_NOTRECOGNIZED:
        break;
      case self::ERROR_NO_USER_FOUND:
        break;
      default:
      case self::ERROR_UNKNOWN:
        break;
    }
    return $message;
  }

  public function abort($_error = null) {
    $args = func_get_args();
    $this->addError($args);
    return call_user_func_array($this->done, $args);
  }

  public function done($_message = null) {
    $this->addMessage($_message);
    return $this->getMessages();
  }

	public function __construct($inputstring = null, $password = null)
	{
    if (!$inputstring) $this->errorCode = self::ERROR_INPUTSTRING_NONE;
    if (!$password) $this->errorCode = self::ERROR_PASSWORD_NONE;

    $is_email = (MyValid::is_valid('email', $inputstring)) ? true : false;
    $is_username = (MyValid::is_valid('username', $inputstring)) ? true : false;
    $is_phone = (MyValid::is_valid('userphone', $inputstring)) ? true : false;

    $this->password = $password;
    if ($is_email) {
      $this->email = $inputstring;
    } elseif ($is_phone) {
      $this->phone = $inputstring;
    } elseif ($is_username) {
      $this->username = $inputstring;
    } else {
      $this->abort(self::ERROR_INPUTSTRING_NOTRECOGNIZED, $inputstring)
    }
	}

	public function authenticate() {
    if ($this->errorCode) return !$this->errorCode;

    $criteria = new CDbCriteria;
    $criteria->alias = 'user';
    if ($this->username) $criteria->compare('user.email', $this->email, false);
    if ($this->email) $criteria->compare('user.email', $this->email, false);
    if ($this->phone) $criteria->compare('user.phone', $this->phone, false);
    $_user = Users::model()->with('role')->find($criteria);
    if ($_user) {
      $this->id = $_user->id;
      $this->username = $_user->username;
      $this->email = $_user->email;
      $this->phone = $_user->phone;
      $this->role = ($_user->roleid) ? $_user->role->title : 'user';
      if (!CPasswordHelper::verifyPassword($this->password, $_user->password)) {
        $this->errorCode = self::ERROR_PASSWORD_INVALID;
      } else {
        $this->errorCode = self::ERROR_NONE;
        // These need to create shield vs session-stolen attacks
        // $this->setState('authhash', md5($this->email.$this->phone.time()));
      }
    } else {
      if ($this->errorCode === self::ERROR_UNKNOWN_IDENTITY)
        $this->errorCode = self::ERROR_NO_USER_FOUND;
    }
    return !$this->errorCode;
	}

	public function getId()
	{
		return $this->id;
	}
	public function getName()
	{
		return $this->username;
	}
  public function getRole()
  {
    return $this->role;
  }
}
