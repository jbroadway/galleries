<?php

$this->require_acl ('admin', 'galleries', 'settings');

$page->layout = 'admin';
$page->title = __ ('Galleries Settings');

$form = new Form ('post', $this);

require_once ('apps/admin/lib/Functions.php');

$form->data = array (
	'title' => Appconf::galleries ('Galleries', 'title'),
	'layout' => Appconf::galleries ('Galleries', 'layout'),
	'layouts' => admin_get_layouts ()
);

echo $form->handle (function ($form) {
	$merged = Appconf::merge (
		'galleries',
		array (
			'Galleries' => array (
				'title' => $_POST['title'],
				'layout' => $_POST['layout']
			)
		)
	);
	
	if (! Ini::write ($merged, 'conf/app.galleries.' . ELEFANT_ENV . '.php')) {
		printf ('<p>%s</p>', __ ('Unable to save changes. Check your folder permissions and try again.'));
		return;
	}

	$form->controller->add_notification (__ ('Settings saved.'));
	$form->controller->redirect ('/galleries/admin');
});

?>