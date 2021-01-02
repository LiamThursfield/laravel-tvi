(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_pages_auth_Login_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/InputGroup.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/InputGroup.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************************************************/
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
  name: "InputGroup",
  model: {
    prop: 'input_value'
  },
  props: {
    allow_parent_updates: {
      "default": true,
      type: Boolean
    },
    error_class: {
      "default": 'mt-1 text-red-500 text-sm',
      type: String
    },
    error_hide_on_input: {
      "default": true,
      type: Boolean
    },
    error_message: {
      "default": '',
      type: false | String
    },
    input_autocomplete: {
      "default": '',
      type: String
    },
    input_autofocus: {
      "default": false,
      type: Boolean
    },
    input_class: {
      "default": 'border border-theme-base-subtle font-medium px-3 py-2 rounded w-full focus:border-theme-primary focus:outline-none focus:ring-0',
      type: String
    },
    input_disabled: {
      "default": false,
      type: Boolean
    },
    input_id: {
      required: true,
      type: String
    },
    input_max: {
      "default": '',
      type: String | Number
    },
    input_maxlength: {
      "default": '',
      type: String | Number
    },
    input_min: {
      "default": '',
      type: String | Number
    },
    input_minlength: {
      "default": '',
      type: String | Number
    },
    input_name: {
      required: true,
      type: String
    },
    input_placeholder: {
      "default": '',
      type: String
    },
    input_required: {
      "default": false,
      type: Boolean
    },
    input_type: {
      "default": 'text',
      type: String
    },
    input_value: {
      "default": '',
      type: String | Number
    },
    label_class: {
      "default": 'font-medium mb-2 text-theme-base-contrast text-sm tracking-wider',
      type: String
    },
    label_hidden: {
      "default": false,
      type: Boolean
    },
    label_text: {
      required: true,
      type: String
    }
  },
  data: function data() {
    return {
      hide_error: false
    };
  },
  computed: {
    formatted_input_class: function formatted_input_class() {
      if (this.is_error) {
        return this.input_class + ' error';
      }

      return this.input_class;
    },
    formatted_label_class: function formatted_label_class() {
      var label_class = this.label_class;

      if (this.label_hidden) {
        label_class += ' hidden';
      }

      return label_class;
    },
    is_error: function is_error() {
      return !this.hide_error && this.error_message && this.error_message !== '';
    }
  },
  mounted: function mounted() {
    this.autofocus();
  },
  methods: {
    autofocus: function autofocus() {
      var _this = this;

      if (this.input_autofocus && this.$refs[this.input_id]) {
        this.$nextTick(function () {
          _this.$refs[_this.input_id].focus();
        });
      }
    },
    blurInput: function blurInput() {
      var _this2 = this;

      if (this.$refs[this.input_id]) {
        this.$nextTick(function () {
          _this2.$refs[_this2.input_id].blur();
        });
      }
    },
    onErrorMessageChange: function onErrorMessageChange() {
      this.hide_error = false;
    },
    onInputBlur: function onInputBlur() {
      this.$emit('blur');
    },
    onInputKeyPress: function onInputKeyPress() {
      this.$emit('input', this.$refs[this.input_id].value);

      if (this.error_hide_on_input) {
        this.hide_error = true;
      }
    }
  },
  watch: {
    error_message: {
      handler: "onErrorMessageChange"
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/auth/Login.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/auth/Login.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _components_core_forms_InputGroup__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/core/forms/InputGroup */ "./resources/js/components/core/forms/InputGroup.vue");
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

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "AuthLogin",
  components: {
    InputGroup: _components_core_forms_InputGroup__WEBPACK_IMPORTED_MODULE_0__.default
  },
  layout: 'auth-layout',
  data: function data() {
    return {
      form: {
        email: 'admin@example.com',
        // TODO: Remove on final release
        password: 'AdminPassword',
        // TODO: Remove on final release
        remember: null
      }
    };
  },
  methods: {
    submit: function submit() {
      this.$inertia.post(this.$route('login'), this.form);
    }
  }
});

/***/ }),

/***/ "./resources/js/components/core/forms/InputGroup.vue":
/*!***********************************************************!*\
  !*** ./resources/js/components/core/forms/InputGroup.vue ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _InputGroup_vue_vue_type_template_id_4090938a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./InputGroup.vue?vue&type=template&id=4090938a& */ "./resources/js/components/core/forms/InputGroup.vue?vue&type=template&id=4090938a&");
