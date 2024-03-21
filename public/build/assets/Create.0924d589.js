import{s as r}from"./vendor.d799578a.js";import{A as n}from"./ArrayGroup.066104b6.js";import{I as i}from"./InputGroup.23900402.js";import{n as o}from"./LogoLight.dd39b68d.js";const u={name:"AdminEduLabelCreate",components:{ArrayGroup:n,InputGroup:i},layout:"admin-layout",data(){return{autoUpdateSlug:!0,formData:{name:"",slug:""}}},methods:{onNameInput(){!this.autoUpdateSlug||(this.formData.slug=this.slugify(this.formData.name))},onSlugBlur(){this.formData.slug=this.slugify(this.formData.slug)},onSlugInput(){this.autoUpdateSlug=!1},slugify(a){return!a||!a.length?"":r(a,{lower:!0})},submit(){this.$inertia.post(this.$route("admin.edu.labels.store"),this.formData)}}};var l=function(){var t=this,e=t._self._c;return e("form",{staticClass:"max-w-5xl mx-auto",attrs:{autocomplete:"off"},on:{submit:function(s){return s.preventDefault(),t.submit.apply(null,arguments)}}},[e("div",{staticClass:"flex flex-row items-center mb-6"},[e("h1",{staticClass:"font-medium mr-auto text-lg"},[t._v(" Create ")]),t.userCan("labels.view")?e("inertia-link",{staticClass:"button button-default-responsive button-primary-subtle flex flex-row items-center mr-2",attrs:{href:t.$route("admin.edu.labels.index")}},[e("icon-chevron-left",{staticClass:"w-5 md:mr-2"}),e("span",{staticClass:"hidden md:inline"},[t._v(" Back ")])],1):t._e(),t.userCan("labels.create")?e("button",{staticClass:"button button-default-responsive button-primary flex flex-row items-center",attrs:{type:"submit"}},[e("icon-save",{staticClass:"w-5 md:mr-2"}),e("span",{staticClass:"hidden md:inline"},[t._v(" Create ")])],1):t._e()],1),e("div",{staticClass:"bg-white py-6 shadow-subtle rounded-lg"},[e("div",{staticClass:"block px-6 w-full"},[e("input-group",{attrs:{"error-message":t.getPageErrorMessage("name"),"input-autocomplete":"name","input-id":"name","input-name":"name","input-required":!0,"input-type":"text","label-text":"Label"},on:{errorHidden:function(s){return t.clearPageErrorMessage("name")},input:t.onNameInput},model:{value:t.formData.name,callback:function(s){t.$set(t.formData,"name",s)},expression:"formData.name"}})],1)])])},m=[],f=o(u,l,m,!1,null,null,null,null);const b=f.exports;export{b as default};
