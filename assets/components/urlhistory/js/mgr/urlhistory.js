var UrlHistory = function(config) {
    config = config || {};
    UrlHistory.superclass.constructor.call(this,config);
};
Ext.extend(UrlHistory,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {}
});
Ext.reg('urlhistory',UrlHistory);
UrlHistory = new UrlHistory();