List of global template variables
=================================

```
debug               bool    is the board in debugging mode?

page_title          string  title of the page

js                  array   list of core js files

base_url            string  the base url of the board

current_page        array   current page
    title           string  title of the current page
    template        string  template for the current page
    name            string  intern page name
    link            string  link to the current page (not sure why)

style               array   current style
    name            string  the name of the style
    dir             string  url ready style directory (<- remove this)
    css             array   list of css files or a style preprocessor (e.g. style.php)
        [#]         array   index
            file    string  css file or style preprocessor
            media   string  media attribute of the file (optional)

menu                array   contains all menu entries
    [#]             array   index
        name        string  name of the menu entry
        link        string  link of the menu entry
        active      bool    is this the current page?

user                array   current user
    name            string  user name
    id              int     user id (0 = guest, 0 < user)
    group           array   user group
        name        string  group name
        id          int     group id
        icon        string  group icon (may be empty)
    color           string  fancy user rank color stuff (may be empty)
    lang_code       string  language code of the current language

notification        array   contains possible notifications
    [#]             array   index
        message     string  what does the notification say
        type        string  notification type (css class name)

crumbs              array   contains the current breadcrumbs
    [#]             array   index
        title       string  title of the crumb
        link        string  link of the crumb
```

Silex Board own functions
=========================

link
----

Uses URI::Make()

```
{link argument1=Value argument2=Value [...]}
```

lang
----

translate language nodes into strings

```
{lang node="language.node"}
```