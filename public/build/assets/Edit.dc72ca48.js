import{_ as s,s as r}from"./vendor.21c2b6f5.js";import{I as o}from"./InputGroup.548575c6.js";import{M as u,U as p}from"./UrlEditor.5b81ba5d.js";import{S as d}from"./app.7f65178f.js";import{n as m}from"./LogoLight.eb2f8316.js";import"./DateTimePickerGroup.f713b50e.js";import"./InlineCheckboxGroup.03ba61c7.js";import"./checkbox-form-group.50e62bcf.js";import"./ConfirmationModal.41eb8e05.js";let n=axios.CancelToken,i=n.source();const c={name:"AdminCmsPageEdit",components:{InputGroup:o,MetadataEditor:u,SelectGroup:d,UrlEditor:p},layout:"admin-layout",props:{layouts:{type:Object,required:!0},page:{type:Object,required:!0},parentPages:{type:Object|Array|null,required:!0},templates:{type:Object,required:!0}},data(){return{autoUpdateSlug:!1,formData:{},isInitialisedTemplate:!1,isInitialisedContent:!1,isInitialised_url:!1,isLoadingTemplate:!1,isUrlAvailable:!1,selectedTemplate:null}},computed:{fullPageSlug(){if(!this.formData.slug)return"";let t=this.formData.slug;return this.selectedParentPageUrl&&(t=this.selectedParentPageUrl+"/"+t),t},parentPagesUrls(){try{if(!Object.keys(this.parentPages).length)return null;let t={};return s.forEach(this.parentPages,(e,a)=>{t[a]={id:e.id,label:e.name+" => "+e.url.url_full,url_full:e.url.url_full,url_main:e.url.url_main}}),t}catch{return null}},parentPagesMap(){try{if(!Object.keys(this.parentPages).length)return null;let t={};return s.forEach(this.parentPages,(e,a)=>{t[e.id]=a}),t}catch{return null}},selectedParentPage(){try{return this.formData.parent_id?this.parentPages[this.parentPagesMap[this.formData.parent_id]]:null}catch{return null}},selectedParentPageUrl(){try{return this.selectedParentPage.url.url_full}catch{return null}},selectedTemplateHasFields(){try{return this.selectedTemplate?this.selectedTemplate.template_fields.length:!1}catch{return!1}},selectedTemplateId(){var t;return(t=this.formData.template_id)!=null?t:""}},created(){this.formData={content:{},id:this.page.id,layout_id:this.page.layout_id,metadata:s.cloneDeep(this.page.metadata),name:this.page.name,parent_id:this.page.parent_id,slug:this.page.slug,template_id:this.page.template_id,url:{}},this.selectedTemplate=s.cloneDeep(this.page.template),this.setInitialContent(),this.setInitialUrl()},methods:{cancelLoadTemplate(){this.isLoadingTemplate&&(i.cancel("Template load cancelled"),i=n.source())},doesObjectHaveKeys(t){try{return Object.keys(t).length}catch{return!1}},pageHasContentField(t){try{return this.page.content.hasOwnProperty(t)}catch{return!1}},onNameInput(){!this.autoUpdateSlug||(this.formData.slug=this.slugify(this.formData.name))},onSelectedTemplateIdChange:s.debounce(function(){if(!this.isInitialisedTemplate){this.isInitialisedTemplate=!0;return}this.selectedTemplate=null,this.cancelLoadTemplate(),this.selectedTemplateId&&(this.isLoadingTemplate=!0,axios.get(this.$route("admin.api.cms.templates.show",this.selectedTemplateId)).then(t=>{this.selectedTemplate=s.cloneDeep(t.data.data),this.setNewTemplateContent()}).catch(t=>{axios.isCancel(t)||(this.$errorToast("Failed to load selected template"),console.log(t))}).finally(()=>{this.isLoadingTemplate=!1}))},500),onSlugBlur(){this.formData.slug=this.slugify(this.formData.slug)},onSlugInput(){this.autoUpdateSlug=!1},onUrlIsAvailableEvent(t){this.isUrlAvailable=t},setInitialContent(){let t={};this.doesObjectHaveKeys(this.page.content)&&(t=s.cloneDeep(this.page.content)),s.forEach(this.selectedTemplate.template_fields,e=>{this.pageHasContentField(e.id)||(t[e.id]={data:"",template_field_id:e.id})}),this.formData.content=s.cloneDeep(t),this.isInitialisedContent=!0},setInitialUrl(){let t={};this.doesObjectHaveKeys(this.page.url)&&(t=s.cloneDeep(this.page.url)),this.formData.url=s.cloneDeep(t),this.isInitialised_url=!0},setNewTemplateContent(){this.selectedTemplateHasFields||(this.formData.content={});let t={};s.forEach(this.selectedTemplate.template_fields,e=>{t[e.id]={data:"",template_field_id:e.id}}),this.$set(this.formData,"content",s.cloneDeep(t))},slugify(t){return!t||!t.length?"":r(t,{lower:!0})},submit(){if(!this.isUrlAvailable){this.$errorToast("Unable to save page. URL is unavailable");return}this.$inertia.put(this.$route("admin.cms.pages.update",this.page.id),this.formData)}},watch:{selectedTemplateId:{handler:"onSelectedTemplateIdChange"}}};var g=function(){var e=this,a=e._self._c;return a("form",{staticClass:"max-w-5xl mx-auto",attrs:{autocomplete:"off"},on:{submit:function(l){return l.preventDefault(),e.submit.apply(null,arguments)}}},[e.userCan("cms.edit")?a("div",{staticClass:"flex flex-row items-center mb-6 sticky-menu"},[a("h1",{staticClass:"font-medium mr-auto text-lg"},[e._v(" Edit Page ")]),e.userCan("cms.view")?a("inertia-link",{staticClass:"button button-default-responsive button-primary-subtle flex flex-row items-center mr-2",attrs:{href:e.$route("admin.cms.pages.index")}},[a("icon-chevron-left",{staticClass:"w-5 md:mr-2"}),a("span",{staticClass:"hidden md:inline"},[e._v(" Back ")])],1):e._e(),a("button",{staticClass:"button button-default-responsive button-primary flex flex-row items-center",attrs:{type:"submit"}},[a("icon-save",{staticClass:"w-5 md:mr-2"}),a("span",{staticClass:"hidden md:inline"},[e._v(" Save Changes ")])],1)],1):e._e(),a("div",{staticClass:"bg-white py-6 shadow-subtle rounded-lg"},[a("div",{staticClass:"block px-6 w-full"},[a("select-group",{attrs:{"error-message":e.getPageErrorMessage("layout_id"),"label-text":"Layout","input-any-option-enabled":!0,"input-any-option-label":"Please select a Layout","input-autofocus":!0,"input-id":"layout_id","input-name":"layout_id","input-options":e.layouts,"input-option-label-key":"name","input-option-value-key":"id","input-required":!0},on:{errorHidden:function(l){return e.clearPageErrorMessage("layout_id")}},model:{value:e.formData.layout_id,callback:function(l){e.$set(e.formData,"layout_id",l)},expression:"formData.layout_id"}}),a("select-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("template_id"),"label-text":"Template","input-any-option-enabled":!0,"input-any-option-label":"Please select a template","input-id":"template_id","input-name":"template_id","input-options":e.templates,"input-option-label-key":"name","input-option-value-key":"id","input-required":!0},on:{errorHidden:function(l){return e.clearPageErrorMessage("template_id")}},model:{value:e.formData.template_id,callback:function(l){e.$set(e.formData,"template_id",l)},expression:"formData.template_id"}}),e.parentPagesUrls?a("select-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("parent_id"),"label-text":"Parent Page","input-any-option-enabled":!0,"input-any-option-label":"Please select a parent (optional)","input-id":"parent_id","input-name":"parent_id","input-options":e.parentPagesUrls,"input-option-label-key":"label","input-option-value-key":"id"},on:{errorHidden:function(l){return e.clearPageErrorMessage("parent_id")}},model:{value:e.formData.parent_id,callback:function(l){e.$set(e.formData,"parent_id",l)},expression:"formData.parent_id"}}):e._e(),a("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("name"),"input-autocomplete":"page_name","input-id":"name","input-name":"name","input-required":!0,"input-type":"text","label-text":"Page Name"},on:{errorHidden:function(l){return e.clearPageErrorMessage("name")},input:e.onNameInput},model:{value:e.formData.name,callback:function(l){e.$set(e.formData,"name",l)},expression:"formData.name"}}),a("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("slug"),"input-autocomplete":"page_slug","input-id":"slug","input-name":"slug","input-required":!0,"input-type":"text","label-text":"Page Slug"},on:{blur:e.onSlugBlur,errorHidden:function(l){return e.clearPageErrorMessage("slug")},input:e.onSlugInput},model:{value:e.formData.slug,callback:function(l){e.$set(e.formData,"slug",l)},expression:"formData.slug"}}),a("input-group",{staticClass:"mt-4",attrs:{"input-id":"slug","input-name":"full_page_slug","input-disabled":!0,"input-type":"text","label-text":"Full Page Slug"},model:{value:e.fullPageSlug,callback:function(l){e.fullPageSlug=l},expression:"fullPageSlug"}})],1)]),a("div",{staticClass:"bg-white mt-6 overflow-x-hidden px-6 py-6 shadow-subtle rounded-lg"},[a("metadata-editor",{model:{value:e.formData.metadata,callback:function(l){e.$set(e.formData,"metadata",l)},expression:"formData.metadata"}})],1),e.isInitialised_url?a("div",{staticClass:"bg-white mt-6 px-6 py-6 shadow-subtle rounded-lg"},[a("url-editor",{attrs:{"parent-url":e.selectedParentPageUrl},on:{isAvailable:e.onUrlIsAvailableEvent},model:{value:e.formData.url,callback:function(l){e.$set(e.formData,"url",l)},expression:"formData.url"}})],1):e._e(),!this.isLoadingTemplate&&e.selectedTemplateHasFields&&e.isInitialisedContent?a("div",{staticClass:"bg-white mt-6 px-4 py-6 shadow-subtle rounded-lg"},[a("p",{staticClass:"text-lg"},[e._v("Fields")]),a("content-editor",{staticClass:"mt-4",attrs:{"template-fields":e.selectedTemplate.template_fields},model:{value:e.formData.content,callback:function(l){e.$set(e.formData,"content",l)},expression:"formData.content"}})],1):e._e()])},f=[],h=m(c,g,f,!1,null,null,null,null);const I=h.exports;export{I as default};