/* harmony import */ var _InputGroup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./InputGroup.vue?vue&type=script&lang=js& */ "./resources/js/components/core/forms/InputGroup.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _InputGroup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _InputGroup_vue_vue_type_template_id_4090938a___WEBPACK_IMPORTED_MODULE_0__.render,
  _InputGroup_vue_vue_type_template_id_4090938a___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/core/forms/InputGroup.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/pages/auth/Login.vue":
/*!*******************************************!*\
  !*** ./resources/js/pages/auth/Login.vue ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _Login_vue_vue_type_template_id_42c42d6a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Login.vue?vue&type=template&id=42c42d6a& */ "./resources/js/pages/auth/Login.vue?vue&type=template&id=42c42d6a&");
/* harmony import */ var _Login_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Login.vue?vue&type=script&lang=js& */ "./resources/js/pages/auth/Login.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _Login_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _Login_vue_vue_type_template_id_42c42d6a___WEBPACK_IMPORTED_MODULE_0__.render,
  _Login_vue_vue_type_template_id_42c42d6a___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/auth/Login.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/core/forms/InputGroup.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/core/forms/InputGroup.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_InputGroup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./InputGroup.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/InputGroup.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_InputGroup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/pages/auth/Login.vue?vue&type=script&lang=js&":
/*!********************************************************************!*\
  !*** ./resources/js/pages/auth/Login.vue?vue&type=script&lang=js& ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Login_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Login.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/auth/Login.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Login_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/components/core/forms/InputGroup.vue?vue&type=template&id=4090938a&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/core/forms/InputGroup.vue?vue&type=template&id=4090938a& ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_InputGroup_vue_vue_type_template_id_4090938a___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_InputGroup_vue_vue_type_template_id_4090938a___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_InputGroup_vue_vue_type_template_id_4090938a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./InputGroup.vue?vue&type=template&id=4090938a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/InputGroup.vue?vue&type=template&id=4090938a&");


/***/ }),

