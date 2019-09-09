<?php
class Article{

	public $article_id;
	public $title;
	public $text;
	public $source;
	public $article_audio;
	public $listened;
	public $channel;
	public $like;
	public $recommend;
	public $share;
	public $creation_date;

	function __construct() {
		
		$this->article_id=1;
		$this->title="title";
		$this->text="text";
		$this->source="source";
		$this->article_audio="";
		$this->channel=array(1,2,3,4,5);
		$this->listened=10;
		$this->like=5;
		$this->recommend=3;
		$this->share=1;
		$this->creation_date=time();
		
	}

	public function get_article($i)
			{
				$audio = new ArticleAudio();
				return array(
					'article_id'=>$this->article_id,
					'title'=>$this->title,
					'text'=>$this->text,
					'source'=>$this->source,
					'article_audio'=>$audio->get_article_audio($i),
					'channel'=>$this->channel,
					'listened'=>$this->listened,
					'like'=>$this->like,
					'recommend'=>$this->recommend,
					'share'=>$this->share,
					'creation_date'=>$this->creation_date
					);
			}

	public function get_article_short($i)
			{
				return array(
					'article_id'=>$this->article_id,
					'title'=>$this->title,
					'text'=>$this->text,
					'creation_date'=>$this->creation_date
					);
			}
}
?>