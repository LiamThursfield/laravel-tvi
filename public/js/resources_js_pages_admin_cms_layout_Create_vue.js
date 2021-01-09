(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_pages_admin_cms_layout_Create_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/ContentEditor.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/ContentEditor.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _content_fields_ImageField__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./content_fields/ImageField */ "./resources/js/components/admin/cms/content/content_fields/ImageField.vue");
/* harmony import */ var _content_fields_NumberField__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./content_fields/NumberField */ "./resources/js/components/admin/cms/content/content_fields/NumberField.vue");
/* harmony import */ var _content_fields_TextAreaField__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./content_fields/TextAreaField */ "./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue");
/* harmony import */ var _content_fields_TextField__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./content_fields/TextField */ "./resources/js/components/admin/cms/content/content_fields/TextField.vue");
/* harmony import */ var _content_fields_WysiwygField__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./content_fields/WysiwygField */ "./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: 'AdminCmsContentEditor',
  components: {
    ImageField: _content_fields_ImageField__WEBPACK_IMPORTED_MODULE_1__.default,
    NumberField: _content_fields_NumberField__WEBPACK_IMPORTED_MODULE_2__.default,
    TextAreaField: _content_fields_TextAreaField__WEBPACK_IMPORTED_MODULE_3__.default,
    TextField: _content_fields_TextField__WEBPACK_IMPORTED_MODULE_4__.default,
    WysiwygField: _content_fields_WysiwygField__WEBPACK_IMPORTED_MODULE_5__.default
  },
  model: {
    prop: 'content'
  },
  props: {
    content: {
      required: true,
      type: Array | Object
    },
    content_field_slug: {
      "default": 'content',
      type: String
    },
    templateFields: {
      required: true,
      type: Array
    }
  },
  data: function data() {
    return {
      editableContent: {}
    };
  },
  created: function created() {
    // If there is existing content, clone it
    if (_typeof(this.content) === 'object' && Object.keys(this.content).length > 0) {
      this.editableContent = lodash__WEBPACK_IMPORTED_MODULE_0___default().cloneDeep(this.content);
    }
  },
  methods: {
    getContentFieldComponent: function getContentFieldComponent(templateField) {
      switch (templateField.type) {
        case 'image':
          return 'ImageField';

        case 'number':
          return 'NumberField';

        case 'text':
          return 'TextField';

        case 'textarea':
          return 'TextAreaField';

        case 'wysiwyg':
          return 'WysiwygField';

        default:
          this.$errorToast('Unregistered content field for template field: ' + templateField.type);
          return false;
      }
    },
    onEditableContentUpdate: function onEditableContentUpdate() {
      this.$emit('input', lodash__WEBPACK_IMPORTED_MODULE_0___default().cloneDeep(this.editableContent));
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/ImageField.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/ImageField.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _mixins_admin_cms_content_field__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../mixins/admin/cms/content-field */ "./resources/js/mixins/admin/cms/content-field.js");
/* harmony import */ var _core_forms_InputGroup__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../core/forms/InputGroup */ "./resources/js/components/core/forms/InputGroup.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
// TODO: Replace with an image select modal


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "ImageField",
  mixins: [_mixins_admin_cms_content_field__WEBPACK_IMPORTED_MODULE_0__.contentFieldMixin],
  components: {
    InputGroup: _core_forms_InputGroup__WEBPACK_IMPORTED_MODULE_1__.default
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/NumberField.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/NumberField.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _mixins_admin_cms_content_field__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../mixins/admin/cms/content-field */ "./resources/js/mixins/admin/cms/content-field.js");
/* harmony import */ var _core_forms_InputGroup__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../core/forms/InputGroup */ "./resources/js/components/core/forms/InputGroup.vue");
//
//
//
//
//
//
//
//
//
//
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
  name: "NumberField",
  mixins: [_mixins_admin_cms_content_field__WEBPACK_IMPORTED_MODULE_0__.contentFieldMixin],
  components: {
    InputGroup: _core_forms_InputGroup__WEBPACK_IMPORTED_MODULE_1__.default
  },
  computed: {
    inputMax: function inputMax() {
      try {
        return this.templateField.settings.max;
      } catch (e) {
        return '';
      }
    },
    inputMin: function inputMin() {
      try {
        return this.templateField.settings.min;
      } catch (e) {
        return '';
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _mixins_admin_cms_content_field__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../mixins/admin/cms/content-field */ "./resources/js/mixins/admin/cms/content-field.js");
/* harmony import */ var _core_forms_TextAreaGroup__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../core/forms/TextAreaGroup */ "./resources/js/components/core/forms/TextAreaGroup.vue");
//
//
//
//
//
//
//
//
//
//
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
  name: "TextAreaField",
  mixins: [_mixins_admin_cms_content_field__WEBPACK_IMPORTED_MODULE_0__.contentFieldMixin],
  components: {
    TextAreaGroup: _core_forms_TextAreaGroup__WEBPACK_IMPORTED_MODULE_1__.default
  },
  computed: {
    inputMaxLength: function inputMaxLength() {
      try {
        return this.templateField.settings.max_length;
      } catch (e) {
        return '';
      }
    },
    inputRows: function inputRows() {
      try {
        return this.templateField.settings.rows;
      } catch (e) {
        return '';
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/TextField.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/TextField.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _mixins_admin_cms_content_field__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../mixins/admin/cms/content-field */ "./resources/js/mixins/admin/cms/content-field.js");
/* harmony import */ var _core_forms_InputGroup__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../core/forms/InputGroup */ "./resources/js/components/core/forms/InputGroup.vue");
//
//
//
//
//
//
//
//
//
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
  name: "TextField",
  mixins: [_mixins_admin_cms_content_field__WEBPACK_IMPORTED_MODULE_0__.contentFieldMixin],
  components: {
    InputGroup: _core_forms_InputGroup__WEBPACK_IMPORTED_MODULE_1__.default
  },
  computed: {
    inputMaxLength: function inputMaxLength() {
      try {
        return this.templateField.settings.max_length;
      } catch (e) {
        return '';
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _mixins_admin_cms_content_field__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../mixins/admin/cms/content-field */ "./resources/js/mixins/admin/cms/content-field.js");
/* harmony import */ var _core_forms_TextAreaGroup__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../core/forms/TextAreaGroup */ "./resources/js/components/core/forms/TextAreaGroup.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
// TODO: Find a suitable WYSIWYG plugin and replace


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "WysiwygField",
  mixins: [_mixins_admin_cms_content_field__WEBPACK_IMPORTED_MODULE_0__.contentFieldMixin],
  components: {
    TextAreaGroup: _core_forms_TextAreaGroup__WEBPACK_IMPORTED_MODULE_1__.default
  }
});

/***/ }),

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
    prop: 'inputValue'
  },
  props: {
    errorClass: {
      "default": 'mt-1 text-red-500 text-sm',
      type: String
    },
    errorHideOnInput: {
      "default": true,
      type: Boolean
    },
    errorMessage: {
      "default": '',
      type: false | String
    },
    inputAutocomplete: {
      "default": '',
      type: String
    },
    inputAutofocus: {
      "default": false,
      type: Boolean
    },
    inputClass: {
      "default": 'border border-theme-base-subtle font-medium px-3 py-2 rounded w-full focus:border-theme-primary focus:outline-none focus:ring-0',
      type: String
    },
    inputDisabled: {
      "default": false,
      type: Boolean
    },
    inputId: {
      required: true,
      type: String
    },
    inputMax: {
      "default": '',
      type: String | Number
    },
    inputMaxLength: {
      "default": '',
      type: String | Number
    },
    inputMin: {
      "default": '',
      type: String | Number
    },
    inputMinLength: {
      "default": '',
      type: String | Number
    },
    inputName: {
      required: true,
      type: String
    },
    inputPlaceholder: {
      "default": '',
      type: String
    },
    inputRequired: {
      "default": false,
      type: Boolean
    },
    inputType: {
      "default": 'text',
      type: String
    },
    inputValue: {
      "default": '',
      type: String | Number
    },
    labelClass: {
      "default": 'font-medium mb-2 text-theme-base-contrast text-sm tracking-wider',
      type: String
    },
    labelHidden: {
      "default": false,
      type: Boolean
    },
    labelText: {
      required: true,
      type: String
    }
  },
  data: function data() {
    return {
      hideError: false
    };
  },
  computed: {
    formattedInputClass: function formattedInputClass() {
      if (this.isError) {
        return this.inputClass + ' error';
      }

      return this.inputClass;
    },
    formattedLabelClass: function formattedLabelClass() {
      var labelClass = this.labelClass;

      if (this.labelHidden) {
        labelClass += ' hidden';
      }

      return labelClass;
    },
    isError: function isError() {
      return !this.hideError && this.errorMessage && this.errorMessage !== '';
    }
  },
  mounted: function mounted() {
    this.autofocus();
  },
  methods: {
    autofocus: function autofocus() {
      var _this = this;

      if (this.inputAutofocus && this.$refs[this.inputId]) {
        this.$nextTick(function () {
          _this.$refs[_this.inputId].focus();
        });
      }
    },
    blurInput: function blurInput() {
      var _this2 = this;

      if (this.$refs[this.inputId]) {
        this.$nextTick(function () {
          _this2.$refs[_this2.inputId].blur();
        });
      }
    },
    onErrorMessageChange: function onErrorMessageChange() {
      this.hideError = false;
    },
    onInputBlur: function onInputBlur() {
      this.$emit('blur');
    },
    onInputKeyPress: function onInputKeyPress() {
      this.$emit('input', this.$refs[this.inputId].value);

      if (this.errorHideOnInput) {
        this.hideError = true;
      }
    }
  },
  watch: {
    errorMessage: {
      handler: "onErrorMessageChange"
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/SelectGroup.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/SelectGroup.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_0__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: 'SelectGroup',
  model: {
    prop: 'selectValue'
  },
  props: {
    errorClass: {
      "default": 'mt-1 text-red-500 text-sm',
      type: String
    },
    errorHideOnSelect: {
      "default": true,
      type: Boolean
    },
    errorMessage: {
      "default": '',
      type: String
    },
    selectAnyEnabled: {
      "default": false,
      type: Boolean
    },
    selectAnyLabel: {
      "default": "Any",
      type: String
    },
    selectAnyClass: {
      "default": "",
      type: String
    },
    selectAnyValue: {
      "default": ''
    },
    selectAutoFocus: {
      "default": false,
      type: Boolean
    },
    selectClass: {
      "default": 'border border-theme-base-subtle cursor-pointer font-medium form-select px-3 py-2 rounded w-full focus:border-theme-primary focus:outline-none focus:ring-0 focus:shadow-none',
      type: String
    },
    selectDisabled: {
      "default": false,
      type: Boolean
    },
    selectId: {
      required: true,
      type: String
    },
    selectName: {
      required: true,
      type: String
    },
    selectOptionLabelKey: {
      "default": false,
      type: Boolean | String | Number
    },
    selectOptionValueKey: {
      "default": false,
      type: Boolean | String | Number
    },
    selectOptions: {
      required: true,
      type: Object
    },
    selectRequired: {
      "default": false,
      type: Boolean
    },
    selectValue: {
      "default": '',
      type: String | Number
    },
    labelClass: {
      "default": 'font-medium mb-2 text-theme-base-contrast text-sm tracking-wider',
      type: String
    },
    labelHidden: {
      "default": false,
      type: Boolean
    },
    labelText: {
      required: true,
      type: String
    }
  },
  data: function data() {
    return {
      hideError: false
    };
  },
  computed: {
    formattedOptions: function formattedOptions() {
      var _this = this;

      var options = {};

      lodash__WEBPACK_IMPORTED_MODULE_0___default().forEach(this.selectOptions, function (option, key) {
        // Default the label and value for the select
        var label = option;
        var value = key; // Set a custom label if necessary

        if (_this.selectOptionLabelKey !== false && option.hasOwnProperty(_this.selectOptionLabelKey)) {
          label = option[_this.selectOptionLabelKey];
        } // Set a custom value if necessary


        if (_this.selectOptionValueKey !== false && option.hasOwnProperty(_this.selectOptionValueKey)) {
          value = option[_this.selectOptionValueKey];
        }

        options[key] = {
          label: label,
          value: value
        };
      });

      return options;
    },
    formattedSelectClass: function formattedSelectClass() {
      var selectClass = this.selectClass;

      if (this.isError) {
        selectClass += ' error';
      }

      if (this.isAnyOptionSelected) {
        selectClass += ' ' + this.selectAnyClass;
      }

      return selectClass;
    },
    formattedLabelClass: function formattedLabelClass() {
      var labelClass = this.labelClass;

      if (this.labelHidden) {
        labelClass += ' hidden';
      }

      return labelClass;
    },
    isError: function isError() {
      return !this.hideError && this.errorMessage && this.errorMessage !== '';
    },
    isAnyOptionSelected: function isAnyOptionSelected() {
      return this.selectValue === this.selectAnyValue || this.selectValue === null;
    }
  },
  mounted: function mounted() {
    this.autofocus();
  },
  methods: {
    autofocus: function autofocus() {
      var _this2 = this;

      if (this.selectAutoFocus && this.$refs[this.selectId]) {
        this.$nextTick(function () {
          _this2.$refs[_this2.selectId].focus();
        });
      }
    },
    blurSelect: function blurSelect() {
      var _this3 = this;

      if (this.$refs[this.selectId]) {
        this.$nextTick(function () {
          _this3.$refs[_this3.selectId].blur();
        });
      }
    },
    isOptionDisabled: function isOptionDisabled(option_value) {
      if (!this.selectRequired) {
        return false;
      }

      if (option_value === '') {
        return true;
      }

      return false;
    },
    isOptionSelected: function isOptionSelected(option_value) {
      return option_value === this.selectValue;
    },
    onErrorMessageChange: function onErrorMessageChange() {
      this.hideError = false;
    },
    onSelectChange: function onSelectChange() {
      this.$emit('input', this.$refs[this.selectId].value);

      if (this.errorHideOnSelect) {
        this.hideError = true;
      }
    }
  },
  watch: {
    errorMessage: {
      handler: "onErrorMessageChange"
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/TextAreaGroup.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/TextAreaGroup.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************************************************/
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
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "TextAreaGroup",
  model: {
    prop: 'inputValue'
  },
  props: {
    errorClass: {
      "default": 'mt-1 text-red-500 text-sm',
      type: String
    },
    errorHideOnInput: {
      "default": true,
      type: Boolean
    },
    errorMessage: {
      "default": '',
      type: String
    },
    inputAutocomplete: {
      "default": '',
      type: String
    },
    inputAutofocus: {
      "default": false,
      type: Boolean
    },
    inputClass: {
      "default": 'border border-theme-base-subtle font-medium px-3 py-2 rounded w-full focus:border-theme-primary focus:outline-none focus:ring-0',
      type: String
    },
    inputDisabled: {
      "default": false,
      type: Boolean
    },
    inputId: {
      required: true,
      type: String
    },
    inputMaxLength: {
      "default": '',
      type: String | Number
    },
    inputName: {
      required: true,
      type: String
    },
    inputPlaceholder: {
      "default": '',
      type: String
    },
    inputRequired: {
      "default": false,
      type: Boolean
    },
    inputRows: {
      "default": '',
      type: String | Number
    },
    inputType: {
      "default": 'text',
      type: String
    },
    inputValue: {
      "default": '',
      type: String | Number
    },
    labelClass: {
      "default": 'font-medium mb-2 text-theme-base-contrast text-sm tracking-wider',
      type: String
    },
    labelHidden: {
      "default": false,
      type: Boolean
    },
    labelText: {
      required: true,
      type: String
    }
  },
  data: function data() {
    return {
      hideError: false
    };
  },
  computed: {
    formattedInputClass: function formattedInputClass() {
      if (this.isError) {
        return this.inputClass + ' error';
      }

      return this.inputClass;
    },
    formattedLabelClass: function formattedLabelClass() {
      var labelClass = this.labelClass;

      if (this.labelHidden) {
        labelClass += ' hidden';
      }

      return labelClass;
    },
    isError: function isError() {
      return !this.hideError && this.errorMessage && this.errorMessage !== '';
    }
  },
  mounted: function mounted() {
    this.autofocus();
  },
  methods: {
    autofocus: function autofocus() {
      var _this = this;

      if (this.inputAutofocus && this.$refs[this.inputId]) {
        this.$nextTick(function () {
          _this.$refs[_this.inputId].focus();
        });
      }
    },
    blurInput: function blurInput() {
      var _this2 = this;

      if (this.$refs[this.inputId]) {
        this.$nextTick(function () {
          _this2.$refs[_this2.inputId].blur();
        });
      }
    },
    onErrorMessageChange: function onErrorMessageChange() {
      this.hideError = false;
    },
    onInputBlur: function onInputBlur() {
      this.$emit('blur');
    },
    onInputKeyPress: function onInputKeyPress() {
      this.$emit('input', this.$refs[this.inputId].value);

      if (this.errorHideOnInput) {
        this.hideError = true;
      }
    }
  },
  watch: {
    errorMessage: {
      handler: "onErrorMessageChange"
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/admin/cms/layout/Create.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/admin/cms/layout/Create.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var slugify__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! slugify */ "./node_modules/slugify/slugify.js");
/* harmony import */ var slugify__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(slugify__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_admin_cms_content_ContentEditor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../components/admin/cms/content/ContentEditor */ "./resources/js/components/admin/cms/content/ContentEditor.vue");
/* harmony import */ var _components_core_forms_InputGroup__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../components/core/forms/InputGroup */ "./resources/js/components/core/forms/InputGroup.vue");
/* harmony import */ var _components_core_forms_SelectGroup__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../components/core/forms/SelectGroup */ "./resources/js/components/core/forms/SelectGroup.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//




var CancelToken = axios.CancelToken;
var templateCancelToken = CancelToken.source();
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "AdminCmsLayoutCreate",
  components: {
    ContentEditor: _components_admin_cms_content_ContentEditor__WEBPACK_IMPORTED_MODULE_1__.default,
    InputGroup: _components_core_forms_InputGroup__WEBPACK_IMPORTED_MODULE_2__.default,
    SelectGroup: _components_core_forms_SelectGroup__WEBPACK_IMPORTED_MODULE_3__.default
  },
  layout: 'admin-layout',
  props: {
    'templates': {
      type: Object,
      required: true
    }
  },
  data: function data() {
    return {
      autoUpdateSlug: true,
      formData: {
        name: '',
        slug: '',
        template_id: ''
      },
      isLoadingTemplate: false,
      selectedTemplate: null
    };
  },
  computed: {
    selectedTemplateHasFields: function selectedTemplateHasFields() {
      try {
        if (!this.selectedTemplate) {
          return false;
        }

        return this.selectedTemplate.template_fields.length;
      } catch (e) {
        return false;
      }
    },
    selectedTemplateId: function selectedTemplateId() {
      var _this$formData$templa;

      return (_this$formData$templa = this.formData.template_id) !== null && _this$formData$templa !== void 0 ? _this$formData$templa : '';
    }
  },
  methods: {
    cancelLoadTemplate: function cancelLoadTemplate() {
      if (this.isLoadingTemplate) {
        templateCancelToken.cancel('Template load cancelled');
        templateCancelToken = CancelToken.source();
      }
    },
    onNameInput: function onNameInput() {
      if (!this.autoUpdateSlug) {
        return;
      }

      this.formData.slug = this.slugify(this.formData.name);
    },
    onSelectedTemplateIdChange: _.debounce(function () {
      var _this = this;

      this.selectedTemplate = null;
      this.cancelLoadTemplate();

      if (!this.selectedTemplateId) {
        return;
      }

      this.isLoadingTemplate = true;
      axios.get(this.$route('admin.api.cms.templates.index', this.selectedTemplateId)).then(function (response) {
        _this.selectedTemplate = _.cloneDeep(response.data.data);

        _this.setNewTemplateContent();
      })["catch"](function (e) {
        if (!axios.isCancel(e)) {
          _this.$errorToast('Failed to load selected template');

          console.log(e); // TODO: This should go through to a log tracker once available
        }
      })["finally"](function () {
        _this.isLoadingTemplate = false;
      });
    }, 500),
    onSlugBlur: function onSlugBlur() {
      this.formData.slug = this.slugify(this.formData.slug);
    },
    onSlugInput: function onSlugInput() {
      this.autoUpdateSlug = false;
    },
    setNewTemplateContent: function setNewTemplateContent() {
      if (!this.selectedTemplateHasFields) {
        this.formData.content = {};
      } // Get all fields from the template and set the default data


      var new_content = {};

      _.forEach(this.selectedTemplate.template_fields, function (templateField) {
        new_content[templateField.id] = {
          data: '',
          template_field_id: templateField.id
        };
      }); // Replace the existing content


      this.$set(this.formData, 'content', _.cloneDeep(new_content));
    },
    slugify: function slugify(value) {
      if (!value || !value.length) {
        return '';
      }

      return slugify__WEBPACK_IMPORTED_MODULE_0___default()(value, {
        lower: true
      });
    },
    submit: function submit() {
      this.$inertia.post(this.$route('admin.cms.layouts.store'), this.formData);
    }
  },
  watch: {
    selectedTemplateId: {
      handler: 'onSelectedTemplateIdChange'
    }
  }
});

/***/ }),

