<?php

// keep unauthorized users out
$this->require_acl ('admin', 'galleries');

// set the layout
$page->layout = 'admin';

// get the version and check if the app installed
$version = Appconf::get ($this->app, 'Admin', 'version');
$current = $this->installed ($this->app, $version);

if ($current === true) {
    // app is already installed and up-to-date, stop here
    $page->title = __ ('Already up-to-date');
    printf ('<p><a href="/%s/admin">%s</a>', $this->app, __ ('Home'));
    return;
}

$page->title = sprintf (
    '%s: %s',
    __ ('Upgrading App'),
    Appconf::get ($this->app, 'Admin', 'name')
);

// add your upgrade logic here

// mark the new version installed
$this->mark_installed ($this->app, $version);

printf ('<p><a href="/%s/admin">%s</a></p>', $this->app, __ ('Done.'));

?>