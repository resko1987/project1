(window.webpackJsonp=window.webpackJsonp||[]).push([[88],{lSlZ:function(t,e,i){"use strict";var s=i("L2JU");function o(t,e){var i=Object.keys(t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(t);e&&(s=s.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),i.push.apply(i,s)}return i}function r(t){for(var e=1;e<arguments.length;e++){var i=null!=arguments[e]?arguments[e]:{};e%2?o(Object(i),!0).forEach((function(e){a(t,e,i[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(i)):o(Object(i)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(i,e))}))}return t}function a(t,e,i){return e in t?Object.defineProperty(t,e,{value:i,enumerable:!0,configurable:!0,writable:!0}):t[e]=i,t}var n={props:{boxed:{type:Boolean,default:!1},isLoading:{type:Boolean,default:!1}},computed:r(r({},Object(s.c)("common",["filters"])),Object(s.c)("config",["vars"])),methods:r(r({},Object(s.b)("common",["ResetFilters"])),{},{submit:function(){var t=r(r(r({},this.$route.query),this.filters),{},{filtered:!0,filtered_at:moment().unix()});this.$router.push({path:this.$route.path,query:t}).catch((function(t){}))},reset:function(){this.ResetFilters(),this.$route.query&&this.$route.query.filtered&&this.$router.push({path:this.$route.path})}})},l=i("KHd+"),d=Object(l.a)(n,(function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("base-container",{staticClass:"mb-element",attrs:{boxed:t.boxed,"with-loader":"","is-loading":t.isLoading,"loader-color":t.vars.loaderColor}},[i("close-button",{attrs:{title:t.$t("general.close")},on:{click:function(e){return t.$emit("close")}}}),t._v(" "),i("form",{on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[t._t("default"),t._v(" "),i("div",{staticClass:"form-footer mt-3"},[i("div",{staticClass:"left-side"},[i("base-button",{attrs:{type:"button",design:"light",disabled:t.isLoading},on:{click:function(e){return t.$emit("close")}}},[t._v(t._s(t.$t("general.close")))])],1),t._v(" "),i("div",{staticClass:"right-side"},[i("base-button",{attrs:{type:"button",design:"light",disabled:t.isLoading},on:{click:t.reset}},[t._v(t._s(t.$t("general.clear")))]),t._v(" "),i("base-button",{attrs:{type:"submit",design:"primary",disabled:t.isLoading}},[t._v(t._s(t.$t("general.filter")))])],1)])],2)],1)}),[],!1,null,null,null).exports;function c(t,e){var i=Object.keys(t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(t);e&&(s=s.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),i.push.apply(i,s)}return i}function u(t,e,i){return e in t?Object.defineProperty(t,e,{value:i,enumerable:!0,configurable:!0,writable:!0}):t[e]=i,t}e.a={components:{FilterWrapper:d},props:{preRequisite:{type:Object,default:function(){return{}}},boxed:{type:Boolean,default:!1},isLoading:{type:Boolean,default:!1}},computed:function(t){for(var e=1;e<arguments.length;e++){var i=null!=arguments[e]?arguments[e]:{};e%2?c(Object(i),!0).forEach((function(e){u(t,e,i[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(i)):c(Object(i)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(i,e))}))}return t}({},Object(s.c)("common",["filters"]))}},mgBu:function(t,e,i){"use strict";i.r(e);var s=i("UPFT"),o={extends:i("lSlZ").a},r=i("KHd+"),a={components:{FilterForm:Object(r.a)(o,(function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("filter-wrapper",{attrs:{boxed:t.boxed,"is-loading":t.isLoading},on:{close:function(e){return t.$emit("close")}}},[i("div",{staticClass:"row"},[i("div",{staticClass:"col-12 col-md-4 mb-4"},[i("base-input",{attrs:{"auto-focus":"",label:t.$t("general.search_keyword"),type:"text",disabled:t.isLoading},model:{value:t.filters.keyword,callback:function(e){t.$set(t.filters,"keyword",e)},expression:"filters.keyword"}})],1),t._v(" "),i("div",{staticClass:"col-12 col-md-4 mb-4"},[i("base-select",{attrs:{options:t.preRequisite.statuses,label:t.$t("utility.todo.props.status"),disabled:t.isLoading,simple:!0},model:{value:t.filters.status,callback:function(e){t.$set(t.filters,"status",e)},expression:"filters.status"}})],1),t._v(" "),i("div",{staticClass:"col-12 col-md-4 mb-4"},[i("date-between",{attrs:{label:t.$t("global.between",{attribute:t.$t("utility.todo.todo")}),start:t.filters.startDate,end:t.filters.endDate,disabled:t.isLoading},on:{"update:start":function(e){return t.$set(t.filters,"startDate",e)},"update:end":function(e){return t.$set(t.filters,"endDate",e)}}})],1)])])}),[],!1,null,null,null).exports},extends:s.a,data:function(){return{fields:[{key:"title",label:$t("utility.todo.props.title"),sort:"title",transformer:"limitWords",tdClass:"td-ellipsis max-width-250px"},{key:"date",label:$t("utility.todo.due_on"),sort:"date",transformer:"date"},{key:"status",label:$t("utility.todo.props.status"),sort:"status",transformer:"badgeStatusCompleted"},{key:"completedAt",label:$t("utility.todo.completed_at"),sort:"completed_at",transformer:"date"},{key:"actions",label:"",cantHide:!0,tdClass:"actions-dropdown-wrapper"}],filtersOptions:{keyword:"",status:"",startDate:"",endDate:""},permissionsRequired:"access-todo",routesRequired:{add:"appUtilityTodoAdd"},initUrl:"utility/todos",dataType:"todo"}},methods:{toggleTodo:function(t){var e=this;this.isLoading=!0,this.Custom({url:"utility/todos/"+t.uuid+"/status",method:"post"}).then((function(t){e.isLoading=!1,e.$nextTick((function(){e.refreshTable()}))})).catch((function(t){e.isLoading=!1,formUtil.handleErrors(t)}))}},mounted:function(){this.updatePageMeta()}},n=Object(r.a)(a,(function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"entity-list-container"},[i("collapse-transition",{attrs:{group:!0,duration:300,tag:"div"}},[t.showFilters?i("filter-form",{key:"filters",attrs:{boxed:!0,"pre-requisite":t.preRequisite,"is-loading":t.isLoading},on:{close:t.toggleFilter}}):t._e(),t._v(" "),i("base-container",{key:"list",staticClass:"p-0",attrs:{boxed:"","with-loader":"","is-loading":t.isLoading,"loader-color":t.vars.loaderColor}},[t.isInitialized?i("table-wrapper",{attrs:{meta:t.entities.meta,filtered:t.isFiltered,"add-button-route":"appUtilityTodoAdd","add-button-permissions":["access-todo"],"entity-title":"utility.todo.todo","entities-title":"utility.todo.todos","entity-description":"utility.todo.module_description"}},[i("b-table",{directives:[{name:"show",rawName:"v-show",value:t.entities.meta.total,expression:"entities.meta.total"}],ref:"btable",attrs:{items:t.itemsProvider,fields:t.fields,busy:t.isLoading,hover:"",striped:"",stacked:"sm","per-page":t.entities.meta.perPage,"current-page":t.entities.meta.currentPage,filters:null},on:{"update:busy":function(e){t.isLoading=e},"row-dblclicked":function(e){return t.rowClickHandler({route:"appUtilityTodoView"},e)}},scopedSlots:t._u([{key:"cell(date)",fn:function(t){return[t.item.time?i("view-date",{staticClass:"mb-0",attrs:{value:t.item.date+" "+t.item.time,"with-tz":"",tag:"span"}}):i("view-date",{staticClass:"mb-0",attrs:{value:t.item.date,tag:"span"}})]}},{key:"cell(completedAt)",fn:function(t){return[i("view-date",{staticClass:"mb-0",attrs:{value:t.item.completedAt,"with-tz":"",tag:"span"}})]}},{key:"cell(status)",fn:function(e){return[i("div",{staticClass:"pointer",on:{click:function(i){return i.stopPropagation(),t.toggleTodo(e.item)}}},[e.item.status?i("badge",{attrs:{rounded:"",type:"primary"}},[i("i",{staticClass:"far fa-check-circle"}),t._v(" "+t._s(t.$t("utility.todo.completed")))]):i("badge",{attrs:{rounded:"",type:"dark"}},[i("i",{staticClass:"far fa-circle"}),t._v(" "+t._s(t.$t("utility.todo.incomplete")))])],1)]}},{key:"cell(actions)",fn:function(e){return[i("base-button",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover.d500",modifiers:{hover:!0,d500:!0}}],class:e.item.status?"text-success":"text-dark",attrs:{type:"button",size:"sm",design:"",title:t.$t("global.toggle",{attribute:t.$t("utility.todo.todo")})},on:{click:function(i){return i.stopPropagation(),t.toggleTodo(e.item)}}},[e.item.status?i("i",{staticClass:"fas fa-check-circle"}):i("i",{staticClass:"fas fa-times-circle"})]),t._v(" "),i("table-row-actions",[i("router-link",{staticClass:"dropdown-item",attrs:{to:{name:"appUtilityTodoView",params:{uuid:e.item.uuid}}}},[i("i",{staticClass:"fas fa-arrow-circle-right"}),t._v(" "+t._s(t.$t("global.view",{attribute:t.$t("utility.todo.todo")})))]),t._v(" "),t.hasPermission("edit-user")?i("router-link",{staticClass:"dropdown-item",attrs:{to:{name:"appUtilityTodoEdit",params:{uuid:e.item.uuid}}}},[i("i",{staticClass:"fas fa-edit"}),t._v(" "+t._s(t.$t("global.edit",{attribute:t.$t("utility.todo.todo")})))]):t._e(),t._v(" "),t.hasPermission("delete-user")?i("a",{staticClass:"dropdown-item",on:{click:function(i){return i.stopPropagation(),t.deleteEntity(e.item)}}},[i("i",{staticClass:"fas fa-trash"}),t._v(" "+t._s(t.$t("global.delete",{attribute:t.$t("utility.todo.todo")})))]):t._e()],1)]}}],null,!1,498260250)})],1):t._e()],1)],1)],1)}),[],!1,null,null,null);e.default=n.exports}}]);
//# sourceMappingURL=index.js.map?id=ef8ff01906f4e282abb2