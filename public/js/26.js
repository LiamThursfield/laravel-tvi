(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[26],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/admin/cms/layout/Index.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/admin/cms/layout/Index.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _inertiajs_inertia__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @inertiajs/inertia */ "./node_modules/@inertiajs/inertia/dist/index.js");
/* harmony import */ var _inertiajs_inertia__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_inertiajs_inertia__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _components_core_modals_ConfirmationModal__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../components/core/modals/ConfirmationModal */ "./resources/js/components/core/modals/ConfirmationModal.vue");
/* harmony import */ var _components_core_forms_InputGroup__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../components/core/forms/InputGroup */ "./resources/js/components/core/forms/InputGroup.vue");
/* harmony import */ var _components_core_forms_SelectGroup__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../../components/core/forms/SelectGroup */ "./resources/js/components/core/forms/SelectGroup.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: "AdminCMSLayoutIndex",
  components: {
    ConfirmationModal: _components_core_modals_ConfirmationModal__WEBPACK_IMPORTED_MODULE_2__["default"],
    InputGroup: _components_core_forms_InputGroup__WEBPACK_IMPORTED_MODULE_3__["default"],
    SelectGroup: _components_core_forms_SelectGroup__WEBPACK_IMPORTED_MODULE_4__["default"]
  },
  layout: 'admin-layout',
  props: {
    layouts: Object,
    search_options: Object | Array,
    templates: Object
  },
  data: function data() {
    return {
      editable_search_options: {
        per_page: 15,
        layout_name: '',
        layout_slug: '',
        template_id: ''
      },
      is_initialised: false,
      is_loading_delete: false,
      show_delete_modal: false,
      layout_to_delete: null
    };
  },
  mounted: function mounted() {
    this.setSearchOptions(this.search_options);
  },
  computed: {
    delete_modal_text: function delete_modal_text() {
      try {
        return 'Do you really want to delete \'' + this.layout_to_delete.name + '\'?';
      } catch (e) {
        return 'Do you really want to delete this layouts?';
      }
    },
    show_pagination: function show_pagination() {
      try {
        return this.layouts.pagination.last_page > 1;
      } catch (e) {
        return false;
      }
    },
    show_layout_actions: function show_layout_actions() {
      return this.userCan('cms.edit') || this.userCan('cms.delete');
    },
    layouts_data: function layouts_data() {
      if (!this.layouts || !this.layouts.data || this.layouts.data.length < 1) {
        return false;
      }

      return this.layouts.data;
    }
  },
  methods: {
    cancelDelete: function cancelDelete() {
      if (!this.is_loading_delete) {
        this.show_delete_modal = false;
        this.layout_to_delete = null;
      }
    },
    checkDelete: function checkDelete(layout) {
      this.show_delete_modal = true;
      this.layout_to_delete = layout;
    },
    confirmDelete: function confirmDelete() {
      if (this.is_loading_delete) {
        return this.$errorToast('It\'s only possible to delete one layouts at a time.');
      }

      this.$inertia["delete"](this.$route('admin.cms.layouts.destroy', this.layout_to_delete.id), {
        only: ['flash', 'layouts']
      });
      this.layout_to_delete = null;
      this.show_delete_modal = false;
    },
    onSearchOptionsUpdate: lodash__WEBPACK_IMPORTED_MODULE_0___default.a.debounce(function () {
      if (!this.is_initialised) {
        this.is_initialised = true; // If there are already search results, don't attempt search

        if (this.layouts_data) {
          return;
        }
      }

      _inertiajs_inertia__WEBPACK_IMPORTED_MODULE_1__["Inertia"].get(this.$route('admin.cms.layouts.index'), this.editable_search_options, {
        only: ['layouts'],
        preserveState: true
      });
    }, 500),
    setSearchOptions: function setSearchOptions() {
      var new_options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      var options = {
        per_page: 15,
        layout_name: '',
        layout_slug: '',
        template_type: ''
      };

      try {
        // Overwrite the defaults with any new options
        lodash__WEBPACK_IMPORTED_MODULE_0___default.a.forEach(new_options, function (option, key) {
          options[key] = option;
        });
      } catch (e) {
        console.log(e);
      }

      this.editable_search_options = lodash__WEBPACK_IMPORTED_MODULE_0___default.a.cloneDeep(options);
    }
  },
  watch: {
    editable_search_options: {
      deep: true,
      handler: 'onSearchOptionsUpdate'
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/admin/cms/layout/Index.vue?vue&type=template&id=4ab57a7c&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/admin/cms/layout/Index.vue?vue&type=template&id=4ab57a7c& ***!
  \********************************************************************************************************************************************************************************************************************/
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
  return _c("section", [
    _c(
      "div",
      { staticClass: "flex flex-row items-center mb-6" },
      [
        _c("h1", { staticClass: "mr-auto text-lg" }, [
          _vm._v("\n             Layout\n        ")
        ]),
        _vm._v(" "),
        _vm.userCan("cms.create")
          ? _c(
              "inertia-link",
              {
                staticClass:
                  "\n                button button-default-responsive button-primary\n                flex flex-row items-center\n            ",
                attrs: { href: _vm.$route("admin.cms.layouts.create") }
              },
              [
                _c("icon-plus", { staticClass: "w-5 md:mr-2" }),
                _vm._v(" "),
                _c("span", { staticClass: "hidden md:inline" }, [
                  _vm._v("\n                Create Layout\n            ")
                ])
              ],
              1
            )
          : _vm._e()
      ],
      1
    ),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "bg-white py-6 shadow-subtle rounded-lg" },
      [
        _c("h1", { staticClass: "font-semibold px-6 text-gray-850" }, [
          _vm._v("\n            Search\n        ")
        ]),
        _vm._v(" "),
        _c(
          "div",
          {
            staticClass:
              "\n                flex flex-col items-center mt-4 px-6 space-y-4\n                md:flex-row md:space-y-0 md:space-x-8\n            "
          },
          [
            _c(
              "div",
              { staticClass: "w-full md:w-1/3" },
              [
                _c("input-group", {
                  attrs: {
                    input_autocomplete: "layout_name_search",
                    input_class: "form-control form-control-short",
                    input_id: "layout_name",
                    input_name: "layout_name",
                    input_placeholder: "Layout Name",
                    input_type: "text",
                    label_hidden: true,
                    label_text: "Layout Name"
                  },
                  model: {
                    value: _vm.editable_search_options.layout_name,
                    callback: function($$v) {
                      _vm.$set(_vm.editable_search_options, "layout_name", $$v)
                    },
                    expression: "editable_search_options.layout_name"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "w-full md:w-1/3" },
              [
                _c("input-group", {
                  attrs: {
                    input_autocomplete: "layout_slug_search",
                    input_class: "form-control form-control-short",
                    input_id: "layout_slug",
                    input_name: "layout_slug",
                    input_placeholder: "Layout Slug",
                    input_type: "text",
                    label_hidden: true,
                    label_text: "Layout Slug"
                  },
                  model: {
                    value: _vm.editable_search_options.layout_slug,
                    callback: function($$v) {
                      _vm.$set(_vm.editable_search_options, "layout_slug", $$v)
                    },
                    expression: "editable_search_options.layout_slug"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "w-full md:w-1/3" },
              [
                _c("select-group", {
                  attrs: {
                    label_hidden: true,
                    label_text: "Template",
                    select_any_enabled: true,
                    select_any_label: "Template",
                    select_class: "form-control form-control-short",
                    select_id: "template_id",
                    select_name: "template_id",
                    select_option_label_key: "name",
                    select_option_value_key: "id",
                    select_options: _vm.templates
                  },
                  model: {
                    value: _vm.editable_search_options.template_id,
                    callback: function($$v) {
                      _vm.$set(_vm.editable_search_options, "template_id", $$v)
                    },
                    expression: "editable_search_options.template_id"
                  }
                })
              ],
              1
            )
          ]
        ),
        _vm._v(" "),
        !_vm.layouts_data
          ? _c(
              "p",
              {
                staticClass:
                  "bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
              },
              [_vm._v("\n            No layouts\n        ")]
            )
          : [
              _c("div", { staticClass: "block mt-8 overflow-x-auto w-full" }, [
                _c(
                  "table",
                  { staticClass: "table table-hover table-striped w-full" },
                  [
                    _c("thead", [
                      _c("tr", [
                        _c("th", [_vm._v("Name")]),
                        _vm._v(" "),
                        _c("th", [_vm._v("Slug")]),
                        _vm._v(" "),
                        _c("th", [_vm._v("Template")]),
                        _vm._v(" "),
                        _vm.show_layout_actions ? _c("th") : _vm._e()
                      ])
                    ]),
                    _vm._v(" "),
                    _c(
                      "tbody",
                      _vm._l(_vm.layouts_data, function(layout, index) {
                        return _c("tr", { key: "layout-" + layout.id }, [
                          _c("td", [
                            _vm._v(
                              "\n                            " +
                                _vm._s(layout.name) +
                                "\n                        "
                            )
                          ]),
                          _vm._v(" "),
                          _c("td", [
                            _vm._v(
                              "\n                            " +
                                _vm._s(layout.slug) +
                                "\n                        "
                            )
                          ]),
                          _vm._v(" "),
                          _c("td", [
                            _vm._v(
                              "\n                            " +
                                _vm._s(layout.template.name) +
                                "\n                        "
                            )
                          ]),
                          _vm._v(" "),
                          _vm.show_layout_actions
                            ? _c("td", [
                                _c(
                                  "div",
                                  {
                                    staticClass:
                                      "flex flex-row items-center justify-end -mx-1"
                                  },
                                  [
                                    _vm.userCan("cms.edit")
                                      ? _c(
                                          "inertia-link",
                                          {
                                            staticClass:
                                              "\n                                        flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide\n                                        focus:outline-none focus:shadow-outline\n                                        hover:bg-theme-info hover:text-theme-info-contrast\n                                    ",
                                            attrs: {
                                              href: _vm.$route(
                                                "admin.cms.layouts.edit",
                                                layout.id
                                              ),
                                              title: "Edit Layout"
                                            }
                                          },
                                          [
                                            _c("icon-edit", {
                                              staticClass: "w-4"
                                            })
                                          ],
                                          1
                                        )
                                      : _vm._e(),
                                    _vm._v(" "),
                                    _vm.userCan("cms.delete")
                                      ? _c(
                                          "button",
                                          {
                                            staticClass:
                                              "\n                                        flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide\n                                        focus:outline-none focus:shadow-outline\n                                        hover:bg-theme-danger hover:text-theme-danger-contrast\n                                    ",
                                            attrs: { title: "Delete Layout" },
                                            on: {
                                              click: function($event) {
                                                return _vm.checkDelete(layout)
                                              }
                                            }
                                          },
                                          [
                                            _c("icon-trash", {
                                              staticClass: "w-4"
                                            })
                                          ],
                                          1
                                        )
                                      : _vm._e()
                                  ],
                                  1
                                )
                              ])
                            : _vm._e()
                        ])
                      }),
                      0
                    )
                  ]
                )
              ]),
              _vm._v(" "),
              _vm.show_pagination
                ? _c(
                    "div",
                    { staticClass: "flex flex-row justify-center mt-12 px-6" },
                    [
                      _c("pagination", {
                        attrs: { pagination: _vm.layouts.pagination }
                      })
                    ],
                    1
                  )
                : _vm._e()
            ],
        _vm._v(" "),
        _c("confirmation-modal", {
          attrs: {
            confirmText: "Delete",
            confirmType: "danger",
            showModal: _vm.show_delete_modal,
            messageText: _vm.delete_modal_text
          },
          on: {
            cancelAction: _vm.cancelDelete,
            closeModal: _vm.cancelDelete,
            confirmAction: _vm.confirmDelete
          }
        })
      ],
      2
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/pages/admin/cms/layout/Index.vue":
/*!*******************************************************!*\
  !*** ./resources/js/pages/admin/cms/layout/Index.vue ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Index_vue_vue_type_template_id_4ab57a7c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=4ab57a7c& */ "./resources/js/pages/admin/cms/layout/Index.vue?vue&type=template&id=4ab57a7c&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./resources/js/pages/admin/cms/layout/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_4ab57a7c___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Index_vue_vue_type_template_id_4ab57a7c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/admin/cms/layout/Index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/admin/cms/layout/Index.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/js/pages/admin/cms/layout/Index.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/admin/cms/layout/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/admin/cms/layout/Index.vue?vue&type=template&id=4ab57a7c&":
/*!**************************************************************************************!*\
  !*** ./resources/js/pages/admin/cms/layout/Index.vue?vue&type=template&id=4ab57a7c& ***!
  \**************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_4ab57a7c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=template&id=4ab57a7c& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/admin/cms/layout/Index.vue?vue&type=template&id=4ab57a7c&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_4ab57a7c___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_4ab57a7c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);