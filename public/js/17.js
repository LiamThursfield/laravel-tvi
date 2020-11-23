(window.webpackJsonp=window.webpackJsonp||[]).push([[17],{qQAs:function(e,t,i){"use strict";i.r(t);var r=i("LvDl"),n=i.n(r),s={name:"FileManagerDirectoryList",props:{canChangeDirectory:{default:!1,type:Boolean},directories:{required:!0,type:Array},isLoadingDirectories:{default:!1,type:Boolean},parentDirectory:{required:!0,type:null|String}},methods:{changeDirectory:function(e){this.$emit("changeDirectory",e)}}},o=i("KHd+"),a=Object(o.a)(s,(function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("ul",[e.isLoadingDirectories?[i("li",{staticClass:"flex flex-row items-start text-theme-base-subtle-contrast py-1 w-full"},[i("icon-loader-circle",{staticClass:"animate-spin-slow mr-2 w-5"}),e._v(" "),i("span",[e._v("Loading")])],1)]:[null!==e.parentDirectory?i("li",[i("button",{staticClass:"\n                    flex flex-row items-start py-1 w-full\n                    focus:outline-none focus:text-theme-primary\n                    hover:text-theme-primary\n                ",attrs:{disabled:!e.canChangeDirectory,type:"button"},on:{click:function(t){return e.changeDirectory(e.parentDirectory)}}},[i("icon-arrow-bar-up",{staticClass:"mr-2 w-5"}),e._v(" "),i("span",[e._v("Parent Directory")])],1)]):e._e(),e._v(" "),e._l(e.directories,(function(t){return i("li",{key:t.directory},[i("button",{staticClass:"\n                    flex flex-row items-start py-1 w-full\n                    focus:outline-none focus:text-theme-primary\n                    hover:text-theme-primary\n                ",attrs:{type:"button",disabled:!e.canChangeDirectory},on:{click:function(i){return e.changeDirectory(t.directory)}}},[i("icon-folder",{staticClass:"mr-2 w-5"}),e._v(" "),i("span",[e._v(e._s(t.label))])],1)])}))]],2)}),[],!1,null,null,null).exports,c={name:"FileManagerFilesHeader",props:{canChangeDirectory:{default:!1,type:Boolean},currentDirectoryList:{required:!0,type:Array},showBreadcrumbs:{default:!1,type:Boolean}},methods:{changeDirectoryViaBreadcrumb:function(e){this.$emit("changeDirectoryViaBreadcrumb",e)}}},l=Object(o.a)(c,(function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("h2",{staticClass:"flex flex-row items-center justify-between"},[i("span",{staticClass:"text-theme-base-subtle-contrast"},[e._v("\n        Files\n    ")]),e._v(" "),e.showBreadcrumbs?i("span",{staticClass:"flex flex-row space-x-2 text-sm"},e._l(e.currentDirectoryList,(function(t,r){return i("span",{key:"breadcrumb_"+r,staticClass:"flex flex-row"},[r<e.currentDirectoryList.length-1?[i("button",{staticClass:"\n                        text-theme-base-subtle-contrast\n                        focus:outline-none focus:text-theme-primary\n                        hover:text-theme-primary\n                    ",attrs:{type:"button",disabled:!e.canChangeDirectory},on:{click:function(t){return e.changeDirectoryViaBreadcrumb(r)}}},[0===r?[e._v("\n                        root\n                    ")]:[e._v("\n                        "+e._s(t)+"\n                    ")]],2),e._v(" "),i("span",{staticClass:"ml-2 text-gray-300"},[e._v("\n                    /\n                ")])]:[i("span",{staticClass:"text-theme-base-subtle-contrast",class:{"opacity-50":!e.canChangeDirectory}},[e._v("\n                    "+e._s(t)+"\n                ")])]],2)})),0):e._e()])}),[],!1,null,null,null).exports,u=i("lN98"),d=i.n(u),h=i("NmYn"),f=i.n(h),m=i("b5oN"),p=(i("0EnR"),i("wK6g")),y={name:"FileManagerFilesListFile",components:{IconInfoSquare:i("d1pi").default,IconExternalLink:p.default},props:{file:{required:!0,type:Object}},data:function(){return{isDropdownPreviewLoaded:!1}},computed:{etag:function(){return this.file.meta.etag.split('"').join("")},fileDropdownMeta:function(){var e={};return this.fileUpdatedAt&&(e["Last Updated"]=this.fileUpdatedAt),this.fileSize&&(e.Size=this.fileSize),this.fileExtension&&(e["File Extension"]=this.fileExtension),this.file.url&&(e.URL=this.file.url),e},fileExtension:function(){try{return this.file.meta.extension}catch(e){return!1}},fileIcon:function(){try{switch(this.file.meta.mimetype.toLowerCase()){case"image/jpeg":case"image/png":return"icon-photo";case"application/pdf":case"text/plain":return"icon-file-text";default:return"icon-file"}}catch(e){return"icon-file"}},fileNameSlug:function(){return f()(this.file.meta.basename,{remove:"."})},fileSize:function(){try{return d()(this.file.meta.size)}catch(e){return!1}},fileUpdatedAt:function(){try{return new Date(this.file.meta.timestamp).toLocaleString()}catch(e){return!1}},infoButtonId:function(){return"info-button-"+this.fileNameSlug},isFileDropdownMeta:function(){try{return Object.keys(this.fileDropdownMeta).length}catch(e){return!1}},isFileImage:function(){try{return 0===this.file.meta.mimetype.indexOf("image")}catch(e){return!1}},showDropdownPreview:function(){return this.isDropdownPreviewLoaded&&this.isFileImage}},mounted:function(){this.initialiseFileDropdown()},methods:{initialiseFileDropdown:function(){if(this.isFileDropdownMeta){var e=this.$refs.infoDropdownMenu;e.style.display="block",Object(m.a)("#"+this.infoButtonId,{animation:"shift-away-extreme",content:e,interactive:!0,placement:"bottom-end",theme:"dropdown",trigger:"click"})}},onDropdownButtonClick:function(){this.isDropdownPreviewLoaded=!0}}},g={name:"FileManagerFilesList",components:{FileManagerFilesListFile:Object(o.a)(y,(function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("li",{staticClass:"\n        flex flex-row items-start justify-between py-2 space-x-4\n        ease-in-out duration-300 transition-colors\n        hover:bg-gray-100\n    "},[i("div",{staticClass:"flex flex-row items-start"},[i(e.fileIcon,{tag:"component",staticClass:"min-w-5 mr-2 w-5"}),e._v(" "),i("span",[e._v(e._s(e.file.meta.basename))])],1),e._v(" "),i("div",{staticClass:"flex flex-row items-center space-x-2"},[e.file.url?i("a",{staticClass:"\n                flex flex-row items-center justify-center rounded text-theme-base-subtle-contrast\n                ease-in-out duration-300 transition-colors\n                focus:text-theme-primary focus:outline-none\n                hover:text-theme-primary\n            ",attrs:{href:e.file.url,rel:"noreferrer noopener nofollow",target:"_blank"}},[i("icon-external-link",{staticClass:"w-5"})],1):e._e(),e._v(" "),i("div",[e.isFileDropdownMeta?i("button",{staticClass:"\n                    flex flex-row items-center justify-center rounded text-theme-base-subtle-contrast\n                    ease-in-out duration-300 transition-colors\n                    focus:text-theme-primary focus:outline-none\n                    hover:text-theme-primary\n                ",attrs:{id:e.infoButtonId,type:"button"},on:{click:e.onDropdownButtonClick}},[i("icon-info-square",{staticClass:"w-5"})],1):e._e(),e._v(" "),e.isFileDropdownMeta?i("div",{ref:"infoDropdownMenu",staticClass:"\n                    flex flex-col px-4 py-4 space-y-3\n                    focus:outline-none\n                "},[e.showDropdownPreview?i("div",[i("img",{staticClass:"max-w-full",attrs:{src:e.file.url,alt:""}})]):e._e(),e._v(" "),e._l(e.fileDropdownMeta,(function(t,r){return i("p",{key:r},[i("span",{staticClass:"block text-theme-base-subtle-contrast text-xs"},[e._v("\n                        "+e._s(r)+"\n                    ")]),e._v(" "),i("span",{staticClass:"block break-all text-gray-700 text-sm"},[e._v("\n                        "+e._s(t)+"\n                    ")])])}))],2):e._e()])])])}),[],!1,null,null,null).exports},props:{files:{required:!0,type:Array},showFilesLoader:{default:!0,type:Boolean}},computed:{isFiles:function(){return this.files.length}}},w=Object(o.a)(g,(function(){var e=this.$createElement,t=this._self._c||e;return t("ul",[this.showFilesLoader?[t("li",{staticClass:"flex flex-row items-center justify-center text-theme-base-subtle-contrast text-sm py-4 w-full"},[t("span",{staticClass:"flex items-center"},[t("icon-loader-circle",{staticClass:"animate-spin-slow mr-2 w-5"}),this._v(" "),t("span",[this._v("Loading")])],1)])]:this.isFiles?this._l(this.files,(function(e){return t("file-manager-files-list-file",{key:e.meta.basename,staticClass:"-mx-6 px-6",attrs:{file:e}})})):[this._m(0)]],2)}),[function(){var e=this.$createElement,t=this._self._c||e;return t("li",{staticClass:"flex flex-row items-center justify-center text-theme-base-subtle-contrast text-sm py-4 w-full"},[t("span",[this._v("No files")])])}],!1,null,null,null).exports,D=i("ksP6");function b(e,t){var i=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),i.push.apply(i,r)}return i}function v(e){for(var t=1;t<arguments.length;t++){var i=null!=arguments[t]?arguments[t]:{};t%2?b(Object(i),!0).forEach((function(t){x(e,t,i[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(i)):b(Object(i)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(i,t))}))}return e}function x(e,t,i){return t in e?Object.defineProperty(e,t,{value:i,enumerable:!0,configurable:!0,writable:!0}):e[t]=i,e}var C={name:"FileManagerFileUploader",components:{vue2Dropzone:i.n(D).a},props:{id:{default:"file-manager-file-uploader-dropzone",type:String},directory:{default:"/",type:String},url:{required:!0,type:String}},computed:{dropzoneOptions:function(){var e={};return e.url=this.url,e.headers=v(v({},axios.defaults.headers.common),{},{"X-XSRF-TOKEN":this.$cookies.get("XSRF-TOKEN")}),e}},methods:{onDirectoryChange:function(){try{this.$refs[this.id].removeAllFiles()}catch(e){console.log(e)}},onError:function(e,t,i){var r="Failed to upload ";e&&e.name?r+="'"+e.name+"' ":r+="file ",t&&t.message&&(r+="- "+t.message),this.$errorToast(r)},onFilesAdded:function(){this.$emit("filesAdded")},onQueueComplete:function(){this.$emit("queueCompleted")},onSending:function(e,t,i){i.append("directory",this.directory)}},watch:{directory:{handler:"onDirectoryChange"}}},_=Object(o.a)(C,(function(){var e=this.$createElement,t=this._self._c||e;return t("div",[t("vue2-dropzone",{ref:this.id,attrs:{id:this.id,duplicateCheck:!0,options:this.dropzoneOptions},on:{"vdropzone-error":this.onError,"vdropzone-files-added":this.onFilesAdded,"vdropzone-sending":this.onSending,"vdropzone-queue-complete":this.onQueueComplete}})],1)}),[],!1,null,null,null).exports,F=axios.CancelToken,L=F.source(),j={name:"FileManager",components:{FileManagerFileUploader:_,FileManagerDirectoryList:a,FileManagerFilesHeader:l,FileManagerFilesList:w},props:{initialise:{default:!1,type:Boolean}},data:function(){return{currentDirectory:"/",directories:[],files:[],isInitialised:!1,isCreatingDirectory:!1,isLoadingDirectories:!1,isLoadingFiles:!1,isLoadingNewDirectory:!1,isLoadingFileUpload:!1,newDirectoryName:""}},computed:{canChangeDirectory:function(){return!this.isLoadingNewDirectory&&!this.isLoadingDirectories&&!this.isLoadingFileUpload},canCreateDirectory:function(){return!!this.isCreatingDirectory&&(!this.isLoadingNewDirectory&&(!this.isLoadingFileUpload&&!!n.a.trim(this.newDirectoryName).length))},canUploadFiles:function(){return!this.isLoadingDirectories},currentDirectoryList:function(){var e=n.a.trim(this.currentDirectory,"/");if(!e)return["/"];var t=n.a.split(e,"/");return["/"].concat(t)},newDirectoryNameFormatted:function(){if(!this.currentDirectoryList||this.currentDirectoryList.length<2)return this.newDirectoryName;var e=n.a.clone(this.currentDirectoryList);return(e=e.splice(1)).push(this.newDirectoryName),"/"+e.join("/")},parentDirectory:function(){return this.currentDirectoryList?1===this.currentDirectoryList.length?null:2===this.currentDirectoryList.length?this.currentDirectoryList[0]:"/"+n.a.clone(this.currentDirectoryList).splice(1,this.currentDirectoryList.length-2).join("/"):null},showBreadcrumbs:function(){return this.currentDirectoryList.length>1},showCreateDirectoryButton:function(){return!this.isLoadingDirectories&&!this.isLoadingFileUpload&&this.userCan("file_manager.edit")},showFilesLoader:function(){return this.isLoadingDirectories||this.isLoadingFiles},showFileUploader:function(){return this.canUploadFiles&&this.userCan("file_manager.edit")},uploaderDirectory:function(){var e="/";return"/"!==this.currentDirectory&&(e+=this.currentDirectory),e}},mounted:function(){this.initialise&&this.initialiseFileManager()},methods:{cancelLoadFiles:function(){this.isLoadingFiles&&(L.cancel("Files load cancelled"),L=F.source())},changeDirectory:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"/";this.canChangeDirectory?(this.currentDirectory=e,this.loadDirectories()):this.$errorToast("Unable to change directory")},changeDirectoryViaBreadcrumb:function(e){if(!(e>this.currentDirectoryList.length-1)){var t=this.getDirectoryViaBreadcrumb(e);t&&this.changeDirectory(t)}},createDirectory:function(){var e=this;if(this.canCreateDirectory){this.isLoadingNewDirectory=!0;var t={directory:this.newDirectoryNameFormatted};axios.post(this.$route("admin.api.file-manager.directories.store"),t).then((function(t){e.isLoadingNewDirectory=!1,e.changeDirectory(e.newDirectoryNameFormatted),e.stopCreatingDirectory()})).catch((function(t){e.$errorToast("Failed to create directory"),e.isLoadingNewDirectory=!1}))}else this.$errorToast("Please enter a valid directory name")},getDirectoryViaBreadcrumb:function(e){if(0===e)return"/";var t=n.a.clone(this.currentDirectoryList);return"/"+(t=t.splice(1,e)).join("/")},initialiseFileManager:function(){this.isInitialised||(this.isInitialised=!0,this.loadFileManager())},loadDirectories:function(){var e=this;if(!this.isLoadingDirectories){this.isLoadingDirectories=!0,this.directories=[],this.cancelLoadFiles();var t={directory:this.currentDirectory};axios.get(this.$route("admin.api.file-manager.directories.index"),{params:t}).then((function(t){t.data.hasOwnProperty("directories")&&(e.directories=t.data.directories),e.loadFiles()})).catch((function(t){e.$errorToast("Failed to load directories")})).finally((function(){e.isLoadingDirectories=!1}))}},loadFileManager:function(){this.loadDirectories()},loadFiles:function(){var e=this;if(!this.isLoadingFiles){this.isLoadingFiles=!0,this.files=[];var t={directory:this.currentDirectory};axios.get(this.$route("admin.api.file-manager.files.index"),{params:t,cancelToken:L.token}).then((function(t){t.data.hasOwnProperty("files")&&(e.files=t.data.files)})).catch((function(t){axios.isCancel(t)||e.$errorToast("Failed to load files")})).finally((function(){e.isLoadingFiles=!1}))}},onFileUploaderFilesAdded:function(){this.isLoadingFileUpload=!0},onFileUploaderCompleted:function(){this.isLoadingFileUpload=!1,this.loadFiles()},onInitialise:function(){this.initialise&&this.initialiseFileManager()},startCreatingDirectory:function(){var e=this;this.newDirectoryName="",this.isCreatingDirectory=!0;try{setTimeout((function(){e.$refs.new_directory.focus()}),450)}catch(e){}},stopCreatingDirectory:function(){if(this.isCreatingDirectory){if(this.isLoadingNewDirectory)return!1;this.newDirectoryName="",this.isCreatingDirectory=!1;try{this.$refs.new_directory.blur()}catch(e){}}}},watch:{initialise:{handler:"onInitialise"}}},N={name:"AdminFileManagerIndex",components:{FileManager:Object(o.a)(j,(function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("section",[i("div",{staticClass:"\n            flex flex-col mt-4 space-y-4\n            md:flex-row md:items-start md:space-x-4 md:space-y-0\n        "},[i("div",{staticClass:"\n                bg-white p-6 shadow-subtle overflow-hidden rounded-lg\n                md:w-72\n            "},[e._m(0),e._v(" "),i("div",{staticClass:"mt-2"},[i("file-manager-directory-list",{attrs:{canChangeDirectory:e.canChangeDirectory,directories:e.directories,isLoadingDirectories:e.isLoadingDirectories,parentDirectory:e.parentDirectory},on:{changeDirectory:e.changeDirectory}}),e._v(" "),e.showCreateDirectoryButton?i("div",{staticClass:"mt-8 w-full"},[i("transition",{attrs:{name:"slide-left-multiple",mode:"out-in"}},[e.isCreatingDirectory?i("div",{key:"creating",staticClass:"flex flex-col"},[i("label",{attrs:{for:"new_directory",hidden:""}},[e._v("\n                                New Directory Name\n                            ")]),e._v(" "),i("input",{directives:[{name:"model",rawName:"v-model",value:e.newDirectoryName,expression:"newDirectoryName"}],ref:"new_directory",staticClass:"\n                                    appearance-none border border-theme-base-subtle-contrast px-4 py-1 rounded shadow-none\n                                    focus:outline-none focus:shadow-outline-primary\n                                ",attrs:{id:"new_directory",placeholder:"Directory Name",type:"text"},domProps:{value:e.newDirectoryName},on:{input:function(t){t.target.composing||(e.newDirectoryName=t.target.value)}}}),e._v(" "),i("div",{staticClass:"flex flex-row mt-2 space-x-2 w-full"},[i("button",{staticClass:"\n                                        bg-theme-base-subtle flex flex-row items-center justify-center px-2 py-1 rounded text-theme-base-subtle-contrast w-1/2\n                                        ease-in-out duration-300 transition-colors\n                                        focus:bg-theme-danger focus:outline-none focus:text-theme-danger-contrast\n                                        hover:bg-theme-danger hover:text-theme-danger-contrast\n                                    ",attrs:{type:"button",disabled:e.isLoadingNewDirectory},on:{click:e.stopCreatingDirectory}},[i("icon-x",{staticClass:"w-5"})],1),e._v(" "),i("button",{staticClass:"\n                                        bg-theme-base-subtle flex flex-row items-center justify-center px-2 py-1 rounded text-theme-base-subtle-contrast w-1/2\n                                        ease-in-out duration-300 transition-colors\n                                        focus:bg-theme-success focus:outline-none focus:text-theme-success-contrast\n                                        hover:bg-theme-success hover:border-theme-success hover:text-theme-success-contrast\n                                    ",attrs:{type:"button",disabled:!e.canCreateDirectory},on:{click:e.createDirectory}},[e.isLoadingNewDirectory?i("icon-loader-circle",{staticClass:"animate-spin-slow w-5"}):i("icon-check",{staticClass:"w-5"})],1)])]):i("div",{key:"intial"},[i("button",{staticClass:"\n                                    bg-theme-base-subtle flex flex-row items-center justify-center px-2 py-1 rounded text-theme-base-subtle-contrast w-full\n                                    ease-in-out duration-300 transition-colors\n                                    focus:outline-none focus:shadow-outline-primary\n                                    hover:bg-theme-primary hover:text-theme-primary-contrast\n                                ",attrs:{type:"button"},on:{click:e.startCreatingDirectory}},[e._v("\n                                Create Directory\n                            ")])])])],1):e._e()],1)]),e._v(" "),i("div",{staticClass:"flex-1"},[i("div",{staticClass:"bg-white shadow-subtle p-6 rounded-lg"},[i("file-manager-files-header",{attrs:{canChangeDirectory:e.canChangeDirectory,currentDirectoryList:e.currentDirectoryList,showBreadcrumbs:e.showBreadcrumbs},on:{changeDirectoryViaBreadcrumb:e.changeDirectoryViaBreadcrumb}}),e._v(" "),i("file-manager-files-list",{staticClass:"mt-2",attrs:{files:e.files,showFilesLoader:e.showFilesLoader}})],1),e._v(" "),i("file-manager-file-uploader",{directives:[{name:"show",rawName:"v-show",value:e.showFileUploader,expression:"showFileUploader"}],staticClass:"mt-4",attrs:{directory:e.uploaderDirectory,url:e.$route("admin.api.file-manager.files.store")},on:{filesAdded:e.onFileUploaderFilesAdded,queueCompleted:e.onFileUploaderCompleted}})],1)])])}),[function(){var e=this.$createElement,t=this._self._c||e;return t("h2",{staticClass:"flex flex-row justify-between"},[t("span",{staticClass:"text-theme-base-subtle-contrast"},[this._v("\n                    Directories\n                ")])])}],!1,null,null,null).exports},layout:"admin-layout"},O=Object(o.a)(N,(function(){var e=this.$createElement,t=this._self._c||e;return t("section",{staticClass:"container mx-auto"},[this._m(0),this._v(" "),t("file-manager",{attrs:{initialise:!0}})],1)}),[function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"\n            page-header\n            mb-6 text-lg\n        "},[t("h1",[this._v("File Manager")])])}],!1,null,null,null);t.default=O.exports}}]);