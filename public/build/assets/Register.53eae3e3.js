import{I as a}from"./InputGroup.23900402.js";import{n as s}from"./LogoLight.dd39b68d.js";import"./vendor.d799578a.js";const n={name:"AuthRegister",components:{InputGroup:a},layout:"auth-layout",data(){return{form:{email:"",first_name:"",last_name:"",password:"",password_confirmation:""}}},methods:{submit(){this.$inertia.post(this.$route("register"),this.form)}}};var i=function(){var e=this,r=e._self._c;return r("div",{staticClass:"auth-card-container"},[r("div",{staticClass:"auth-card"},[r("h1",{staticClass:"auth-header"},[e._v(" Welcome ")]),r("form",{staticClass:"px-6",on:{submit:function(t){return t.preventDefault(),e.submit.apply(null,arguments)}}},[r("div",{staticClass:"flex flex-col md:flex-row md:space-x-2"},[r("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("first_name"),"input-autocomplete":"given-name","input-autofocus":!0,"input-class":"auth-input","input-id":"first_name","input-name":"first_name","input-required":!0,"input-type":"first_name","label-text":"First Name"},on:{errorHidden:function(t){return e.clearPageErrorMessage("first_name")}},model:{value:e.form.first_name,callback:function(t){e.$set(e.form,"first_name",t)},expression:"form.first_name"}}),r("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("last_name"),"input-autocomplete":"family-name","input-class":"auth-input","input-id":"last_name","input-name":"last_name","input-required":!0,"input-type":"last_name","label-text":"Last Name"},on:{errorHidden:function(t){return e.clearPageErrorMessage("last_name")}},model:{value:e.form.last_name,callback:function(t){e.$set(e.form,"last_name",t)},expression:"form.last_name"}})],1),r("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("email"),"input-autocomplete":"email","input-class":"auth-input","input-id":"email","input-name":"email","input-required":!0,"input-type":"email","label-text":"Email"},on:{errorHidden:function(t){return e.clearPageErrorMessage("email")}},model:{value:e.form.email,callback:function(t){e.$set(e.form,"email",t)},expression:"form.email"}}),r("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("password"),"input-autocomplete":"new-password","input-class":"auth-input","input-id":"password","input-name":"password","input-required":!0,"input-type":"password","label-text":"Password"},on:{errorHidden:function(t){return e.clearPageErrorMessage("password")}},model:{value:e.form.password,callback:function(t){e.$set(e.form,"password",t)},expression:"form.password"}}),r("input-group",{staticClass:"mt-4",attrs:{"error-message":e.getPageErrorMessage("password_confirmation"),"input-autocomplete":"new-password","input-class":"auth-input","input-id":"password_confirmation","input-name":"password_confirmation","input-required":!0,"input-type":"password","label-text":"Confirm Password"},on:{errorHidden:function(t){return e.clearPageErrorMessage("password_confirmation")}},model:{value:e.form.password_confirmation,callback:function(t){e.$set(e.form,"password_confirmation",t)},expression:"form.password_confirmation"}}),r("div",{staticClass:"flex flex-row items-center justify-between mt-4 py-6"},[r("button",{staticClass:"bg-theme-primary px-4 py-2 rounded shadow text-theme-primary-contrast focus:outline-none focus:ring focus:ring-primary hover:bg-theme-primary-hover hover:shadow-lg transition-all ease-in-out duration-300",attrs:{type:"submit"}},[e._v(" Register ")]),r("inertia-link",{staticClass:"text-gray-900 hover:text-theme-primary transition-all ease-in-out duration-300",attrs:{href:e.$route("login")}},[e._v(" Already registered? ")])],1)],1)])])},o=[],u=s(n,i,o,!1,null,null,null,null);const d=u.exports;export{d as default};
