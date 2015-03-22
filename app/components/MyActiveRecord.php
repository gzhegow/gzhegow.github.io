<?php
abstract class MyActiveRecord extends CActiveRecord
{
  private static $_activerecords = array();
  private static $_as = 'model';

  private $_compiled = null;

  public function init() {
    parent::init();
  }

  protected function compile($mode = null) {
    $mode = (string) $mode;
    if ($mode) self::$as = $mode;
    $this->{'to' . self::$_as}();
  }

  protected function afterFind() {
    vdp(self::$_as);
    vdp($this);
    $this->compile();
    vdp($this);
  }

  public function asMode($mode = null) {
    $mode = (string) $mode;
    self::$_as = $mode;
    return $this;
  }

  public function toModel() {
  }

  public function toArray() {
    $this->_compiled = array();
    $this->_compiled = array_merge($this->_compiled, $this->attributes);
    foreach ($this->relations() as $name => $val) {
      $relation = null;
      $relations = array();
      switch ($val[0]) {
        case 'CHasOneRelation':
        case 'CBelongsToRelation':
          if ($ok = $this->hasRelated($name)) $relation = $this->$name->getCompiled();
          vdpd($ok);
          $this->_compiled[$name] = $relation;
          break;
        case 'CStatRelation':
        case 'CHasManyRelation':
        case 'CManyManyRelation':
          if ($this->hasRelated($name)) {
            foreach ($this->$name as $model) {
              $relations[] = $model->getCompiled();
            }
          }
          $this->_compiled[$name] = $relations;
          break;
        default:
          throw new Exception('Unknown realtion type ' . $val[0]);
          break;
      }
    }
  }

  public function toObject() {
    $this->_compiled = new StdClass;
    foreach ($this->attributes as $name => $val) {
      $this->_compiled->$name = $val;
    }
    foreach ($this->relations() as $name => $val) {
      $relation = null;
      $relations = array();
      switch ($val[0]) {
        case 'CHasOneRelation':
        case 'CBelongsToRelation':
          if ($this->hasRelated($name)) $relation = $this->$name->getCompiled();
          $this->_compiled->$name = $relation;
          break;
        case 'CHasManyRelation':
        case 'CManyManyRelation':
          if ($this->hasRelated($name)) {
            foreach ($this->$name as $model) {
              $relations[] = $model->getCompiled();
            }
          }
          $this->_compiled->$name = $relations;
          break;
        default:
          throw new Exception('Unknown realtion type ' . $val[0]);
          break;
      }
    }
  }

  public function getCompiled() {
    return $this->_compiled;
  }

  /*
  public static function model($className = __CLASS__) {
    if (!isset(self::$_activerecords[$className])) {
      self::$_activerecords[$className] = new $className(null);
      self::$_activerecords[$className]->attachBehaviors(self::$_activerecords[$className]->behaviors());
    }
    $activerecord = self::$_activerecords[$className];
    return $activerecord;
  }
  */

  public function find($condition='',$params=array())
  {
    $model = CActiveRecord::find($condition,$params);
    return $model;
  }

  public function findAll($condition='',$params=array())
  {
    $models = CActiveRecord::findAll($condition,$params);
    return $models;
  }

  public function findByPk($pk,$condition='',$params=array())
  {
    $model = CActiveRecord::findByPk($pk,$condition,$params);
    return $model;
  }

  public function findAllByPk($pk,$condition='',$params=array())
  {
    $models = CActiveRecord::findAllByPk($pk,$condition,$params);
    return $models;
  }

  public function findByAttributes($attributes,$condition='',$params=array())
  {
    $model = CActiveRecord::findByAttributes($attributes,$condition,$params);
    return $model;
  }

  public function findAllByAttributes($attributes,$condition='',$params=array())
  {
    $models = CActiveRecord::findAllByAttributes($attributes,$condition,$params);
    return $models;
  }

  public function findBySql($sql,$params=array())
  {
    $model = CActiveRecord::findBySql($sql,$params);
    return $model;
  }

  public function findAllBySql($sql,$params=array())
  {
    $models = CActiveRecord::findAllBySql($sql,$params);
    return $models;
  }
}