/***/ "./resources/js/mixins/admin/cms/content-field.js":
/*!********************************************************!*\
  !*** ./resources/js/mixins/admin/cms/content-field.js ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "contentFieldMixin": () => /* binding */ contentFieldMixin
/* harmony export */ });
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_0__);

var contentFieldMixin = {
  model: {
    prop: 'content'
  },
  props: {
    content: {
      required: true
    },
    templateField: {
      required: true,
      type: Object
    }
  },
  data: function data() {
    return {
      editableContent: ''
    };
  },
  computed: {
    errorMessage: function errorMessage() {
      // Returns either the first error message for the field, or false
      try {
        if (!Array.isArray(this.inputErrors)) {
          return this.inputErrors;
        }

        return this.inputErrors[0];
      } catch (e) {
        return false;
      }
    },
    inputErrors: function inputErrors() {
      var _this = this;

      try {
        var errors = [];

        lodash__WEBPACK_IMPORTED_MODULE_0___default().forEach(this.$page.props.errors, function (e, slug) {
          if (slug.indexOf(_this.inputName) === 0) {
            e = lodash__WEBPACK_IMPORTED_MODULE_0___default().replace(e, _this.inputName + '.', '');
            e = lodash__WEBPACK_IMPORTED_MODULE_0___default().replace(e, _this.inputName, '');
            errors.push(e);
          }
        });

        return errors;
      } catch (e) {
        return false;
      }
    },
    inputName: function inputName() {
      return 'content.' + this.templateField.id;
    }
  },
  created: function created() {
    this.editableContent = lodash__WEBPACK_IMPORTED_MODULE_0___default().cloneDeep(this.content);
  },
  methods: {
    onEditableContentUpdate: lodash__WEBPACK_IMPORTED_MODULE_0___default().debounce(function () {
      this.$emit('input', this.editableContent);
    }, 100)
  },
  watch: {
    editableContent: {
      deep: true,
      handler: 'onEditableContentUpdate'
    }
  }
};

