(window.webpackJsonp=window.webpackJsonp||[]).push([[30],{WEIi:function(e,t,i){"use strict";i.r(t);var a={extends:i("UPFT").a,data:function(){return{fields:[{key:"name",label:$t("config.role.props.name"),sort:"name"},{key:"isDefault",label:$t("config.role.props.is_default")},{key:"actions",label:"",cantHide:!0,tdClass:"actions-wrapper"}],permissionsRequired:"access-config",routesRequired:{add:"appConfigRoleAdd"},initUrl:"config/roles",dataType:"role",hideFilterButton:!0}},mounted:function(){this.updatePageMeta()}},s=i("KHd+"),o=Object(s.a)(a,(function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("base-container",{staticClass:"p-0 flex-grow",attrs:{boxed:"","with-loader":"","is-loading":e.isLoading,"loader-color":e.vars.loaderColor}},[e.isInitialized?i("table-wrapper",{attrs:{meta:e.entities.meta,filtered:e.isFiltered,"add-button-route":"appConfigRoleAdd","entity-title":"config.role.roles","entities-title":"config.role.roles","entity-description":"config.role.module_description"}},[i("b-table",{directives:[{name:"show",rawName:"v-show",value:e.entities.meta.total,expression:"entities.meta.total"}],ref:"btable",attrs:{items:e.itemsProvider,fields:e.fields,busy:e.isLoading,hover:"",striped:"",stacked:"sm","per-page":e.entities.meta.perPage,"current-page":e.entities.meta.currentPage,filters:null},on:{"update:busy":function(t){e.isLoading=t}},scopedSlots:e._u([{key:"cell(isDefault)",fn:function(t){return[t.item.isDefault?i("badge",{attrs:{rounded:"",type:"primary"}},[i("i",{staticClass:"fas fa-check"}),e._v(" "+e._s(e.$t("general.default")))]):e._e()]}},{key:"cell(actions)",fn:function(t){return[i("div",{staticClass:"btn-group",attrs:{role:"group","aria-label":"Actions Buttons"}},[t.item.isDefault?e._e():i("base-button",{directives:[{name:"b-tooltip",rawName:"v-b-tooltip.hover.d500",modifiers:{hover:!0,d500:!0}}],attrs:{type:"button",size:"sm",design:"dark",title:e.$t("global.delete",{attribute:e.$t("config.role.role")})},on:{click:function(i){return i.stopPropagation(),e.deleteEntity(t.item)}}},[i("i",{staticClass:"fas fa-trash"})])],1)]}}],null,!1,2056286666)})],1):e._e()],1)}),[],!1,null,null,null);t.default=o.exports}}]);
//# sourceMappingURL=index.js.map?id=f92705f02549ddfac595