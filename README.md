# adminLTE for AppGini

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

## FIX

04/08/2019

- fix double wide left side menu in small devices

29/06/2019

- fix print problem

older

- fix mpi control
- remove side bar in login
- redirection in forgotten password
- redirection in new user registration

## Changes

- Add back to login button in upper menu in reset password page and new user page.

- Add a right side control bar, ther you can changue the layout color and other things. You can customize this item.

- Update to adminLTE 2.4.10

- config_lte.php
  - ```$LTE_globals``` basic configurations in global variable for the menu and the footer.

    ```php
    $LTE_globals =[
    "app-title-prefix" => "Ale | ", //window bar prfix title or browser tab
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
