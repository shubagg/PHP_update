<?php
class ArticleAudio{

	public $audio_id;
	public $narrator;
	public $path;
	public $status;
	public $approved_date;
	public $creation_date;

	function __construct() {
		
		$this->audio_id=1;
		$this->narrator="";
		$this->path="http://webexperts.info/nav/webservice/assets/audio.mp3";;
		$this->status="approved";
		$this->approved_date=time();
		$this->creation_date=time();
		
	}

	public function get_article_audio($i)
			{
				$user = new User();
				
				return array(
					'audio_id'=>$i,
					'narrator'=>$user->get_profile($i),
					'path'=>$this->path
					
					);
			}
}
?>