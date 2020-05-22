<?php return [
    'plugin' => [
        'name' => 'FrontEnd Model Editor',
        'description' => 'Create front end shortcuts links in the AdminBar on frontend to redirect to the backend model\'s forms.'
    ],
    'labels' => [
        'namespace' => 'Namespace',
        'model_name' => 'Model name',
        'displayed_actions' => 'Displayed actions',
        'url_param' => 'Url parameters',
        'link_text' => 'Model name on link text',
        'pages_names' => 'Pages names',
        'page_name' => 'Page name',
    ],
    'comments' => [
        'pages_names' => 'The pages where the link(s) will be displayed (be careful: a sub-directory is represented with a dash. The page \'pages/blog/post.htm\' will have a page name as \'blog-post\'',
        'url_param' => 'The url parameter to retrieve the model id',
    ],
    'menus' => [
        'main-menu' => 'FEME',
    ],
];
