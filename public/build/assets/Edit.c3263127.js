import{_ as s,s as i}from"./vendor.d799578a.js";import{I as n}from"./InputGroup.23900402.js";import{S as l}from"./app.267c68cc.js";import{T as o}from"./TemplateFieldEditor.756d160e.js";import{n as p}from"./LogoLight.dd39b68d.js";import"./ConfirmationModal.02c27389.js";import"./vuedraggable.umd.35ed2d71.js";import"./CheckboxGroup.cbdbc77c.js";import"./checkbox-form-group.50e62bcf.js";const u={name:"AdminCmsTemplateEdit",components:{InputGroup:n,SelectGroup:l,TemplateFieldEditor:o},layout:"admin-layout",props:{repeaterTemplateFieldTypes:{type:Object,required:!0},template:{type:Object,required:!0},templateFieldSettings:{type:Object,required:!0},templateFieldTypes:{type:Object,required:!0},templateTypes:{type:Object,required:!0}},data(){return{autoUpdateSlug:!1,formData:{}}},computed:{allowedTemplateFieldTypes(){return this.formData.type==="repeater"?this.repeaterTemplateFieldTypes:this.templateFieldTypes}},created(){this.formData=s.cloneDeep(this.template)},methods:{onNameInput(){!this.autoUpdateSlug||(this.formData.slug=this.slugify(this.formData.name))},onSlugBlur(){this.formData.slug=this.slugify(this.formData.slug)},slugify(r){return!r||!r.length?"":i(r,{lower:!0})},submit(){this.$inertia.put(this.$route("admin.cms.templates.update",this.template.id),this.formData)}}};var m=function(){var e=this,t=e._self._c;return t("form",{staticClass:"max-w-5xl mx-auto",attrs:{autocomplete:"off"},on:{submit:function(a){return a.preventDefault(),e.submit.apply(null,arguments)}}},[e.userCan("cms_advanced.edit")?t("div",{staticClass:"flex flex-row items-center mb-6"},[t("h1",{staticClass:"font-medium mr-auto text-lg"},[e._v(" Edit Template - "+e._s(e.template.name)+" ")]),e.userCan("cms_advanced.view")?t("inertia-link",{staticClass:"button button-default-responsive button-primary-subtle flex flex-row items-center mr-2",attrs:{href:e.$route("admin.cms.templates.index")}},[t("icon-chevron-left",{staticClass:"w-5 md:mr-2"}),t("span",{staticClass:"hidden md:inline"},[e._v(" Back ")])],1):e._e(),t("button",{staticClass:"button button-default-responsive button-primary flex flex-row items-center",attrs:{type:"submit"}},[t("icon-save",{staticClass:"w-5 md:mr-2"}),t("span",{staticClass:"hidden md:inline"},[e._v(" Save Changes ")])],1)],1):e._e(),t("div",{staticClass:"bg-white py-6 shadow-subtle rounded-lg"},[t("div",{staticClass:"block px-6 w-full"},[t("select-group",{attrs:{"error-message":e.getPageErrorMessage("type"),"label-text":"Template Type","input-any-option-enabled":!0,"input-any-option-label":"Please select a template type","input-autofocus":!0,"input-disabled":!0,"input-id":"type","input-name":"type","input-options":e.templateTypes,"input-required":!0},on:{errorHidden:function(a){return e.clearPageErrorMessage("type")}},model:{value:e.formData.type,callback:function(a){e.$set(e.formData,"type",a)},expression:"formData.type"}}),t("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("name"),"input-autocomplete":"template_name","input-id":"name","input-name":"name","input-required":!0,"input-type":"text","label-text":"Template Name"},on:{errorHidden:function(a){return e.clearPageErrorMessage("name")},input:e.onNameInput},model:{value:e.formData.name,callback:function(a){e.$set(e.formData,"name",a)},expression:"formData.name"}}),t("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("slug"),"input-autocomplete":"template_slug","input-id":"slug","input-name":"slug","input-required":!0,"input-type":"text","label-text":"Template Slug"},on:{blur:e.onSlugBlur,errorHidden:function(a){return e.clearPageErrorMessage("slug")}},model:{value:e.formData.slug,callback:function(a){e.$set(e.formData,"slug",a)},expression:"formData.slug"}}),t("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("description"),"input-autocomplete":"template_description","input-id":"description","input-name":"description","input-type":"text","label-text":"Description"},on:{errorHidden:function(a){return e.clearPageErrorMessage("description")}},model:{value:e.formData.description,callback:function(a){e.$set(e.formData,"description",a)},expression:"formData.description"}})],1)]),t("div",{staticClass:"bg-white mt-6 py-6 shadow-subtle rounded-lg"},[t("div",{staticClass:"block px-6 w-full"},[t("template-field-editor",{attrs:{"is-editing":!0,"template-field-settings":e.templateFieldSettings,"template-field-types":e.allowedTemplateFieldTypes},model:{value:e.formData.template_fields,callback:function(a){e.$set(e.formData,"template_fields",a)},expression:"formData.template_fields"}})],1)])])},d=[],c=p(u,m,d,!1,null,null,null,null);const C=c.exports;export{C as default};
