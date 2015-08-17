UrlHistory.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,cls: 'container'
        ,items: [{
            html: '<h2>'+_('urlhistory')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,activeItem: 0
            ,hideMode: 'offsets'
            ,items: [{
                title: _('urlhistory.items')
                ,items: [{
                    html: '<p>'+_('urlhistory.intro_msg')+'</p>'
                    ,border: false
                    ,bodyCssClass: 'panel-desc'
                },{
                    xtype: 'urlhistory-grid-items'
                    ,preventRender: true
                    ,cls: 'main-wrapper'
                }]
            }]
        }]
    });
    UrlHistory.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(UrlHistory.panel.Home,MODx.Panel);
Ext.reg('urlhistory-panel-home',UrlHistory.panel.Home);