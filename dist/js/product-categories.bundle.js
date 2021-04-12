/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/debounce/index.js":
/*!****************************************!*\
  !*** ./node_modules/debounce/index.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/**\n * Returns a function, that, as long as it continues to be invoked, will not\n * be triggered. The function will be called after it stops being called for\n * N milliseconds. If `immediate` is passed, trigger the function on the\n * leading edge, instead of the trailing. The function also has a property 'clear' \n * that is a function which will clear the timer to prevent previously scheduled executions. \n *\n * @source underscore.js\n * @see http://unscriptable.com/2009/03/20/debouncing-javascript-methods/\n * @param {Function} function to wrap\n * @param {Number} timeout in ms (`100`)\n * @param {Boolean} whether to execute at the beginning (`false`)\n * @api public\n */\nfunction debounce(func, wait, immediate){\n  var timeout, args, context, timestamp, result;\n  if (null == wait) wait = 100;\n\n  function later() {\n    var last = Date.now() - timestamp;\n\n    if (last < wait && last >= 0) {\n      timeout = setTimeout(later, wait - last);\n    } else {\n      timeout = null;\n      if (!immediate) {\n        result = func.apply(context, args);\n        context = args = null;\n      }\n    }\n  };\n\n  var debounced = function(){\n    context = this;\n    args = arguments;\n    timestamp = Date.now();\n    var callNow = immediate && !timeout;\n    if (!timeout) timeout = setTimeout(later, wait);\n    if (callNow) {\n      result = func.apply(context, args);\n      context = args = null;\n    }\n\n    return result;\n  };\n\n  debounced.clear = function() {\n    if (timeout) {\n      clearTimeout(timeout);\n      timeout = null;\n    }\n  };\n  \n  debounced.flush = function() {\n    if (timeout) {\n      result = func.apply(context, args);\n      context = args = null;\n      \n      clearTimeout(timeout);\n      timeout = null;\n    }\n  };\n\n  return debounced;\n};\n\n// Adds compatibility for ES modules\ndebounce.debounce = debounce;\n\nmodule.exports = debounce;\n\n\n//# sourceURL=webpack:///./node_modules/debounce/index.js?");

/***/ }),

/***/ "./src/images/clear.svg":
/*!******************************!*\
  !*** ./src/images/clear.svg ***!
  \******************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony default export */ __webpack_exports__[\"default\"] = (__webpack_require__.p + \"images/clear.svg\");\n\n//# sourceURL=webpack:///./src/images/clear.svg?");

/***/ }),

/***/ "./src/images/loading-dark.svg":
/*!*************************************!*\
  !*** ./src/images/loading-dark.svg ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony default export */ __webpack_exports__[\"default\"] = (__webpack_require__.p + \"images/loading-dark.svg\");\n\n//# sourceURL=webpack:///./src/images/loading-dark.svg?");

/***/ }),

/***/ "./src/images/loading.svg":
/*!********************************!*\
  !*** ./src/images/loading.svg ***!
  \********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony default export */ __webpack_exports__[\"default\"] = (__webpack_require__.p + \"images/loading.svg\");\n\n//# sourceURL=webpack:///./src/images/loading.svg?");

/***/ }),

/***/ "./src/images/woocommerce-placeholder.png":
/*!************************************************!*\
  !*** ./src/images/woocommerce-placeholder.png ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony default export */ __webpack_exports__[\"default\"] = (__webpack_require__.p + \"images/woocommerce-placeholder.png\");\n\n//# sourceURL=webpack:///./src/images/woocommerce-placeholder.png?");

/***/ }),

