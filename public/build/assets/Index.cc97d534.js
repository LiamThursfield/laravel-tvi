import{n as i}from"./LogoLight.eb2f8316.js";import"./vendor.21c2b6f5.js";const a={name:"Index",layout:"home-layout",props:{courses:{type:Array}},data(){return{isLoading:!0}}};var r=function(){var t=this,e=t._self._c;return t.isLoading?t._e():e("div",{staticClass:"bg-gray-100 flex flex-col min-h-screen min-w-screen"},[e("nav",{staticClass:"bg-white py-3"},[e("div",{staticClass:"container flex flex-row justify-between mx-auto px-4"},[e("inertia-link",{staticClass:"font-semibold hover:text-theme-primary-hover",attrs:{href:"/"}},[t._v(" Home ")]),e("ul",{staticClass:"flex flex-row space-x-4"},[t.$page.props.auth.user?[t.userCan("admin.view")?e("li",[e("inertia-link",{staticClass:"hover:text-theme-primary-hover",attrs:{href:t.$route("admin.index")}},[t._v(" Lecturer Admin ")])],1):t._e(),t.userCan("student_admin.view")?e("li",[e("inertia-link",{staticClass:"hover:text-theme-primary-hover",attrs:{href:t.$route("student.admin.index")}},[t._v(" Student Admin ")])],1):t._e()]:[t.$routeCheck("student.login")?e("li",[e("inertia-link",{staticClass:"hover:text-theme-primary-hover",attrs:{href:t.$route("student.login")}},[t._v(" Student Login ")])],1):t._e(),t.$routeCheck("student.register")?e("li",[e("inertia-link",{staticClass:"hover:text-theme-primary-hover",attrs:{href:t.$route("student.register")}},[t._v(" Student Register ")])],1):t._e()]],2)],1)]),e("section",{staticClass:"container mt-4 mx-auto px-4"},[e("h1",{staticClass:"font-semibold text-xl"},[t._v(" Welcome to "+t._s(t.$page.props.tenant.id)+" ")])]),t.courses&&t.courses.length?e("section",{staticClass:"container mt-4 mx-auto px-4"},[e("h1",{staticClass:"font-semibold text-lg"},[t._v(" Featured Courses ")]),e("div",{staticClass:"grid gap-4 mt-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"},t._l(t.courses,function(s){return e("div",[e("inertia-link",{staticClass:"flex flex-1 flex-col group h-full relative",attrs:{href:t.$route("website.edu.courses.show",s.slug),title:`View course: ${s.name}`}},[e("article",{staticClass:"flex flex-1 flex-col bg-white inset-0 overflow-hidden rounded-lg shadow-subtle ease-in-out duration-300 transition-colors hover:bg-gray-100"},[e("div",[e("div",{staticClass:"aspect-ratio-16-9 relative w-full"},[e("img",{staticClass:"bg-gray-100 h-full object-cover w-full",attrs:{alt:"Course preview image",src:s.primary_image}}),e("div",{staticClass:"absolute flex h-full inset-0 items-center justify-center opacity-0 w-full ease-in-out duration-300 transition-opacity group-hover:opacity-100"},[e("span",{staticClass:"absolute bg-black h-full inset-0 opacity-40 w-full"}),e("icon-player-play-filled",{staticClass:"h-12 relative text-white w-12"})],1)])]),e("section",{staticClass:"pb-3 px-6 mt-3"},[e("h3",{staticClass:"font-semibold text-sm group-hover:underline",attrs:{title:s.name}},[t._v(" "+t._s(s.name)+" ")])])])])],1)}),0)]):t._e()])},l=[],n=i(a,r,l,!1,null,null,null,null);const d=n.exports;export{d as default};