/***/ }),

/***/ "./node_modules/slugify/slugify.js":
/*!*****************************************!*\
  !*** ./node_modules/slugify/slugify.js ***!
  \*****************************************/
/***/ (function(module) {


;(function (name, root, factory) {
  if (true) {
    module.exports = factory()
    module.exports.default = factory()
  }
  /* istanbul ignore next */
  else {}
}('slugify', this, function () {
  var charMap = JSON.parse('{"$":"dollar","%":"percent","&":"and","<":"less",">":"greater","|":"or","¢":"cent","£":"pound","¤":"currency","¥":"yen","©":"(c)","ª":"a","®":"(r)","º":"o","À":"A","Á":"A","Â":"A","Ã":"A","Ä":"A","Å":"A","Æ":"AE","Ç":"C","È":"E","É":"E","Ê":"E","Ë":"E","Ì":"I","Í":"I","Î":"I","Ï":"I","Ð":"D","Ñ":"N","Ò":"O","Ó":"O","Ô":"O","Õ":"O","Ö":"O","Ø":"O","Ù":"U","Ú":"U","Û":"U","Ü":"U","Ý":"Y","Þ":"TH","ß":"ss","à":"a","á":"a","â":"a","ã":"a","ä":"a","å":"a","æ":"ae","ç":"c","è":"e","é":"e","ê":"e","ë":"e","ì":"i","í":"i","î":"i","ï":"i","ð":"d","ñ":"n","ò":"o","ó":"o","ô":"o","õ":"o","ö":"o","ø":"o","ù":"u","ú":"u","û":"u","ü":"u","ý":"y","þ":"th","ÿ":"y","Ā":"A","ā":"a","Ă":"A","ă":"a","Ą":"A","ą":"a","Ć":"C","ć":"c","Č":"C","č":"c","Ď":"D","ď":"d","Đ":"DJ","đ":"dj","Ē":"E","ē":"e","Ė":"E","ė":"e","Ę":"e","ę":"e","Ě":"E","ě":"e","Ğ":"G","ğ":"g","Ģ":"G","ģ":"g","Ĩ":"I","ĩ":"i","Ī":"i","ī":"i","Į":"I","į":"i","İ":"I","ı":"i","Ķ":"k","ķ":"k","Ļ":"L","ļ":"l","Ľ":"L","ľ":"l","Ł":"L","ł":"l","Ń":"N","ń":"n","Ņ":"N","ņ":"n","Ň":"N","ň":"n","Ō":"O","ō":"o","Ő":"O","ő":"o","Œ":"OE","œ":"oe","Ŕ":"R","ŕ":"r","Ř":"R","ř":"r","Ś":"S","ś":"s","Ş":"S","ş":"s","Š":"S","š":"s","Ţ":"T","ţ":"t","Ť":"T","ť":"t","Ũ":"U","ũ":"u","Ū":"u","ū":"u","Ů":"U","ů":"u","Ű":"U","ű":"u","Ų":"U","ų":"u","Ŵ":"W","ŵ":"w","Ŷ":"Y","ŷ":"y","Ÿ":"Y","Ź":"Z","ź":"z","Ż":"Z","ż":"z","Ž":"Z","ž":"z","Ə":"E","ƒ":"f","Ơ":"O","ơ":"o","Ư":"U","ư":"u","ǈ":"LJ","ǉ":"lj","ǋ":"NJ","ǌ":"nj","Ș":"S","ș":"s","Ț":"T","ț":"t","ə":"e","˚":"o","Ά":"A","Έ":"E","Ή":"H","Ί":"I","Ό":"O","Ύ":"Y","Ώ":"W","ΐ":"i","Α":"A","Β":"B","Γ":"G","Δ":"D","Ε":"E","Ζ":"Z","Η":"H","Θ":"8","Ι":"I","Κ":"K","Λ":"L","Μ":"M","Ν":"N","Ξ":"3","Ο":"O","Π":"P","Ρ":"R","Σ":"S","Τ":"T","Υ":"Y","Φ":"F","Χ":"X","Ψ":"PS","Ω":"W","Ϊ":"I","Ϋ":"Y","ά":"a","έ":"e","ή":"h","ί":"i","ΰ":"y","α":"a","β":"b","γ":"g","δ":"d","ε":"e","ζ":"z","η":"h","θ":"8","ι":"i","κ":"k","λ":"l","μ":"m","ν":"n","ξ":"3","ο":"o","π":"p","ρ":"r","ς":"s","σ":"s","τ":"t","υ":"y","φ":"f","χ":"x","ψ":"ps","ω":"w","ϊ":"i","ϋ":"y","ό":"o","ύ":"y","ώ":"w","Ё":"Yo","Ђ":"DJ","Є":"Ye","І":"I","Ї":"Yi","Ј":"J","Љ":"LJ","Њ":"NJ","Ћ":"C","Џ":"DZ","А":"A","Б":"B","В":"V","Г":"G","Д":"D","Е":"E","Ж":"Zh","З":"Z","И":"I","Й":"J","К":"K","Л":"L","М":"M","Н":"N","О":"O","П":"P","Р":"R","С":"S","Т":"T","У":"U","Ф":"F","Х":"H","Ц":"C","Ч":"Ch","Ш":"Sh","Щ":"Sh","Ъ":"U","Ы":"Y","Ь":"","Э":"E","Ю":"Yu","Я":"Ya","а":"a","б":"b","в":"v","г":"g","д":"d","е":"e","ж":"zh","з":"z","и":"i","й":"j","к":"k","л":"l","м":"m","н":"n","о":"o","п":"p","р":"r","с":"s","т":"t","у":"u","ф":"f","х":"h","ц":"c","ч":"ch","ш":"sh","щ":"sh","ъ":"u","ы":"y","ь":"","э":"e","ю":"yu","я":"ya","ё":"yo","ђ":"dj","є":"ye","і":"i","ї":"yi","ј":"j","љ":"lj","њ":"nj","ћ":"c","ѝ":"u","џ":"dz","Ґ":"G","ґ":"g","Ғ":"GH","ғ":"gh","Қ":"KH","қ":"kh","Ң":"NG","ң":"ng","Ү":"UE","ү":"ue","Ұ":"U","ұ":"u","Һ":"H","һ":"h","Ә":"AE","ә":"ae","Ө":"OE","ө":"oe","฿":"baht","ა":"a","ბ":"b","გ":"g","დ":"d","ე":"e","ვ":"v","ზ":"z","თ":"t","ი":"i","კ":"k","ლ":"l","მ":"m","ნ":"n","ო":"o","პ":"p","ჟ":"zh","რ":"r","ს":"s","ტ":"t","უ":"u","ფ":"f","ქ":"k","ღ":"gh","ყ":"q","შ":"sh","ჩ":"ch","ც":"ts","ძ":"dz","წ":"ts","ჭ":"ch","ხ":"kh","ჯ":"j","ჰ":"h","Ẁ":"W","ẁ":"w","Ẃ":"W","ẃ":"w","Ẅ":"W","ẅ":"w","ẞ":"SS","Ạ":"A","ạ":"a","Ả":"A","ả":"a","Ấ":"A","ấ":"a","Ầ":"A","ầ":"a","Ẩ":"A","ẩ":"a","Ẫ":"A","ẫ":"a","Ậ":"A","ậ":"a","Ắ":"A","ắ":"a","Ằ":"A","ằ":"a","Ẳ":"A","ẳ":"a","Ẵ":"A","ẵ":"a","Ặ":"A","ặ":"a","Ẹ":"E","ẹ":"e","Ẻ":"E","ẻ":"e","Ẽ":"E","ẽ":"e","Ế":"E","ế":"e","Ề":"E","ề":"e","Ể":"E","ể":"e","Ễ":"E","ễ":"e","Ệ":"E","ệ":"e","Ỉ":"I","ỉ":"i","Ị":"I","ị":"i","Ọ":"O","ọ":"o","Ỏ":"O","ỏ":"o","Ố":"O","ố":"o","Ồ":"O","ồ":"o","Ổ":"O","ổ":"o","Ỗ":"O","ỗ":"o","Ộ":"O","ộ":"o","Ớ":"O","ớ":"o","Ờ":"O","ờ":"o","Ở":"O","ở":"o","Ỡ":"O","ỡ":"o","Ợ":"O","ợ":"o","Ụ":"U","ụ":"u","Ủ":"U","ủ":"u","Ứ":"U","ứ":"u","Ừ":"U","ừ":"u","Ử":"U","ử":"u","Ữ":"U","ữ":"u","Ự":"U","ự":"u","Ỳ":"Y","ỳ":"y","Ỵ":"Y","ỵ":"y","Ỷ":"Y","ỷ":"y","Ỹ":"Y","ỹ":"y","‘":"\'","’":"\'","“":"\\\"","”":"\\\"","†":"+","•":"*","…":"...","₠":"ecu","₢":"cruzeiro","₣":"french franc","₤":"lira","₥":"mill","₦":"naira","₧":"peseta","₨":"rupee","₩":"won","₪":"new shequel","₫":"dong","€":"euro","₭":"kip","₮":"tugrik","₯":"drachma","₰":"penny","₱":"peso","₲":"guarani","₳":"austral","₴":"hryvnia","₵":"cedi","₸":"kazakhstani tenge","₹":"indian rupee","₺":"turkish lira","₽":"russian ruble","₿":"bitcoin","℠":"sm","™":"tm","∂":"d","∆":"delta","∑":"sum","∞":"infinity","♥":"love","元":"yuan","円":"yen","﷼":"rial"}')
  var locales = JSON.parse('{"de":{"Ä":"AE","ä":"ae","Ö":"OE","ö":"oe","Ü":"UE","ü":"ue"},"vi":{"Đ":"D","đ":"d"}}')

  function replace (string, options) {
    if (typeof string !== 'string') {
      throw new Error('slugify: string argument expected')
    }

    options = (typeof options === 'string')
      ? {replacement: options}
      : options || {}

    var locale = locales[options.locale] || {}

    var replacement = options.replacement === undefined ? '-' : options.replacement

    var slug = string.split('')
      // replace characters based on charMap
      .reduce(function (result, ch) {
        return result + (locale[ch] || charMap[ch] || ch)
          // remove not allowed characters
          .replace(options.remove || /[^\w\s$*_+~.()'"!\-:@]+/g, '')
      }, '')
      // trim leading/trailing spaces
      .trim()
      // convert spaces to replacement character
      // also remove duplicates of the replacement character
      .replace(new RegExp('[\\s' + replacement + ']+', 'g'), replacement)

    if (options.lower) {
      slug = slug.toLowerCase()
    }

    if (options.strict) {
      // remove anything besides letters, numbers, and the replacement char
      slug = slug
        .replace(new RegExp('[^a-zA-Z0-9' + replacement + ']', 'g'), '')
        // remove duplicates of the replacement character
        .replace(new RegExp('[\\s' + replacement + ']+', 'g'), replacement)
    }

    return slug
  }

  replace.extend = function (customMap) {
    for (var key in customMap) {
      charMap[key] = customMap[key]
    }
  }

  return replace
}))


/***/ }),

/***/ "./resources/js/components/admin/cms/content/ContentEditor.vue":
/*!*********************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/ContentEditor.vue ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _ContentEditor_vue_vue_type_template_id_5f32828f___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ContentEditor.vue?vue&type=template&id=5f32828f& */ "./resources/js/components/admin/cms/content/ContentEditor.vue?vue&type=template&id=5f32828f&");
/* harmony import */ var _ContentEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ContentEditor.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/cms/content/ContentEditor.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _ContentEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _ContentEditor_vue_vue_type_template_id_5f32828f___WEBPACK_IMPORTED_MODULE_0__.render,
  _ContentEditor_vue_vue_type_template_id_5f32828f___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/cms/content/ContentEditor.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/ImageField.vue":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/ImageField.vue ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _ImageField_vue_vue_type_template_id_ec00e690___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ImageField.vue?vue&type=template&id=ec00e690& */ "./resources/js/components/admin/cms/content/content_fields/ImageField.vue?vue&type=template&id=ec00e690&");
/* harmony import */ var _ImageField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ImageField.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/cms/content/content_fields/ImageField.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _ImageField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _ImageField_vue_vue_type_template_id_ec00e690___WEBPACK_IMPORTED_MODULE_0__.render,
  _ImageField_vue_vue_type_template_id_ec00e690___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/cms/content/content_fields/ImageField.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/NumberField.vue":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/NumberField.vue ***!
  \**********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _NumberField_vue_vue_type_template_id_fa5c47b0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./NumberField.vue?vue&type=template&id=fa5c47b0& */ "./resources/js/components/admin/cms/content/content_fields/NumberField.vue?vue&type=template&id=fa5c47b0&");
