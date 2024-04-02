import{s as r}from"./vendor.c4aed689.js";import{I as l}from"./InputGroup.a0b1f6ab.js";import{S as u}from"./app.c87722bf.js";import{n as c}from"./LogoLight.682f8f67.js";import"./ConfirmationModal.e511f35f.js";let n=axios.CancelToken,i=n.source(),s=n.source();const p={name:"AdminCrmOrganisationUnitCreate",components:{InputGroup:l,SelectGroup:u},layout:"admin-layout",props:{types:{type:Object,required:!0}},data(){return{autoUpdateSlug:!0,companies:[],formData:{company_id:"",email:"",location_id:"",name:"",notification_emails:[],parent_id:null,slug:"",socials:{facebook:"",instagram:"",linkedin:"",snapchat:"",tiktok:"",twitter:"",youtube:""},telephone:"",type:""},isLoadingCompanies:!1,isLoadingLocations:!1,locations:[],selected_company_id:null,selected_location_id:null}},computed:{showCompanySelect(){return["location","department"].indexOf(this.formData.type)>-1},showLocationSelect(){return this.formData.type==="department"}},methods:{loadCompanies(){this.isLoadingCompanies&&(i.cancel("Companies load cancelled"),i=n.source()),this.isLoadingCompanies=!0,axios.get(this.$route("admin.api.crm.organisation-units.index"),{params:{organisation_unit_type:"company"}}).then(o=>{this.companies=o.data.data}).catch(o=>{axios.isCancel(o)||this.$errorToast("Failed to load companies")}).finally(()=>{this.isLoadingCompanies=!1})},loadLocations(){this.isLoadingLocations&&(s.cancel("Locations load cancelled"),s=n.source()),this.isLoadingLocations=!0,axios.get(this.$route("admin.api.crm.organisation-units.index"),{params:{organisation_unit_type:"location",organisation_unit_company_id:this.formData.company_id}}).then(o=>{this.locations=o.data.data}).catch(o=>{axios.isCancel(o)||this.$errorToast("Failed to load locations")}).finally(()=>{this.isLoadingLocations=!1})},onCompanyInput(){console.log("onCompanyInput",this.formData.company_id),this.locations=[],this.formData.location_id=null,this.showLocationSelect?(this.formData.parent_id=null,this.loadLocations()):this.formData.company_id&&(this.formData.parent_id=this.formData.company_id)},onLocationInput(){this.formData.location_id?this.formData.parent_id=this.formData.location_id:this.formData.parent_id=null},onNameInput(){!this.autoUpdateSlug||(this.formData.slug=this.slugify(this.formData.name))},onSlugBlur(){this.formData.slug=this.slugify(this.formData.slug)},onSlugInput(){this.autoUpdateSlug=!1},onTypeInput(){this.companies=[],this.locations=[],this.formData.company_id=null,this.formData.location_id=null,this.formData.parent_id=null,this.showCompanySelect&&this.loadCompanies()},slugify(o){return!o||!o.length?"":r(o,{lower:!0})},submit(){this.$inertia.post(this.$route("admin.crm.organisation-units.store"),this.formData)}}};var m=function(){var t=this,a=t._self._c;return a("form",{staticClass:"max-w-5xl mx-auto",attrs:{autocomplete:"off"},on:{submit:function(e){return e.preventDefault(),t.submit.apply(null,arguments)}}},[t.userCan("crm_orgamisation_units.create")?a("div",{staticClass:"flex flex-row items-center mb-6"},[a("h1",{staticClass:"font-medium mr-auto text-lg"},[t._v(" Create Organisation Unit ")]),t.userCan("crm_orgamisation_units.view")?a("inertia-link",{staticClass:"button button-default-responsive button-primary-subtle flex flex-row items-center mr-2",attrs:{href:t.$route("admin.crm.organisation-units.index")}},[a("icon-chevron-left",{staticClass:"w-5 md:mr-2"}),a("span",{staticClass:"hidden md:inline"},[t._v(" Back ")])],1):t._e(),a("button",{staticClass:"button button-default-responsive button-primary flex flex-row items-center",attrs:{type:"submit"}},[a("icon-save",{staticClass:"w-5 md:mr-2"}),a("span",{staticClass:"hidden md:inline"},[t._v(" Create Organisation Unit ")])],1)],1):t._e(),a("div",{staticClass:"bg-white py-6 shadow-subtle rounded-lg"},[a("div",{staticClass:"block px-6 w-full"},[a("select-group",{attrs:{"error-message":t.getPageErrorMessage("type"),"input-any-option-enabled":!0,"input-any-option-label":"Please select a type","input-autofocus":!0,"input-id":"type","input-name":"Type","input-options":t.types,"input-required":!0,"label-text":"Type"},on:{errorHidden:function(e){return t.clearPageErrorMessage("type")},input:t.onTypeInput},model:{value:t.formData.type,callback:function(e){t.$set(t.formData,"type",e)},expression:"formData.type"}}),t.showCompanySelect?a("select-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("company_id"),"input-any-option-enabled":!0,"input-any-option-label":t.isLoadingCompanies?"Loading...":"Please select a company","input-any-option-value":null,"input-disabled":t.isLoadingCompanies||!t.companies||!t.companies.length,"input-id":"company_id","input-name":"company_id","input-option-force-formatting":!0,"input-option-label-key":"name","input-option-value-key":"id","input-options":t.companies,"input-required":!0,"label-text":"Company"},on:{errorHidden:function(e){return t.clearPageErrorMessage("company_id")},input:t.onCompanyInput},model:{value:t.formData.company_id,callback:function(e){t.$set(t.formData,"company_id",e)},expression:"formData.company_id"}}):t._e(),t.showLocationSelect?a("select-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("location_id"),"input-any-option-enabled":!0,"input-any-option-label":t.isLoadingLocations?"Loading...":"Please select a location","input-any-option-value":null,"input-disabled":t.isLoadingLocations||!t.locations||!t.locations.length,"input-id":"location_id","input-name":"location_id","input-option-force-formatting":!0,"input-option-label-key":"name","input-option-value-key":"id","input-options":t.locations,"input-required":!0,"label-text":"Location"},on:{errorHidden:function(e){return t.clearPageErrorMessage("location_id")},input:t.onLocationInput},model:{value:t.formData.location_id,callback:function(e){t.$set(t.formData,"location_id",e)},expression:"formData.location_id"}}):t._e()],1)]),a("div",{staticClass:"bg-white mt-6 py-6 shadow-subtle rounded-lg"},[a("div",{staticClass:"block px-6 w-full"},[a("span",{staticClass:"text-lg"},[t._v("Contact Details")]),a("input-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("name"),"input-autocomplete":"name","input-id":"name","input-name":"name","input-required":!0,"input-type":"text","label-text":"Name"},on:{errorHidden:function(e){return t.clearPageErrorMessage("name")},input:t.onNameInput},model:{value:t.formData.name,callback:function(e){t.$set(t.formData,"name",e)},expression:"formData.name"}}),a("input-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("slug"),"input-autocomplete":"slug","input-id":"slug","input-name":"slug","input-required":!0,"input-type":"text","label-text":"Slug"},on:{blur:t.onSlugBlur,errorHidden:function(e){return t.clearPageErrorMessage("slug")},input:t.onSlugInput},model:{value:t.formData.slug,callback:function(e){t.$set(t.formData,"slug",e)},expression:"formData.slug"}}),a("input-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("email"),"input-autocomplete":"organisation_unit_email","input-id":"email","input-name":"email","input-required":!0,"input-type":"email","label-text":"Email"},on:{errorHidden:function(e){return t.clearPageErrorMessage("email")}},model:{value:t.formData.email,callback:function(e){t.$set(t.formData,"email",e)},expression:"formData.email"}}),a("input-group",{staticClass:"mt-4",attrs:{"error-message":t.getPageErrorMessage("telephone"),"input-autocomplete":"organisation_unit_telephone","input-id":"telephone","input-name":"telephone","input-type":"text","label-text":"Telephone"},on:{errorHidden:function(e){return t.clearPageErrorMessage("telephone")}},model:{value:t.formData.telephone,callback:function(e){t.$set(t.formData,"telephone",e)},expression:"formData.telephone"}})],1)]),a("div",{staticClass:"bg-white mt-6 py-6 shadow-subtle rounded-lg"},[a("div",{staticClass:"block px-6 w-full"},[a("span",{staticClass:"text-lg"},[t._v("Socials")]),a("div",{staticClass:"flex flex-col md:flex-row md:space-x-4"},[a("input-group",{staticClass:"mt-4 md:flex-1",attrs:{"error-message":t.getPageErrorMessage("socials.youtube"),"input-autocomplete":"youtube_account","input-id":"youtube_account","input-name":"youtube_account","input-required":!1,"input-type":"text","label-text":"Youtube"},on:{errorHidden:function(e){return t.clearPageErrorMessage("socials.youtube")}},model:{value:t.formData.socials.youtube,callback:function(e){t.$set(t.formData.socials,"youtube",e)},expression:"formData.socials.youtube"}})],1),a("div",{staticClass:"flex flex-col md:flex-row md:space-x-4"},[a("input-group",{staticClass:"mt-4 md:flex-1",attrs:{"error-message":t.getPageErrorMessage("socials.facebook"),"input-autocomplete":"facebook_account","input-id":"facebook_account","input-name":"facebook_account","input-required":!1,"input-type":"text","label-text":"Facebook"},on:{errorHidden:function(e){return t.clearPageErrorMessage("socials.facebook")}},model:{value:t.formData.socials.facebook,callback:function(e){t.$set(t.formData.socials,"facebook",e)},expression:"formData.socials.facebook"}}),a("input-group",{staticClass:"mt-4 md:flex-1",attrs:{"error-message":t.getPageErrorMessage("socials.instagram"),"input-autocomplete":"instagram_account","input-id":"instagram_account","input-name":"instagram_account","input-required":!1,"input-type":"text","label-text":"Instagram"},on:{errorHidden:function(e){return t.clearPageErrorMessage("socials.instagram")}},model:{value:t.formData.socials.instagram,callback:function(e){t.$set(t.formData.socials,"instagram",e)},expression:"formData.socials.instagram"}})],1),a("div",{staticClass:"flex flex-col md:flex-row md:space-x-4"},[a("input-group",{staticClass:"mt-4 md:flex-1",attrs:{"error-message":t.getPageErrorMessage("socials.linkedin"),"input-autocomplete":"linkedin_account","input-id":"linkedin_account","input-name":"linkedin_account","input-required":!1,"input-type":"text","label-text":"Linkedin"},on:{errorHidden:function(e){return t.clearPageErrorMessage("socials.linkedin")}},model:{value:t.formData.socials.linkedin,callback:function(e){t.$set(t.formData.socials,"linkedin",e)},expression:"formData.socials.linkedin"}}),a("input-group",{staticClass:"mt-4 md:flex-1",attrs:{"error-message":t.getPageErrorMessage("socials.snapchat"),"input-autocomplete":"snapchat_account","input-id":"snapchat_account","input-name":"snapchat_account","input-required":!1,"input-type":"text","label-text":"Snapchat"},on:{errorHidden:function(e){return t.clearPageErrorMessage("socials.snapchat")}},model:{value:t.formData.socials.snapchat,callback:function(e){t.$set(t.formData.socials,"snapchat",e)},expression:"formData.socials.snapchat"}})],1),a("div",{staticClass:"flex flex-col md:flex-row md:space-x-4"},[a("input-group",{staticClass:"mt-4 md:flex-1",attrs:{"error-message":t.getPageErrorMessage("socials.tiktok"),"input-autocomplete":"tiktok_account","input-id":"tiktok_account","input-name":"tiktok_account","input-required":!1,"input-type":"text","label-text":"TikTok"},on:{errorHidden:function(e){return t.clearPageErrorMessage("socials.tiktok")}},model:{value:t.formData.socials.tiktok,callback:function(e){t.$set(t.formData.socials,"tiktok",e)},expression:"formData.socials.tiktok"}}),a("input-group",{staticClass:"mt-4 md:flex-1",attrs:{"error-message":t.getPageErrorMessage("socials.twitter"),"input-autocomplete":"twitter_account","input-id":"twitter_account","input-name":"twitter_account","input-required":!1,"input-type":"text","label-text":"Twitter/X"},on:{errorHidden:function(e){return t.clearPageErrorMessage("socials.twitter")}},model:{value:t.formData.socials.twitter,callback:function(e){t.$set(t.formData.socials,"twitter",e)},expression:"formData.socials.twitter"}})],1)])])])},d=[],f=c(p,m,d,!1,null,null,null,null);const b=f.exports;export{b as default};
