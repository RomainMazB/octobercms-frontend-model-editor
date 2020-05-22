# Frontend Model Editor
This plugin allows you to add shortcuts links on front-end to redirect to the model's targeted back-end form.

You can easily from a back-end form:
 - Create a menu to create, update, preview or delete a model.
 - Chose the page(s) where the links should be displayed.
 - Chose the identifier from the url to retrieve and target the model: such as `slug` for blog post.
 - Display many models on a same page (example: Category and Post creation on blog's home page).
 
 
## How to use it
### First step
The plugins depends on the `RomainMazB.AdminBar` plugin and its `AdminBar` component, you need to insert the component in your layout to displays the shortcuts. See the [AdminBar documentation](https://github.com/RomainMazB/octobercms-adminbar#add-the-adminbar-component-to-layout).


For example, will use in this documentation the well known `Rainlab.Blog` plugin to display the CRUD shortcuts for `Post` model into the blog's pages located in the themes at `pages/blog/home`(url `/blog`) and `pages/blog/post`(url `/blog/:slug`).

Since `home` displays just a list of posts, it will only display the `create` action. `post` page displays a `blogPost` component, identified with `:slug` parameters, the plugin will display all available CRUD actions: `create`, `update`, `delete` (`preview` is not allowed with `Rainlab.Blog`)

### Namespace
Fill the plugin namespace only: `Rainlab\Blog`

### Model name
Fill the model class name: `Post`

### Url parameters
Fill the url parameter with the one you've chosen in your theme's pages: `slug`
```html
url = "/blog/:slug"

[blogPost]
slug = {{ :slug }}
==
{% component 'blogPost' %}
```

### Model name on link text
This is the text displayed in the AdminBar first-level menu: `Post`

### Displayed actions 
Select here the actions you want to displays, in our case: `create`, `update` and `delete`

 - *`create` link will always be displayed in the selected pages*
 - *`preview`, `update` and `delete` links will be displayed in the selected pages _ONLY IF a model is found with the url parameter_, which is not the case in our example with the `blog-home` page, this page will only display the `create` action*

### Pages names
Insert here the pages names where the links should be displayed, in our case: `blog-home` and `blog-post`

__The plugin uses `$page->id`, which identifies a sub-folder with a dash-notations. The page `pages/blog/sub-folder/post.htm` will be identified by `blog-sub-folder-post`__

## Use it with your custom plugin's models!
This plugin is not just for `Rainlab.Blog plugin`, it will work with all your custom plugin's models and all the marketplace's plugins.

As an example, you could use the namespace `RomainMazB\RealEstate` with the model `HouseModel`, and the plugin will create the CRUD shortcuts for it:

- `/backend/romainmazb/realestate/housemodels/create`
- `/backend/romainmazb/realestate/housemodels/preview/9`
- `/backend/romainmazb/realestate/housemodels/update/9`
- `/backend/romainmazb/realestate/housemodels/update/9` with an ajax call to `onDelete` method

just select the appropriate pages you want to displays the links on.
