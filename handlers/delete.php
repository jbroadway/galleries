<?php

$this->require_acl ('admin', 'galleries', 'admin/delete');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	$this->redirect ('/galleries/admin');
}

$gallery = new galleries\Gallery;
$gallery->remove ($_POST['id']);

if ($gallery->error) {
	error_log ('Error deleting gallery: ' . DB::error ());
	$this->add_notification (__ ('Unable to delete gallery.'));
	$this->redirect ('/galleries/admin');
}

$this->add_notification (__ ('Gallery deleted.'));
$this->redirect ('/galleries/admin');

?>