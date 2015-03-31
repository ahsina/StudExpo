(function($) {
    tinymce.create('tinymce.plugins.tiny_bootstrap_elements_light', {
        init : function(editor, url) {
            var $ = jQuery.noConflict();
            tinymce.PluginManager.requireLangPack('tiny_bootstrap_elements_light');

            var iFrameDefaultWidth = 885;

            /* Extend valid elements to prevent tinymce from removing glyphicon tags */

            var settings_ext_valid_elements = editor.settings.extended_valid_elements;
            if(typeof(settings_ext_valid_elements) == "undefined") {
                settings_ext_valid_elements = "div[*],span[class|style],a[accesskey|contextmenu|data-*|disabled|hidden|lang|style|media|download|id|rel|rev|charset|hreflang|tabindex|accesskey|type|name|href|target|title|class|onfocus|onblur]"; // prevent tinymce from removing text from link with empty href.
            } else {
                settings_ext_valid_elements = settings_ext_valid_elements + ',' + "div[*],span[class|style],a[accesskey|contextmenu|data-*|disabled|hidden|lang|style|media|download|id|rel|rev|charset|hreflang|tabindex|accesskey|type|name|href|target|title|class|onfocus|onblur]";
            }
            tinyMCE.activeEditor.settings.extended_valid_elements = settings_ext_valid_elements;

            if(typeof(editor.settings.bootstrapLightConfig) == "undefined") {
                editor.settings.bootstrapLightConfig = [];
            }

            /* Bootstrap css path (default / custom) */

            if(editor.settings.bootstrapLightConfig.bootstrapLightCssPath === '' && editor.settings.bootstrapLightConfig.frontEndLightCssFiles === '') { // default Bootstrap css if no css configured
                bootstrapLightCssPath = url + '/css/bootstrap.min.css';
                editor.settings.bootstrapLightConfig.bootstrapLightCssPath = {'bootstrapLightCssPath': bootstrapLightCssPath};
            } else {
                bootstrapLightCssPath = editor.settings.bootstrapLightConfig.bootstrapLightCssPath;
            }

            /* Bootstrap Elements (default / custom) */

            if(typeof(editor.settings.bootstrapLightConfig.bootstrapElementsLight) == "undefined") { // default Elements
                editor.settings.bootstrapLightConfig.bootstrapElementsLight = {
                    'btn': true,
                    'label': true,
                    'badge': true,
                    'alert': true
                };
            }

            bootstrapElementsLight = editor.settings.bootstrapLightConfig.bootstrapElementsLight;

            /* Add Bootstrap css to editor */

            var content_css = editor.settings.content_css;
            if(typeof(content_css) == "undefined") {
                content_css = bootstrapLightCssPath + ',' + url + '/css/editor-content.css';
            } else {
                content_css = content_css + ',' + bootstrapLightCssPath + ',' + url + '/css/editor-content.css';
            }
            editor.settings.content_css = content_css;

            /* add Frontend css to editor */

            var frontEndLightCssFiles = editor.settings.bootstrapLightConfig.frontEndLightCssFiles;
            if(frontEndLightCssFiles !== '') {
                editor.settings.content_css += ', ' + frontEndLightCssFiles;
            }

            /* catch css pathes to send to php dialogs */

            var css_paths = bootstrapLightCssPath;
            if(frontEndLightCssFiles !== '') {
                css_paths += ', ' + frontEndLightCssFiles;
            }

            /**
             * Open iframe dialog,
             * Get and transmit selected element attributes to iframe
             * @param  string iframeUrl
             * @param  string iframeTitle
             * @param  string iframeHeight
             * @param  string type      the dialog to display
             * (bsBtn|bsIcon|bsTable|bsTemplate|bsBreadcrumb|bsPagination|bsPager|bsLabel|bsBadge|bsAlert|bsPanel)
             * @return void
             */
            function tbelShowDialog(iframeUrl, iframeTitle, iframeHeight, type)
            {

                /* get selected element values to transmit to iframe */

                var selectedNode = tbelGetSelectedNode();
                var nodeAttributes = '';
                if($(selectedNode).hasClass('active')) {
                    if($(selectedNode).hasClass('btn')) {
                        nodeAttributes = tbelGetNodeAttributes(selectedNode, 'bsBtn');
                    } else if($(selectedNode).hasClass('label')) {
                        nodeAttributes = tbelGetNodeAttributes(selectedNode, 'bsLabel');
                    } else if($(selectedNode).hasClass('badge')) {
                        nodeAttributes = tbelGetNodeAttributes(selectedNode, 'bsBadge');
                    } else if($(selectedNode).hasClass('alert')) {
                        nodeAttributes = tbelGetNodeAttributes(selectedNode, 'bsAlert');
                    }
                }
                function GetTheHtml(){
                    var html = '';
                    var language = tinymce.activeEditor.getParam('language');
                    if(!language) {
                        language = 'en_EN';
                    }
                    html += '<input type="hidden" name="bs-code" id="bs-code" />';
                    html += '<iframe src="'+ url + '/' + iframeUrl + '?language=' + language + '&css_paths=' + css_paths + '&' + nodeAttributes + '&' + new Date().getTime() + '" frameborder="0"></iframe>';

                    return html;
                }

                var iFrameWidth = iFrameDefaultWidth;

                if($(window).width() < 885) {
                    iFrameWidth = $(window).width()*0.9;
                }

                if($(window).height() > iframeHeight) {
                    iframeHeight = ($(window).height()*0.9) - 90;
                }

                win = editor.windowManager.open({
                    title: iframeTitle,
                    width : iFrameWidth,
                    height : iframeHeight,
                    html: GetTheHtml(),
                    buttons: [
                        {
                            text: 'OK',
                            subtype: 'primary',
                            onclick: function(element) {
                                tbelRenderContent(element, type);
                                this.parent().parent().close();
                            }
                        },
                        {
                            text: 'Cancel',
                            onclick: function() {
                                this.parent().parent().close();
                            }
                        }
                    ]
                },
                {
                    jquery: $ // PASS JQUERY
                });

                /* OK / Cancel buttons position for responsive */

                $('.mce-floatpanel').find('.mce-abs-layout-item.mce-first').css({'left':'auto', 'right':'82px'});
                $('.mce-floatpanel').find('.mce-last.mce-abs-layout-item').css({'left':'auto', 'right':'10px'});

                $(window).on('resize', function() {
                    tbelResizeDialog();
                });
            }

            function tbelResizeDialog()
            {
                var iFrameWidth = iFrameDefaultWidth;
                if($(window).width() > iFrameDefaultWidth) {
                    iFrameWidth = iFrameDefaultWidth;
                } else {
                    iFrameWidth = $(window).width()*0.9;
                }
                $('.mce-floatpanel').width(iFrameWidth).css('left', ($(window).width() - iFrameWidth) / 2);
                $('.mce-floatpanel').find('.mce-container-body, .mce-foot, .mce-abs-layout').width(iFrameWidth);
                if(iFrameWidth < 768) {
                    $('iframe').contents().find('.container').addClass('container-xs');
                } else {
                    $('iframe').contents().find('.container').removeClass('container-xs');
                }
            }

            /**
             * gets the selected node in editor, or the active parent matching a bootstrap element
             * @return matching bootstrap element
             */
            function tbelGetSelectedNode()
            {
                var selectedNode = editor.selection.getNode();
                if(!$(selectedNode).hasClass('active') || $(selectedNode).closest("div.alert").length > 0) { // li without link HAS class 'active' in bootstrap

                    /* look for .table|.breadcrumb|.pagination|.pager|.alert|.panel in parents */

                    var classes = ['.alert'];
                    var found = false;

                    for (var i = 0; i < classes.length; i++) {
                        if($(selectedNode).closest(classes[i]).length > 0 && found === false) {
                            selectedNode = $(selectedNode).closest(classes[i]);
                            found = true;
                        }
                    }
                }

                return selectedNode;
            }

            /**
             * insert|update editor content
             * @param  string element the 'ok' button of iframe
             * @param  string type    type of content to insert|update
             *                        (bsBtn|bsIcon|bsTable|bsTemplate|bsBreadcrumb|bsPagination|bsPager|bsLabel|bsBadge|bsAlert|bsPanel)
             * @return void
             */
            function tbelRenderContent(element, type)
            {
                var markup = tbelHtmlDecode(document.getElementById('bs-code').value) + '<p></p>';
                var selectedNode = tbelGetSelectedNode();
                if($(selectedNode).hasClass('active')) {

                    /* remove old content */

                    var typesClasses = {
                        'bsBtn': 'btn',
                        'bsLabel': 'label',
                        'bsBadge': 'badge',
                        'bsAlert': 'alert'
                    };

                    for(var key in typesClasses)
                    {
                      var value = typesClasses[key];
                        if(type == key) {
                            if($(selectedNode).hasClass(value)) { // remove old element
                                editor.dom.remove(selectedNode);
                            }
                        }
                    }
                }
                editor.insertContent(markup);
                /* remove the '<br data-mce-bogus="1"> added by tinyMce in pagination with firefox */
                tinymce.activeEditor.dom.remove(tinymce.activeEditor.dom.select('br[data-mce-bogus="1"]'));
            }

            /**
             * get selected node attributes to transmit to iframe
             * @param  string selectedNode
             * @param  string type         type of the clicked btn
             *                             (bsBtn|bsIcon|bsTable|bsTemplate|bsBreadcrumb|bsPagination|bsPager|bsLabel|bsBadge|bsAlert|bsPanel)
             * @return string              node attributes
             */
            function tbelGetNodeAttributes(selectedNode, type)
            {
                var urlString = '';
                if(type == 'bsBtn') {
                    var i;
                    var btnCode = $(selectedNode)[0].outerHTML.replace(' active', '');
                    var btnIcon = '';
                    if($(selectedNode).find('span')[0]) {
                        btnIcon = $(selectedNode).find('span').attr('class').split(" ")[1];
                    }
                    var styles = new Array('default', 'btn-primary', 'btn-success', 'btn-info', 'btn-warning', 'btn-danger');
                    var btnStyle = '';
                    for (i = styles.length - 1; i >= 0; i--) {
                        if($(selectedNode).hasClass(styles[i])) {
                            btnStyle = styles[i];
                        }
                    }
                    var sizes = new Array('btn-xs', 'btn-sm', 'btn-lg');
                    var btnSize = '';
                    for (i = sizes.length - 1; i >= 0; i--) {
                        if($(selectedNode).hasClass(sizes[i])) {
                            btnSize = sizes[i];
                        }
                    }
                    var btnTag = $(selectedNode).prop("tagName").toLowerCase();
                    var btnHref = '';
                    if(btnTag == 'a') {
                        btnHref = $(selectedNode).attr("href");
                    }
                    var btnType = '';
                    if(btnTag == 'button' || btnTag == 'input') {
                        btnType = $(selectedNode).attr("type");
                    }
                    var btnText;
                    if(btnTag == 'button' || btnTag == 'a') {
                        btnText = $(selectedNode).remove('i').text();
                    } else {
                        btnText = $(selectedNode).val();
                    }
                    var iconPos = 'prepend';
                    if($(selectedNode).find('span')[0]) {
                        var reg = new RegExp('/^' + btnText + '/');
                        if(reg.test($(selectedNode).html()) !== true) {
                            iconPos = 'append';
                        }
                    }
                    btnCode   = encodeURIComponent(btnCode);
                    btnIcon   = encodeURIComponent(btnIcon);
                    btnStyle  = encodeURIComponent(btnStyle);
                    btnSize   = encodeURIComponent(btnSize);
                    btnTag    = encodeURIComponent(btnTag);
                    btnHref   = encodeURIComponent(btnHref);
                    btnType   = encodeURIComponent(btnType);
                    btnText   = encodeURIComponent(btnText);
                    iconPos   = encodeURIComponent(iconPos);
                    urlString =  'btnCode=' + btnCode + '&btnIcon=' + btnIcon + '&btnStyle=' + btnStyle + '&btnSize=' + btnSize + '&btnTag=' + btnTag + '&btnHref=' + btnHref + '&btnType=' + btnType + '&btnText=' + btnText + '&iconPos=' + iconPos;
                }
                else if(type == 'bsLabel' || type == 'bsBadge' || type == 'bsAlert') {
                    urlString =  'edit=true';
                }

                return urlString;
            }

            function tbelHtmlDecode(input)
            {
                var e = document.createElement('div');
                e.innerHTML = input;
                return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
            }

            // Add custom css for toolbar icons

            editor.on('init', function()
            {
                var cssURL = url + '/css/editor.css';
                if(document.createStyleSheet){
                    document.createStyleSheet(cssURL);
                } else {
                    cssLink = editor.dom.create('link', {
                                rel: 'stylesheet',
                                href: cssURL
                              });
                    document.getElementsByTagName('head')[0].
                              appendChild(cssLink);
                }

                /* get custom background color */

                var tinymceLightBackgroundColor = editor.settings.bootstrapLightConfig.tinymceLightBackgroundColor;
                if(tinymceLightBackgroundColor !== '') {
                    editor.dom.addStyle('.mce-content-body {background-color: ' + tinymceLightBackgroundColor + ' !important}');
                }
                tbelInitCallbackEvents();
            });

            /* callback events to select bootstrap elements on click and allow updates */

            /**
             * tbelInitCallbackEvents
             * @return void
             */
            function tbelInitCallbackEvents()
            {
                $(editor.dom.select('body')).on('click keyup', function(e) {
                    var elementSelector = '';
                    var editorBtnName = '';
                    if($(e.target).attr('class')) { // btn
                        if($(e.target).attr('class').match(/btn/)) {
                            elementSelector = '.btn';
                            editorBtnName = 'insertBtnBtn';
                        } else if($(e.target).attr('class').match(/label/)) {
                            elementSelector = '.label';
                            editorBtnName = 'insertLabelBtn';
                        } else if($(e.target).attr('class').match(/badge/)) {
                            elementSelector = '.badge';
                            editorBtnName = 'insertBadgeBtn';
                        } else if($(e.target).attr('class').match(/alert/)) {
                            elementSelector = '.alert';
                            editorBtnName = 'insertAlertBtn';
                        }
                    } else if($(e.target).closest('.alert').attr('class')) { // alert
                        elementSelector = '.alert';
                        editorBtnName = 'insertAlertBtn';
                    }

                    /* deactivate all previous activated */

                    tbelDeactivateAll();

                    if(elementSelector === '') {
                        return;
                    }

                    /* activate current */

                    tbelActivate(e.target, elementSelector, editorBtnName);
                });
                tbelDeactivateAll(); // onLoad
            }

            function tbelActivate(element, elementSelector, editorBtnName)
            {
                if(elementSelector == '.btn') {
                    editor.selection.setCursorLocation(element, true);
                }
                if(elementSelector == '.alert') {
                    $(element).closest('.alert').addClass('active');
                    tbelToggleEditorButton(editorBtnName, 'on');
                } else {
                    $(element).addClass('active');
                    tbelToggleEditorButton(editorBtnName, 'on');
                }
            }

            function tbelDeactivateAll()
            {
                var elements = new Array('.btn', '.label', '.badge', '.alert');
                for (var i = 0; i < elements.length; i++) {
                    $(editor.dom.select(elements[i])).removeClass('active');
                }
                tbelToggleEditorButton('allBtns', 'off');
            }

            function tbelToggleEditorButton(editorBtnName, onOff)
            {
                var editorBtns = editor.buttons.tiny_bootstrap_elements_light.items;
                for (var i = editorBtns.length - 1; i >= 0; i--) {
                    if(editorBtnName == 'allBtns' || editorBtns[i]._name == editorBtnName) {
                        if(onOff == 'on') {
                            editorBtns[i].addClass('active');
                        } else {
                            editorBtns[i].removeClass('active');
                        }
                    }
                }
            }

            function tbelProVersion()
            {
                $('<div id="buy-pro-version" style="position:absolute;top:-100px;left:50%;width:580px;margin-left:-225px;z-index:1000000"><a href="http://codecanyon.net/item/tiny-bootstrap-elements-wordpress-plugin/10293837"><p class="button button-primary button-large" style="height:auto !important;padding:20px !important"><button type="button" id="close-btn" style="float:right;margin-top:-4px;padding:0 5px; background:#FFF;color:#333">×</button><strong>Get this feature on PRO version at</strong><br>http://codecanyon.net/item/tiny-bootstrap-elements-wordpress-plugin/10293837</p></a></div>').appendTo('.mce-tinymce.mce-container');
                $('#close-btn').on('click', function(event) {
                    event.stopPropagation();
                    $('#buy-pro-version').fadeOut(400);
                    return false;
                });
            }

            var tbelBsItems = [];

            // Create and render a buttongroup with buttons

            var tbelBs3Btn = tinymce.ui.Factory.create({
                type: 'button',
                text: "",
                classes: "widget btn bs-icon-btn",
                icon: "bootstrap-icon",
                tooltip: "Bootstrap Elements Light"
            });
            tbelBsItems.push(tbelBs3Btn);
            if(bootstrapElementsLight.btn) {
                var insertBtn = tinymce.ui.Factory.create({
                    type: 'button',
                    classes: "widget btn bs-icon-btn",
                    // text: "btn",
                    icon: "icon-btn",
                    name: "insertBtnBtn",
                    tooltip: "Insert/Edit Bootstrap Button",
                    onclick: function() {
                        tbelShowDialog("bootstrap-btn.php", "Insert/Edit Bootstrap Button", 580, 'bsBtn');
                    }
                });
                tbelBsItems.push(insertBtn);
            }
            var insertImage = tinymce.ui.Factory.create({
                type: 'button',
                classes: "widget btn bs-icon-btn bs-icon-btn-disabled",
                icon: "icon-image",
                name: "insertImageBtn",
                tooltip: "Insert/Edit Bootstrap Image",
                onclick: function() {
                    tbelProVersion();
                }
            });
            tbelBsItems.push(insertImage);
            var insertIcon = tinymce.ui.Factory.create({
                type: 'button',
                classes: "widget btn bs-icon-btn bs-icon-btn-disabled",
                icon: "icon-icon",
                name: "insertIconBtn",
                tooltip: "Insert/Edit Bootstrap Icon",
                onclick: function() {
                    tbelProVersion();
                }
            });
            tbelBsItems.push(insertIcon);
            var insertTable = tinymce.ui.Factory.create({
                type: 'button',
                classes: "widget btn bs-icon-btn bs-icon-btn-disabled",
                icon: "icon-table",
                name: "insertTableBtn",
                tooltip: "Insert/Edit Bootstrap Table",
                onclick: function() {
                    tbelProVersion();
                }
            });
            tbelBsItems.push(insertTable);
            var insertTemplate = tinymce.ui.Factory.create({
                type: 'button',
                classes: "widget btn bs-icon-btn bs-icon-btn-disabled",
                icon: "icon-template",
                name: "insertTemplateBtn",
                tooltip: "Insert Bootstrap Template",
                onclick: function() {
                    tbelProVersion();
                }
            });
            tbelBsItems.push(insertTemplate);
            var insertBreadcrumb = tinymce.ui.Factory.create({
                type: 'button',
                classes: "widget btn bs-icon-btn bs-icon-btn-disabled",
                icon: "icon-breadcrumb",
                name: "insertBreadcrumbBtn",
                tooltip: "Insert/Edit Bootstrap Breadcrumb",
                onclick: function() {
                    tbelProVersion();
                }
            });
            tbelBsItems.push(insertBreadcrumb);
            var insertPagination = tinymce.ui.Factory.create({
                type: 'button',
                classes: "widget btn bs-icon-btn bs-icon-btn-disabled",
                icon: "icon-pagination",
                name: "insertPaginationBtn",
                tooltip: "Insert/Edit Bootstrap Pagination",
                onclick: function() {
                    tbelProVersion();
                }
            });
            tbelBsItems.push(insertPagination);
            var insertPager = tinymce.ui.Factory.create({
                type: 'button',
                classes: "widget btn bs-icon-btn bs-icon-btn-disabled",
                icon: "icon-pager",
                name: "insertPagerBtn",
                tooltip: "Insert/Edit Bootstrap Pager",
                onclick: function() {
                    tbelProVersion();
                }
            });
            tbelBsItems.push(insertPager);
            if(bootstrapElementsLight.label) {
                var insertLabel = tinymce.ui.Factory.create({
                    type: 'button',
                    classes: "widget btn bs-icon-btn",
                    icon: "icon-label",
                    name: "insertLabelBtn",
                    tooltip: "Insert/Edit Bootstrap Label",
                    onclick: function() {
                        tbelShowDialog("bootstrap-label.php", "Insert/Edit Bootstrap Label", 350, 'bsLabel');
                    }
                });
                tbelBsItems.push(insertLabel);
            }
            if(bootstrapElementsLight.badge) {
                var insertBadge = tinymce.ui.Factory.create({
                    type: 'button',
                    classes: "widget btn bs-icon-btn",
                    icon: "icon-badge",
                    name: "insertBadgeBtn",
                    tooltip: "Insert/Edit Bootstrap Badge",
                    onclick: function() {
                        tbelShowDialog("bootstrap-badge.php", "Insert/Edit Bootstrap Badge", 350, 'bsBadge');
                    }
                });
                tbelBsItems.push(insertBadge);
            }
            if(bootstrapElementsLight.alert) {
                var insertAlert = tinymce.ui.Factory.create({
                    type: 'button',
                    classes: "widget btn bs-icon-btn",
                    icon: "icon-alert",
                    name: "insertAlertBtn",
                    tooltip: "Insert/Edit Bootstrap Alert",
                    onclick: function() {
                        tbelShowDialog("bootstrap-alert.php", "Insert/Edit Bootstrap Alert", 580, 'bsAlert');
                    }
                });
                tbelBsItems.push(insertAlert);
            }
            var insertPanel = tinymce.ui.Factory.create({
                type: 'button',
                classes: "widget btn bs-icon-btn bs-icon-btn-disabled",
                icon: "icon-panel",
                name: "insertPanelBtn",
                tooltip: "Insert/Edit Bootstrap Panel",
                onclick: function() {
                    tbelProVersion();
                }
            });
            tbelBsItems.push(insertPanel);
            editor.addButton("tiny_bootstrap_elements_light", {
                type: "buttongroup",
                classes: "bs-btn",
                items: tbelBsItems
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "Tiny Bootstrap Elements Light",
                author : 'Gilles Migliori',
                authorurl : 'http://www.creation-site.org',
                infourl : 'http://codecanyon.net/item/tinymce-bootstrap-plugin/10086522',
                version : "1.0"
            };
        }
   });
   tinymce.PluginManager.add('tiny_bootstrap_elements_light', tinymce.plugins.tiny_bootstrap_elements_light);
})(jQuery);
