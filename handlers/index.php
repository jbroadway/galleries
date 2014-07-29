<?php

if (count ($this->params) > 0) {
	$gallery = new galleries\Gallery ($this->params[0]);
	if ($gallery->error) {
		echo $this->error ();
		return;
	}
	
	$page->id = 'galleries';
	$page->title = $gallery->title;
	$page->layout = Appconf::galleries ('Galleries', 'layout');
	$page->description = $gallery->description;

	echo $tpl->render (
		'galleries/gallery',
		$gallery->orig ()
	);
	return;
}

if (! $this->internal) {
	$page->id = 'galleries';
	$page->title = Appconf::galleries ('Galleries', 'title');
	$page->layout = Appconf::galleries ('Galleries', 'layout');
}

$items = galleries\Gallery::query ()->order ('date', 'desc')->fetch ();

echo $tpl->render (
	'galleries/index',
	array (
		'galleries' => $items
	)
);

?>