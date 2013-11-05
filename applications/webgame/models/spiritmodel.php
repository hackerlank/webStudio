<?php
class SpiritModel extends CommonModel 
{
	public function __construct($data = '')
	{
		$this->table = 'spirit';
		parent::__construct($data);		
	}
				
	/**
	 * Initial the fields for menu
	 * 
	 * @return array the field infos of menu
	 */
	protected function _fieldInfos()
	{
		$positionInfos = array(
			'index' => array('key' => 'index', 'value' => '首页焦点推荐'),
			'show' => array('key' => 'show', 'value' => '内容页推荐'),
		);
		$fieldInfos['fields'] = array(
			'id' => array('name' => '精灵ID'),
			'title' => array('name' => '精灵名称'),
			'thumb' => array('name' => '缩略图'),
			'pic_effect' => array('name' => '精灵效果图'),
			'pic_growup' => array('name' => '精灵养成图'),
			'pic_ext' => array('name' => '扩展图'),
			'description' => array('name' => '描述'),
			'listorder' => array('name' => '排序'),
			'content' => array('name' => '内容'),
			'username' => array('name' => '管理员帐号'),
			'position' => array('name' => '推荐位', 'infos' => $positionInfos),
			'status' => array('name' => '状态', 'infos' => array('0' => '<font class="red">不显示</font>', '1' => '<font class="green">显示</font>')),
			'inputtime' => array('name' => '录入时间'),
			'updatetime' => array('name' => '更新时间'),
		);
		$fieldInfos['fieldList'] = array('id', 'title', 'listorder','position', 'username', 'status', 'updatetime', 'inputtime');
		$fieldInfos['fieldChanges'] = array('title', 'thumb', 'pic_effect', 'pic_growup', 'pic_ext', 'description', 'listorder', 'content', 'position', 'status');
		
		return $fieldInfos;
	}
}