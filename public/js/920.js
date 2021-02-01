(self.webpackChunk=self.webpackChunk||[]).push([[920],{952:(e,t,s)=>{"use strict";s.d(t,{S:()=>n});var n={model:{prop:"inputValue"},props:{errorClass:{default:"mt-1 text-red-500 text-sm",type:String},errorHideOnInput:{default:!0,type:Boolean},errorMessage:{default:"",type:String},inputAutofocus:{default:!1,type:Boolean},inputClass:{default:"border border-theme-base-subtle font-medium px-3 py-2 rounded w-full focus:border-theme-primary focus:outline-none focus:ring-0",type:String},inputDisabled:{default:!1,type:Boolean},inputId:{required:!0,type:String},inputName:{required:!0,type:String},inputRequired:{default:!1,type:Boolean},inputValue:{default:"",type:String|Number},inputWrapperClass:{default:"",type:String},labelClass:{default:"font-medium mb-2 text-theme-base-contrast text-sm tracking-wider",type:String},labelHidden:{default:!1,type:Boolean},labelText:{required:!0,type:String}},data:function(){return{hideError:!1}},computed:{formattedInputClass:function(){return this.isError?this.inputClass+" error":this.inputClass},formattedLabelClass:function(){var e=this.labelClass;return this.labelHidden&&(e+=" hidden"),e},isError:function(){return!(this.hideError||!this.errorMessage||""===this.errorMessage)}},methods:{autofocus:function(){var e=this;this.inputAutofocus&&this.$refs[this.inputId]&&this.$nextTick((function(){e.$refs[e.inputId].focus()}))},blurInput:function(){var e=this;this.$refs[this.inputId]&&this.$nextTick((function(){e.$refs[e.inputId].blur()}))},onErrorMessageChange:function(){this.hideError=!1},onInput:function(){this.$emit("input",this.$refs[this.inputId].value),this.errorHideOnInput&&(this.hideError=!0)},onInputBlur:function(){this.$emit("blur")}},watch:{errorMessage:{handler:"onErrorMessageChange"}}}},5463:(e,t,s)=>{"use strict";var n=s(538);n="default"in n?n.default:n;var i="2.2.2";/^2\./.test(n.version)||n.util.warn("VueClickaway 2.2.2 only supports Vue 2.x, and does not support Vue "+n.version);var r="_vue_clickaway_handler";function a(e,t,s){o(e);var n=s.context,i=t.value;if("function"==typeof i){var a=!1;setTimeout((function(){a=!0}),0),e[r]=function(t){var s=t.path||(t.composedPath?t.composedPath():void 0);if(a&&(s?s.indexOf(e)<0:!e.contains(t.target)))return i.call(n,t)},document.documentElement.addEventListener("click",e[r],!1)}}function o(e){document.documentElement.removeEventListener("click",e[r],!1),delete e[r]}var l={bind:a,update:function(e,t){t.value!==t.oldValue&&a(e,t)},unbind:o},u={directives:{onClickaway:l}};t.jB=u},3764:(e,t,s)=>{"use strict";s.d(t,{Z:()=>a});var n=s(952),i=s(1147);const r={name:"InputGroup",mixins:[n.S],components:{FormFieldError:i.Z},props:{inputAutocomplete:{default:"",type:String},inputMax:{default:"",type:String|Number},inputMaxLength:{default:"",type:String|Number},inputMin:{default:"",type:String|Number},inputMinLength:{default:"",type:String|Number},inputPlaceholder:{default:"",type:String},inputType:{default:"text",type:String}},mounted:function(){this.autofocus()}};const a=(0,s(1900).Z)(r,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"flex flex-col"},[s("label",{class:e.formattedLabelClass,attrs:{for:e.inputId}},[e._t("default",[s("span",{staticClass:"flex flex-row items-baseline"},[s("span",[e._v(e._s(e.labelText))]),e._v(" "),e.inputRequired?s("sup",{staticClass:"text-theme-danger-contrast"},[e._v("\n                    *\n                ")]):e._e()])])],2),e._v(" "),s("div",{class:e.inputWrapperClass},[e._t("inputPrepend"),e._v(" "),s("input",{ref:e.inputId,class:e.formattedInputClass,attrs:{id:e.inputId,autocomplete:e.inputAutocomplete,disabled:e.inputDisabled,max:e.inputMax,maxlength:e.inputMaxLength,min:e.inputMin,minlength:e.inputMinLength,name:e.inputName,placeholder:e.inputPlaceholder,required:e.inputRequired,type:e.inputType},domProps:{value:e.inputValue},on:{blur:e.onInputBlur,input:e.onInput,keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"esc",27,t.key,["Esc","Escape"])?null:e.blurInput(t)}}}),e._v(" "),e._t("inputAppend")],2),e._v(" "),s("form-field-error",{attrs:{"error-class":e.errorClass,"error-message":e.errorMessage,"is-error":e.isError}})],1)}),[],!1,null,null,null).exports},1147:(e,t,s)=>{"use strict";s.d(t,{Z:()=>i});const n={name:"FormFieldError",props:{errorClass:{required:!0,type:String},errorMessage:{required:!0,type:String},isError:{required:!0,type:Boolean},transitionName:{default:"slide-down-fade",type:String}}};const i=(0,s(1900).Z)(n,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",[s("transition",{attrs:{name:e.transitionName}},[e.isError?s("p",{class:e.errorClass},[e._v("\n            "+e._s(e.errorMessage)+"\n        ")]):e._e()])],1)}),[],!1,null,null,null).exports},329:(e,t,s)=>{"use strict";s.d(t,{Z:()=>i});const n={name:"ConfirmationModal",mixins:[s(5463).jB],props:{componentName:{default:"confirmation-modal",type:String},cancelText:{default:"Cancel",type:String},confirmText:{default:"Confirm",type:String},confirmType:{default:"primary",type:String},isActionLoading:{default:!1,type:Boolean},messageText:{default:"Do you really want to continue?",type:String},messageTitle:{default:"Are you sure?",type:String},showModal:{default:!0,type:Boolean}},computed:{confirmButtonClass:function(){var e=[];return e.push("bg-theme-"+this.confirmType),e.push("border-theme-"+this.confirmType),e.push("text-theme-"+this.confirmType+"-contrast"),e.push("hover:bg-theme-"+this.confirmType+"-hover"),e.push("hover:border-theme-"+this.confirmType+"-hover"),e.push("hover:text-theme-"+this.confirmType+"-hover-contrast"),e},isMessage:function(){return this.isMessageText&&this.isMessageTitle},isMessageText:function(){return!!this.messageText.length},isMessageTitle:function(){return!!this.messageTitle.length}},methods:{cancelAction:function(){this.$emit("cancelAction")},closeModal:function(){this.$emit("closeModal")},confirmAction:function(){this.$emit("confirmAction")},onShowModal:function(){try{var e=document.getElementsByTagName("body")[0];this.showModal?e.classList.add("overflow-y-hidden"):e.classList.remove("overflow-y-hidden")}catch(e){console.error(e)}}},watch:{showModal:{handler:"onShowModal"}}};const i=(0,s(1900).Z)(n,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return e.showModal?s("transition",{attrs:{name:"fade"}},[s("div",{staticClass:"absolute bg-gray-800 bg-opacity-75 flex h-full inset-0 items-center justify-center w-full p-4 z-30",class:e.componentName},[s("div",{directives:[{name:"on-clickaway",rawName:"v-on-clickaway",value:e.closeModal,expression:"closeModal"}],staticClass:"bg-theme-card max-h-full max-w-full overflow-y-auto relative rounded shadow-md text-theme-card-contrast w-96"},[s("div",{staticClass:"flex flex-row justify-end p-2"},[s("button",{staticClass:"\n                        flex items-center justify-center ml-auto p-1 rounded\n                        ease-in-out duration-300 transition-colors\n                        focus:outline-none focus:ring focus:ring-primary\n                        hover:bg-theme-base-subtle\n                    ",attrs:{disabled:e.isActionLoading,type:"button"},on:{click:e.closeModal}},[s("icon-close",{staticClass:"h-5 w-5"})],1)]),e._v(" "),e._t("default",[e.isMessage?s("div",{staticClass:"flex flex-col items-center mt-6 px-4 text-center"},[e.messageTitle?s("h2",{staticClass:"font-semibold text-lg"},[e._v("\n                        "+e._s(e.messageTitle)+"\n                    ")]):e._e(),e._v(" "),e.messageText?s("p",{staticClass:"mt-2 text-center text-gray-700"},[e._v("\n                        "+e._s(e.messageText)+"\n                    ")]):e._e()]):e._e()]),e._v(" "),s("div",{staticClass:"\n                    flex flex-col items-center justify-center mb-4 mt-8 px-4 space-y-2\n                    sm:flex-row sm:space-x-3 sm:space-y-0\n                "},[s("button",{staticClass:"\n                        bg-theme-base-subtle min-w-24 px-4 py-2 rounded text-center text-theme-base-subtle-contrast w-full\n                        ease-in-out duration-300 transition-colors\n                        sm:w-auto\n                        focus:outline-none focus:ring focus:ring-primary\n                        hover:bg-theme-base-subtle-contrast hover:text-theme-base-subtle\n                    ",attrs:{disabled:e.isActionLoading,type:"button"},on:{click:e.cancelAction}},[e._v("\n                    "+e._s(e.cancelText)+"\n                ")]),e._v(" "),s("button",{staticClass:"\n                        border flex flex-row items-center justify-center px-4 py-2 min-w-24 px-4 py-2 rounded text-center w-full\n                        ease-in-out duration-300 transition-colors\n                        sm:w-auto\n                        focus:outline-none focus:ring focus:ring-primary\n                    ",class:e.confirmButtonClass,attrs:{disabled:e.isActionLoading,type:"button"},on:{click:e.confirmAction}},[e.isActionLoading?s("icon-loader-circle",{staticClass:"animate-spin-slow mr-2 w-5"}):s("span",[e._v("\n                        "+e._s(e.confirmText)+"\n                    ")])],1)])],2)])]):e._e()}),[],!1,null,null,null).exports},7920:(e,t,s)=>{"use strict";s.r(t),s.d(t,{default:()=>u});var n=s(6486),i=s.n(n),r=s(9680),a=s(329),o=s(3764);const l={name:"AdminUserIndex",components:{ConfirmationModal:a.Z,InputGroup:o.Z},layout:"admin-layout",props:{searchOptions:Array|Object,users:Object},data:function(){return{editableSearchOptions:{per_page:15,user_first_name:"",user_last_name:"",user_email:""},isInitialised:!1,isLoadingUserDelete:!1,showDeleteModal:!1,userToDelete:null}},computed:{deleteModalText:function(){try{return"Do you really want to delete '"+this.userToDelete.name+"'?"}catch(e){return"Do you really want to delete this user?"}},show_users_actions:function(){return this.userCan("users.edit")||this.userCan("users.delete")},showPagination:function(){try{return this.users.pagination.last_page>1}catch(e){return!1}},usersData:function(){return!(!this.users||!this.users.data||this.users.data.length<1)&&this.users.data}},mounted:function(){this.setSearchOptions(this.searchOptions)},methods:{cancelUserDelete:function(){this.isLoadingUserDelete||(this.showDeleteModal=!1,this.userToDelete=null)},checkUserDelete:function(e){this.showDeleteModal=!0,this.userToDelete=e},confirmUserDelete:function(){if(this.isLoadingUserDelete)return this.$errorToast("It's only possible to delete one user at a time.");this.$inertia.delete(this.$route("admin.users.destroy",this.userToDelete.id),{only:["flash","users"]}),this.userToDelete=null,this.showDeleteModal=!1},isUserCurrent:function(e){try{return e.id===this.$page.props.auth.user.id}catch(e){return!1}},onSearchOptionsUpdate:i().debounce((function(){!this.isInitialised&&(this.isInitialised=!0,this.usersData)||r.Inertia.get(this.$route("admin.users.index"),this.editableSearchOptions,{only:["users"],preserveState:!0})}),500),setSearchOptions:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},t={per_page:15,user_first_name:"",user_last_name:"",user_email:""};try{i().forEach(e,(function(e,s){t[s]=e}))}catch(e){console.log(e)}this.editableSearchOptions=i().cloneDeep(t)}},watch:{editableSearchOptions:{deep:!0,handler:"onSearchOptionsUpdate"}}};const u=(0,s(1900).Z)(l,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("section",[s("div",{staticClass:"flex flex-row items-center mb-6"},[s("h1",{staticClass:"font-medium mr-auto text-lg"},[e._v("\n            Users\n        ")]),e._v(" "),e.userCan("users.create")?s("inertia-link",{staticClass:"\n                button button-default-responsive button-primary\n                flex flex-row items-center\n            ",attrs:{href:e.$route("admin.users.create")}},[s("icon-plus",{staticClass:"w-5 md:mr-2"}),e._v(" "),s("span",{staticClass:"hidden md:inline"},[e._v("\n                Create User\n            ")])],1):e._e()],1),e._v(" "),s("div",{staticClass:"bg-white py-6 shadow-subtle rounded-lg"},[s("h1",{staticClass:"font-semibold px-6 text-gray-850"},[e._v("\n            Search\n            "),s("button",{staticClass:"\n                    text-sm text-theme-base-subtle-contrast\n                    focus:outline-none focus:text-theme-primary\n                    hover:text-theme-primary\n                ",on:{click:e.setSearchOptions}},[e._v("\n                (Clear)\n            ")])]),e._v(" "),s("div",{staticClass:"\n                flex flex-col items-center mt-4 px-6 space-y-4\n                md:flex-row md:space-y-0 md:space-x-8\n            "},[s("div",{staticClass:"w-full md:w-1/3"},[s("input-group",{attrs:{"input-autocomplete":"user_first_name_search","input-class":"form-control form-control-short","input-id":"user_first_name","input-name":"user_first_name","input-placeholder":"First Name","input-type":"text","label-hidden":!0,"label-text":"First Name"},model:{value:e.editableSearchOptions.user_first_name,callback:function(t){e.$set(e.editableSearchOptions,"user_first_name",t)},expression:"editableSearchOptions.user_first_name"}})],1),e._v(" "),s("div",{staticClass:"w-full md:w-1/3"},[s("input-group",{attrs:{"input-autocomplete":"user_last_name_search","input-class":"form-control form-control-short","input-id":"user_last_name","input-name":"user_last_name","input-placeholder":"Last Name","input-type":"text","label-hidden":!0,"label-text":"Last Name"},model:{value:e.editableSearchOptions.user_last_name,callback:function(t){e.$set(e.editableSearchOptions,"user_last_name",t)},expression:"editableSearchOptions.user_last_name"}})],1),e._v(" "),s("div",{staticClass:"w-full md:w-1/3"},[s("input-group",{attrs:{"input-autocomplete":"user_email_search","input-class":"form-control form-control-short","input-id":"user_email","input-name":"user_email","input-placeholder":"Email","input-type":"text","label-hidden":!0,"label-text":"Email"},model:{value:e.editableSearchOptions.user_email,callback:function(t){e.$set(e.editableSearchOptions,"user_email",t)},expression:"editableSearchOptions.user_email"}})],1)]),e._v(" "),e.usersData?[s("div",{staticClass:"block mt-8 overflow-x-auto w-full"},[s("table",{staticClass:"table table-hover table-striped w-full"},[s("thead",[s("tr",[s("th",[e._v("Name")]),e._v(" "),s("th",[e._v("Email")]),e._v(" "),e.show_users_actions?s("th"):e._e()])]),e._v(" "),s("tbody",e._l(e.usersData,(function(t,n){return s("tr",{key:"user-"+t.id},[s("td",[e._v("\n                                "+e._s(t.name)+"\n                            ")]),e._v(" "),s("td",[e._v("\n                                "+e._s(t.email)+"\n                            ")]),e._v(" "),e.show_users_actions?s("td",[s("div",{staticClass:"flex flex-row items-center justify-end -mx-1"},[e.userCan("users.edit")?s("inertia-link",{staticClass:"\n                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide\n                                            focus:outline-none focus:ring\n                                            hover:bg-theme-info hover:text-theme-info-contrast\n                                        ",attrs:{href:e.$route("admin.users.edit",t.id),title:"Edit User"}},[s("icon-edit",{staticClass:"w-4"})],1):e._e(),e._v(" "),e.userCan("users.delete")?s("button",{staticClass:"\n                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide\n                                            focus:outline-none focus:ring\n                                            hover:bg-theme-danger hover:text-theme-danger-contrast\n                                        ",attrs:{disabled:e.isUserCurrent(t),title:"Delete User"},on:{click:function(s){return e.checkUserDelete(t)}}},[s("icon-trash",{staticClass:"w-4"})],1):e._e()],1)]):e._e()])})),0)])])]:s("p",{staticClass:"bg-theme-base-subtle mt-6 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"},[e._v("\n            No users\n        ")]),e._v(" "),e.showPagination?s("div",{staticClass:"flex flex-row justify-center mt-12 px-6"},[s("pagination",{attrs:{pagination:e.users.pagination}})],1):e._e(),e._v(" "),s("confirmation-modal",{attrs:{"confirm-text":"Delete","confirm-type":"danger","show-modal":e.showDeleteModal,"message-text":e.deleteModalText},on:{cancelAction:e.cancelUserDelete,closeModal:e.cancelUserDelete,confirmAction:e.confirmUserDelete}})],2)])}),[],!1,null,null,null).exports}}]);