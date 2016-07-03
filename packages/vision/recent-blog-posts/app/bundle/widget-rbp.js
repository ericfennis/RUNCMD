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
	  console.warn("[vue-loader] app/components/widget-rbp.vue: named exports in *.vue files are ignored.")}
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
	  var id = "/Users/yanpaiha/Code/pagekit/packages/vision/recent-blog-posts/app/components/widget-rbp.vue"
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

	    props: ['config', 'form', 'widget'],

	    created: function created() {
	        this.$options.partials = this.$parent.$options.partials;
	    }
	};
	window.Widgets.components['vision-rbp:settings'] = module.exports;

/***/ },
/* 2 */
/***/ function(module, exports) {

	module.exports = "\n\n<div class=\"uk-grid pk-grid-large\" data-uk-grid-margin>\n    <div class=\"uk-flex-item-1 uk-form-horizontal\">\n\n        <div class=\"uk-form-row\">\n            <label for=\"form-title\" class=\"uk-form-label\">{{ 'Title' | trans }}</label>\n            <div class=\"uk-form-controls\">\n                <input id=\"form-title\" class=\"uk-form-width-large\" type=\"text\" name=\"title\" v-model=\"widget.title\" v-validate:required>\n                <p class=\"uk-form-help-block uk-text-danger\" v-show=\"form.title.invalid\">{{ 'Title cannot be blank.' | trans }}</p>\n            </div>\n        </div>\n\n        <div class=\"uk-form-row\">\n            <span class=\"uk-form-label\">Image</span>\n            <div class=\"uk-form-controls uk-form-controls-text\">\n                <label><input id=\"form-display-image\" class=\"uk-form-width-large\" type=\"checkbox\" name=\"display-image\" v-model=\"widget.data.display_image\"> Show Article Image</label>\n            </div>\n        </div>\n\n        <div class=\"uk-form-row\">\n            <span class=\"uk-form-label\">How many posts did you want to display?</span>\n            <div class=\"uk-form-controls\">\n                <input id=\"form-blog-posts-limit\" class=\"uk-form-width-large\" type=\"number\", name=\"blog-posts-limit\" v-model=\"widget.data.blog_posts_limit\">\n            </div>\n        </div>\n\n    </div>\n    <div class=\"pk-width-sidebar pk-width-sidebar-large\">\n\n        <partial name=\"settings\"></partial>\n\n    </div>\n</div>\n\n";

/***/ }
/******/ ]);