/* harmony import */ var _NumberField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./NumberField.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/cms/content/content_fields/NumberField.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _NumberField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _NumberField_vue_vue_type_template_id_fa5c47b0___WEBPACK_IMPORTED_MODULE_0__.render,
  _NumberField_vue_vue_type_template_id_fa5c47b0___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/cms/content/content_fields/NumberField.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue":
/*!************************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _TextAreaField_vue_vue_type_template_id_29605912___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TextAreaField.vue?vue&type=template&id=29605912& */ "./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue?vue&type=template&id=29605912&");
/* harmony import */ var _TextAreaField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TextAreaField.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _TextAreaField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _TextAreaField_vue_vue_type_template_id_29605912___WEBPACK_IMPORTED_MODULE_0__.render,
  _TextAreaField_vue_vue_type_template_id_29605912___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/cms/content/content_fields/TextAreaField.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/TextField.vue":
/*!********************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/TextField.vue ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _TextField_vue_vue_type_template_id_efa102f8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TextField.vue?vue&type=template&id=efa102f8& */ "./resources/js/components/admin/cms/content/content_fields/TextField.vue?vue&type=template&id=efa102f8&");
/* harmony import */ var _TextField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TextField.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/cms/content/content_fields/TextField.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _TextField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _TextField_vue_vue_type_template_id_efa102f8___WEBPACK_IMPORTED_MODULE_0__.render,
  _TextField_vue_vue_type_template_id_efa102f8___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/cms/content/content_fields/TextField.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue ***!
  \***********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _WysiwygField_vue_vue_type_template_id_10530c06___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./WysiwygField.vue?vue&type=template&id=10530c06& */ "./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue?vue&type=template&id=10530c06&");
