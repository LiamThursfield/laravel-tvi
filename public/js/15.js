(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[15],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/website/home/Index.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/website/home/Index.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************/
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
  layout: 'website-layout'
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/website/home/Index.vue?vue&type=style&index=0&id=986248c2&scoped=true&lang=css&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/website/home/Index.vue?vue&type=style&index=0&id=986248c2&scoped=true&lang=css& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.skewed-logo-bg[data-v-986248c2] {\n    --transform-rotate: -18deg;\n    --transform-skew-y: 12deg\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/website/home/Index.vue?vue&type=style&index=0&id=986248c2&scoped=true&lang=css&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/website/home/Index.vue?vue&type=style&index=0&id=986248c2&scoped=true&lang=css& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader??ref--6-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--6-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=style&index=0&id=986248c2&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/website/home/Index.vue?vue&type=style&index=0&id=986248c2&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/website/home/Index.vue?vue&type=template&id=986248c2&scoped=true&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/website/home/Index.vue?vue&type=template&id=986248c2&scoped=true& ***!
  \****************************************************************************************************************************************************************************************************************************/
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
    { staticClass: "bg-gray-100 flex flex-col min-h-screen min-w-screen" },
    [
      _c("nav", { staticClass: "flex flex-row justify-end px-6 py-4" }, [
        _c(
          "ul",
          {
            staticClass:
              "flex flex-row font-medium space-x-4 text-theme-base-contrast"
          },
          [
            _vm.$page.props.auth.user
              ? [
                  _c("li", [
                    _c(
                      "a",
                      {
                        staticClass: "hover:text-theme-primary",
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
                  _vm.$routeCheck("login")
                    ? _c(
                        "li",
                        [
                          _c(
                            "inertia-link",
                            {
                              staticClass: "hover:text-theme-primary",
                              attrs: { href: _vm.$route("login") }
                            },
                            [
                              _vm._v(
                                "\n                        Login\n                    "
                              )
                            ]
                          )
                        ],
                        1
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.$routeCheck("register")
                    ? _c(
                        "li",
                        [
                          _c(
                            "inertia-link",
                            {
                              staticClass: "hover:text-theme-primary",
                              attrs: { href: _vm.$route("register") }
                            },
                            [
                              _vm._v(
                                "\n                        Register\n                    "
                              )
                            ]
                          )
                        ],
                        1
                      )
                    : _vm._e()
                ]
          ],
          2
        )
      ]),
      _vm._v(" "),
      _c(
        "section",
        { staticClass: "flex flex-1 flex-col items-center justify-center p-8" },
        [
          _c("div", { staticClass: "relative" }, [
            _c("div", {
              staticClass:
                "\n                    skewed-logo-bg\n                    absolute bg-gradient-to-r from-blue-700 inset-0 to-blue-600 rounded-lg shadow-lg transform\n                "
            }),
            _vm._v(" "),
            _c(
              "h1",
              {
                staticClass:
                  "\n                    bg-theme-base-contrast flex flex-row font-semibold items-center px-8 py-4 relative rounded-lg text-center text-3xl tracking-wide\n                    sm:text-6xl\n                "
              },
              [
                _c("icon-logo-dark", { staticClass: "w-9 sm:w-16" }),
                _vm._v(" "),
                _c(
                  "span",
                  {
                    staticClass:
                      "\n                        ml-3 text-white\n                        sm:ml-6\n                    "
                  },
                  [
                    _vm._v(
                      "\n                    Laravel TVI\n                "
                    )
                  ]
                )
              ],
              1
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
          "flex flex-row flex-wrap font-medium justify-center mt-8 pt-4 px-4 space-x-6 text-theme-base-contrast md:text-lg"
      },
      [
        _c("li", [
          _c(
            "a",
            {
              staticClass: "hover:text-theme-primary",
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
              staticClass: "hover:text-theme-primary",
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
              staticClass: "hover:text-theme-primary",
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
              staticClass: "hover:text-theme-primary",
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

/***/ "./resources/js/pages/website/home/Index.vue":
/*!***************************************************!*\
  !*** ./resources/js/pages/website/home/Index.vue ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Index_vue_vue_type_template_id_986248c2_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=986248c2&scoped=true& */ "./resources/js/pages/website/home/Index.vue?vue&type=template&id=986248c2&scoped=true&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./resources/js/pages/website/home/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Index_vue_vue_type_style_index_0_id_986248c2_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Index.vue?vue&type=style&index=0&id=986248c2&scoped=true&lang=css& */ "./resources/js/pages/website/home/Index.vue?vue&type=style&index=0&id=986248c2&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_986248c2_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Index_vue_vue_type_template_id_986248c2_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "986248c2",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/website/home/Index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/website/home/Index.vue?vue&type=script&lang=js&":
/*!****************************************************************************!*\
  !*** ./resources/js/pages/website/home/Index.vue?vue&type=script&lang=js& ***!
  \****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/website/home/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/website/home/Index.vue?vue&type=style&index=0&id=986248c2&scoped=true&lang=css&":
/*!************************************************************************************************************!*\
  !*** ./resources/js/pages/website/home/Index.vue?vue&type=style&index=0&id=986248c2&scoped=true&lang=css& ***!
  \************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_id_986248c2_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader??ref--6-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--6-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=style&index=0&id=986248c2&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/website/home/Index.vue?vue&type=style&index=0&id=986248c2&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_id_986248c2_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_id_986248c2_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_id_986248c2_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_style_index_0_id_986248c2_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/pages/website/home/Index.vue?vue&type=template&id=986248c2&scoped=true&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/pages/website/home/Index.vue?vue&type=template&id=986248c2&scoped=true& ***!
  \**********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_986248c2_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=template&id=986248c2&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/website/home/Index.vue?vue&type=template&id=986248c2&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_986248c2_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_986248c2_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);