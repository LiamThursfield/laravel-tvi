(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_pages_website_error_Error_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/website/error/Error.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/website/error/Error.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "WebsiteError",
  layout: 'website-layout',
  props: {
    status: {
      required: true,
      type: Number
    }
  },
  computed: {
    error_button_class: function error_button_class() {
      if (!this.is_allowed_error) {
        return 'bg-theme-danger text-theme-danger-contrast hover:bg-theme-danger-contrast hover:text-theme-danger';
      }

      return {
        403: 'bg-theme-warning text-theme-warning-contrast hover:bg-theme-warning-contrast hover:text-theme-warning',
        404: 'bg-theme-info text-theme-info-contrast hover:bg-theme-info-contrast hover:text-theme-info',
        500: 'bg-theme-danger text-theme-danger-contrast hover:bg-theme-danger-contrast hover:text-theme-danger'
      }[this.status];
    },
    error_description: function error_description() {
      if (!this.is_allowed_error) {
        return 'Whoops, something went wrong on our servers. We are looking into it.';
      }

      return {
        403: 'Sorry, you are forbidden from accessing this page.',
        404: 'Sorry, the page you are looking for could not be found.',
        500: 'Whoops, something went wrong on our servers. We are looking into it.',
        503: 'Sorry, we are doing some maintenance. Please check back soon.'
      }[this.status];
    },
    error_title_class: function error_title_class() {
      if (!this.is_allowed_error) {
        return 'text-theme-danger-contrast';
      }

      return {
        403: 'text-theme-warning-contrast',
        404: 'text-theme-info-contrast',
        500: 'text-theme-danger-contrast',
        503: 'text-theme-primary'
      }[this.status];
    },
    is_allowed_error: function is_allowed_error() {
      var allowed_errors = [403, 404, 500, 503];
      return allowed_errors.indexOf(this.status) >= 0;
    }
  }
});

/***/ }),

/***/ "./resources/js/pages/website/error/Error.vue":
/*!****************************************************!*\
  !*** ./resources/js/pages/website/error/Error.vue ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _Error_vue_vue_type_template_id_0f463354___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Error.vue?vue&type=template&id=0f463354& */ "./resources/js/pages/website/error/Error.vue?vue&type=template&id=0f463354&");
/* harmony import */ var _Error_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Error.vue?vue&type=script&lang=js& */ "./resources/js/pages/website/error/Error.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _Error_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _Error_vue_vue_type_template_id_0f463354___WEBPACK_IMPORTED_MODULE_0__.render,
  _Error_vue_vue_type_template_id_0f463354___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/website/error/Error.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/pages/website/error/Error.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/pages/website/error/Error.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Error_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Error.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/website/error/Error.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Error_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/pages/website/error/Error.vue?vue&type=template&id=0f463354&":
/*!***********************************************************************************!*\
  !*** ./resources/js/pages/website/error/Error.vue?vue&type=template&id=0f463354& ***!
  \***********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Error_vue_vue_type_template_id_0f463354___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Error_vue_vue_type_template_id_0f463354___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Error_vue_vue_type_template_id_0f463354___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Error.vue?vue&type=template&id=0f463354& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/website/error/Error.vue?vue&type=template&id=0f463354&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/website/error/Error.vue?vue&type=template&id=0f463354&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/website/error/Error.vue?vue&type=template&id=0f463354& ***!
  \**************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* binding */ render,
/* harmony export */   "staticRenderFns": () => /* binding */ staticRenderFns
/* harmony export */ });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "section",
    {
      staticClass:
        "flex flex-col items-center justify-center h-full min-h-screen p-6"
    },
    [
      _c(
        "div",
        { staticClass: "text-center" },
        [
          _c(
            "h1",
            {
              staticClass: "font-black text-7xl text-center",
              class: _vm.error_title_class
            },
            [
              _vm._v(
                "\n            " +
                  _vm._s(_vm.is_allowed_error ? _vm.status : "Error") +
                  "\n        "
              )
            ]
          ),
          _vm._v(" "),
          _c(
            "p",
            {
              staticClass:
                "font-semibold mt-4 max-w-full text-center text-theme-base-subtle-contrast text-lg w-72"
            },
            [
              _vm._v(
                "\n            " + _vm._s(_vm.error_description) + "\n        "
              )
            ]
          ),
          _vm._v(" "),
          _vm.status !== 503
            ? _c(
                "inertia-link",
                {
                  staticClass:
                    "\n                button\n                font-semibold inline-block mt-8 mx-auto px-12 text-lg\n            ",
                  class: _vm.error_button_class,
                  attrs: { href: "/" }
                },
                [_vm._v("\n            Go Home\n        ")]
              )
            : _vm._e()
        ],
        1
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);