<?php

$this->require_acl ('admin', 'galleries', 'admin/edit');

$page->layout = 'admin';
$page->title = __ ('Edit Gallery');

$form = new Form ('post', $this);

$form->data = new galleries\Gallery ($_GET['id']);
$form->data->folders = FileManager::list_folders ();

echo $form->handle (function ($form) {
	// Update the gallery 
	$gallery = $form->data;
	$gallery->title = $_POST['title'];
	$gallery->description = $_POST['description'];
	$gallery->folder = $_POST['folder'];
	$gallery->thumbnail = $_POST['thumbnail'];
	$gallery->date = $_POST['date'];
	$gallery->put ();

	if ($gallery->error) {
		// Failed to save
		error_log ('Error updating gallery: ' . DB::error ());
		$form->controller->add_notification (__ ('Unable to save gallery.'));
		return false;
	}

	// Save a version of the gallery 
	Versions::add ($gallery);

	// Notify the user and redirect on success
	$form->controller->add_notification (__ ('Gallery saved.'));
	$form->controller->redirect ('/galleries/admin');
});

?>