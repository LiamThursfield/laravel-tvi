(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[14],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/admin/user/Index.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/admin/user/Index.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_core_modals_ConfirmationModal__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../components/core/modals/ConfirmationModal */ "./resources/js/components/core/modals/ConfirmationModal.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: "AdminUserIndex",
  components: {
    ConfirmationModal: _components_core_modals_ConfirmationModal__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  layout: 'admin-layout',
  props: {
    users: Object
  },
  data: function data() {
    return {
      isLoadingUserDelete: false,
      showDeleteModal: false,
      userToDelete: null
    };
  },
  computed: {
    deleteModalText: function deleteModalText() {
      try {
        return 'Do you really want to delete \'' + this.userToDelete.name + '\'?';
      } catch (e) {
        return 'Do you really want to delete this user?';
      }
    },
    showUsersActions: function showUsersActions() {
      return this.userCan('users.edit') || this.userCan('users.delete');
    },
    usersData: function usersData() {
      if (!this.users || !this.users.data || this.users.data.length < 1) {
        return false;
      }

      return this.users.data;
    }
  },
  methods: {
    cancelUserDelete: function cancelUserDelete() {
      if (!this.isLoadingUserDelete) {
        this.showDeleteModal = false;
        this.userToDelete = null;
      }
    },
    checkUserDelete: function checkUserDelete(user) {
      this.showDeleteModal = true;
      this.userToDelete = user;
    },
    confirmUserDelete: function confirmUserDelete() {
      if (this.isLoadingUserDelete) {
        return this.$errorToast('Only able to delete one user at a time.');
      }

      this.$inertia["delete"](this.$route('admin.users.destroy', this.userToDelete.id), {
        only: ['flash', 'users']
      });
      this.userToDelete = null;
    },
    deleteUser: function deleteUser() {},
    isUserCurrent: function isUserCurrent(user) {
      try {
        return user.id === this.$page.auth.user.id;
      } catch (e) {
        return false;
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/admin/user/Index.vue?vue&type=template&id=d1f1aad2&":
/*!**************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/admin/user/Index.vue?vue&type=template&id=d1f1aad2& ***!
  \**************************************************************************************************************************************************************************************************************/
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
    { staticClass: "bg-white py-6 shadow-subtle rounded-lg" },
    [
      _c("h1", { staticClass: "font-semibold px-6 text-gray-850" }, [
        _vm._v("\n        Users\n    ")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "block mt-4 overflow-x-auto w-full" }, [
        _c("table", { staticClass: "table table-hover table-striped w-full" }, [
          _c("thead", [
            _c("tr", [
              _c("th", [_vm._v("Name")]),
              _vm._v(" "),
              _c("th", [_vm._v("Email")]),
              _vm._v(" "),
              _vm.showUsersActions ? _c("th") : _vm._e()
            ])
          ]),
          _vm._v(" "),
          _c(
            "tbody",
            _vm._l(_vm.usersData, function(user, index) {
              return _c("tr", { key: "user-" + user.id }, [
                _c("td", [
                  _vm._v(
                    "\n                        " +
                      _vm._s(user.name) +
                      "\n                    "
                  )
                ]),
                _vm._v(" "),
                _c("td", [
                  _vm._v(
                    "\n                        " +
                      _vm._s(user.email) +
                      "\n                    "
                  )
                ]),
                _vm._v(" "),
                _vm.showUsersActions
                  ? _c("td", [
                      _c(
                        "div",
                        {
                          staticClass:
                            "flex flex-row items-center justify-end -mx-1"
                        },
                        [
                          _vm.userCan("users.edit")
                            ? _c(
                                "button",
                                {
                                  staticClass:
                                    "\n                                    flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide\n                                    focus:outline-none focus:shadow-outline\n                                    hover:bg-theme-info hover:text-theme-info-contrast\n                                ",
                                  attrs: { title: "Edit User" }
                                },
                                [_c("icon-edit", { staticClass: "w-4" })],
                                1
                              )
                            : _vm._e(),
                          _vm._v(" "),
                          _vm.userCan("users.delete")
                            ? _c(
                                "button",
                                {
                                  staticClass:
                                    "\n                                    flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide\n                                    focus:outline-none focus:shadow-outline\n                                    hover:bg-theme-danger hover:text-theme-danger-contrast\n                                ",
                                  attrs: {
                                    disabled: _vm.isUserCurrent(user),
                                    title: "Delete User"
                                  },
                                  on: {
                                    click: function($event) {
                                      return _vm.checkUserDelete(user)
                                    }
                                  }
                                },
                                [_c("icon-trash", { staticClass: "w-4" })],
                                1
                              )
                            : _vm._e()
                        ]
                      )
                    ])
                  : _vm._e()
              ])
            }),
            0
          )
        ])
      ]),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "flex flex-row justify-center mt-12 px-6" },
        [_c("pagination", { attrs: { pagination: _vm.users.pagination } })],
        1
      ),
      _vm._v(" "),
      _c("confirmation-modal", {
        attrs: {
          confirmText: "Delete",
          confirmType: "danger",
          showModal: _vm.showDeleteModal,
          messageText: _vm.deleteModalText
        },
        on: {
          cancelAction: _vm.cancelUserDelete,
          closeModal: _vm.cancelUserDelete,
          confirmAction: _vm.confirmUserDelete
        }
      })
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/pages/admin/user/Index.vue":
/*!*************************************************!*\
  !*** ./resources/js/pages/admin/user/Index.vue ***!
  \*************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Index_vue_vue_type_template_id_d1f1aad2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=d1f1aad2& */ "./resources/js/pages/admin/user/Index.vue?vue&type=template&id=d1f1aad2&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./resources/js/pages/admin/user/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_d1f1aad2___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Index_vue_vue_type_template_id_d1f1aad2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/admin/user/Index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/admin/user/Index.vue?vue&type=script&lang=js&":
/*!**************************************************************************!*\
  !*** ./resources/js/pages/admin/user/Index.vue?vue&type=script&lang=js& ***!
  \**************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/admin/user/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/admin/user/Index.vue?vue&type=template&id=d1f1aad2&":
/*!********************************************************************************!*\
  !*** ./resources/js/pages/admin/user/Index.vue?vue&type=template&id=d1f1aad2& ***!
  \********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_d1f1aad2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=template&id=d1f1aad2& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/admin/user/Index.vue?vue&type=template&id=d1f1aad2&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_d1f1aad2___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_d1f1aad2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);