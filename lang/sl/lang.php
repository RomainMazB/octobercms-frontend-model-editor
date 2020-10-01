<?php return [
    'plugin' => [
        'name' => 'FrontEnd Model Editor',
        'description' => 'Vtičnik za ustvarjanje frontend bližnjic (v administratorski vrstici na frontendu) do obrazcev v zalednem sistemu.'
    ],
    'labels' => [
        'namespace' => 'Imenski prostor',
        'model_name' => 'Naziv modela',
        'displayed_actions' => 'Prikazani ukazi',
        'url_param' => 'Url parametri',
        'link_text' => 'Naziv modela v besedilu povezave',
        'pages_names' => 'Nazivi strani',
        'page_name' => 'Naziv strani',
    ],
    'comments' => [
        'pages_names' => 'Strani na katerih bodo povezave prikazane (pozor: poddirektoriji so ponazorjeni z vezajem. Stran \'pages/blog/post.htm\' bo imela naziv \'blog-post\')',
        'url_param' => 'Url parameter za pridobitev identifikatorja modela',
    ],
    'menus' => [
        'main-menu' => 'FEUM',
    ],
];