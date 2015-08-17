Ext.onReady(function() {
    MODx.load({ xtype: 'urlhistory-page-home'});
});

UrlHistory.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'urlhistory-panel-home'
            ,renderTo: 'urlhistory-panel-home-div'
        }]
    });
    UrlHistory.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(UrlHistory.page.Home,MODx.Component);
Ext.reg('urlhistory-page-home',UrlHistory.page.Home);