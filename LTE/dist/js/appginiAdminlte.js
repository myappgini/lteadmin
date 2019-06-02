/**
 * AdminLTE control Menu
 * ------------------
 */
$j(function () {
    'use strict';

    /**
     * Get access to plugins
     */

    $j('[data-toggle="control-sidebar"]').controlSidebar();
    $j('[data-toggle="push-menu"]').pushMenu();
    var $pushMenu = $j('[data-toggle="push-menu"]').data('lte.pushmenu');
    var $controlSidebar = $j('[data-toggle="control-sidebar"]').data('lte.controlsidebar');
    var $layout = $j('body').data('lte.layout');
    $j(window).on('load', function() {
        // Reinitialize variables on load
        $pushMenu = $j('[data-toggle="push-menu"]').data('lte.pushmenu');
        $controlSidebar = $j('[data-toggle="control-sidebar"]').data('lte.controlsidebar');
        $layout = $j('body').data('lte.layout');
    });

    /**
     * List of all the available skins
     *
     * @type Array
     */
    var mySkins = [
        'skin-blue',
        'skin-black',
        'skin-red',
        'skin-yellow',
        'skin-purple',
        'skin-green',
        'skin-blue-light',
        'skin-black-light',
        'skin-red-light',
        'skin-yellow-light',
        'skin-purple-light',
        'skin-green-light'
    ];

    /**
     * Get a prestored setting
     *
     * @param String name Name of of the setting
     * @returns String The value of the setting | null
     */
    function get(name) {
        if (typeof (Storage) !== 'undefined') {
            return localStorage.getItem(name);
        } else {
            window.alert('Please use a modern browser to properly view this template!');
        }
    }

    /**
     * Store a new settings in the browser
     *
     * @param String name Name of the setting
     * @param String val Value of the setting
     * @returns void
     */
    function store(name, val) {
        if (typeof (Storage) !== 'undefined') {
            localStorage.setItem(name, val);
        } else {
            window.alert('Please use a modern browser to properly view this template!');
        }
    }

    /**
     * Toggles layout classes
     *
     * @param String cls the layout class to toggle
     * @returns void
     */
    function changeLayout(cls) {
        $j('body').toggleClass(cls);
        $layout.fixSidebar();
        if ($j('body').hasClass('fixed') && cls == 'fixed') {
            $pushMenu.expandOnHover();
            $layout.activate();
        }
        $controlSidebar.fix();
        
    }

    /**
     * Replaces the old skin with the new skin
     * @param String cls the new skin class
     * @returns Boolean false to prevent link's default action
     */
    function changeSkin(cls) {
        $j.each(mySkins, function (i) {
            $j('body').removeClass(mySkins[i]);
        });
        
        $j('body').addClass(cls);
        store('skin', cls);
        return false;
    }

    function toggleControlSideSkin(){
        var tmp = "";
        var $sidebar = $j('.control-sidebar');
            if ($sidebar.hasClass('control-sidebar-dark')) {
                $sidebar.removeClass('control-sidebar-dark');
                $sidebar.addClass('control-sidebar-light');
                tmp = 'control-sidebar-light';
                $j('[data-sidebarskin="toggle"]').attr('checked', 'checked');
            } else {
                $sidebar.removeClass('control-sidebar-light');
                $sidebar.addClass('control-sidebar-dark');
                tmp = 'control-sidebar-dark';
            }

            store('controlSideSkin',tmp);
    }
    function toggleLayout($this){
        var cls = $j($this).data('controlsidebar');
            changeLayout(cls);
            var slide = !$controlSidebar.options.slide;
            
            $controlSidebar.options.slide = slide;
            if (!slide){
                store('layout',cls);
                $j('.control-sidebar').removeClass('control-sidebar-open');
            }
    }
    /**
     * Retrieve default settings and apply them to the template
     *
     * @returns void
     */
    function setup() {
        var tmp = get('skin');

        if (tmp == "null" && !$j.inArray(tmp, mySkins)){
            tmp="skin-blue";
        }
        
        changeSkin(tmp);
    
        tmp = get('controlSideSkin');

        if (tmp != "" && tmp != "null" && !$j('.control-sidebar').hasClass(tmp)){
            toggleControlSideSkin();
        }
        
        tmp = get('layout');
        if (tmp != "" && tmp != "null" && tmp == "control-sidebar-open"){
            var a = tmp;
            setTimeout(function(){
                $j('[data-controlsidebar="control-sidebar-open"]').attr('checked', 'checked');
                changeLayout(a);
            },1000);
        }

        tmp = get('colapsedLeft');
        if (tmp != "" && tmp != "null" && tmp == "sidebar-collapse"){
            var b =tmp;
            setTimeout(function(){
                $j('[data-layout="sidebar-collapse"]').attr('checked', 'checked');
                changeLayout(b);
            },1000);
        }


        // Add the change skin listener
        $j('[data-skin]').on('click', function (e) {
            if ($j(this).hasClass('knob'))
                return;
            e.preventDefault();
            changeSkin($j(this).data('skin'));
        });

        // togle left side
        $j('[data-layout]').on('click', function () {
            var tmp = get('colapsedLeft');
            var cls = $j(this).data('layout');
            changeLayout(cls);
            store("colapsedLeft",cls);
            if (tmp =="sidebar-collapse"){
                store("colapsedLeft","");
            }
        });

        $j('[data-controlsidebar]').on('click', function () {
            var tmp = get('layout');
            toggleLayout(this);
            if (tmp == "control-sidebar-open"){
                store('layout','');
            }
        });

        $j('[data-sidebarskin="toggle"]').on('click', function () {
            toggleControlSideSkin();
        });

        $j('[data-enable="expandOnHover"]').on('click', function () {
            $j(this).attr('disabled', true);
            $pushMenu.expandOnHover();
            if (!$j('body').hasClass('sidebar-collapse'))
                $j('[data-layout="sidebar-collapse"]').click();
        });

        //  Reset options
        if ($j('body').hasClass('sidebar-collapse')) {
            $j('[data-layout="sidebar-collapse"]').attr('checked', 'checked');
        }

    }

    // Create the new tab
    var $tabPane = $j('<div />', {
        'id': 'control-sidebar-theme-demo-options-tab',
        'class': 'tab-pane active'
    });

    // Create the tab button
    var $tabButton = $j('<li />', {'class': 'active'})
        .html('<a href=\'#control-sidebar-theme-demo-options-tab\' data-toggle=\'tab\'><i class="fa fa-wrench"></i></a>');

    // Add the tab button to the right sidebar tabs
    $j('[href="#control-sidebar-home-tab"]')
        .parent()
        .before($tabButton);

    // Create the menu
    var $demoSettings = $j('<div />');

    // Layout options
    $demoSettings.append(
        '<h4 class="control-sidebar-heading">' +
        'Layout Options' +
        '</h4>' +
        // Sidebar Toggle +
        '<div class="form-group">' +
        '<label class="control-sidebar-subheading">' +
        '<input type="checkbox" data-layout="sidebar-collapse" class="pull-right"/> ' +
        'Toggle Sidebar' +
        '</label>' +
        '<p>Toggle the left sidebar\'s state (open or collapse)</p>' +
        '</div>' +
        // Control Sidebar Toggle +
        '<div class="form-group">' +
        '<label class="control-sidebar-subheading">' +
        '<input type="checkbox" data-controlsidebar="control-sidebar-open" class="pull-right"/> ' +
        'Toggle Right Sidebar Slide' +
        '</label>' +
        '<p>Toggle between slide over content and push content effects</p>' +
        '</div>' +
        // Control Sidebar Skin Toggle +
        '<div class="form-group">' +
        '<label class="control-sidebar-subheading">' +
        '<input type="checkbox"data-sidebarskin="toggle"class="pull-right"/> ' +
        'Toggle Right Sidebar Skin' +
        '</label>' +
        '<p>Toggle between dark and light skins for the right sidebar</p>' +
        '</div>'
    );
    var $skinsList = $j('<ul />', {'class': 'list-unstyled clearfix'});

    // Dark sidebar skins
    var $skinBlue =
        $j('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-blue" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">' +
                '<div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div>' +
                '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>' +
                '</a>' +
                '<p class="text-center no-margin">Blue</p>');
    $skinsList.append($skinBlue);
    var $skinBlack =
        $j('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-black" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">' +
                '<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div>' +
                '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>' +
                '</a>' +
                '<p class="text-center no-margin">Black</p>');
    $skinsList.append($skinBlack);
    var $skinPurple =
        $j('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-purple" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">' +
                '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div>' +
                '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>' +
                '</a>' +
                '<p class="text-center no-margin">Purple</p>');
    $skinsList.append($skinPurple);
    var $skinGreen =
        $j('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-green" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">' +
                '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div>' +
                '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>' +
                '</a>' +
                '<p class="text-center no-margin">Green</p>');
    $skinsList.append($skinGreen);
    var $skinRed =
        $j('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-red" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">' +
                '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div>' +
                '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>' +
                '</a>' +
                '<p class="text-center no-margin">Red</p>');
    $skinsList.append($skinRed);
    var $skinYellow =
        $j('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-yellow" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">' +
                '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div>' +
                '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>' +
                '</a>' +
                '<p class="text-center no-margin">Yellow</p>');
    $skinsList.append($skinYellow);

    // Light sidebar skins
    var $skinBlueLight =
        $j('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-blue-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">' +
                '<div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div>' +
                '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>' +
                '</a>' +
                '<p class="text-center no-margin" style="font-size: 12px">Blue Light</p>');
    $skinsList.append($skinBlueLight);
    var $skinBlackLight =
        $j('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-black-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">' +
                '<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div>' +
                '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>' +
                '</a>' +
                '<p class="text-center no-margin" style="font-size: 12px">Black Light</p>');
    $skinsList.append($skinBlackLight);
    var $skinPurpleLight =
        $j('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-purple-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">' +
                '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div>' +
                '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>' +
                '</a>' +
                '<p class="text-center no-margin" style="font-size: 12px">Purple Light</p>');
    $skinsList.append($skinPurpleLight);
    var $skinGreenLight =
        $j('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-green-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">' +
                '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div>' +
                '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>' +
                '</a>' +
                '<p class="text-center no-margin" style="font-size: 12px">Green Light</p>');
    $skinsList.append($skinGreenLight);
    var $skinRedLight =
        $j('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-red-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">' +
                '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div>' +
                '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>' +
                '</a>' +
                '<p class="text-center no-margin" style="font-size: 12px">Red Light</p>');
    $skinsList.append($skinRedLight);
    var $skinYellowLight =
        $j('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-yellow-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">' +
                '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div>' +
                '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>' +
                '</a>' +
                '<p class="text-center no-margin" style="font-size: 12px">Yellow Light</p>');
    $skinsList.append($skinYellowLight);

    $demoSettings.append('<h4 class="control-sidebar-heading">Skins</h4>');
    $demoSettings.append($skinsList);

    $tabPane.append($demoSettings);
    $j('.tab-content').append($tabPane);

    setup();

    $j('[data-toggle="tooltip"]').tooltip();
});
