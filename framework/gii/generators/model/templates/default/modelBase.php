<?php echo "<?php\n"; ?>

class <?php echo $fileName; ?> extends <?php echo $this->baseClass."\n"; ?>
{
	public function tableName()
	{
		return '<?php echo $tableName; ?>';
	}

  public function init() {
    parent::init();
  }

	public function rules()
	{
		return array(
<?php foreach($rules as $rule): ?>
			<?php echo $rule.",\n"; ?>
<?php endforeach; ?>
			array('<?php echo implode(', ', array_keys($columns)); ?>', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
<?php foreach($relations as $name=>$relation): ?>
			<?php echo "'$name' => $relation,\n"; ?>
<?php endforeach; ?>
		);
	}

	public function attributeLabels()
	{
		return array(
<?php foreach($labels as $name=>$label): ?>
			<?php echo "'".$name."' => '".str_replace("'","\'",$label)."',\n"; ?>
<?php endforeach; ?>
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

<?php
foreach($columns as $name=>$column)
{
	if($column->type==='string')
	{
		echo "\t\t\$criteria->compare('$name',\$this->$name,true);\n";
	}
	else
	{
		echo "\t\t\$criteria->compare('$name',\$this->$name);\n";
	}
}
?>

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

<?php if($connectionId!='db'):?>
	public function getDbConnection()
	{
		return Yii::app()-><?php echo $connectionId ?>;
	}
<?php endif?>

  public static function model($className=__CLASS__)
  {
    return <?php echo $this->baseClass; ?>::model($className);
  }
}
