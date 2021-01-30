(self.webpackChunk=self.webpackChunk||[]).push([[546],{952:(e,t,n)=>{"use strict";n.d(t,{S:()=>i});var i={model:{prop:"inputValue"},props:{errorClass:{default:"mt-1 text-red-500 text-sm",type:String},errorHideOnInput:{default:!0,type:Boolean},errorMessage:{default:"",type:String},inputAutofocus:{default:!1,type:Boolean},inputClass:{default:"border border-theme-base-subtle font-medium px-3 py-2 rounded w-full focus:border-theme-primary focus:outline-none focus:ring-0",type:String},inputDisabled:{default:!1,type:Boolean},inputId:{required:!0,type:String},inputName:{required:!0,type:String},inputRequired:{default:!1,type:Boolean},inputValue:{default:"",type:String|Number},inputWrapperClass:{default:"",type:String},labelClass:{default:"font-medium mb-2 text-theme-base-contrast text-sm tracking-wider",type:String},labelHidden:{default:!1,type:Boolean},labelText:{required:!0,type:String}},data:function(){return{hideError:!1}},computed:{formattedInputClass:function(){return this.isError?this.inputClass+" error":this.inputClass},formattedLabelClass:function(){var e=this.labelClass;return this.labelHidden&&(e+=" hidden"),e},isError:function(){return!(this.hideError||!this.errorMessage||""===this.errorMessage)}},methods:{autofocus:function(){var e=this;this.inputAutofocus&&this.$refs[this.inputId]&&this.$nextTick((function(){e.$refs[e.inputId].focus()}))},blurInput:function(){var e=this;this.$refs[this.inputId]&&this.$nextTick((function(){e.$refs[e.inputId].blur()}))},onErrorMessageChange:function(){this.hideError=!1},onInput:function(){this.$emit("input",this.$refs[this.inputId].value),this.errorHideOnInput&&(this.hideError=!0)},onInputBlur:function(){this.$emit("blur")}},watch:{errorMessage:{handler:"onErrorMessageChange"}}}},4041:(e,t,n)=>{"use strict";n.d(t,{H:()=>i});var i={props:{inputValue:{default:!1,type:String|Number|Boolean},inputValueFalse:{default:!1,type:String|Number|Boolean},inputValueTrue:{default:!0,type:String|Number|Boolean}},data:function(){return{editableValue:!1}},computed:{isChecked:function(){return this.editableValue===this.inputValueTrue}},mounted:function(){this.editableValue=this.inputValue,this.autofocus()},methods:{onInput:function(){this.$emit("input",this.isChecked?this.inputValueTrue:this.inputValueFalse),this.errorHideOnInput&&(this.hideError=!0)}}}},5643:(e,t,n)=>{"use strict";n.d(t,{Z:()=>A});var i=n(6486),a=n.n(i),r={model:{prop:"content"},props:{content:{required:!0},templateField:{required:!0,type:Object}},data:function(){return{editableContent:""}},computed:{errorMessage:function(){try{return Array.isArray(this.inputErrors)?this.inputErrors[0]:this.inputErrors}catch(e){return!1}},inputErrors:function(){var e=this;try{var t=[];return a().forEach(this.$page.props.errors,(function(n,i){0===i.indexOf(e.inputName)&&(n=a().replace(n,e.inputName+".",""),n=a().replace(n,e.inputName,""),t.push(n))})),t}catch(e){return!1}},inputName:function(){return"content."+this.templateField.id}},created:function(){this.editableContent=a().cloneDeep(this.content)},methods:{onEditableContentUpdate:a().debounce((function(){this.$emit("input",this.editableContent)}),100)},watch:{editableContent:{deep:!0,handler:"onEditableContentUpdate"}}},l=n(3764);const s={name:"ImageField",mixins:[r],components:{InputGroup:l.Z},methods:{onFileManagerFileSelected:function(e){try{this.editableContent=e.url}catch(e){this.$errorToast(e)}},openFileManagerModal:function(){this.$store.commit("openFileManagerModel",this.onFileManagerFileSelected)}}};var o=n(1900);const u=(0,o.Z)(s,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("input-group",{attrs:{"error-message":e.errorMessage,"input-autocomplete":e.inputName,"input-class":"border border-theme-base-subtle font-medium px-3 py-2 rounded-l w-full focus:border-theme-primary focus:outline-none focus:ring-0","input-id":e.inputName,"input-name":e.inputName,"input-required":e.templateField.is_required,"input-type":"text","input-wrapper-class":"flex flex-row items-center","label-class":"","label-text":""},scopedSlots:e._u([{key:"default",fn:function(){return[e._t("default")]},proxy:!0},{key:"inputAppend",fn:function(){return[n("button",{staticClass:"border border-l-0 border-theme-primary-subtle button button-primary-subtle rounded-l-none",attrs:{type:"button"},on:{click:e.openFileManagerModal}},[e._v("\n                Browse...\n            ")])]},proxy:!0}],null,!0),model:{value:e.editableContent,callback:function(t){e.editableContent=t},expression:"editableContent"}})],1)}),[],!1,null,null,null).exports;const p={name:"NumberField",mixins:[r],components:{InputGroup:l.Z},computed:{inputMax:function(){try{return this.templateField.settings.max}catch(e){return""}},inputMin:function(){try{return this.templateField.settings.min}catch(e){return""}}}};const d=(0,o.Z)(p,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("input-group",{attrs:{"error-message":e.errorMessage,"input-autocomplete":e.inputName,"input-id":e.inputName,"input-max":e.inputMax,"input-min":e.inputMin,"input-name":e.inputName,"input-required":e.templateField.is_required,"input-type":"number","label-class":"","label-text":""},model:{value:e.editableContent,callback:function(t){e.editableContent=t},expression:"editableContent"}},[e._t("default")],2)],1)}),[],!1,null,null,null).exports;var c=n(952),m=n(1147);const f={name:"TextAreaGroup",mixins:[c.S],components:{FormFieldError:m.Z},props:{inputAutocomplete:{default:"",type:String},inputMaxLength:{default:"",type:String|Number},inputPlaceholder:{default:"",type:String},inputRows:{default:"",type:String|Number},inputType:{default:"text",type:String}},mounted:function(){this.autofocus()}};const h={name:"TextAreaField",mixins:[r],components:{TextAreaGroup:(0,o.Z)(f,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"flex flex-col"},[n("label",{class:e.formattedLabelClass,attrs:{for:e.inputId}},[e._t("default",[n("span",{staticClass:"flex flex-row items-baseline"},[n("span",[e._v(e._s(e.labelText))]),e._v(" "),e.inputRequired?n("sup",{staticClass:"text-theme-danger-contrast"},[e._v("\n                    *\n                ")]):e._e()])])],2),e._v(" "),n("textarea",{ref:e.inputId,class:e.formattedInputClass,attrs:{id:e.inputId,autocomplete:e.inputAutocomplete,disabled:e.inputDisabled,maxlength:e.inputMaxLength,name:e.inputName,rows:e.inputRows,placeholder:e.inputPlaceholder,required:e.inputRequired,type:e.inputType},domProps:{value:e.inputValue},on:{blur:e.onInputBlur,input:e.onInput,keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"esc",27,t.key,["Esc","Escape"])?null:e.blurInput(t)}}}),e._v(" "),n("form-field-error",{attrs:{"error-class":e.errorClass,"error-message":e.errorMessage,"is-error":e.isError}})],1)}),[],!1,null,null,null).exports},computed:{inputMaxLength:function(){try{return this.templateField.settings.max_length}catch(e){return""}},inputRows:function(){try{return this.templateField.settings.rows}catch(e){return""}}}};const b=(0,o.Z)(h,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("text-area-group",{attrs:{"error-message":e.errorMessage,"input-autocomplete":e.inputName,"input-id":e.inputName,"input-max-length":e.inputMaxLength,"input-name":e.inputName,"input-required":e.templateField.is_required,"input-rows":e.inputRows,"input-type":"text","label-class":"","label-text":""},model:{value:e.editableContent,callback:function(t){e.editableContent=t},expression:"editableContent"}},[e._t("default")],2)],1)}),[],!1,null,null,null).exports;const g={name:"TextField",mixins:[r],components:{InputGroup:l.Z},computed:{inputMaxLength:function(){try{return this.templateField.settings.max_length}catch(e){return""}}}};const y=(0,o.Z)(g,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("input-group",{attrs:{"error-message":e.errorMessage,"input-autocomplete":e.inputName,"input-id":e.inputName,"input-max-length":e.inputMaxLength,"input-name":e.inputName,"input-required":e.templateField.is_required,"input-type":"text","label-class":"","label-text":""},model:{value:e.editableContent,callback:function(t){e.editableContent=t},expression:"editableContent"}},[e._t("default")],2)],1)}),[],!1,null,null,null).exports;var v,_=["onActivate","onAddUndo","onBeforeAddUndo","onBeforeExecCommand","onBeforeGetContent","onBeforeRenderUI","onBeforeSetContent","onBeforePaste","onBlur","onChange","onClearUndos","onClick","onContextMenu","onCopy","onCut","onDblclick","onDeactivate","onDirty","onDrag","onDragDrop","onDragEnd","onDragGesture","onDragOver","onDrop","onExecCommand","onFocus","onFocusIn","onFocusOut","onGetContent","onHide","onInit","onKeyDown","onKeyPress","onKeyUp","onLoadContent","onMouseDown","onMouseEnter","onMouseLeave","onMouseMove","onMouseOut","onMouseOver","onMouseUp","onNodeChange","onObjectResizeStart","onObjectResized","onObjectSelected","onPaste","onPostProcess","onPostRender","onPreProcess","onProgressState","onRedo","onRemove","onReset","onSaveContent","onSelectionChange","onSetAttrib","onSetContent","onShow","onSubmit","onUndo","onVisualAid"],x=function(e){return-1!==_.map((function(e){return e.toLowerCase()})).indexOf(e.toLowerCase())},C=function(e,t,n){var i=t.$props.value?t.$props.value:"",a=t.$props.initialValue?t.$props.initialValue:"";n.setContent(i||(t.initialized?t.cache:a)),t.$watch("value",(function(e,i){n&&"string"==typeof e&&e!==i&&e!==n.getContent({format:t.$props.outputFormat})&&n.setContent(e)})),t.$listeners.input&&function(e,t){var n=e.$props.modelEvents?e.$props.modelEvents:null,i=Array.isArray(n)?n.join(" "):n;t.on(i||"change input undo redo",(function(){e.$emit("input",t.getContent({format:e.$props.outputFormat}))}))}(t,n),function(e,t,n){Object.keys(t).filter(x).forEach((function(i){var a=t[i];"function"==typeof a&&("onInit"===i?a(e,n):n.on(i.substring(2),(function(e){return a(e,n)})))}))}(e,t.$listeners,n),t.initialized=!0},k=0,I=function(e){var t=Date.now();return e+"_"+Math.floor(1e9*Math.random())+ ++k+String(t)},U=function(e){return void 0===e||""===e?[]:Array.isArray(e)?e:e.split(" ")},S=function(){return{listeners:[],scriptId:I("tiny-script"),scriptLoaded:!1}},E=(v=S(),{load:function(e,t,n){v.scriptLoaded?n():(v.listeners.push(n),e.getElementById(v.scriptId)||function(e,t,n,i){var a=t.createElement("script");a.referrerPolicy="origin",a.type="application/javascript",a.id=e,a.src=n;var r=function(){a.removeEventListener("load",r),i()};a.addEventListener("load",r),t.head&&t.head.appendChild(a)}(v.scriptId,e,t,(function(){v.listeners.forEach((function(e){return e()})),v.scriptLoaded=!0})))},reinitialize:function(){v=S()}}),D=function(){var e="undefined"!=typeof window?window:n.g;return e&&e.tinymce?e.tinymce:null},$={apiKey:String,cloudChannel:String,id:String,init:Object,initialValue:String,inline:Boolean,modelEvents:[String,Array],plugins:[String,Array],tagName:String,toolbar:[String,Array],value:String,disabled:Boolean,tinymceScriptSrc:String,outputFormat:{type:String,validator:function(e){return"html"===e||"text"===e}}},F=function(){return(F=Object.assign||function(e){for(var t,n=1,i=arguments.length;n<i;n++)for(var a in t=arguments[n])Object.prototype.hasOwnProperty.call(t,a)&&(e[a]=t[a]);return e}).apply(this,arguments)},w=function(e){return function(){var t,n,i,a=F(F({},e.$props.init),{readonly:e.$props.disabled,selector:"#"+e.elementId,plugins:(t=e.$props.init&&e.$props.init.plugins,n=e.$props.plugins,U(t).concat(U(n))),toolbar:e.$props.toolbar||e.$props.init&&e.$props.init.toolbar,inline:e.inlineEditor,setup:function(t){e.editor=t,t.on("init",(function(n){return C(n,e,t)})),e.$props.init&&"function"==typeof e.$props.init.setup&&e.$props.init.setup(t)}});null!==(i=e.element)&&"textarea"===i.tagName.toLowerCase()&&(e.element.style.visibility="",e.element.style.display=""),D().init(a)}};const M={name:"WysiwygField",mixins:[r],components:{editor:{props:$,created:function(){this.elementId=this.$props.id||I("tiny-vue"),this.inlineEditor=this.$props.init&&this.$props.init.inline||this.$props.inline,this.initialized=!1},watch:{disabled:function(){this.editor.setMode(this.disabled?"readonly":"design")}},mounted:function(){if(this.element=this.$el,null!==D())w(this)();else if(this.element&&this.element.ownerDocument){var e=this.$props.cloudChannel?this.$props.cloudChannel:"5",t=this.$props.apiKey?this.$props.apiKey:"no-api-key",n=null==this.$props.tinymceScriptSrc?"https://cdn.tiny.cloud/1/"+t+"/tinymce/"+e+"/tinymce.min.js":this.$props.tinymceScriptSrc;E.load(this.element.ownerDocument,n,w(this))}},beforeDestroy:function(){null!==D()&&D().remove(this.editor)},deactivated:function(){var e;this.inlineEditor||(this.cache=this.editor.getContent(),null===(e=D())||void 0===e||e.remove(this.editor))},activated:function(){!this.inlineEditor&&this.initialized&&w(this)()},render:function(e){return this.inlineEditor?function(e,t,n){return e(n||"div",{attrs:{id:t}})}(e,this.elementId,this.$props.tagName):function(e,t){return e("textarea",{attrs:{id:t},style:{visibility:"hidden"}})}(e,this.elementId)}}},data:function(){return{editorFilePickerCallback:null}},computed:{editorConfig:function(){return{content_css:"/css/app.css",file_picker_callback:this.onEditorFilePicker,formats:{alignleft:{selector:"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img",classes:"text-left"},aligncenter:{selector:"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img",classes:"text-center"},alignright:{selector:"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img",classes:"text-right"},alignjustify:{selector:"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img",classes:"text-justify"},bold:{inline:"strong",classes:"font-bold"},italic:{inline:"em",classes:"italic"},underline:{inline:"span",classes:"underline"},strikethrough:{inline:"span",classes:"line-through"}},min_height:300,plugins:"code fullscreen image",skin:"TVI",skin_url:"/vendor/tinymce/skins/tvi",toolbar:"fullscreen code styleselect bold italic alignleft aligncenter alignright image"}}},beforeDestroy:function(){this.$refs.editor.editor.destroy()},methods:{onEditorFilePicker:function(e,t,n){this.editorFilePickerCallback=e,this.$store.commit("openFileManagerModel",this.onFileManagerFileSelected)},onFileManagerFileSelected:function(e){try{this.editorFilePickerCallback(e.url,{alt:e.meta.filename?e.meta.filename:""}),this.editorFilePickerCallback=null}catch(e){this.$errorToast(e)}}}};function T(e){return(T="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}const P={name:"AdminCmsContentEditor",components:{ImageField:u,NumberField:d,TextAreaField:b,TextField:y,WysiwygField:(0,o.Z)(M,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[e._t("default"),e._v(" "),n("editor",{ref:"editor",attrs:{"api-key":"yjslf080227w394afqv4gkul5yer7sxjorf08kvjgztc1n0i",init:e.editorConfig},model:{value:e.editableContent,callback:function(t){e.editableContent=t},expression:"editableContent"}})],2)}),[],!1,null,null,null).exports},model:{prop:"content"},props:{content:{required:!0,type:Array|Object},content_field_slug:{default:"content",type:String},templateFields:{required:!0,type:Array}},data:function(){return{editableContent:{}}},created:function(){"object"===T(this.content)&&Object.keys(this.content).length>0&&(this.editableContent=a().cloneDeep(this.content))},methods:{getContentFieldComponent:function(e){switch(e.type){case"image":return"ImageField";case"number":return"NumberField";case"text":return"TextField";case"textarea":return"TextAreaField";case"wysiwyg":return"WysiwygField";default:return this.$errorToast("Unregistered content field for template field: "+e.type),!1}},onEditableContentUpdate:function(){this.$emit("input",a().cloneDeep(this.editableContent))}}};const A=(0,o.Z)(P,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"flex flex-col space-y-4"},[e.getPageErrorMessage(e.content_field_slug)?n("p",{staticClass:"text-theme-danger-contrast"},[e._v("\n        "+e._s(e.getPageErrorMessage(e.content_field_slug))+"\n    ")]):e._e(),e._v(" "),e._l(e.templateFields,(function(t){return n("div",{key:t.id},[n(e.getContentFieldComponent(t),{tag:"component",attrs:{"template-field":t},on:{input:e.onEditableContentUpdate},model:{value:e.editableContent[t.id].data,callback:function(n){e.$set(e.editableContent[t.id],"data",n)},expression:"editableContent[templateField.id].data"}},[n("div",{staticClass:"mb-2"},[n("p",{staticClass:"flex flex-row font-medium items-baseline text-theme-base-contrast text-sm tracking-wider"},[n("span",[e._v(e._s(t.name))]),e._v(" "),t.is_required?n("sup",{staticClass:"text-theme-danger-contrast"},[e._v("\n                        *\n                    ")]):e._e()]),e._v(" "),t.description?n("p",{staticClass:"text-sm text-theme-base-subtle-contrast"},[e._v("\n                    "+e._s(t.description)+"\n                ")]):e._e()])])],1)}))],2)}),[],!1,null,null,null).exports},1184:(e,t,n)=>{"use strict";n.d(t,{Z:()=>g});var i=n(6486),a=n.n(i),r=n(1304),l=n.n(r),s=n(952),o=n(1147);const u={name:"DateTimePickerGroup",mixins:[s.S],components:{FormFieldError:o.Z},props:{inputClass:{default:"",type:String},inputFormat:{default:"DD/MM/YYYY HH:mm",type:String},inputPlaceholder:{default:"Please select a date",type:String},inputTimeTitleFormat:{default:"DD/MM/YYYY HH:mm",type:String},inputTitleFormat:{default:"DD/MM/YYYY HH:mm",type:String},inputType:{default:"datetime",type:String},inputValueType:{default:"YYYY-MM-DD HH:mm",type:String}},data:function(){return{editableInput:"",isInitialised:!1}},mounted:function(){var e=this;this.editableInput=this.inputValue,this.$nextTick((function(){e.isInitialised=!0}))},methods:{onInput:function(){this.isInitialised&&(this.$emit("input",this.editableInput),this.errorHideOnInput&&(this.hideError=!0))},onInputValueChange:function(){this.inputValue!==this.editableInput&&(this.editableInput=this.inputValue)}},watch:{editableInput:{handler:"onInput"},inputValue:{handler:"onInputValueChange"}}};var p=n(1900);const d=(0,p.Z)(u,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"flex flex-col"},[n("label",{class:e.formattedLabelClass,attrs:{for:e.inputId}},[e._t("default",[n("span",{staticClass:"flex flex-row items-baseline"},[n("span",[e._v(e._s(e.labelText))]),e._v(" "),e.inputRequired?n("sup",{staticClass:"text-theme-danger-contrast"},[e._v("\n                    *\n                ")]):e._e()])])],2),e._v(" "),n("date-picker",{class:e.formattedInputClass,attrs:{id:e.inputId,disabled:e.inputDisabled,format:e.inputFormat,placeholder:e.inputPlaceholder,required:e.inputRequired,"time-title-format":e.inputTimeTitleFormat,"title-format":e.inputTitleFormat,type:e.inputType,"value-type":e.inputValueType},model:{value:e.editableInput,callback:function(t){e.editableInput=t},expression:"editableInput"}}),e._v(" "),n("form-field-error",{attrs:{"error-class":e.errorClass,"error-message":e.errorMessage,"is-error":e.isError}})],1)}),[],!1,null,null,null).exports;var c=n(1274),m=n(3764),f=axios.CancelToken,h=f.source();const b={name:"UrlEditor",components:{DateTimePickerGroup:d,InlineCheckboxGroup:c.Z,InputGroup:m.Z},model:{prop:"urlData"},props:{computedUrl:{default:"",type:String},parentUrl:{default:null,type:null|String},urlData:{required:!0,type:null|Object}},data:function(){return{autoUpdateUrl:!0,editableUrlData:{expired_at:null,is_enabled:!1,published_at:null,url_main:""},isUrlChecked:!1,isUrlCheckLoading:!1,isUrlAvailable:!1,urlInput:""}},computed:{urlFull:function(){var e="";return this.parentUrl&&this.parentUrl.length&&(e+=this.parentUrl),(e+=this.urlInputSlugified).split("//").join("/")},urlInputSlugified:function(){if(!this.urlInput)return"/";var e=this.urlInput;return e.trim(),e.length?(0!==(e=l()(e,{lower:!0})).indexOf("/")&&(e="/"+e),e):"/"}},created:function(){try{var e;if(this.urlData&&Object.keys(this.urlData).length)this.editableUrlData=a().cloneDeep(this.urlData),this.urlInput=null!==(e=this.editableUrlData.url_main)&&void 0!==e?e:"";this.urlInput&&""!==this.urlInput&&(this.autoUpdateUrl=!1)}catch(e){return}},methods:{cancelUrlCheck:function(){this.isUrlCheckLoading&&(h.cancel("URL check cancelled"),h=f.source())},checkUrlIsAvailable:a().debounce((function(){var e=this;if(this.isUrlChecked=!1,this.cancelUrlCheck(),this.isUrlChecked=!1,this.isUrlAvailable=!1,this.urlInput.length){this.isUrlCheckLoading=!0;var t={url:this.urlFull,url_id:this.urlData.id?this.urlData.id:null};axios.get(this.$route("admin.api.cms.urls.available"),{params:t,cancelToken:h.token}).then((function(t){e.isUrlCheckLoading=!1,e.isUrlChecked=!0,e.isUrlAvailable=t.data})).catch((function(t){axios.isCancel(t)||(e.isUrlCheckLoading=!1,e.$errorToast("Failed to check URL availability"))}))}}),500),onComputedUrlUpdate:function(){this.autoUpdateUrl&&this.updateUrl(this.computedUrl)},onEditableUrlUpdate:a().debounce((function(){this.$emit("input",this.editableUrlData)}),100),onIsUrlAvailableUpdate:function(){this.$emit("isAvailable",this.isUrlAvailable)},onUrlInputInput:function(){this.autoUpdateUrl=!1,this.isUrlChecked=!1},onUrlInputUpdate:a().debounce((function(){this.urlInput.length&&this.updateUrl(this.urlInput)}),100),updateUrl:function(e){var t=e,n="/"===t.charAt(0);t=l()(t),n&&(t="/"+t),this.urlInput!==t&&(this.urlInput=t,this.isUrlChecked=!1),this.$set(this.editableUrlData,"url_main",t),this.checkUrlIsAvailable()}},watch:{computedUrl:{handler:"onComputedUrlUpdate"},editableUrlData:{deep:!0,handler:"onEditableUrlUpdate"},isUrlAvailable:{handler:"onIsUrlAvailableUpdate"},urlFull:{handler:"checkUrlIsAvailable"},urlInput:{handler:"onUrlInputUpdate"}}};const g=(0,p.Z)(b,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("input-group",{attrs:{"error-message":e.getPageErrorMessage("url.url_main"),"input-id":"url_input","input-name":"url_input","input-required":!0,"input-type":"text","label-text":"URL"},on:{input:e.onUrlInputInput},model:{value:e.urlInput,callback:function(t){e.urlInput=t},expression:"urlInput"}}),e._v(" "),n("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("url.url_full"),"input-disabled":!0,"input-id":"url_full","input-name":"url_full","input-type":"text","label-text":"Formatted URL"},model:{value:e.urlFull,callback:function(t){e.urlFull=t},expression:"urlFull"}},[n("span",{staticClass:"flex flex-row items-center"},[n("span",{staticClass:"flex flex-row items-baseline"},[e._v("\n                Formatted URL\n                "),n("sup",{staticClass:"text-theme-danger-contrast"},[e._v("*")])]),e._v(" "),e.isUrlCheckLoading?n("icon-loader-circle",{staticClass:"animate-spin-slow h-4 ml-3 text-theme-base-subtle-contrast w-4"}):e.isUrlChecked&&this.urlInput.length?n("span",{staticClass:"flex flex-row font-normal items-center ml-3",class:{"text-theme-success-contrast":e.isUrlAvailable,"text-theme-danger-contrast":!e.isUrlAvailable}},[e.isUrlAvailable?[n("icon-check",{staticClass:"h-4 mr-1 w-4"}),e._v(" "),n("span",[e._v("URL is available")])]:e.isUrlAvailable?e._e():[n("icon-x",{staticClass:"h-4 mr-1 w-4"}),e._v(" "),n("span",[e._v("URL is unavailable")])]],2):e._e()],1)]),e._v(" "),n("div",{staticClass:"bg-theme-base-subtle h-px my-6"}),e._v(" "),n("inline-checkbox-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("url.is_enabled"),"input-id":"url_is_enabled","input-name":"url_is_enabled","label-text":"Enabled?"},model:{value:e.editableUrlData.is_enabled,callback:function(t){e.$set(e.editableUrlData,"is_enabled",t)},expression:"editableUrlData.is_enabled"}}),e._v(" "),n("div",{staticClass:"flex flex-col md:flex-row md:mt-2 md:space-x-4"},[n("date-time-picker-group",{staticClass:"mt-4 md:flex-1",attrs:{"error-message":e.getPageErrorMessage("url.published_at"),"input-id":"url_published_at","input-name":"url_published_at","label-text":"Publish Date"},model:{value:e.editableUrlData.published_at,callback:function(t){e.$set(e.editableUrlData,"published_at",t)},expression:"editableUrlData.published_at"}}),e._v(" "),n("date-time-picker-group",{staticClass:"mt-4 md:flex-1",attrs:{"error-message":e.getPageErrorMessage("url.expired_at"),"input-id":"url_expired_at","input-name":"url_expired_at","label-text":"Expiry Date"},model:{value:e.editableUrlData.expired_at,callback:function(t){e.$set(e.editableUrlData,"expired_at",t)},expression:"editableUrlData.expired_at"}})],1)],1)}),[],!1,null,null,null).exports},1274:(e,t,n)=>{"use strict";n.d(t,{Z:()=>s});var i=n(952),a=n(4041),r=n(1147);const l={name:"InlineCheckboxGroup",mixins:[i.S,a.H],components:{FormFieldError:r.Z},props:{inputClass:{default:"cursor-pointer form-checkbox h-5 mr-2 rounded text-theme-primary w-5 focus:border-theme-primary focus:outline-none focus:ring focus:ring-primary",type:String},labelClass:{default:"cursor-pointer flex-1 font-medium select-none text-theme-base-contrast text-sm tracking-wider",type:String}}};const s=(0,n(1900).Z)(l,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"flex flex-col"},[n("div",{staticClass:"flex flex-row"},[n("input",{directives:[{name:"model",rawName:"v-model",value:e.editableValue,expression:"editableValue"}],ref:e.inputId,class:e.formattedInputClass,attrs:{id:e.inputId,disabled:e.inputDisabled,"false-value":e.inputValueFalse,name:e.inputName,required:e.inputRequired,"true-value":e.inputValueTrue,type:"checkbox"},domProps:{checked:Array.isArray(e.editableValue)?e._i(e.editableValue,null)>-1:e._q(e.editableValue,e.inputValueTrue)},on:{change:[function(t){var n=e.editableValue,i=t.target,a=i.checked?e.inputValueTrue:e.inputValueFalse;if(Array.isArray(n)){var r=e._i(n,null);i.checked?r<0&&(e.editableValue=n.concat([null])):r>-1&&(e.editableValue=n.slice(0,r).concat(n.slice(r+1)))}else e.editableValue=a},e.onInput],keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"esc",27,t.key,["Esc","Escape"])?null:e.blurInput(t)}}}),e._v(" "),n("label",{class:e.labelClass,attrs:{for:e.inputId}},[n("span",{staticClass:"flex flex-row items-baseline"},[n("span",[e._v(e._s(e.labelText))]),e._v(" "),e.inputRequired?n("sup",{staticClass:"text-theme-danger-contrast"},[e._v("\n                    *\n                ")]):e._e()])])]),e._v(" "),n("form-field-error",{attrs:{"error-class":e.errorClass,"error-message":e.errorMessage,"is-error":e.isError}})],1)}),[],!1,null,null,null).exports},3764:(e,t,n)=>{"use strict";n.d(t,{Z:()=>l});var i=n(952),a=n(1147);const r={name:"InputGroup",mixins:[i.S],components:{FormFieldError:a.Z},props:{inputAutocomplete:{default:"",type:String},inputMax:{default:"",type:String|Number},inputMaxLength:{default:"",type:String|Number},inputMin:{default:"",type:String|Number},inputMinLength:{default:"",type:String|Number},inputPlaceholder:{default:"",type:String},inputType:{default:"text",type:String}},mounted:function(){this.autofocus()}};const l=(0,n(1900).Z)(r,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"flex flex-col"},[n("label",{class:e.formattedLabelClass,attrs:{for:e.inputId}},[e._t("default",[n("span",{staticClass:"flex flex-row items-baseline"},[n("span",[e._v(e._s(e.labelText))]),e._v(" "),e.inputRequired?n("sup",{staticClass:"text-theme-danger-contrast"},[e._v("\n                    *\n                ")]):e._e()])])],2),e._v(" "),n("div",{class:e.inputWrapperClass},[e._t("inputPrepend"),e._v(" "),n("input",{ref:e.inputId,class:e.formattedInputClass,attrs:{id:e.inputId,autocomplete:e.inputAutocomplete,disabled:e.inputDisabled,max:e.inputMax,maxlength:e.inputMaxLength,min:e.inputMin,minlength:e.inputMinLength,name:e.inputName,placeholder:e.inputPlaceholder,required:e.inputRequired,type:e.inputType},domProps:{value:e.inputValue},on:{blur:e.onInputBlur,input:e.onInput,keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"esc",27,t.key,["Esc","Escape"])?null:e.blurInput(t)}}}),e._v(" "),e._t("inputAppend")],2),e._v(" "),n("form-field-error",{attrs:{"error-class":e.errorClass,"error-message":e.errorMessage,"is-error":e.isError}})],1)}),[],!1,null,null,null).exports},9472:(e,t,n)=>{"use strict";n.d(t,{Z:()=>o});var i=n(6486),a=n.n(i),r=n(952),l=n(1147);const s={name:"SelectGroup",mixins:[r.S],components:{FormFieldError:l.Z},props:{inputAnyOptionEnabled:{default:!1,type:Boolean},inputAnyOptionLabel:{default:"Any",type:String},inputAnyOptionClass:{default:"",type:String},inputAnyOptionValue:{default:""},inputClass:{default:"border border-theme-base-subtle cursor-pointer font-medium form-select px-3 py-2 rounded w-full focus:border-theme-primary focus:outline-none focus:ring-0 focus:shadow-none",type:String},inputOptionLabelKey:{default:!1,type:Boolean|String|Number},inputOptionValueKey:{default:!1,type:Boolean|String|Number},inputOptions:{required:!0,type:Object}},computed:{formattedOptions:function(){var e=this,t={};return a().forEach(this.inputOptions,(function(n,i){var a=n,r=i;!1!==e.inputOptionLabelKey&&n.hasOwnProperty(e.inputOptionLabelKey)&&(a=n[e.inputOptionLabelKey]),!1!==e.inputOptionValueKey&&n.hasOwnProperty(e.inputOptionValueKey)&&(r=n[e.inputOptionValueKey]),t[i]={label:a,value:r}})),t},formattedInputClass:function(){var e=this.inputClass;return this.isError&&(e+=" error"),this.isAnyOptionSelected&&(e+=" "+this.inputAnyOptionClass),e},isAnyOptionSelected:function(){return this.inputValue===this.inputAnyOptionValue||null===this.inputValue}},mounted:function(){this.autofocus()},methods:{isOptionDisabled:function(e){return!!this.inputRequired&&""===e},isOptionSelected:function(e){return e===this.inputValue}}};const o=(0,n(1900).Z)(s,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"flex flex-col"},[n("label",{class:e.formattedLabelClass,attrs:{for:e.inputId}},[e._t("default",[n("span",{staticClass:"flex flex-row items-baseline"},[n("span",[e._v(e._s(e.labelText))]),e._v(" "),e.inputRequired?n("sup",{staticClass:"text-theme-danger-contrast"},[e._v("\n                    *\n                ")]):e._e()])])],2),e._v(" "),n("select",{ref:e.inputId,class:e.formattedInputClass,attrs:{id:e.inputId,disabled:e.inputDisabled,name:e.inputName,required:e.inputRequired},on:{change:e.onInput,keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"esc",27,t.key,["Esc","Escape"])?null:e.blurInput(t)}}},[e.inputAnyOptionEnabled?n("option",{attrs:{disabled:e.isOptionDisabled(e.inputAnyOptionValue)},domProps:{selected:e.isOptionSelected(e.inputAnyOptionValue),value:e.inputAnyOptionValue}},[e._v("\n            "+e._s(e.inputAnyOptionLabel)+"\n        ")]):e._e(),e._v(" "),e._l(e.formattedOptions,(function(t,i){return n("option",{key:e.inputId+"-option-"+t.value,attrs:{disabled:e.isOptionDisabled(t.value)},domProps:{selected:e.isOptionSelected(t.value),value:t.value}},[e._v("\n            "+e._s(t.label)+"\n        ")])}))],2),e._v(" "),n("form-field-error",{attrs:{"error-class":e.errorClass,"error-message":e.errorMessage,"is-error":e.isError}})],1)}),[],!1,null,null,null).exports},1147:(e,t,n)=>{"use strict";n.d(t,{Z:()=>a});const i={name:"FormFieldError",props:{errorClass:{required:!0,type:String},errorMessage:{required:!0,type:String},isError:{required:!0,type:Boolean},transitionName:{default:"slide-down-fade",type:String}}};const a=(0,n(1900).Z)(i,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("transition",{attrs:{name:e.transitionName}},[e.isError?n("p",{class:e.errorClass},[e._v("\n            "+e._s(e.errorMessage)+"\n        ")]):e._e()])],1)}),[],!1,null,null,null).exports},2546:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>c});var i=n(1304),a=n.n(i),r=n(5643),l=n(3764),s=n(9472),o=n(1184),u=axios.CancelToken,p=u.source();const d={name:"AdminCmsPageCreate",components:{ContentEditor:r.Z,InputGroup:l.Z,SelectGroup:s.Z,UrlEditor:o.Z},layout:"admin-layout",props:{layouts:{required:!0,type:Object|Array},parentPages:{required:!0,type:Object|Array|null},templates:{required:!0,type:Object|Array}},data:function(){return{autoUpdateSlug:!0,computedUrl:"",formData:{layout_id:"",name:"",parent_id:"",slug:"",template_id:"",url:{}},isLoadingTemplate:!1,isUrlAvailable:!1,selectedTemplate:null}},computed:{isLayouts:function(){try{return Object.keys(this.layouts).length}catch(e){return!1}},isTemplates:function(){try{return Object.keys(this.templates).length}catch(e){return!1}},parentPagesUrls:function(){try{if(!Object.keys(this.parentPages).length)return null;var e={};return _.forEach(this.parentPages,(function(t,n){e[n]={id:t.id,label:t.name+" => "+t.url.url_full,url_full:t.url.url_full,url_main:t.url.url_main}})),e}catch(e){return null}},parentPagesMap:function(){try{if(!Object.keys(this.parentPages).length)return null;var e={};return _.forEach(this.parentPages,(function(t,n){e[t.id]=n})),e}catch(e){return null}},selectedParentPage:function(){try{return this.formData.parent_id?this.parentPages[this.parentPagesMap[this.formData.parent_id]]:null}catch(e){return null}},selectedParentPageUrl:function(){try{return this.selectedParentPage.url.url_full}catch(e){return null}},selectedTemplateHasFields:function(){try{return!!this.selectedTemplate&&this.selectedTemplate.template_fields.length}catch(e){return!1}},selectedTemplateId:function(){var e;return null!==(e=this.formData.template_id)&&void 0!==e?e:""}},methods:{cancelLoadTemplate:function(){this.isLoadingTemplate&&(p.cancel("Template load cancelled"),p=u.source())},onNameInput:function(){this.autoUpdateSlug&&(this.formData.slug=this.slugify(this.formData.name),this.computedUrl=this.formData.slug)},onSelectedTemplateIdChange:_.debounce((function(){var e=this;this.selectedTemplate=null,this.cancelLoadTemplate(),this.selectedTemplateId&&(this.isLoadingTemplate=!0,axios.get(this.$route("admin.api.cms.templates.index",this.selectedTemplateId)).then((function(t){e.selectedTemplate=_.cloneDeep(t.data.data),e.setNewTemplateContent()})).catch((function(t){axios.isCancel(t)||(e.$errorToast("Failed to load selected template"),console.log(t))})).finally((function(){e.isLoadingTemplate=!1})))}),500),onSlugBlur:function(){this.formData.slug=this.slugify(this.formData.slug)},onSlugInput:function(){this.autoUpdateSlug=!1,this.computedUrl=this.formData.slug},onUrlIsAvailableEvent:function(e){this.isUrlAvailable=e},setNewTemplateContent:function(){this.selectedTemplateHasFields||(this.formData.content={});var e={};_.forEach(this.selectedTemplate.template_fields,(function(t){e[t.id]={data:"",template_field_id:t.id}})),this.$set(this.formData,"content",_.cloneDeep(e))},slugify:function(e){return e&&e.length?a()(e,{lower:!0}):""},submit:function(){this.isUrlAvailable?this.$inertia.post(this.$route("admin.cms.pages.store"),this.formData):this.$errorToast("Unable to create page. URL is unavailable")}},watch:{selectedTemplateId:{handler:"onSelectedTemplateIdChange"}}};const c=(0,n(1900).Z)(d,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("form",{staticClass:"max-w-5xl mx-auto",attrs:{autocomplete:"off"},on:{submit:function(t){return t.preventDefault(),e.submit(t)}}},[e.userCan("cms.create")?n("div",{staticClass:"flex flex-row items-center mb-6"},[n("h1",{staticClass:"font-medium mr-auto text-lg"},[e._v("\n            Create Page\n        ")]),e._v(" "),e.userCan("cms.view")?n("inertia-link",{staticClass:"\n                button button-default-responsive button-primary-subtle\n                flex flex-row items-center mr-2\n            ",attrs:{href:e.$route("admin.cms.pages.index")}},[n("icon-chevron-left",{staticClass:"w-5 md:mr-2"}),e._v(" "),n("span",{staticClass:"hidden md:inline"},[e._v("\n                Back\n            ")])],1):e._e(),e._v(" "),n("button",{staticClass:"\n                button button-default-responsive button-primary\n                flex flex-row items-center\n            ",attrs:{type:"submit"}},[n("icon-save",{staticClass:"w-5 md:mr-2"}),e._v(" "),n("span",{staticClass:"hidden md:inline"},[e._v("\n                Create Page\n            ")])],1)],1):e._e(),e._v(" "),n("div",{staticClass:"bg-white py-6 shadow-subtle rounded-lg"},[n("div",{staticClass:"block px-6 w-full"},[n("select-group",{attrs:{"error-message":e.getPageErrorMessage("layout_id"),"label-text":"Layout","input-any-option-enabled":!0,"input-any-option-label":"Please select a Layout","input-autofocus":!0,"input-id":"layout_id","input-name":"layout_id","input-options":e.isLayouts?e.layouts:{},"input-option-label-key":"name","input-option-value-key":"id","input-required":!0},model:{value:e.formData.layout_id,callback:function(t){e.$set(e.formData,"layout_id",t)},expression:"formData.layout_id"}}),e._v(" "),n("select-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("template_id"),"label-text":"Template","input-any-option-enabled":!0,"input-any-option-label":"Please select a template","input-id":"template_id","input-name":"template_id","input-options":e.isTemplates?e.templates:{},"input-option-label-key":"name","input-option-value-key":"id","input-required":!0},model:{value:e.formData.template_id,callback:function(t){e.$set(e.formData,"template_id",t)},expression:"formData.template_id"}}),e._v(" "),e.parentPagesUrls?n("select-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("parent_id"),"label-text":"Parent Page","input-any-option-enabled":!0,"input-any-option-label":"Please select a parent (optional)","input-id":"parent_id","input-name":"parent_id","input-options":e.parentPagesUrls,"input-option-label-key":"label","input-option-value-key":"id"},model:{value:e.formData.parent_id,callback:function(t){e.$set(e.formData,"parent_id",t)},expression:"formData.parent_id"}}):e._e(),e._v(" "),n("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("name"),"input-autocomplete":"page_name","input-id":"name","input-name":"name","input-required":!0,"input-type":"text","label-text":"Page Name"},on:{input:e.onNameInput},model:{value:e.formData.name,callback:function(t){e.$set(e.formData,"name",t)},expression:"formData.name"}}),e._v(" "),n("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("slug"),"input-autocomplete":"page_slug","input-id":"slug","input-name":"slug","input-required":!0,"input-type":"text","label-text":"Page Slug"},on:{blur:e.onSlugBlur,input:e.onSlugInput},model:{value:e.formData.slug,callback:function(t){e.$set(e.formData,"slug",t)},expression:"formData.slug"}})],1)]),e._v(" "),n("div",{staticClass:"bg-white mt-6 px-6 py-6 shadow-subtle rounded-lg"},[n("url-editor",{attrs:{"computed-url":e.computedUrl,"parent-url":e.selectedParentPageUrl},on:{isAvailable:e.onUrlIsAvailableEvent},model:{value:e.formData.url,callback:function(t){e.$set(e.formData,"url",t)},expression:"formData.url"}})],1),e._v(" "),!this.isLoadingTemplate&&e.selectedTemplateHasFields?n("div",{staticClass:"bg-white mt-6 px-6 py-6 shadow-subtle rounded-lg"},[n("p",{staticClass:"text-lg"},[e._v("Fields")]),e._v(" "),n("content-editor",{staticClass:"mt-4",attrs:{"template-fields":this.selectedTemplate.template_fields},model:{value:e.formData.content,callback:function(t){e.$set(e.formData,"content",t)},expression:"formData.content"}})],1):e._e()])}),[],!1,null,null,null).exports}}]);