/* harmony import */ var _WysiwygField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./WysiwygField.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _WysiwygField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _WysiwygField_vue_vue_type_template_id_10530c06___WEBPACK_IMPORTED_MODULE_0__.render,
  _WysiwygField_vue_vue_type_template_id_10530c06___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/cms/content/content_fields/WysiwygField.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

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

/***/ "./resources/js/components/core/forms/SelectGroup.vue":
/*!************************************************************!*\
  !*** ./resources/js/components/core/forms/SelectGroup.vue ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _SelectGroup_vue_vue_type_template_id_5aa394fe___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SelectGroup.vue?vue&type=template&id=5aa394fe& */ "./resources/js/components/core/forms/SelectGroup.vue?vue&type=template&id=5aa394fe&");
/* harmony import */ var _SelectGroup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SelectGroup.vue?vue&type=script&lang=js& */ "./resources/js/components/core/forms/SelectGroup.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _SelectGroup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _SelectGroup_vue_vue_type_template_id_5aa394fe___WEBPACK_IMPORTED_MODULE_0__.render,
  _SelectGroup_vue_vue_type_template_id_5aa394fe___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/core/forms/SelectGroup.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/core/forms/TextAreaGroup.vue":
/*!**************************************************************!*\
  !*** ./resources/js/components/core/forms/TextAreaGroup.vue ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _TextAreaGroup_vue_vue_type_template_id_619eb3a0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TextAreaGroup.vue?vue&type=template&id=619eb3a0& */ "./resources/js/components/core/forms/TextAreaGroup.vue?vue&type=template&id=619eb3a0&");
