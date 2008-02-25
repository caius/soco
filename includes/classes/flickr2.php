<?php

class Flickr2
{
	private $flickr;
	private $user_id;

	function __construct($user)
	{
		# todo: check if api_key/api_secret is private data & hide if it is
		$secrets = array('api_key'=>'2fea7c2fb9213004ed1611ce291b50d0',
			'api_secret'=>'cd0be4ec5db8bf61');
		
		$this->flickr = new Flickr($secrets);
		# Setup my username
		$this->user_id = $this->flickr->peopleFindByUsername($user);
	}

	public function HentanTags()
	{
		$params = array(
			'user_id' => $this->flickr->user_id,
			'tags' => 'hentan',
			'per_page' => '10'
			);
		$search = $this->flickr->photosSearch($params);
		foreach ($search['photos'] as $photo) {
			echo $this->ImgTag($photo);
		}
	} // HentanTags

	public function ImgTag($photo)
	{
		$data = $this->flickr->PeopleGetInfo($this->user_id);
		return "<a href=\"{$data["photosurl"]}{$photo["id"]}\" title=\"{$photo["title"]}\">".
		"<img src=\"" . $this->flickr->getPhotoURL($photo) . "\" /></a>\n";
	} // ImgTag

	function Output()
	{
		echo $this->output;
	} // Output
}


?>