/***/ "./resources/js/pages/auth/Login.vue?vue&type=template&id=42c42d6a&":
/*!**************************************************************************!*\
  !*** ./resources/js/pages/auth/Login.vue?vue&type=template&id=42c42d6a& ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Login_vue_vue_type_template_id_42c42d6a___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Login_vue_vue_type_template_id_42c42d6a___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Login_vue_vue_type_template_id_42c42d6a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Login.vue?vue&type=template&id=42c42d6a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/auth/Login.vue?vue&type=template&id=42c42d6a&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/InputGroup.vue?vue&type=template&id=4090938a&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/InputGroup.vue?vue&type=template&id=4090938a& ***!
  \*********************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "flex flex-col" }, [
    _c(
      "label",
      { class: _vm.formatted_label_class, attrs: { for: _vm.input_id } },
      [
        _vm._t("default", [
          _c("span", { staticClass: "flex flex-row items-baseline" }, [
            _c("span", [_vm._v(_vm._s(_vm.label_text))]),
            _vm._v(" "),
            _vm.input_required
              ? _c("sup", { staticClass: "text-theme-danger-contrast" }, [
                  _vm._v("\n                    *\n                ")
                ])
              : _vm._e()
          ])
        ])
      ],
      2
    ),
    _vm._v(" "),
    _c("input", {
      ref: _vm.input_id,
      class: _vm.formatted_input_class,
      attrs: {
        id: _vm.input_id,
        autocomplete: _vm.input_autocomplete,
        disabled: _vm.input_disabled,
        max: _vm.input_max,
        maxlength: _vm.input_maxlength,
        min: _vm.input_min,
        minlength: _vm.input_minlength,
        name: _vm.input_name,
        placeholder: _vm.input_placeholder,
        required: _vm.input_required,
        type: _vm.input_type
      },
      domProps: { value: _vm.input_value },
      on: {
        blur: _vm.onInputBlur,
        input: _vm.onInputKeyPress,
        keyup: function($event) {
          if (
            !$event.type.indexOf("key") &&
            _vm._k($event.keyCode, "esc", 27, $event.key, ["Esc", "Escape"])
          ) {
            return null
          }
          return _vm.blurInput($event)
        }
      }
    }),
    _vm._v(" "),
    _c(
      "div",
      [
        _c("transition", { attrs: { name: "slide-down-fade" } }, [
          _vm.is_error
            ? _c("p", { class: _vm.error_class }, [
                _vm._v(
                  "\n                " +
                    _vm._s(_vm.error_message) +
                    "\n            "
                )
              ])
            : _vm._e()
        ])
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/auth/Login.vue?vue&type=template&id=42c42d6a&":
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/auth/Login.vue?vue&type=template&id=42c42d6a& ***!
  \*****************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "auth-card-container" }, [
    _c("div", { staticClass: "auth-card" }, [
      _c("h1", { staticClass: "auth-header" }, [
        _vm._v("\n            Welcome back\n        ")
      ]),
      _vm._v(" "),
      _c(
        "form",
        {
          staticClass: "px-6",
          on: {
            submit: function($event) {
              $event.preventDefault()
              return _vm.submit($event)
            }
          }
        },
        [
          _c("input-group", {
            staticClass: "mt-4",
            attrs: {
              error_message: _vm.getPageErrorMessage("email"),
              input_autocomplete: "email",
              input_autofocus: true,
              input_class: "auth-input",
              input_id: "email",
              input_name: "email",
              input_required: true,
              input_type: "email",
              label_text: "Email"
            },
            model: {
              value: _vm.form.email,
              callback: function($$v) {
                _vm.$set(_vm.form, "email", $$v)
              },
              expression: "form.email"
            }
          }),
          _vm._v(" "),
          _c("input-group", {
            staticClass: "mt-4",
            attrs: {
              error_message: _vm.getPageErrorMessage("password"),
              input_autocomplete: "current-password",
              input_class: "auth-input",
              input_id: "password",
              input_name: "password",
              input_required: true,
              input_type: "password",
              label_text: "Password"
            },
            model: {
              value: _vm.form.password,
              callback: function($$v) {
                _vm.$set(_vm.form, "password", $$v)
              },
              expression: "form.password"
            }
          }),
          _vm._v(" "),
          _c("div", { staticClass: "mt-6" }, [
            _c(
              "label",
              {
                staticClass:
                  "cursor-pointer flex font-medium inline-block items-center text-theme-base-contrast"
              },
              [
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.form.remember,
                      expression: "form.remember"
                    }
                  ],
                  staticClass:
                    "\n                            leading-tight mr-2 rounded\n                            focus:outline-none focus:ring focus:ring-primary\n                        ",
                  attrs: { id: "remember", name: "remember", type: "checkbox" },
                  domProps: {
                    checked: Array.isArray(_vm.form.remember)
                      ? _vm._i(_vm.form.remember, null) > -1
                      : _vm.form.remember
                  },
                  on: {
                    change: function($event) {
                      var $$a = _vm.form.remember,
                        $$el = $event.target,
                        $$c = $$el.checked ? true : false
                      if (Array.isArray($$a)) {
                        var $$v = null,
                          $$i = _vm._i($$a, $$v)
                        if ($$el.checked) {
                          $$i < 0 &&
                            _vm.$set(_vm.form, "remember", $$a.concat([$$v]))
                        } else {
                          $$i > -1 &&
                            _vm.$set(
                              _vm.form,
                              "remember",
                              $$a.slice(0, $$i).concat($$a.slice($$i + 1))
                            )
                        }
                      } else {
                        _vm.$set(_vm.form, "remember", $$c)
                      }
                    }
                  }
                }),
                _vm._v(" "),
                _c("span", { staticClass: "select-none text-sm" }, [
                  _vm._v(
                    "\n                        Remember Me\n                      "
                  )
                ])
              ]
            )
          ]),
          _vm._v(" "),
          _c(
            "div",
            {
              staticClass:
                "flex flex-row items-center justify-between mt-4 py-6"
            },
            [
              _c(
                "button",
                {
                  staticClass:
                    "\n                        bg-theme-primary px-4 py-2 rounded shadow text-theme-primary-contrast\n                        focus:outline-none focus:ring focus:ring-primary\n                        hover:bg-theme-primary-hover hover:shadow-lg\n                        transition-all ease-in-out duration-300\n                    ",
                  attrs: { type: "submit" }
                },
                [_vm._v("\n                    Sign In\n                ")]
              ),
              _vm._v(" "),
              _c(
                "inertia-link",
                {
                  staticClass:
                    "\n                        text-gray-900\n                        hover:text-theme-primary\n                        transition-all ease-in-out duration-300\n                    ",
                  attrs: { href: _vm.$route("password.request") }
                },
                [
                  _vm._v(
                    "\n                    Forgot Password?\n                "
                  )
                ]
              )
            ],
            1
          )
        ],
        1
      )
    ]),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "flex justify-end mt-4" },
      [
        _c(
          "inertia-link",
          {
            staticClass:
              "\n                text-gray-300 text-sm tracking-wide\n                hover:text-theme-base-subtle-contrast\n            ",
            attrs: { href: _vm.$route("register") }
          },
          [_vm._v("\n            Create a new account\n        ")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);