import{n as o,aD as l}from"./LogoLight.eb2f8316.js";import{W as i}from"./app.1a7ea90d.js";import"./vendor.21c2b6f5.js";import"./InputGroup.548575c6.js";import"./ConfirmationModal.41eb8e05.js";const n={name:"CourseCard",components:{IconPlus:l},props:{course:{required:!0,type:Object}},computed:{formattedCourseName(){let r=100;return this.course.name.length<=r?this.course.name:this.course.name.substring(0,r-3)+"..."},progress(){return Math.floor(Math.random()*101)}}};var c=function(){var t=this,e=t._self._c;return e("inertia-link",{staticClass:"flex flex-1 flex-col group relative",attrs:{href:t.$route("student.admin.show",t.course.slug),title:`View course: ${t.course.name}`}},[e("article",{staticClass:"flex flex-1 flex-col bg-white inset-0 overflow-hidden rounded-lg shadow-subtle ease-in-out duration-300 transition-colors hover:bg-gray-100"},[e("div",[e("div",{staticClass:"image-container relative w-full"},[e("img",{staticClass:"bg-gray-100 h-full object-cover w-full",attrs:{alt:"Course preview image",src:t.course.primary_image}}),e("div",{staticClass:"absolute flex h-full inset-0 items-center justify-center opacity-0 w-full ease-in-out duration-300 transition-opacity group-hover:opacity-100"},[e("span",{staticClass:"absolute bg-black h-full inset-0 opacity-40 w-full"}),e("icon-player-play-filled",{staticClass:"h-12 relative text-white w-12"})],1)])]),e("section",{staticClass:"px-6 mt-3 mb-3"},[e("h2",{staticClass:"font-semibold group-hover:underline text-xl",attrs:{title:t.course.name}},[t._v(" "+t._s(t.formattedCourseName)+" ")]),e("h3",{staticClass:"opacity-40 text-sm"},[t._v(" "+t._s(t.__("messages.author"))+": "),e("strong",[t._v(t._s(t.course.creator.name))])])])])])},u=[],d=o(n,c,u,!1,null,"cdba2cb1",null,null);const m=d.exports,_={name:"StudentAdminHomeIndex",components:{CourseCard:m,WysiwygField:i},layout:"student-admin-layout",props:{courses:{required:!0,type:Object|Array},announcements:{required:!0,type:Object|Array}},computed:{coursesData(){return this.courses?this.courses:!1}}};var p=function(){var t=this,e=t._self._c;return e("div",{staticClass:"max-w-screen-2xl mx-auto"},[t.announcements.length?e("div",t._l(t.announcements,function(s,a){return e("div",{key:"announcement-"+a+"-"+s.slug,staticClass:"bg-white border-t-4 border-light-500 rounded-b text-teal-900 px-4 py-3 mb-5 shadow-md",attrs:{role:"alert"}},[e("div",{staticClass:"flex"},[e("div",{staticClass:"py-1"},[e("svg",{staticClass:"fill-current h-6 w-6 text-teal-500 mr-4",attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"}},[e("path",{attrs:{d:"M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"}})])]),e("div",[e("p",{staticClass:"font-bold"},[t._v(t._s(s.title))]),e("p",{staticClass:"text-sm",domProps:{innerHTML:t._s(s.description)}})])])])}),0):t._e(),e("div",{staticClass:"flex flex-row items-center mb-6"},[e("h1",{staticClass:"font-semibold mr-auto text-3xl"},[t._v(" "+t._s(t.__("messages.my-courses"))+" ")])]),t.coursesData?[e("div",{staticClass:"grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"},t._l(t.coursesData,function(s,a){return e("course-card",{key:a+s.slug,attrs:{course:s}})}),1)]:e("p",{staticClass:"bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"},[t._v(" "+t._s(t.__("messages.no-results"))+" ")])],2)},f=[],v=o(_,p,f,!1,null,null,null,null);const y=v.exports;export{y as default};
