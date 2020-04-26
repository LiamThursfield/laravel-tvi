(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/app/home/Index.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/app/home/Index.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Index",
  layout: 'app-layout'
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/app/home/Index.vue?vue&type=template&id=10b635d9&":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/app/home/Index.vue?vue&type=template&id=10b635d9& ***!
  \************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "bg-gray-200 flex flex-col min-h-screen min-w-screen" },
    [
      _c("nav", { staticClass: "flex flex-row justify-end px-6 py-4" }, [
        _c(
          "ul",
          { staticClass: "flex flex-row space-x-4 text-gray-600" },
          [
            _vm.$page.auth.user
              ? [
                  _c("li", [
                    _c(
                      "a",
                      {
                        staticClass: "hover:text-blue-700",
                        attrs: { href: _vm.$route("admin.index") }
                      },
                      [
                        _vm._v(
                          "\n                        Admin\n                    "
                        )
                      ]
                    )
                  ])
                ]
              : [
                  _c("li", [
                    _c(
                      "a",
                      {
                        staticClass: "hover:text-blue-700",
                        attrs: { href: _vm.$route("login") }
                      },
                      [
                        _vm._v(
                          "\n                        Login\n                    "
                        )
                      ]
                    )
                  ]),
                  _vm._v(" "),
                  _c("li", [
                    _c(
                      "a",
                      {
                        staticClass: "hover:text-blue-700",
                        attrs: { href: _vm.$route("register") }
                      },
                      [
                        _vm._v(
                          "\n                        Register\n                    "
                        )
                      ]
                    )
                  ])
                ]
          ],
          2
        )
      ]),
      _vm._v(" "),
      _c(
        "section",
        { staticClass: "flex flex-1 flex-col items-center justify-center" },
        [
          _c("h1", { staticClass: "font-black text-6xl" }, [
            _vm._v(
              "\n            " +
                _vm._s(_vm.$page.app.name || "Laravel TVI") +
                "\n        "
            )
          ]),
          _vm._v(" "),
          _vm._m(0)
        ]
      )
    ]
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "ul",
      {
        staticClass:
          "border-gray-400 border-t flex flex-row pt-4 space-x-6 text-gray-600 text-lg"
      },
      [
        _c("li", [
          _c(
            "a",
            {
              staticClass: "hover:text-blue-700",
              attrs: {
                href: "https://laravel.com/docs/",
                rel: "noopener noreferrer",
                target: "_blank"
              }
            },
            [_vm._v("\n                    Laravel\n                ")]
          )
        ]),
        _vm._v(" "),
        _c("li", [
          _c(
            "a",
            {
              staticClass: "hover:text-blue-700",
              attrs: {
                href: "https://tailwindcss.com/docs/",
                rel: "noopener noreferrer",
                target: "_blank"
              }
            },
            [_vm._v("\n                    Tailwind\n                ")]
          )
        ]),
        _vm._v(" "),
        _c("li", [
          _c(
            "a",
            {
              staticClass: "hover:text-blue-700",
              attrs: {
                href: "https://vuejs.org/v2/guide/",
                rel: "noopener noreferrer",
                target: "_blank"
              }
            },
            [_vm._v("\n                    Vue.js\n                ")]
          )
        ]),
        _vm._v(" "),
        _c("li", [
          _c(
            "a",
            {
              staticClass: "hover:text-blue-700",
              attrs: {
                href: "https://inertiajs.com/",
                rel: "noopener noreferrer",
                target: "_blank"
              }
            },
            [_vm._v("\n                    Inertia.js\n                ")]
          )
        ])
      ]
    )
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/pages/app/home/Index.vue":
/*!***********************************************!*\
  !*** ./resources/js/pages/app/home/Index.vue ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Index_vue_vue_type_template_id_10b635d9___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=10b635d9& */ "./resources/js/pages/app/home/Index.vue?vue&type=template&id=10b635d9&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./resources/js/pages/app/home/Index.vue?vue&type=script&lang=js&");
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[key]; }) }(__WEBPACK_IMPORT_KEY__));
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_10b635d9___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Index_vue_vue_type_template_id_10b635d9___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/app/home/Index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/app/home/Index.vue?vue&type=script&lang=js&":
/*!************************************************************************!*\
  !*** ./resources/js/pages/app/home/Index.vue?vue&type=script&lang=js& ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/app/home/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/app/home/Index.vue?vue&type=template&id=10b635d9&":
/*!******************************************************************************!*\
  !*** ./resources/js/pages/app/home/Index.vue?vue&type=template&id=10b635d9& ***!
  \******************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_10b635d9___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=template&id=10b635d9& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/app/home/Index.vue?vue&type=template&id=10b635d9&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_10b635d9___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_10b635d9___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);