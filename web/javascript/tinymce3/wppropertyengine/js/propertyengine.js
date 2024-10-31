/**
 * @author simonc
 * @since 1.0
 * @package tinymce
 */

var propertyengine = {
    /**
     * Form manipulation
     *
     * @author simonc
     * @since 1.1
     */
    form: {
        /**
         * Extend a form object with getter and setter methods
         *
         * @author simonc
         * @since 1.1
         * @param {Object} form DOM reference to the form
         */
        extend: function(form) {
            tinymce.each(this._extend, function(value, key) {
                form[key] = value;
            });
        },
        /**
         * Populate a form with a shortcode object
         *
         * @param {Object} form DOM reference to the form
         * @param {Object} shortcode Shortcode object {atts, type, value}
         */
        populate: function(form, shortcode) {
            propertyengine.form.extend(form);

            // set the shortcode value for this particular widget
            form.setValue('widgetid', shortcode.value);

            /*
             * Populating attributes
             */
            tinymce.each(shortcode.atts, function(value, key) {
                form.setValue(key, value);
            });
        },
        _extend: {
            /**
             * Retrieves group values from the form, like checkboxes and creates a comma
             * seperated array for the table
             */
            getGroupValue: function(field_name, alt_value) {
                var fields = this[field_name], inArray = tinymce.inArray;
                var values=new Array();

                for (var i in fields) {
                    var field = fields[i];
                    if(field.checked){
                        values.push(field.value )
                    }
                }
                return values.join(',')
            },
            getValue: function(field_name, alt_value) {
                var field = this[field_name], inArray = tinymce.inArray;
                alt_value = alt_value || '';

                if (typeof field == 'undefined') {
                    return '';
                }

                if (field.tagName === 'INPUT' && inArray(['checkbox', 'radio'], field.type) > -1) {
                    field.value = field.checked ? 1 : '';
                }

                return field.value ? field.value : alt_value;
            },
            /**
             * Set group values from the shortcode and configures the form fields, ie. group checkboxes
             */
            setGroupValue: function(field_name, value, alt_value) {
                var fields = this[field_name], inArray = tinymce.inArray;

                // loop over each field
                for (i in fields) {
                    var singleField = fields[i];
                    // set to alt_value if entire value is not prsent
                    if(value){
                        singleField.checked = (value.indexOf(singleField.value) > -1);
                    } else if(alt_value=="checked"){
                        singleField.checked = alt_value
                    }

                }

            },
            setValue: function(field_name, value) {
                if( value.indexOf(',')>-1){
                    this.setGroupValue(field_name, value);
                    return;
                }
                var field = this[field_name], inArray = tinymce.inArray;

                /*
                 * Checkbox/selectbox
                 * @todo : test if functionnal
                 */
                if (field.tagName === 'INPUT' && inArray(['checkbox', 'radio'], field.type) > -1) {
                    // For groupd checkboxes
                    if (field.value.contains(',')) {

                        for (i in field.value.split(',')) {
                            console.log(i);
                        }
                    } else {
                        field.checked = value == field.value ? true : false;
                    }
                }
                /*
                 * Selectbox
                 */
                else if (field.tagName === 'SELECT') {
                    field.value = value || '';
                }
                /*
                 * Input field or a single selected Checkbox
                 */
                else {
                    //determine if this is an input field or
                    if(field.type == undefined && field[0] != null){
                        //This is a very specific case where of the checkbox grp, only 1 item was selected..
                        if( field[0].type == "checkbox" ){
                            this.setGroupValue(field_name, value);
                        }
                    }else{
                        field.value = value || '';
                    }

                }

            }
        }

    },
    /**
     * Proxy method to extract widget settings from HTML code
     *
     * @author simonc
     * @param {String} widget_type
     * @param {String} value_tag_name
     * @param {String} form_id
     */
    fromHtmlToForm: function(widget_type, value_tag_name, form_id) {

        var widgets = this.widget;


        if (typeof widgets[widget_type] != 'object') {
            throw Exception('Undefined widget, what are you playing with?');
        }

        var form = document.getElementById(form_id) || document.getElementsByTagName('form')[0];
        propertyengine.form.extend(form);


        if (widgets[widget_type].fromHtmlToForm(form.getValue(value_tag_name), form)) {
            document.getElementById('apply-magic-response').className = '';
            mcTabs.displayTab('general_tab', 'general_panel');
        }
        else {
            document.getElementById('apply-magic-response').className = 'error';
        }
    },
    /**
     * Assembling shortcode to send it to the editor
     *
     * @author simonc
     * @param {String} name
     * @param {String} value
     * @param {Object} attr
     * @return {String} shortcode
     */
    generate: function(name, value, attr) {
        var each = tinymce.each;
        value = value || '';
        attr = attr || [];

        /*
         * Nothing ? Don't give up yet !
         */
        if (!value) {
            return false;
        }

        var shortcode = '[' + name;
        each(attr, function(value, key) {
            /*
             * No value ? No need to save it
             */
            if (!value) {
                return '';
            }

            shortcode += ' ';
            shortcode += jsEncode(key);
            shortcode += '="';
            shortcode += jsEncode(value);
            shortcode += '"';
        });

        shortcode += ']';
        shortcode += value;
        shortcode += '[/' + name + ']';

        return shortcode;
    },
    /**
     * Parse a shortcode from its HTML DOM node
     *
     * @author simonc
     * @since 1.1
     * @version 1.0
     * @param {Object} tinyMCE Selection
     */
    parse: function(fe) {
        var dom = tinyMCEPopup.editor.dom;
        var node = fe.getNode();
        var shortcode = {
            atts: {},
            type: '',
            value: ''
        };

        /*
         * No content or no selection
         */
        if (!dom.hasClass(node, 'propertyengine')) {
            return shortcode;
        }

        /*
         * Parsing type
         */
        shortcode.type = /(propertyengine-[0-9a-z]+)( |$)/.exec(dom.getAttrib(node, 'class'))[1];

        /*
         * Parsing value
         */
        shortcode.value = /\](.*)\[\//.exec(node.innerHTML)[1]

        /*
         * Parsing attributes
         */
        node.innerHTML.replace(/ ([a-z0-9_]+)="([^"]*)"/g, function(match, key, value) {
            shortcode.atts[key] = value;
        });

        return shortcode;
    },
    /**
     * Proxy method to inject a shortcode in TinyMCE Editor
     *
     * @author simonc
     * @since 1.1
     * @version 1.0
     * @param {Object} type
     * @param {Object} el DOM element. Only support form for now
     */
    sendToRte: function(type, form) {
        form = form || document.getElementsByTagName('form')[0];
        var p = tinyMCEPopup, ed = p.editor, fe = ed.selection.getNode();

        if (typeof propertyengine.widget[type] == 'undefined') {
            throw('Unsupported Widget type. Hm, what are you playing with?');
        }

        /*
         * Form validating
         *
         * Note : tinyMCEPopup.alert() is only available since v3.1.0
         */
        if (!AutoValidator.validate(form)) {
            ed.windowManager.alert(ed.getLang('invalid_data'));
            return false;
        }

        p.restoreSelection();
        propertyengine.form.extend(form);
        var shortcode = propertyengine.widget[type].generate(form, 'propertyengine-' + type);

        /*
         * No shortcode ? Hm, don't want to insert anything in the editor I guess
         */
        if (!shortcode) {
            p.close();
            return false;
        }

        /*
         * Updating a selection
         */
        if (fe && /(^| )propertyengine( |$)/.test(ed.dom.getAttrib(fe, 'class'))) {
            ed.dom.setAttrib(fe, 'class', '');
            ed.dom.addClass(fe, 'propertyengine');
            ed.dom.addClass(fe, 'propertyengine-' + type);
            ed.dom.setHTML(fe, shortcode);
        }
        /*
         * Inserting in the editor
         */
        else {
            p.execCommand(
                'mceInsertContent',
                false,
                '<span class="propertyengine propertyengine-' + type + '">' + shortcode + '</span>'
            );
        }

        p.close();
        return false;
    },
    /*
     * Utilities
     */
    utils: {

        getBasicString: function(tag, html) {
            return tag + '="([a-zA-Z0-9]+)"'.execAndGet(html)
        }
    },
    /**
     * Widgets settings and callbacks
     */
    widget: {
        /*
         * LiveList
         */
        livelist: {
            /**
             * Populate the form from HTML code provided by PropertyEngine
             *
             * @param {String} html HTML code
             * @param {Object} form form to inject values in
             */
            fromHtmlToForm: function(html, form) {
                form.setValue('widgetid', /id="PE_WIDGET_([^"]+)"/i.execAndGet(html));
                form.setValue('view', propertyengine.utils.getBasicString(html));
                form.setValue('startview', propertyengine.utils.getBasicString(html));
                form.setValue('showsearch', propertyengine.utils.getBasicString(html));
                form.setGroupValue('showstatus', propertyengine.utils.getBasicString(html),'checked');
                form.setGroupValue('sharebutton', propertyengine.utils.getBasicString(html),'checked');
                form.setGroupValue('hidecolumns', propertyengine.utils.getBasicString(html),'');
                form.setValue('align', propertyengine.utils.getBasicString(html));
                form.setValue('fontcolor', propertyengine.utils.getBasicString(html));
                form.setValue('linecolor', propertyengine.utils.getBasicString(html));
                form.setValue('bgcolor', propertyengine.utils.getBasicString(html));
                form.setValue('height', propertyengine.utils.getBasicString(html));
                form.setValue('width', propertyengine.utils.getBasicString(html));
                return form.getValue('widgetid');
            },
            /**
             * Generate shortcode from forms value
             *
             * @param {Object} form
             * @param {Object} name
             */
            generate: function(form, name) {
                var shortcode = propertyengine.generate(name, form.getValue('widgetid'), {
                    view:         form.getValue('view'),
                    startview:    form.getValue('startview'),
                    showsearch:   form.getValue('showsearch'),
                    showstatus:   form.getGroupValue('showstatus'),
                    sharebutton:  form.getGroupValue('sharebutton'),
                    hidecolumns:  form.getGroupValue('hidecolumns'),
                    align:        form.getValue('align'),
                    fontcolor:    form.getValue('fontcolor'),
                    linecolor:    form.getValue('linecolor'),
                    bgcolor:      form.getValue('bgcolor'),
                    height:       form.getValue('height'),
                    width:        form.getValue('width')
                });

                return shortcode;
            }
        }

    }
};

/*
 * Custom and internal functions
 */

/**
 * Execute a RegExp and extract a result by index
 *
 * @author tparisot
 * @param {String} haystack String to apply the regular expression on
 * @param {Integer} index Index of the regexp result to return, if not empty
 */
RegExp.prototype.execAndGet = function(haystack, index) {
    index = index || 1;

    var result = this.exec(haystack) || '';
    return result ? result[index] : '';
}

/**
 * Encode a value and assume it can be an HTML attribute value
 *
 * @author simonc
 * @param {String} val Initial value to clean
 * @return {String} val Sanitized value
 */
function jsEncode(val) {
    val = val.replace(/\\\\/, '\\\\');
    val = val.replace(/["']/, '');

    return val;
}