import{_ as i,O as l}from"./vendor.21c2b6f5.js";import{C as c}from"./ConfirmationModal.41eb8e05.js";import{I as u}from"./InputGroup.548575c6.js";import{aB as h,aC as d,n as m}from"./LogoLight.eb2f8316.js";const f={name:"AdminEDUCourseIndex",components:{IconCheck:h,IconSave:d,ConfirmationModal:c,InputGroup:u},layout:"admin-layout",props:{courses:{required:!0,type:Object},searchOptions:{required:!0,type:Object|Array}},data(){return{editableSearchOptions:{course_name:"",per_page:15},isInitialised:!1,isLoadingDelete:!1,isLoadingPublish:!1,showDeleteModal:!1,itemToDelete:null,showConfirmPublishModal:null,itemToPublish:null}},mounted(){this.setSearchOptions(this.searchOptions)},computed:{publishModalText(){try{return"Do you really want to publish '"+this.itemToPublish.name+"'?"}catch{return"Do you really want to perform this action?"}},deleteModalText(){try{return"Do you really want to delete '"+this.itemToDelete.name+"'?"}catch{return"Do you really want to delete this?"}},showPagination(){try{return this.courses.pagination.last_page>1}catch{return!1}},showActions(){return this.userCan("courses.edit")||this.userCan("courses.delete")},coursesData(){return!this.courses||!this.courses.data||this.courses.data.length<1?!1:this.courses.data}},methods:{checkPublishCourse(o){this.showConfirmPublishModal=!0,this.itemToPublish=o},confirmPublish(){if(this.isLoadingPublish)return this.$errorToast("It's only possible to publish one item at a time.");this.$inertia.patch(this.$route("admin.edu.courses.publish",this.itemToPublish.id),{only:["flash","courses"]}),this.itemToPublish=null,this.showConfirmPublishModal=!1},cancelPublish(){this.isLoadingPublish||(this.showConfirmPublishModal=!1,this.itemToPublish=null)},cancelDelete(){this.isLoadingDelete||(this.showDeleteModal=!1,this.itemToDelete=null)},checkDelete(o){this.showDeleteModal=!0,this.itemToDelete=o},confirmDelete(){if(this.isLoadingDelete)return this.$errorToast("It's only possible to delete one item at a time.");this.$inertia.delete(this.$route("admin.edu.courses.destroy",this.itemToDelete.id),{only:["flash","courses"]}),this.itemToDelete=null,this.showDeleteModal=!1},onSearchOptionsUpdate:i.debounce(function(){!this.isInitialised&&(this.isInitialised=!0,this.coursesData)||l.get(this.$route("admin.edu.courses.index"),this.editableSearchOptions,{only:["courses"],preserveState:!0})},500),setSearchOptions(o={}){let e={course_name:"",per_page:15};try{i.forEach(o,(t,s)=>{e[s]=t})}catch(t){console.log(t)}this.editableSearchOptions=i.cloneDeep(e)}},watch:{editableSearchOptions:{deep:!0,handler:"onSearchOptionsUpdate"}}};var p=function(){var e=this,t=e._self._c;return t("section",[t("div",{staticClass:"flex flex-row items-center mb-6"},[t("h1",{staticClass:"font-medium mr-auto text-lg"},[e._v(" Courses ")]),e.userCan("courses.create")?t("inertia-link",{staticClass:"button button-default-responsive button-primary flex flex-row items-center",attrs:{href:e.$route("admin.edu.courses.create")}},[t("icon-plus",{staticClass:"w-5 md:mr-2"}),t("span",{staticClass:"hidden md:inline"},[e._v(" Create ")])],1):e._e()],1),t("div",{staticClass:"bg-white py-6 shadow-subtle rounded-lg"},[t("h1",{staticClass:"font-semibold px-6 text-gray-850"},[e._v(" Search "),t("button",{staticClass:"text-sm text-theme-base-subtle-contrast focus:outline-none focus:text-theme-primary hover:text-theme-primary",on:{click:e.setSearchOptions}},[e._v(" (Clear) ")])]),t("div",{staticClass:"flex flex-col items-center mt-4 px-6 space-y-4 md:flex-row md:space-y-0 md:space-x-8"},[t("div",{staticClass:"w-full md:w-1/3"},[t("input-group",{attrs:{"input-autocomplete":"course_name_search","input-class":"form-control form-control-short","input-id":"course_name","input-name":"course_name","input-placeholder":"Course Name","input-type":"text","label-hidden":!0,"label-text":"Course Name"},model:{value:e.editableSearchOptions.course_name,callback:function(s){e.$set(e.editableSearchOptions,"course_name",s)},expression:"editableSearchOptions.course_name"}})],1)]),e.coursesData?[t("div",{staticClass:"block mt-8 overflow-x-auto w-full"},[t("table",{staticClass:"table table-hover table-striped w-full"},[t("thead",[t("tr",[t("th",[e._v("Image")]),t("th",[e._v("Name")]),t("th",[e._v("Price")]),t("th",[e._v("Status")]),t("th",[e._v("Summary")]),t("th",[e._v("Created By")]),t("th",[e._v("Length")]),t("th",[e._v("Total Sold")]),t("th",[e._v("Total Participants")]),e.showActions?t("th"):e._e()])]),t("tbody",e._l(e.coursesData,function(s,_){var a,r;return t("tr",{key:`item-${s.id}`},[t("td",[t("img",{staticClass:"w-32 square-full",attrs:{src:s.primary_image,alt:s.name}})]),t("td",[e._v(" "+e._s(s.name)+" "),t("br"),t("small",[e._v(e._s(s.slug))])]),t("td",[e._v(" "+e._s(s.price+" "+s.currency)+" ")]),t("td",[e._v(" "+e._s(s.status)+" ")]),t("td",[e._v(" "+e._s(s.summary.length>60?s.summary.substring(0,60)+" ...":"")+" ")]),t("td",[e._v(" "+e._s(s.creator?s.creator.first_name+" "+s.creator.last_name:"")+" ")]),t("td",[e._v(" "+e._s(s.content_length_video)+" ")]),t("td",[e._v(" "+e._s((a=s.total_sold)!=null?a:10)+" ")]),t("td",[e._v(" "+e._s((r=s.total_customers)!=null?r:10)+" ")]),e.showActions?t("td",[t("div",{staticClass:"flex flex-row items-center justify-end -mx-1"},[e.userCan("courses.publish")?t("button",{staticClass:"flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide focus:outline-none focus:ring hover:bg-theme-success hover:text-theme-success-contrast",attrs:{title:"Publish"},on:{click:function(n){return e.checkPublishCourse(s)}}},[t("icon-check",{staticClass:"w-4"})],1):e._e(),e.userCan("courses.edit")?t("inertia-link",{staticClass:"flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide focus:outline-none focus:ring hover:bg-theme-info hover:text-theme-info-contrast",attrs:{href:e.$route("admin.edu.courses.edit",s.id),title:"Edit"}},[t("icon-edit",{staticClass:"w-4"})],1):e._e(),e.userCan("courses.view")?t("inertia-link",{staticClass:"flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide focus:outline-none focus:ring hover:bg-theme-info hover:text-theme-info-contrast",attrs:{href:e.$route("admin.edu.courses.preview",s.id),title:"Preview"}},[t("icon-eye",{staticClass:"w-4"})],1):e._e(),e.userCan("courses.delete")?t("button",{staticClass:"flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide focus:outline-none focus:ring hover:bg-theme-danger hover:text-theme-danger-contrast",attrs:{title:"Delete"},on:{click:function(n){return e.checkDelete(s)}}},[t("icon-trash",{staticClass:"w-4"})],1):e._e()],1)]):e._e()])}),0)])]),e.showPagination?t("div",{staticClass:"flex flex-row justify-center mt-12 px-6"},[t("pagination",{attrs:{pagination:e.courses.pagination}})],1):e._e()]:t("p",{staticClass:"bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"},[e._v(" No results ")]),t("confirmation-modal",{attrs:{"confirm-text":"Delete","confirm-type":"danger","show-modal":e.showDeleteModal,"message-text":e.deleteModalText},on:{cancelAction:e.cancelDelete,closeModal:e.cancelDelete,confirmAction:e.confirmDelete}}),t("confirmation-modal",{attrs:{"confirm-text":"Publish","confirm-type":"success","show-modal":e.showConfirmPublishModal,"message-text":e.publishModalText},on:{cancelAction:e.cancelPublish,closeModal:e.cancelPublish,confirmAction:e.confirmPublish}})],2)])},b=[],x=m(f,p,b,!1,null,null,null,null);const y=x.exports;export{y as default};
