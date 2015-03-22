<?php echo "<?php\n"; ?>
class <?php echo $modelClass; ?> extends <?php echo $fileName."\n"; ?>
{
  public function init() {
    parent::init();
  }

  public static function model($className=__CLASS__)
  {
    return <?php echo $this->baseClass; ?>::model($className);
  }
}