/* harmony import */ var _TextAreaGroup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TextAreaGroup.vue?vue&type=script&lang=js& */ "./resources/js/components/core/forms/TextAreaGroup.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _TextAreaGroup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _TextAreaGroup_vue_vue_type_template_id_619eb3a0___WEBPACK_IMPORTED_MODULE_0__.render,
  _TextAreaGroup_vue_vue_type_template_id_619eb3a0___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/core/forms/TextAreaGroup.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/pages/admin/cms/layout/Create.vue":
/*!********************************************************!*\
  !*** ./resources/js/pages/admin/cms/layout/Create.vue ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _Create_vue_vue_type_template_id_33ae1fc2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Create.vue?vue&type=template&id=33ae1fc2& */ "./resources/js/pages/admin/cms/layout/Create.vue?vue&type=template&id=33ae1fc2&");
/* harmony import */ var _Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Create.vue?vue&type=script&lang=js& */ "./resources/js/pages/admin/cms/layout/Create.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _Create_vue_vue_type_template_id_33ae1fc2___WEBPACK_IMPORTED_MODULE_0__.render,
  _Create_vue_vue_type_template_id_33ae1fc2___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/admin/cms/layout/Create.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/cms/content/ContentEditor.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/ContentEditor.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ContentEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ContentEditor.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/ContentEditor.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ContentEditor_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/ImageField.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/ImageField.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ImageField.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/ImageField.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/NumberField.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/NumberField.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_NumberField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./NumberField.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/NumberField.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_NumberField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TextAreaField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./TextAreaField.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TextAreaField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/TextField.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/TextField.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TextField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./TextField.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/TextField.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TextField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_WysiwygField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./WysiwygField.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_WysiwygField_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

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

/***/ "./resources/js/components/core/forms/SelectGroup.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/core/forms/SelectGroup.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SelectGroup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./SelectGroup.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/SelectGroup.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SelectGroup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/components/core/forms/TextAreaGroup.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/core/forms/TextAreaGroup.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TextAreaGroup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./TextAreaGroup.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/TextAreaGroup.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TextAreaGroup_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/pages/admin/cms/layout/Create.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/pages/admin/cms/layout/Create.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Create.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/admin/cms/layout/Create.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/components/admin/cms/content/ContentEditor.vue?vue&type=template&id=5f32828f&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/ContentEditor.vue?vue&type=template&id=5f32828f& ***!
  \****************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ContentEditor_vue_vue_type_template_id_5f32828f___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ContentEditor_vue_vue_type_template_id_5f32828f___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ContentEditor_vue_vue_type_template_id_5f32828f___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ContentEditor.vue?vue&type=template&id=5f32828f& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/ContentEditor.vue?vue&type=template&id=5f32828f&");


/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/ImageField.vue?vue&type=template&id=ec00e690&":
/*!****************************************************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/ImageField.vue?vue&type=template&id=ec00e690& ***!
  \****************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageField_vue_vue_type_template_id_ec00e690___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageField_vue_vue_type_template_id_ec00e690___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageField_vue_vue_type_template_id_ec00e690___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ImageField.vue?vue&type=template&id=ec00e690& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/ImageField.vue?vue&type=template&id=ec00e690&");


/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/NumberField.vue?vue&type=template&id=fa5c47b0&":
/*!*****************************************************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/NumberField.vue?vue&type=template&id=fa5c47b0& ***!
  \*****************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NumberField_vue_vue_type_template_id_fa5c47b0___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NumberField_vue_vue_type_template_id_fa5c47b0___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_NumberField_vue_vue_type_template_id_fa5c47b0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./NumberField.vue?vue&type=template&id=fa5c47b0& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/NumberField.vue?vue&type=template&id=fa5c47b0&");


/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue?vue&type=template&id=29605912&":
/*!*******************************************************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue?vue&type=template&id=29605912& ***!
  \*******************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TextAreaField_vue_vue_type_template_id_29605912___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TextAreaField_vue_vue_type_template_id_29605912___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TextAreaField_vue_vue_type_template_id_29605912___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./TextAreaField.vue?vue&type=template&id=29605912& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue?vue&type=template&id=29605912&");


/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/TextField.vue?vue&type=template&id=efa102f8&":
/*!***************************************************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/TextField.vue?vue&type=template&id=efa102f8& ***!
  \***************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TextField_vue_vue_type_template_id_efa102f8___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TextField_vue_vue_type_template_id_efa102f8___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TextField_vue_vue_type_template_id_efa102f8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./TextField.vue?vue&type=template&id=efa102f8& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/TextField.vue?vue&type=template&id=efa102f8&");


/***/ }),

/***/ "./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue?vue&type=template&id=10530c06&":
/*!******************************************************************************************************************!*\
  !*** ./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue?vue&type=template&id=10530c06& ***!
  \******************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_WysiwygField_vue_vue_type_template_id_10530c06___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_WysiwygField_vue_vue_type_template_id_10530c06___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_WysiwygField_vue_vue_type_template_id_10530c06___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./WysiwygField.vue?vue&type=template&id=10530c06& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue?vue&type=template&id=10530c06&");


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

/***/ "./resources/js/components/core/forms/SelectGroup.vue?vue&type=template&id=5aa394fe&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/core/forms/SelectGroup.vue?vue&type=template&id=5aa394fe& ***!
  \*******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SelectGroup_vue_vue_type_template_id_5aa394fe___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SelectGroup_vue_vue_type_template_id_5aa394fe___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SelectGroup_vue_vue_type_template_id_5aa394fe___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./SelectGroup.vue?vue&type=template&id=5aa394fe& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/SelectGroup.vue?vue&type=template&id=5aa394fe&");


/***/ }),

/***/ "./resources/js/components/core/forms/TextAreaGroup.vue?vue&type=template&id=619eb3a0&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/core/forms/TextAreaGroup.vue?vue&type=template&id=619eb3a0& ***!
  \*********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TextAreaGroup_vue_vue_type_template_id_619eb3a0___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TextAreaGroup_vue_vue_type_template_id_619eb3a0___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TextAreaGroup_vue_vue_type_template_id_619eb3a0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./TextAreaGroup.vue?vue&type=template&id=619eb3a0& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/TextAreaGroup.vue?vue&type=template&id=619eb3a0&");


/***/ }),

