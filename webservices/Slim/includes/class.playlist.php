<?php
class Playlist{

	public $playlist_id;
	public $user_id;
	public $playlist_name;
	public $article_id;
	public $creation_date;

	function __construct() {
		$this->playlist_id=1;
		$this->user_id=1;
		$this->playlist_name="Playlist Name";
		$this->article_id="";
		$this->creation_date=time();
	}

	public function get_playlist()
	{
		$arr = array();
		$article = new Article();
		for ($i=1; $i <4 ; $i++) { 
			array_push($arr,$article->get_article_short($i));
		}
		
		return array(
			'playlist_id'=>$this->playlist_id,
			'user_id'=>$this->user_id,
			'playlist_name'=>$this->playlist_name,
			'article_id'=>$arr,
			'creation_date'=>$this->creation_date
			);
	}
}
?>