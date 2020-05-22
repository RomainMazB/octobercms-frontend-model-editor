<?php return [
    'plugin' => [
        'name' => 'FrontEnd Model Editor',
        'description' => 'Cré des racourcis vers les formulaires de vos models sur les pages désirées'
    ],
    'labels' => [
        'namespace' => 'Namespace',
        'model_name' => 'Nom du modèle',
        'displayed_actions' => 'Actions affichées',
        'url_param' => 'Paramètre dans l\'url',
        'link_text' => 'Nom du modèle dans le menu',
        'pages_names' => 'Noms des pages (attention: un sous-dossier est représenté par un tiret. La page \'pages/blog/post\' aura pour nom \'blog-post\'',
        'page_name' => 'Nom de la page',
    ],
    'comments' => [
        'pages_names' => 'Les pages ou seront affiché les actions',
        'url_param' => 'Le paramètre URL pour retrouver l\'id du modèle',
    ],
    'menus' => [
        'main-menu' => 'FEME',
    ],
];