/***/ "./resources/js/pages/admin/cms/layout/Create.vue?vue&type=template&id=33ae1fc2&":
/*!***************************************************************************************!*\
  !*** ./resources/js/pages/admin/cms/layout/Create.vue?vue&type=template&id=33ae1fc2& ***!
  \***************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_33ae1fc2___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_33ae1fc2___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_33ae1fc2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Create.vue?vue&type=template&id=33ae1fc2& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/admin/cms/layout/Create.vue?vue&type=template&id=33ae1fc2&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/ContentEditor.vue?vue&type=template&id=5f32828f&":
/*!*******************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/ContentEditor.vue?vue&type=template&id=5f32828f& ***!
  \*******************************************************************************************************************************************************************************************************************************************/
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
    "div",
    { staticClass: "flex flex-col space-y-4" },
    [
      _vm.getPageErrorMessage(_vm.content_field_slug)
        ? _c("p", { staticClass: "text-theme-danger-contrast" }, [
            _vm._v(
              "\n        " +
                _vm._s(_vm.getPageErrorMessage(_vm.content_field_slug)) +
                "\n    "
            )
          ])
        : _vm._e(),
      _vm._v(" "),
      _vm._l(_vm.templateFields, function(templateField) {
        return _c(
          "div",
          { key: templateField.id },
          [
            _c(
              _vm.getContentFieldComponent(templateField),
              {
                tag: "component",
                attrs: { templateField: templateField },
                on: { input: _vm.onEditableContentUpdate },
                model: {
                  value: _vm.editableContent[templateField.id].data,
                  callback: function($$v) {
                    _vm.$set(_vm.editableContent[templateField.id], "data", $$v)
                  },
                  expression: "editableContent[templateField.id].data"
                }
              },
              [
                _c("div", [
                  _c("p", { staticClass: "flex flex-row items-baseline" }, [
                    _c("span", [_vm._v(_vm._s(templateField.name))]),
                    _vm._v(" "),
                    templateField.is_required
                      ? _c(
                          "sup",
                          { staticClass: "text-theme-danger-contrast" },
                          [
                            _vm._v(
                              "\n                        *\n                    "
                            )
                          ]
                        )
                      : _vm._e()
                  ]),
                  _vm._v(" "),
                  templateField.description
                    ? _c(
                        "p",
                        {
                          staticClass: "text-sm text-theme-base-subtle-contrast"
                        },
                        [
                          _vm._v(
                            "\n                    " +
                              _vm._s(templateField.description) +
                              "\n                "
                          )
                        ]
                      )
                    : _vm._e()
                ])
              ]
            )
          ],
          1
        )
      })
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/ImageField.vue?vue&type=template&id=ec00e690&":
/*!*******************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/ImageField.vue?vue&type=template&id=ec00e690& ***!
  \*******************************************************************************************************************************************************************************************************************************************************/
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
    "div",
    [
      _c(
        "input-group",
        {
          attrs: {
            errorMessage: _vm.errorMessage,
            inputAutocomplete: _vm.inputName,
            inputId: _vm.inputName,
            inputName: _vm.inputName,
            inputRequired: _vm.templateField.is_required,
            inputType: "text",
            labelText: ""
          },
          model: {
            value: _vm.editableContent,
            callback: function($$v) {
              _vm.editableContent = $$v
            },
            expression: "editableContent"
          }
        },
        [_vm._t("default")],
        2
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/NumberField.vue?vue&type=template&id=fa5c47b0&":
/*!********************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/NumberField.vue?vue&type=template&id=fa5c47b0& ***!
  \********************************************************************************************************************************************************************************************************************************************************/
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
    "div",
    [
      _c(
        "input-group",
        {
          attrs: {
            errorMessage: _vm.errorMessage,
            inputAutocomplete: _vm.inputName,
            inputId: _vm.inputName,
            inputMax: _vm.inputMax,
            inputMin: _vm.inputMin,
            inputName: _vm.inputName,
            inputRequired: _vm.templateField.is_required,
            inputType: "number",
            labelText: ""
          },
          model: {
            value: _vm.editableContent,
            callback: function($$v) {
              _vm.editableContent = $$v
            },
            expression: "editableContent"
          }
        },
        [_vm._t("default")],
        2
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue?vue&type=template&id=29605912&":
/*!**********************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/TextAreaField.vue?vue&type=template&id=29605912& ***!
  \**********************************************************************************************************************************************************************************************************************************************************/
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
    "div",
    [
      _c(
        "text-area-group",
        {
          attrs: {
            errorMessage: _vm.errorMessage,
            inputAutocomplete: _vm.inputName,
            inputId: _vm.inputName,
            inputMaxLength: _vm.inputMaxLength,
            inputName: _vm.inputName,
            inputRequired: _vm.templateField.is_required,
            inputRows: _vm.inputRows,
            inputType: "text",
            labelText: ""
          },
          model: {
            value: _vm.editableContent,
            callback: function($$v) {
              _vm.editableContent = $$v
            },
            expression: "editableContent"
          }
        },
        [_vm._t("default")],
        2
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/TextField.vue?vue&type=template&id=efa102f8&":
/*!******************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/TextField.vue?vue&type=template&id=efa102f8& ***!
  \******************************************************************************************************************************************************************************************************************************************************/
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
    "div",
    [
      _c(
        "input-group",
        {
          attrs: {
            errorMessage: _vm.errorMessage,
            inputAutocomplete: _vm.inputName,
            inputId: _vm.inputName,
            inputMaxLength: _vm.inputMaxLength,
            inputName: _vm.inputName,
            inputRequired: _vm.templateField.is_required,
            inputType: "text",
            labelText: ""
          },
          model: {
            value: _vm.editableContent,
            callback: function($$v) {
              _vm.editableContent = $$v
            },
            expression: "editableContent"
          }
        },
        [_vm._t("default")],
        2
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue?vue&type=template&id=10530c06&":
/*!*********************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/admin/cms/content/content_fields/WysiwygField.vue?vue&type=template&id=10530c06& ***!
  \*********************************************************************************************************************************************************************************************************************************************************/
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
    "div",
    [
      _c(
        "text-area-group",
        {
          attrs: {
            errorMessage: _vm.errorMessage,
            inputAutocomplete: _vm.inputName,
            inputId: _vm.inputName,
            inputName: _vm.inputName,
            inputRequired: _vm.templateField.is_required,
            inputType: "text",
            labelText: ""
          },
          model: {
            value: _vm.editableContent,
            callback: function($$v) {
              _vm.editableContent = $$v
            },
            expression: "editableContent"
          }
        },
        [_vm._t("default")],
        2
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



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
      { class: _vm.formattedLabelClass, attrs: { for: _vm.inputId } },
      [
        _vm._t("default", [
          _c("span", { staticClass: "flex flex-row items-baseline" }, [
            _c("span", [_vm._v(_vm._s(_vm.labelText))]),
            _vm._v(" "),
            _vm.inputRequired
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
      ref: _vm.inputId,
      class: _vm.formattedInputClass,
      attrs: {
        id: _vm.inputId,
        autocomplete: _vm.inputAutocomplete,
        disabled: _vm.inputDisabled,
        max: _vm.inputMax,
        maxlength: _vm.inputMaxLength,
        min: _vm.inputMin,
        minlength: _vm.inputMinLength,
        name: _vm.inputName,
        placeholder: _vm.inputPlaceholder,
        required: _vm.inputRequired,
        type: _vm.inputType
      },
      domProps: { value: _vm.inputValue },
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
          _vm.isError
            ? _c("p", { class: _vm.errorClass }, [
                _vm._v(
                  "\n                " +
                    _vm._s(_vm.errorMessage) +
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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/SelectGroup.vue?vue&type=template&id=5aa394fe&":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/SelectGroup.vue?vue&type=template&id=5aa394fe& ***!
  \**********************************************************************************************************************************************************************************************************************************/
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
      { class: _vm.formattedLabelClass, attrs: { for: _vm.selectId } },
      [
        _vm._t("default", [
          _c("span", { staticClass: "flex flex-row items-baseline" }, [
            _c("span", [_vm._v(_vm._s(_vm.labelText))]),
            _vm._v(" "),
            _vm.selectRequired
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
    _c(
      "select",
      {
        ref: _vm.selectId,
        class: _vm.formattedSelectClass,
        attrs: {
          id: _vm.selectId,
          disabled: _vm.selectDisabled,
          name: _vm.selectName,
          required: _vm.selectRequired
        },
        on: {
          change: _vm.onSelectChange,
          keyup: function($event) {
            if (
              !$event.type.indexOf("key") &&
              _vm._k($event.keyCode, "esc", 27, $event.key, ["Esc", "Escape"])
            ) {
              return null
            }
            return _vm.blurSelect($event)
          }
        }
      },
      [
        _vm.selectAnyEnabled
          ? _c(
              "option",
              {
                attrs: { disabled: _vm.isOptionDisabled(_vm.selectAnyValue) },
                domProps: {
                  selected: _vm.isOptionSelected(_vm.selectAnyValue),
                  value: _vm.selectAnyValue
                }
              },
              [
                _vm._v(
                  "\n            " + _vm._s(_vm.selectAnyLabel) + "\n        "
                )
              ]
            )
          : _vm._e(),
        _vm._v(" "),
        _vm._l(_vm.formattedOptions, function(option, key) {
          return _c(
            "option",
            {
              key: _vm.selectId + "-option-" + option.value,
              attrs: { disabled: _vm.isOptionDisabled(option.value) },
              domProps: {
                selected: _vm.isOptionSelected(option.value),
                value: option.value
              }
            },
            [_vm._v("\n            " + _vm._s(option.label) + "\n        ")]
          )
        })
      ],
      2
    ),
    _vm._v(" "),
    _c(
      "div",
      [
        _c("transition", { attrs: { name: "slide-down-fade" } }, [
          _vm.isError
            ? _c("p", { class: _vm.errorClass }, [
                _vm._v(
                  "\n                " +
                    _vm._s(_vm.errorMessage) +
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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/TextAreaGroup.vue?vue&type=template&id=619eb3a0&":
/*!************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/forms/TextAreaGroup.vue?vue&type=template&id=619eb3a0& ***!
  \************************************************************************************************************************************************************************************************************************************/
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
      { class: _vm.formattedLabelClass, attrs: { for: _vm.inputId } },
      [
        _vm._t("default", [
          _c("span", { staticClass: "flex flex-row items-baseline" }, [
            _c("span", [_vm._v(_vm._s(_vm.labelText))]),
            _vm._v(" "),
            _vm.inputRequired
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
    _c("textarea", {
      ref: _vm.inputId,
      class: _vm.formattedInputClass,
      attrs: {
        id: _vm.inputId,
        autocomplete: _vm.inputAutocomplete,
        disabled: _vm.inputDisabled,
        maxlength: _vm.inputMaxLength,
        name: _vm.inputName,
        rows: _vm.inputRows,
        placeholder: _vm.inputPlaceholder,
        required: _vm.inputRequired,
        type: _vm.inputType
      },
      domProps: { value: _vm.inputValue },
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
          _vm.isError
            ? _c("p", { class: _vm.errorClass }, [
                _vm._v(
                  "\n                " +
                    _vm._s(_vm.errorMessage) +
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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/admin/cms/layout/Create.vue?vue&type=template&id=33ae1fc2&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/admin/cms/layout/Create.vue?vue&type=template&id=33ae1fc2& ***!
  \******************************************************************************************************************************************************************************************************************************/
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
    "form",
    {
      staticClass: "max-w-5xl mx-auto",
      attrs: { autocomplete: "off" },
      on: {
        submit: function($event) {
          $event.preventDefault()
          return _vm.submit($event)
        }
      }
    },
    [
      _vm.userCan("cms.create")
        ? _c(
            "div",
            { staticClass: "flex flex-row items-center mb-6" },
            [
              _c("h1", { staticClass: "mr-auto text-lg" }, [
                _vm._v("\n            Create Layout\n        ")
              ]),
              _vm._v(" "),
              _vm.userCan("cms.view")
                ? _c(
                    "inertia-link",
                    {
                      staticClass:
                        "\n                button button-default-responsive button-primary-subtle\n                flex flex-row items-center mr-2\n            ",
                      attrs: { href: _vm.$route("admin.cms.layouts.index") }
                    },
                    [
                      _c("icon-chevron-left", { staticClass: "w-5 md:mr-2" }),
                      _vm._v(" "),
                      _c("span", { staticClass: "hidden md:inline" }, [
                        _vm._v("\n                Back\n            ")
                      ])
                    ],
                    1
                  )
                : _vm._e(),
              _vm._v(" "),
              _c(
                "button",
                {
                  staticClass:
                    "\n                button button-default-responsive button-primary\n                flex flex-row items-center\n            ",
                  attrs: { type: "submit" }
                },
                [
                  _c("icon-save", { staticClass: "w-5 md:mr-2" }),
                  _vm._v(" "),
                  _c("span", { staticClass: "hidden md:inline" }, [
                    _vm._v("\n                Create Layout\n            ")
                  ])
                ],
                1
              )
            ],
            1
          )
        : _vm._e(),
      _vm._v(" "),
      _c("div", { staticClass: "bg-white py-6 shadow-subtle rounded-lg" }, [
        _c(
          "div",
          { staticClass: "block px-6 w-full" },
          [
            _c("select-group", {
              attrs: {
                errorMessage: _vm.getPageErrorMessage("template_id"),
                labelText: "Template",
                selectAnyEnabled: true,
                selectAnyLabel: "Please select a template",
                selectAutoFocus: true,
                selectId: "template_id",
                selectName: "template_id",
                selectOptions: _vm.templates,
                selectOptionLabelKey: "name",
                selectOptionValueKey: "id",
                selectRequired: true
              },
              model: {
                value: _vm.formData.template_id,
                callback: function($$v) {
                  _vm.$set(_vm.formData, "template_id", $$v)
                },
                expression: "formData.template_id"
              }
            }),
            _vm._v(" "),
            _c("input-group", {
              staticClass: "mt-4",
              attrs: {
                errorMessage: _vm.getPageErrorMessage("name"),
                inputAutocomplete: "layout_name",
                inputId: "name",
                inputName: "name",
                inputRequired: true,
                inputType: "text",
                labelText: "Layout Name"
              },
              on: { input: _vm.onNameInput },
              model: {
                value: _vm.formData.name,
                callback: function($$v) {
                  _vm.$set(_vm.formData, "name", $$v)
                },
                expression: "formData.name"
              }
            }),
            _vm._v(" "),
            _c("input-group", {
              staticClass: "mt-4",
              attrs: {
                errorMessage: _vm.getPageErrorMessage("slug"),
                inputAutocomplete: "layout_slug",
                inputId: "slug",
                inputName: "slug",
                inputRequired: true,
                inputType: "text",
                labelText: "Layout Slug"
              },
              on: { blur: _vm.onSlugBlur, input: _vm.onSlugInput },
              model: {
                value: _vm.formData.slug,
                callback: function($$v) {
                  _vm.$set(_vm.formData, "slug", $$v)
                },
                expression: "formData.slug"
              }
            })
          ],
          1
        )
      ]),
      _vm._v(" "),
      !this.isLoadingTemplate && _vm.selectedTemplateHasFields
        ? _c(
            "div",
            { staticClass: "bg-white mt-6 px-4 py-6 shadow-subtle rounded-lg" },
            [
              _c("p", { staticClass: "text-lg" }, [_vm._v("Fields")]),
              _vm._v(" "),
              _c("content-editor", {
                attrs: {
                  templateFields: this.selectedTemplate.template_fields
                },
                model: {
                  value: _vm.formData.content,
                  callback: function($$v) {
                    _vm.$set(_vm.formData, "content", $$v)
                  },
                  expression: "formData.content"
                }
              })
            ],
            1
          )
        : _vm._e()
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);