/***/ "./src/js/product-categories.js":
/*!**************************************!*\
  !*** ./src/js/product-categories.js ***!
  \**************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var debounce__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! debounce */ \"./node_modules/debounce/index.js\");\n/* harmony import */ var debounce__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(debounce__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _images_woocommerce_placeholder_png__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../images/woocommerce-placeholder.png */ \"./src/images/woocommerce-placeholder.png\");\n/* harmony import */ var _images_clear_svg__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../images/clear.svg */ \"./src/images/clear.svg\");\n/* harmony import */ var _images_loading_svg__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../images/loading.svg */ \"./src/images/loading.svg\");\n/* harmony import */ var _images_loading_dark_svg__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../images/loading-dark.svg */ \"./src/images/loading-dark.svg\");\n\n\n\n\n\n\n( function( $ ) {\n\tlet currentPageProducts = 1;\n\tlet currentPageCategories = 1;\n\tlet searchText = '';\n\tlet ajaxInProgress = false;\n\tlet maxPostsProducts = 0;\n\tlet maxPostsCategories = 0;\n\tconst searchField = $( '#mlwoo__search-input' );\n\tconst clearBtn = $( '.mlwoo__clear-btn' );\n\tconst searchResults = $( '#mlwoo__search-results' );\n\tconst productGrid = $( '.mlwoo__search-results .mlwoo__grid' );\n\tconst categoryGrid = $( '.mlwoo__grid--category' );\n\tconst loadMoreSpinnerProducts = $( '.mlwoo__load-more-spinner--products' );\n\tconst body = $( 'body' );\n\tconst debouncedSearchProduct = debounce__WEBPACK_IMPORTED_MODULE_0___default()( searchProduct, 300 );\n\n\tsearchField.on( 'input', function() {\n\t\tsearchText = $( this ).val();\n\n\t\tif ( searchText.length > 0 ) {\n\t\t\tclearBtn.show();\n\t\t} else {\n\t\t\tcurrentPageProducts = 1;\n\t\t\tmaxPostsProducts = 0;\n\t\t\tclearBtn.hide();\n\t\t\tbody.css( 'overflow', 'scroll' );\n\t\t\tsearchResults.removeClass( 'mlwoo__search-results--slide-in' );\n\t\t\tsetTimeout( () => {\n\t\t\t\tproductGrid.html( '' );\n\t\t\t}, 300 );\n\t\t}\n\t} );\n\n\tsearchField.on( 'input', function() {\n\t\tdebouncedSearchProduct( false );\n\t} );\n\n\tclearBtn.on( 'click', function() {\n\t\tsearchField.val( '' );\n\t\tcurrentPageProducts = 1;\n\t\tmaxPostsProducts = 0;\n\t\tsearchText = '';\n\t\t$( this ).hide();\n\t\tbody.css( 'overflow', 'scroll' );\n\t\tsearchResults.removeClass( 'mlwoo__search-results--slide-in' );\n\t\tsetTimeout( () => {\n\t\t\tproductGrid.html( '' );\n\t\t}, 300 );\n\t} );\n\n\t$( '#mlwoo__search-results' ).scroll( function() {\n\t\tif ( ajaxInProgress ) {\n\t\t\treturn;\n\t\t}\n\n\t\tif ( maxPostsProducts > 0 && currentPageProducts * 10 >= maxPostsProducts ) {\n\t\t\treturn;\n\t\t}\n\t\tif ( $( '#mlwoo__search-results' ).scrollTop() + $( '#mlwoo__search-results' ).height() > $( '#mlwoo__search-results .mlwoo__grid--products' ).height() - 88 ) {\n\t\t\t++currentPageProducts;\n\t\t\tsearchProduct( true );\n\t\t}\n\t} );\n\n\tfunction searchProduct( append = false ) {\n\t\tif ( searchText.length <= 3 ) {\n\t\t\treturn;\n\t\t}\n\n\t\t$.ajax( {\n\t\t\turl: mlwoo.ajaxUrl,\n\t\t\ttype: 'POST',\n\t\t\tdata: {\n\t\t\t\taction: 'mlwoo_get_products',\n\t\t\t\tsearch: searchText,\n\t\t\t\tpage: currentPageProducts,\n\t\t\t},\n\t\t\tbeforeSend: function() {\n\t\t\t\tajaxInProgress = true;\n\n\t\t\t\tif ( ! append ) {\n\t\t\t\t\tmaxPostsProducts = 0;\n\t\t\t\t\tproductGrid.html( '' );\n\t\t\t\t}\n\n\t\t\t\tloadMoreSpinnerProducts.addClass( 'mlwoo__load-more-spinner--show' );\n\t\t\t}\n\t\t} ).done( function( response ) {\n\t\t\tif ( ! response.success ) {\n\t\t\t\treturn;\n\t\t\t}\n\n\t\t\tajaxInProgress = false;\n\t\t\tmaxPostsProducts = response.data.maxPosts;\n\n\t\t\tproductGrid.append( response.data.htmlString );\n\t\t\tsearchResults.addClass( 'mlwoo__search-results--slide-in' );\n\t\t\tbody.css( 'overflow', 'hidden' );\n\t\t\tloadMoreSpinnerProducts.removeClass( 'mlwoo__load-more-spinner--show' );\n\t\t} );\n\t}\n\n\tfunction searchCategory() {\n\t\t$.ajax( {\n\t\t\turl: mlwoo.ajaxUrl,\n\t\t\ttype: 'POST',\n\t\t\tdata: {\n\t\t\t\taction: 'mlwoo_get_categories',\n\t\t\t\tpage: currentPageCategories,\n\t\t\t},\n\t\t\tbeforeSend: function() {\n\t\t\t\tajaxInProgress = true;\n\t\t\t\tloadMoreSpinnerProducts.addClass( 'mlwoo__load-more-spinner--show' );\n\t\t\t}\n\t\t} ).done( function( response) {\n\t\t\tif ( ! response.success ) {\n\t\t\t\treturn;\n\t\t\t}\n\n\t\t\tmaxPostsCategories = response.data.maxPosts;\n\n\t\t\tcategoryGrid.append( response.data.htmlString );\n\t\t\tloadMoreSpinnerProducts.removeClass( 'mlwoo__load-more-spinner--show' );\n\t\t} );\n\t}\n} )( jQuery )\n\n\n//# sourceURL=webpack:///./src/js/product-categories.js?");

/***/ }),

/***/ "./src/scss/product-categories.scss":
/*!******************************************!*\
  !*** ./src/scss/product-categories.scss ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// extracted by mini-css-extract-plugin\n\n//# sourceURL=webpack:///./src/scss/product-categories.scss?");

/***/ }),

/***/ 10:
/*!*******************************************************************************!*\
  !*** multi ./src/js/product-categories.js ./src/scss/product-categories.scss ***!
  \*******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("__webpack_require__(/*! ./src/js/product-categories.js */\"./src/js/product-categories.js\");\nmodule.exports = __webpack_require__(/*! ./src/scss/product-categories.scss */\"./src/scss/product-categories.scss\");\n\n\n//# sourceURL=webpack:///multi_./src/js/product-categories.js_./src/scss/product-categories.scss?");

/***/ })

/******/ });