/**
 * This JS file is used by both livelist.js (public-plugin) and table.js (admin)
 */

var mapAttribute={priceLow:{title:"Price",render:priceRenderer},saleStatus:{title:"Status",render:null},label:{title:"Label",render:null},remoteKey:{title:"",render:null}};var columnAttributes={saleStatus:{title:"Sale Status",render:saleStatusRender,type:null,cssClass:'mobile pe-status'},label:{title:"Label",render:labelLinkRenderer,type:null,cssClass:'mobile'},priceLow:{title:"Price",render:priceRenderer,type:"numeric-comma",cssClass:'mobile'},priceHigh:{title:"Max Price",render:priceRenderer,type:"numeric-comma"},rentLow:{title:"Rent(p/m)",render:priceRenderer,type:"numeric-comma",cssClass:'mobile'},rentHigh:{title:"Rent(p/m)",render:priceRenderer,type:"numeric-comma"},rates:{title:"Rates",render:priceRenderer,type:"numeric-comma"},baseCostAmount:{title:"Building Cost",render:priceRenderer,type:"numeric-comma"},block:{title:"Block",render:null,type:null},building:{title:"Building",render:null,type:null},address:{title:"Address",render:null,type:null},phase:{title:"Phase",render:null,type:null},description:{title:"Description",render:null,type:null},plotSize:{title:"Plot Size",render:null,type:null},unitSize:{title:"Unit Size",render:null,type:null},floor:{title:"Floor",render:null,type:null}};function priceRenderer(val,options){if(jQuery(val).length==0){return""}else{return val!=""?options.currency+"&nbsp;"+jQuery.formatNumber(val,{format:"#,###",locale:"us"}):""}}
function dataTablePriceRenderer(data,type,full){return jQuery.formatNumber(data,{checkboxRenderer:"#,###",locale:"us"})}
function checkboxRenderer(id){return"<input type='checkbox' name='select' value='"+id+"'></input>";}
function dateRenderer(val,option){if(jQuery(val).length==0){return""}else{return new Date(val).toString(option.dateFormat)}}
function fullDateRenderer(val,option){dateRenderer(val,option);}
function warningRenderer(val){if(val.length==0){return""}else{return"<span class='label'><i class='icon-warning-sign'></i> "+val+"</span>"}}
function labelLinkRenderer(id,label){return"<a href='#"+id+"'>"+label+"</a>"}
function phoneNumberRenderer(val){return val==null?"":"<a href='tel:"+val+"'>"+val+"</a>"}
function emailRenderer(val){return val==null?"":"<a href='mailto:"+val+"'>"+val+"</a>"}
function saleStatusRender(val,options){return'<i title="'+val+'" class="pe-sale-status pe-status-'+val.toLocaleLowerCase()+' icon-stop"></i><span class="hidden-phone">&nbsp'+val+'</span>';}
function generateDataTableColumns(options){options=options||{};var excludeColumns=options.excludedColumns||"";var currency=options.currency||"$";}