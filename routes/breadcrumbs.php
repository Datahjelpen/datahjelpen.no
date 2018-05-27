<?php

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Hjem', route('home'));
});

// Dashboard start
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Kontrollpanel', route('dashboard'));
});
// Dashboard end

// Dashboard - admin start
Breadcrumbs::for('dashboard.admin', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Admin', route('dashboard.admin'));
});

Breadcrumbs::for('dashboard.admin.entry_types', function ($trail) {
    $trail->parent('dashboard.admin');
    $trail->push('EntryTypes', route('dashboard.admin.entry_types'));
});

Breadcrumbs::for('entry_type.create', function ($trail) {
    $trail->parent('dashboard.admin.entry_types');
    $trail->push('Lag ny', route('entry_type.create'));
});

Breadcrumbs::for('entry_type.edit', function ($trail, $entry_type) {
    $trail->parent('dashboard.admin.entry_types');
    $trail->push('Rediger: ' . $entry_type->name, route('entry_type.edit', $entry_type));
});

Breadcrumbs::for('entry_type.delete', function ($trail, $entry_type) {
    $trail->parent('dashboard.admin.entry_types');
    $trail->push('Slett: ' . $entry_type->name, route('entry_type.delete', $entry_type));
});
// Dashboard - admin end

// Dashboard - author start
Breadcrumbs::for('dashboard.author', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Innhold', route('dashboard.author'));
});

Breadcrumbs::for('dashboard.author.entry_type', function ($trail, $entry_type) {
    $trail->parent('dashboard.author');
    $trail->push($entry_type->name, route('dashboard.author.entry_type', $entry_type));
});
// Dashboard - author end

// User start
Breadcrumbs::for('user', function ($trail) {
    $trail->push('Konto', route('user'));
});

Breadcrumbs::for('user.settings', function ($trail) {
    $trail->parent('user');
    $trail->push('Innstillinger', route('user.settings'));
});

Breadcrumbs::for('user.settings.security', function ($trail) {
    $trail->parent('user.settings');
    $trail->push('Sikkerhet', route('user.settings.security'));
});

Breadcrumbs::for('user.setup_2fa', function ($trail) {
    $trail->parent('user.settings.security');
    $trail->push('2fa oppsett', route('user.setup_2fa'));
});

Breadcrumbs::for('user.disable_2fa', function ($trail) {
    $trail->parent('user.settings.security');
    $trail->push('Skru av 2fa', route('user.setup_2fa'));
});
// User end
