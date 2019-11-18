// TODO: Automatically recognize and add the group list to the variables from this point.
// 
// 

    // stuff for the right click menus
    function setup_menu() {
        $j('div[data-role="arrayitem"]').contextMenu('context-menu1', {
            'remove item': {
                click: remove_item,
                klass: "menu-item-1" // a custom css class for this menu item (usable for styling)
            },
        }, menu_options);
        $j('div[data-role="prop"]').contextMenu('context-menu2', {
            'remove item': {
                click: remove_item,
                klass: "menu-item-1" // a custom css class for this menu item (usable for styling)
            },
        }, menu_options);
    }
    
    function remove_item(element) {
        console.log("# delete");
        element.hide(500, function () {
            $j(this).remove();
        });
    }

    function create_item(element) {
        console.log("# create");
    }

    function add_icon_item(){
        $j('[data-ic]').each(function(){
            $j('<i class="'+$j(this).data('ic')+'"></i>').insertAfter(this);
         }
         );
    }

    var menu_options = {
        disable_native_context_menu: true,
        showMenu: function (element) {
            element.addClass('dimmed');
        },
        hideMenu: function (element) {
            element.removeClass('dimmed');
        },
    };

    // functions used for the web service
    function save_ws(input, file = "jsonsave.php") {
        $json = glean_json(input, 0);
        //console.log($json);
        $j.post(file, {
                json: $json
            },
            function (data) {
                modal_window({  message: '<div class="callout callout-warning"><h4><i class = "fa fa-warning"></i>'+" The data config has been saved"+'</h4> '+ data +'</div>', 
                                  title: 'Save Config'  });
                
            });
    }
    var easy_save_value = function (value, settings) {
        $j(this).text(value);
    };
    var save_value = function (value, settings) {
        //console.log(this);
        //console.log(value); // //console.log(settings);

        if ($j(this).data('role') == 'value') {
            if (value == "null") {
                $j(this).attr("data-type", "null");
                $j(this).data('type', 'null');
                $j(this).text(value);
                $j(this).unbind('click');
            } else if (value == "true" || value == "false") {
                $j(this).attr("data-type", "boolean");
                $j(this).data('type', 'boolean');
                $j(this).text(value);
                $j(this).unbind();
                $j(this).editable(save_value, {
                    cssclass: 'edit_box',
                    data: "{'true':'true','false':'false'}",
                    type: 'select',
                    onblur: 'submit'
                });
            } else {
                var num = parseFloat(value);
                //console.log(num);
                if (isNaN(num)) {
                    $j(this).attr("data-type", "string");
                    $j(this).data('type', 'string');
                    $j(this).text(value);
                    $j(this).unbind();
                    $j(this).editable(save_value, {
                        cssclass: 'edit_box'
                    });
                } else {
                    $j(this).attr("data-type", "number");
                    $j(this).data('type', 'number');
                    $j(this).text(num);
                    $j(this).unbind();
                    $j(this).editable(save_value, {
                        cssclass: 'edit_box'
                    });
                }
            }
        } else {
            $j(this).text(value);
        }
    };
    // copy the workspace back into the textarea
    function extract_json(divid, indent) {
        $j('.jsoninput').val(glean_json(divid, indent));
    }
    // convert the work area to a json string
    function glean_json(divid, indent) {
        var base = $j('#' + divid);
        var rootnode = base.children('div[data-role="value"]:first');
        var jsObject = parse_node(rootnode);
        var json = JSON.stringify(jsObject, null, indent);
        return json;
    }
    // convert the work area to a js object
    function parse_node(node) {
        var newNode = "";
        var type = node.data('type');
        if (type == 'object') {
            newNode = {};
            var props = node.children('div[data-role="prop"]');
            props.each(function (index) {
                newNode[$j(this).children('[data-role="key"]').html()] = parse_node($j(this).children('[data-role="value"]'));
            });
            return newNode;
        } else if (type == 'array') {
            newNode = [];
            var values = node.children('[data-role="arrayitem"]');
            values.each(function (index) {
                var value_node = $j(this).children('[data-role="value"]');
                newNode.push(parse_node(value_node));
            });
            return newNode;
        } else if (type == 'string') {
            n = node.html();
            return n;
        } else if (type == 'number') {
            var parsedNum = parseFloat(node.html());
            if (isNaN(parsedNum)) return 0;
            return parsedNum;
        } else if (type == 'boolean') {
            return (node.html() == "true");
        } else if (type == null || type == 'null') {
            return null;
        } else {
            return "(Unknown Type:" + type + " )";
        }
    }

    function remove_editlets() {
        $j("span.collapse_box").remove();
        $j("div.inline_add_box").remove();
        $j(".context-menu").remove();

    }

    function apply_editlets() {
        remove_editlets();
        // add collapse boxes for the arrays and objects
        var o_collapse_box = $j('<span class="collapse_box"><span><i class ="fa fa-chevron-up"></i></span><span style="display: none"><i class ="fa fa-chevron-down"> {...}</span></span>');
        var a_collapse_box = $j('<span class="collapse_box"><span><i class ="fa fa-chevron-up"></i></span><span style="display: none" data-role="counter"><i class ="fa fa-chevron-down"> []</span></span>');
        $j('div[data-type="object"]').before(o_collapse_box);
        $j('div[data-type="array"]').before(a_collapse_box);

        $j('.collapse_box').click(function () {
            var next = $j(this).next();
            next.toggle();
            $j(this).find('span').toggle();
            if (next.data('type') == 'array') {
                $j(this).find('span[data-role="counter"]').html('<i class ="fa fa-chevron-down"></i> [' + next.children('[data-role="arrayitem"]').length + ']');
            }
            event.stopPropagation();
        });

        // add the "new" buttons
        var add_more_box = $j('<div class="inline_add_box"><div class="add_box_content">add: <a data-task="add_value" class = "btn btn-primary btn-xs">text</a> <a data-task="add_array" class = "btn btn-info btn-xs">array</a> <a data-task="add_object" class = "btn btn-warning btn-xs">object</a></div></div>');
        $j('div[data-type="object"]').append(add_more_box);
        $j('div[data-type="array"]').append(add_more_box);

        $j('div.inline_add_box a').click(function (e) {
            var target = $j(e.target);
            var task = target.data('task');
            var add_box = target.parents(".inline_add_box");
            var collection = add_box.parent();
            var type = collection.data('type');

            // TODO this code is a partial duplicate of code in make_node fix it!
            var newObj ="";
            if (type == 'object') {
                newObj = $j('<div data-role="prop"></div>').append($j('<span data-role="key">').append("key")).append(': ');
            } else {
                newObj = $j('<div data-role="arrayitem"></div>');
            }
            var json = "";
            if (task == 'add_object') {
                json = '{"id":"1"}';
                newObj.append(make_node(JSON.parse(json)));
            } else if (task == 'add_array') {
                json = '["item1"]';
                newObj.append(make_node(JSON.parse(json)));
            } else {
                newObj.append($j('<pre data-role="value" data-type="string">').html("value"));
            }
            newObj.hide();
            add_box.before(newObj);
            newObj.show(500);
            apply_editlets();
            return false;
        });

        // make the fields editable in place
        $j('span[data-role="key"]').editable(easy_save_value, {
            cssclass: 'edit_box'
        });
        $j('[data-type="string"]').editable(save_value, {
            cssclass: 'edit_box',
            width : 'auto'
        });
        $j('[data-type="number"]').editable(save_value, {
            cssclass: 'edit_box'
        });
        $j('[data-type="null"]').editable(save_value, {
            cssclass: 'edit_box'
        });
        $j('[data-type="boolean"]').editable(save_value, {
            type   : "select",
            data   : '{"true":"true","false":"false"}',
            cssclass: 'edit_box'
        });

        $j('[data-type="string"]').focusout(function(){
            o=this;
            $j(o).next().removeClass()
                        .addClass(o.children['0'].children['0'].value);
        })

        // make the right click menus
        setup_menu();

        //add icon to right of field if the text is a glyphsicon of fa
        add_icon_item();

    }
    // parse the text area into the the workarea, setup the event handlers
    function load_from_box(jsonfile) {

        $j('#json_editor').html('');
        json_editor('json_editor', $j('#' + jsonfile).val());

        // add the jquery editing magic
        apply_editlets();
    }
    // convert a string into nodes
    function json_editor(divid, json_string) {
        var json = "";
        try {
            json = JSON.parse(json_string);
        } catch (err) {
            json = JSON.parse('{"error": "parse failed"}');
        }
        var base = $j('#' + divid);
        base.append(make_node(json));
    }
    // recursively make html nodes out of the json
    function make_node(node_in) {
        //console.log(" ====> " + JSON.stringify(node_in));
        var type = Object.prototype.toString.apply(node_in);
        //console.log("  - " + type);
        var container = "";
        var row = "";
        if (type === "[object Object]") {
            // TODO create the div for an object here
            container = $j('<div data-role="value" data-type="object"></div>');
            for (var prop in node_in) {
                if (node_in.hasOwnProperty(prop)) {
                    row = $j('<div data-role="prop">  </div>')
                        .append($j('<span data-role="key">')
                        .append(prop))
                        .append(': ')
                        .append(make_node(node_in[prop]))
                    container.append(row);
                }
            }
            return container;
        } else if (type === "[object Array]") {
            container = $j('<div data-role="value" data-type="array"></div>');
            for (var i = 0, j = node_in.length; i < j; i++) {
                row = $j('<div data-role="arrayitem"></div>').append(make_node(node_in[i]));
                container.append(row);
            }
            return container;
        } else if (type === "[object String]") {
            ic = '';
            if (node_in.search('fa fa-')>=0 || node_in.search('glyphicon')>=0) 
                ic = 'data-ic="'+node_in+'"';
            return $j('<pre data-role="value" data-type="string" '+ic+'>').html(node_in);
        } else if (type === "[object Number]") {
            return $j('<pre data-role="value" data-type="number">').html(node_in);
        } else if (type === "[object global]" || type === "[object Null]") {
            return $j('<pre data-role="value" data-type="null">').html('null');
        } else if (type === "[object Boolean]") {
            return $j('<pre data-role="value" data-type="boolean">').html(node_in.toString());
        }
    }