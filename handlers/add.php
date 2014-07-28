<?php

$this->require_acl ('admin', 'galleries', 'admin/add');

$page->layout = 'admin';
$page->title = __ ('Add Gallery');

$form = new Form ('post', $this);

$form->data = array (
	'folders' => FileManager::list_folders (),
	'date' => gmdate ('Y-m-d')
);

echo $form->handle (function ($form) {
	// Create and save a new gallery 
	$gallery = new galleries\Gallery (array (
		'title' => $_POST['title'], 
		'description' => $_POST['description'], 
		'folder' => $_POST['folder'], 
		'thumbnail' => $_POST['thumbnail'], 
		'date' => $_POST['date'] 
	));
	$gallery->put ();

	if ($gallery->error) {
		// Failed to save
		error_log ('Error adding gallery: ' . DB::error ());
		$form->controller->add_notification (__ ('Unable to save gallery.'));
		return false;
	}

	// Save a version of the gallery 
	Versions::add ($gallery);

	// Notify the user and redirect on success
	$form->controller->add_notification (__ ('Gallery added.'));
	$form->controller->redirect ('/galleries/admin');
});

?>