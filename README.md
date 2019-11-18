
# adminLTE for AppGini

## Release R1.0.0

Staring the new versión

![Login Page](https://trello-attachments.s3.amazonaws.com/5cf458a4c077516299941bbf/600x295/4543ab3b3cfe3a5e98ce23f3f76f0ff2/imagen.png)

## Important note

Remember that: for the plugin to work, you must have previously purchased an original AppGini plugin.

## Install

Use **git** into your root project:

```cmd

$git clone https://github.com/myappgini/lteadmin.git

```

## how to use

After completing the compilation of your project, log in as administrator and go to the administrator area. The "Plugins" menu should appear with the "Landini AdminLTE" option.
Like the rest of the plugins select the project and then move on.
You will be shown a list of the groups that you have configured in your system.
In this same screen you can edit all the environment variables and you can choose the icons you want to display in the left menu.

Save and continue.

Select the folder where your project is located and continue.
The system will make the necessary changes for its operation.
The change log will show you which files were copied and which files were updated.
Once finished, you can return to the home page and the temple should already work.
It is not necessary to return to the plugin to update the variables, since each time you return the variables it will be rewritten with the default values. Yes it is necessary to reinstall the plugin if a new compilation of your project was necessary.
The variables can be updated, by the admin user, from the right control panel. Look for the App Enviroment button.

Enjoy the template and stay tuned for your comments.

You can conmute to default appgini only changue true to false in config_lte.php the varible ```$LTE_enable```

```php

function  getLteStatus($LTE_enable = true){

if(!function_exists('getMemberInfo')){

$LTE_enable = false;

}

return  $LTE_enable;

}

```

## Changues/FIX LOG

Older

- fix RTL LTR text

- update Admin LTE package.

- fix PREPEND_PATH in files sources

- fix double wide left side menu in small devices

- fix print problem

- fix mpi control

- remove side bar in login

- redirection in forgotten password

- redirection in new user registration

## Changes

- Update to adminLTE 2.4.18

- Edit enviroment variables from right side control

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
