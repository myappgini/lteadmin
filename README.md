# adminLTE for AppGini

## First release R0.1.0

This version will remain in a new branch to continue support. I will changue to new versión.

![Login Page](https://trello-attachments.s3.amazonaws.com/5cf458a4c077516299941bbf/600x295/4543ab3b3cfe3a5e98ce23f3f76f0ff2/imagen.png)

## how to use

Before pasting this codes files, rename the next files:

| original name | renamed file |
|-|-|
| index.php | index_old.php |
| footer.php | footer_old.php |
| header.php | header_old.php |
| membership_profile.php | membership_profile_old.php |

Then add the files and use.

Allways after compiling you need to repeat the step of renaming the  files, and re-pasting files in table

you can conmute to default appgini only changue true to false in config_lte.php the varible ```$LTE_enable```

```php
function getLteStatus($LTE_enable = true){
    if(!function_exists('getMemberInfo')){
        $LTE_enable = false;
    }
    return $LTE_enable;
}
```

## Changues/FIX LOG

09/11/2019

- fix RTL LTR text

26/10/2019

- update Admin LTE package.
- fix bugs

01/10/2019

- fix PREPEND_PATH in files sources

older

- 04/08/19 fix double wide left side menu in small devices
- 29/06/19 fix print problem
- fix mpi control
- remove side bar in login
- redirection in forgotten password
- redirection in new user registration

## Changes

- Update to adminLTE 2.4.18

- A new variable is added to enable text direction

- Add back to login button in upper menu in reset password page and new user page.

- Add a right side control bar, ther you can changue the layout color and other things. You can customize this item.

- Update to adminLTE 2.4.10

- config_lte.php
  - ```$LTE_globals``` basic configurations in global variable for the menu and the footer.

    ```php
    $LTE_globals =[
    "app-title-prefix" => "Ale | ", //window bar prfix title or browser tab
    "app-dir-RTL-enable" : false , // add for RTL LTR dir languaje
    "logo-mini" => "glyphicon glyphicon-home", //mini logo for sidebar mini 50x50 pixels
    "logo-mini-text" => "ALE", // text for side bar
    "navbar-text" => "Alejandro Landini template",
    "footer-left-text" => "<strong>ALE © ". date("Y") ." <a href=\"#\">Alejandro Landini admin template from adminLTE</a>.</strong>",
    "footer-right-text" => "Anything you want"
    ];
    ```

  - ```$ico_menu``` definition of icons for the groups in the side menu, is in json format.

    ```php
    //"GroupName":"ico"
    $ico_menu = '{
        "Orders":"fa fa-table",
        "Gift":"fa fa-gift",
        "Pencil":"fa fa-pencil-square-o",
        "Cog":"fa fa-cog",
        "Plus":"fa fa-plus",
        "slash":"fa fa-eye-slash"
    }';
    ```

- myCustom.css
  - modification of the background image and add exmples images

    ```css
        .content-wrapper {
            min-height: 100%;
            background-color: #ecf0f5;
            background: url(background/slide_2.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            z-index: 800;
        }
    ```

  - hide fields directly id

    ```css
        label[for='id']{
            display: none;
        }

        label[for='id'] + div {
            display: none;
        }
    ```

## New Features

- hidden group

    If the hidden group is created, the tables that are within this group will only be visible to the admin user group.
- mpi

    The mebership_profile_image is added by default, so the membership_profile.php file is also modified

## Resources

- <https://adminlte.io/themes/AdminLTE/documentation/index.html#introduction>
