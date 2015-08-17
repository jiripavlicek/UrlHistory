
UrlHistory.grid.Items = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'urlhistory-grid-items'
        ,url: UrlHistory.config.connectorUrl
        ,baseParams: {
            action: 'mgr/item/getlist'
        }
        ,fields: ['id','url','short', 'clicks']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 70
            ,hidden: true
        },{
            header: _('urlhistory.url')
            ,dataIndex: 'url'
            ,width: 200
        },{
            header: _('urlhistory.short')
            ,dataIndex: 'short'
            ,width: 250
        },{
            header: _('urlhistory.clicks')
            ,dataIndex: 'clicks'
            ,width: 250
        }]
        ,tbar: [{
            text: _('urlhistory.item_create')
            ,handler: this.createItem
            ,scope: this
        },'->',{
            xtype: 'textfield'
            ,id: 'urlhistory-search-filter'
            ,emptyText: _('urlhistory.search') + '...'
            ,listeners: {
                'change': {fn:this.search,scope:this}
                ,'render': {fn: function(cmp) {
                    new Ext.KeyMap(cmp.getEl(), {
                        key: Ext.EventObject.ENTER
                        ,fn: function() {
                            this.fireEvent('change',this);
                            this.blur();
                            return true;
                        }
                        ,scope: cmp
                    });
                },scope:this}
            }
        }]
    });
    UrlHistory.grid.Items.superclass.constructor.call(this,config);
};
Ext.extend(UrlHistory.grid.Items,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('urlhistory.item_remove')
            ,handler: this.removeItem
        });
        this.addContextMenuItem(m);
    }
    
    ,createItem: function(btn,e) {
        this.createUpdateItem(btn, e, false);
    }

    ,updateItem: function(btn,e) {
        this.createUpdateItem(btn, e, true);
    }

    ,createUpdateItem: function(btn,e,isUpdate) {
        var r;

        if(isUpdate){
            if (!this.menu.record || !this.menu.record.id) return false;
            r = this.menu.record;
        }else{
            r = {};
        }
        this.windows.createUpdateItem = MODx.load({
            xtype: 'urlhistory-window-item-create-update'
            ,isUpdate: isUpdate
            ,title: (isUpdate) ?  _('urlhistory.item_update') : _('urlhistory.item_create')
            ,record: r
            ,listeners: {
                'success': {fn:function() { this.refresh(); },scope:this}
            }
        });

        this.windows.createUpdateItem.fp.getForm().reset();
        this.windows.createUpdateItem.fp.getForm().setValues(r);
        this.windows.createUpdateItem.show(e.target);
    }
    
    ,removeItem: function(btn,e) {
        if (!this.menu.record) return false;
        
        MODx.msg.confirm({
            title: _('urlhistory.item_remove')
            ,text: _('urlhistory.item_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/item/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': {fn:function(r) { this.refresh(); },scope:this}
            }
        });
    }

    ,search: function(tf,nv,ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }
});
Ext.reg('urlhistory-grid-items',UrlHistory.grid.Items);

UrlHistory.window.CreateUpdateItem = function(config) {
    config = config || {};
    this.ident = config.ident || 'urlhistory-window-item-create-update';
    Ext.applyIf(config,{
        id: this.ident
        ,height: 150
        ,width: 475
        ,closeAction: 'close'
        ,url: UrlHistory.config.connectorUrl
        ,action: (config.isUpdate)? 'mgr/item/update' : 'mgr/item/create'
        ,fields: [{
            xtype: 'textfield'
            ,name: 'id'
            ,id: this.ident+'-id'
            ,hidden: true
        },{
            xtype: 'textfield'
            ,fieldLabel: _('urlhistory.url')
            ,name: 'url'
            ,id: this.ident+'-url'
            ,anchor: '100%'
        }]
    });
    UrlHistory.window.CreateUpdateItem.superclass.constructor.call(this,config);
};
Ext.extend(UrlHistory.window.CreateUpdateItem,MODx.Window);
Ext.reg('urlhistory-window-item-create-update',UrlHistory.window.CreateUpdateItem);

