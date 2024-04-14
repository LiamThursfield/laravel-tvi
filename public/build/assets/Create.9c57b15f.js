import{I as r}from"./InputGroup.513e0dd4.js";import{W as s,T as n}from"./app.b7cbcfd1.js";import{C as o}from"./CheckboxGroup.7b759576.js";import{n as i}from"./LogoLight.f7426689.js";import"./vendor.21c2b6f5.js";import"./ConfirmationModal.242a99d0.js";import"./checkbox-form-group.99a615f1.js";const l={name:"AdminEDUAnnouncementCreate",components:{WysiwygField:s,TextAreaGroup:n,InputGroup:r,CheckboxGroup:o},layout:"admin-layout",data(){return{autoUpdateSlug:!0,formData:{title:"",description:"",platform:"",email:"",sms:""}}},methods:{submit(){this.$inertia.post(this.$route("admin.edu.announcements.store"),this.formData)}}};var m=function(){var t=this,e=t._self._c;return e("form",{staticClass:"max-w-5xl mx-auto",attrs:{autocomplete:"off"},on:{submit:function(a){return a.preventDefault(),t.submit.apply(null,arguments)}}},[t.userCan("announcements.create")?e("div",{staticClass:"flex flex-row items-center mb-6"},[e("h1",{staticClass:"font-medium mr-auto text-lg"},[t._v(" Create ")]),t.userCan("announcement.view")?e("inertia-link",{staticClass:"button button-default-responsive button-primary-subtle flex flex-row items-center mr-2",attrs:{href:t.$route("admin.edu.announcements.index")}},[e("icon-chevron-left",{staticClass:"w-5 md:mr-2"}),e("span",{staticClass:"hidden md:inline"},[t._v(" Back ")])],1):t._e(),e("button",{staticClass:"button button-default-responsive button-primary flex flex-row items-center",attrs:{type:"submit"}},[e("icon-save",{staticClass:"w-5 md:mr-2"}),e("span",{staticClass:"hidden md:inline"},[t._v(" Create ")])],1)],1):t._e(),e("div",{staticClass:"bg-white p-6 shadow-subtle rounded-lg"},[e("h2",[t._v("General details")]),e("input-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("title"),"input-autocomplete":"title_name","input-id":"title","input-name":"title","input-required":!0,"input-type":"text","label-text":"Title"},on:{errorHidden:function(a){return t.clearPageErrorMessage("title")}},model:{value:t.formData.title,callback:function(a){t.$set(t.formData,"title",a)},expression:"formData.title"}}),e("div",{staticClass:"mt-4"},[e("label",[t._v("Description")]),e("wysiwyg-field",{attrs:{"input-autofocus":!0},model:{value:t.formData.description,callback:function(a){t.$set(t.formData,"description",a)},expression:"formData.description"}})],1)],1),e("div",{staticClass:"bg-white p-6 shadow-subtle rounded-lg mt-4"},[e("h2",[t._v("Communication Channels")]),e("div",{staticClass:"grid grid-cols-4 gap-4"},[e("checkbox-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("platform"),"input-id":"platform","input-name":"platform","label-text":"Show to user on the platform?"},on:{errorHidden:function(a){return t.clearPageErrorMessage("platform")}},model:{value:t.formData.platform,callback:function(a){t.$set(t.formData,"platform",a)},expression:"formData.platform"}}),e("checkbox-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("email"),"input-id":"email","input-name":"email","label-text":"Send to users via Email?"},on:{errorHidden:function(a){return t.clearPageErrorMessage("email")}},model:{value:t.formData.email,callback:function(a){t.$set(t.formData,"email",a)},expression:"formData.email"}}),e("checkbox-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("sms"),"input-id":"sms","input-name":"sms","label-text":"Send to users via SMS?"},on:{errorHidden:function(a){return t.clearPageErrorMessage("sms")}},model:{value:t.formData.sms,callback:function(a){t.$set(t.formData,"sms",a)},expression:"formData.sms"}})],1)])])},u=[],c=i(l,m,u,!1,null,null,null,null);const h=c.exports;export{h as default};
