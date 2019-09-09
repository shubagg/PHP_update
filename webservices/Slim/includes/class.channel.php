<?php
class Channel{

	public $channel_id;
	public $channel_name;
	public $description;
	public $source;
	public $creation_date;

	function __construct() {
		$this->channel_id=1;
		$this->channel_name="channel";
		$this->description="text";
		$this->channel_username="channelusername";
		$this->thumbnail="http://webexperts.info/nav/webservice/assets/thumb.jpg";
		$this->creation_date=time();
	}

	public function get_channel($i)
	{
		return array(
			'channel_id'=>$i,
			'channel_name'=>$this->channel_name.$i,
			'description'=>$this->description.$i,
			'thumbnail'=>$this->thumbnail,
			'channel_username'=>$this->channel_username.$i,
			'creation_date'=>$this->creation_date
			);
	}
}
?>