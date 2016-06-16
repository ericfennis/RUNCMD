/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	var __vue_script__, __vue_template__
	__vue_script__ = __webpack_require__(1)
	if (__vue_script__ &&
	    __vue_script__.__esModule &&
	    Object.keys(__vue_script__).length > 1) {
	  console.warn("[vue-loader] packages\\bixie\\blogposts\\app\\components\\widget-blogposts.vue: named exports in *.vue files are ignored.")}
	__vue_template__ = __webpack_require__(2)
	module.exports = __vue_script__ || {}
	if (module.exports.__esModule) module.exports = module.exports.default
	if (__vue_template__) {
	(typeof module.exports === "function" ? (module.exports.options || (module.exports.options = {})) : module.exports).template = __vue_template__
	}
	if (false) {(function () {  module.hot.accept()
	  var hotAPI = require("vue-hot-reload-api")
	  hotAPI.install(require("vue"), true)
	  if (!hotAPI.compatible) return
	  var id = "C:\\BixieProjects\\pagekit\\pagekit\\packages\\bixie\\blogposts\\app\\components\\widget-blogposts.vue"
	  if (!module.hot.data) {
	    hotAPI.createRecord(id, module.exports)
	  } else {
	    hotAPI.update(id, module.exports, __vue_template__)
	  }
	})()}

/***/ },
/* 1 */
/***/ function(module, exports) {

	'use strict';

	module.exports = {

	    section: {
	        label: 'Settings'
	    },

	    replace: false,

	    props: ['widget', 'config', 'form'],

	    created: function created() {
	        this.$options.partials = this.$parent.$options.partials;
	        this.$set('widget.data', _.merge({
	            view: 'list',
	            count: 5,
	            show_image: 'side',
	            cols: 3,
	            panel_class: '',
	            show_meta: 1,
	            show_readmorelink: 1,
	            readmore_text: 'Read more',
	            show_bloglink: 1,
	            bloglink_text: 'All blog posts',
	            content_length: 0
	        }, this.widget.data));
	    }
	};

	window.Widgets.components['bixie-blogposts:settings'] = module.exports;

/***/ },
/* 2 */
/***/ function(module, exports) {

	module.exports = "\n\n<div class=\"uk-grid pk-grid-large\" data-uk-grid-margin>\n    <div class=\"uk-flex-item-1 uk-form-horizontal\">\n\n        <div class=\"uk-form-row\">\n            <label for=\"form-title\" class=\"uk-form-label\">{{ 'Title' | trans }}</label>\n            <div class=\"uk-form-controls\">\n                <input id=\"form-title\" class=\"uk-form-width-large\" type=\"text\" name=\"title\" v-model=\"widget.title\" v-validate:required>\n                <p class=\"uk-form-help-block uk-text-danger\" v-show=\"form.title.invalid\">{{ 'Title cannot be blank.' | trans }}</p>\n            </div>\n        </div>\n\n        <div class=\"uk-form-row\">\n            <label for=\"form-view\" class=\"uk-form-label\">{{ 'Layout' | trans }}</label>\n            <div class=\"uk-form-controls\">\n                <select id=\"form-view\" v-model=\"widget.data.view\" class=\"uk-form-width-medium\">\n                    <option value=\"list\">{{ 'List' | trans }}</option>\n                    <option value=\"grid\">{{ 'Grid' | trans }}</option>\n                </select>\n            </div>\n        </div>\n\n        <div class=\"uk-form-row\">\n            <label for=\"form-count\" class=\"uk-form-label\">{{ 'Count' | trans }}</label>\n            <div class=\"uk-form-controls\">\n                <input id=\"form-count\" class=\"uk-form-width-small uk-text-right\" type=\"number\" name=\"title\"\n                       v-model=\"widget.data.count\" min=\"0\" number>\n            </div>\n        </div>\n\n        <div class=\"uk-form-row\">\n            <label for=\"form-show_image\" class=\"uk-form-label\">{{ 'Show image' | trans }}</label>\n            <div class=\"uk-form-controls\">\n                <select id=\"form-show_image\" v-model=\"widget.data.show_image\" class=\"uk-form-width-medium\">\n                    <option value=\"\">{{ 'No image' | trans }}</option>\n                    <option value=\"side\">{{ 'Side' | trans }}</option>\n                    <option value=\"top\">{{ 'Top' | trans }}</option>\n                </select>\n            </div>\n        </div>\n\n        <div v-show=\"widget.data.view == 'grid'\" class=\"uk-form-row\">\n            <label for=\"form-cols\" class=\"uk-form-label\">{{ 'Columns' | trans }}</label>\n            <div class=\"uk-form-controls\">\n                <select id=\"form-cols\" v-model=\"widget.data.cols\" class=\"uk-form-width-medium\">\n                    <option value=\"1\">1</option>\n                    <option value=\"2\">2</option>\n                    <option value=\"3\">3</option>\n                    <option value=\"4\">4</option>\n                    <option value=\"5\">5</option>\n                    <option value=\"6\">6</option>\n                </select>\n            </div>\n        </div>\n\n        <div v-show=\"widget.data.view == 'grid'\" class=\"uk-form-row\">\n            <label for=\"form-panel_class\" class=\"uk-form-label\">{{ 'Panel' | trans }}</label>\n            <div class=\"uk-form-controls\">\n                <select id=\"form-panel_class\" v-model=\"widget.data.panel_class\" class=\"uk-form-width-medium\">\n                    <option value=\"\">Blank</option>\n                    <option value=\"uk-panel-box\">{{ 'Panel box' | trans }}</option>\n                    <option value=\"uk-panel-space\">{{ 'Panel space' | trans }}</option>\n                    <option value=\"uk-panel-box uk-panel-box-primary\">{{ 'Panel Primary' | trans }}</option>\n                    <option value=\"uk-panel-box uk-panel-box-secondary\">{{ 'Panel Secondary' | trans }}</option>\n                </select>\n            </div>\n        </div>\n\n        <div class=\"uk-form-row\">\n            <label for=\"form-content_length\" class=\"uk-form-label\">{{ 'Content length' | trans }}</label>\n            <div class=\"uk-form-controls\">\n                <input id=\"form-content_length\" class=\"uk-form-width-small uk-text-right\" type=\"number\" name=\"title\"\n                       v-model=\"widget.data.content_length\" min=\"0\" number>\n            </div>\n        </div>\n\n        <div class=\"uk-form-row\">\n            <label for=\"form-show_meta\" class=\"uk-form-label\">{{ 'Show meta' | trans }}</label>\n            <div class=\"uk-form-controls\">\n                <select id=\"form-show_meta\" v-model=\"widget.data.show_meta\" class=\"uk-form-width-medium\" number>\n                    <option value=\"1\">{{ 'Yes' | trans }}</option>\n                    <option value=\"0\">{{ 'No' | trans }}</option>\n                </select>\n            </div>\n        </div>\n\n        <div class=\"uk-form-row\">\n            <label for=\"form-show_readmorelink\" class=\"uk-form-label\">{{ 'Show read more' | trans }}</label>\n            <div class=\"uk-form-controls\">\n                <select id=\"form-show_readmorelink\" v-model=\"widget.data.show_readmorelink\" class=\"uk-form-width-medium\" number>\n                    <option value=\"1\">{{ 'Yes' | trans }}</option>\n                    <option value=\"0\">{{ 'No' | trans }}</option>\n                </select>\n            </div>\n        </div>\n\n        <div v-show=\"widget.data.show_readmorelink == 1\" class=\"uk-form-row\">\n            <label for=\"form-readmore_text\" class=\"uk-form-label\">{{ 'Link text' | trans }}</label>\n            <div class=\"uk-form-controls\">\n                <input id=\"form-readmore_text\" class=\"uk-form-width-large\" type=\"text\" name=\"title\" v-model=\"widget.data.readmore_text\">\n            </div>\n        </div>\n\n        <div class=\"uk-form-row\">\n            <label for=\"form-show_bloglink\" class=\"uk-form-label\">{{ 'Show link to blog' | trans }}</label>\n            <div class=\"uk-form-controls\">\n                <select id=\"form-show_bloglink\" v-model=\"widget.data.show_bloglink\" class=\"uk-form-width-medium\" number>\n                    <option value=\"1\">{{ 'Yes' | trans }}</option>\n                    <option value=\"0\">{{ 'No' | trans }}</option>\n                </select>\n            </div>\n        </div>\n\n        <div v-show=\"widget.data.show_bloglink == 1\" class=\"uk-form-row\">\n            <label for=\"form-bloglink_text\" class=\"uk-form-label\">{{ 'Link text' | trans }}</label>\n            <div class=\"uk-form-controls\">\n                <input id=\"form-bloglink_text\" class=\"uk-form-width-large\" type=\"text\" name=\"title\" v-model=\"widget.data.bloglink_text\">\n            </div>\n        </div>\n\n    </div>\n    <div class=\"pk-width-sidebar pk-width-sidebar-large\">\n\n        <partial name=\"settings\"></partial>\n\n    </div>\n</div>\n\n";

/***/ }
/******/ ]);