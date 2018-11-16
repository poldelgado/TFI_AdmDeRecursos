/*
 * File: app/view/procesos/pve/Provedores.js
 *
 * This file was generated by Sencha Architect version 4.2.3.
 * http://www.sencha.com/products/architect/
 *
 * This file requires use of the Ext JS 6.5.x Classic library, under independent license.
 * License of Sencha Architect does not include license for Ext JS 6.5.x Classic. For more
 * details see http://www.sencha.com/license or contact license@sencha.com.
 *
 * This file will be auto-generated each and everytime you save your project.
 *
 * Do NOT hand edit this file.
 */

Ext.define('app.view.procesos.pve.Provedores', {
    extend: 'Ext.container.Container',
    alias: 'widget.pve',

    requires: [
        'app.view.procesos.pve.ProvedoresViewModel',
        'Ext.button.Button',
        'Ext.grid.Panel',
        'Ext.grid.column.Number',
        'Ext.view.Table',
        'Ext.grid.column.Action'
    ],

    viewModel: {
        type: 'pve'
    },
    defaultListenerScope: true,

    layout: {
        type: 'vbox',
        align: 'stretch'
    },
    items: [
        {
            xtype: 'container',
            items: [
                {
                    xtype: 'button',
                    handler: function(button, e) {

                        var con = button.up('pve'),
                            grid = con.down('grid'),
                            win = Ext.widget('newpve'),
                            frm = win.down('form');
                        win.show();


                        win.on('close',function(){grid.loadGrid();});

                    },
                    icon: 'img/add.png',
                    iconAlign: 'right',
                    text: 'Nuevo'
                },
                {
                    xtype: 'button',
                    handler: function(button, e) {
                        window.open('export_providers','_blank');

                    },
                    margin: '0 0 0 5',
                    icon: 'img/exp.png',
                    iconAlign: 'right',
                    text: 'Exportar'
                }
            ]
        },
        {
            xtype: 'container',
            flex: 1,
            layout: {
                type: 'vbox',
                align: 'stretch'
            },
            items: [
                {
                    xtype: 'gridpanel',
                    loadGrid: function() {
                        var ajax = app.controller.std.Glob.ajax,
                            json = ajax('GET', 'providers',null);


                        var grid = this;


                        if(json.success){
                            grid.store.removeAll();
                            grid.store.add(json.data);
                        }else{
                            Ext.toast({
                                html: 'Sin datos para esta vista',
                                title: 'Info',
                                width: 200,
                                align: 't',
                                autoClose: true
                            });
                        }
                    },
                    flex: 1,
                    margin: '3 0 0 0 ',
                    title: 'Proveedores',
                    columns: [
                        {
                            xtype: 'numbercolumn',
                            dataIndex: 'id',
                            text: '#'
                        },
                        {
                            xtype: 'gridcolumn',
                            width: 250,
                            dataIndex: 'cuit',
                            text: 'CUIT'
                        },
                        {
                            xtype: 'gridcolumn',
                            width: 450,
                            dataIndex: 'name',
                            text: 'Nombre'
                        },
                        {
                            xtype: 'actioncolumn',
                            width: 48,
                            items: [
                                {
                                    handler: function(view, rowIndex, colIndex, item, e, record, row) {
                                        var win = Ext.widget('newpve'),
                                            frm = win.down('form');

                                        frm.loadRecord(record);
                                        win.show();
                                        win.on('close',function(){view.up().loadGrid();});
                                    },
                                    icon: 'img/search.png'
                                }
                            ]
                        },
                        {
                            xtype: 'actioncolumn',
                            width: 59,
                            icon: 'img/cancel.png',
                            items: [
                                {
                                    handler: function(view, rowIndex, colIndex, item, e, record, row) {
                                        Ext.Msg.confirm('Aviso','Esta a punto de eliminar el registro seleccionado.¿Desea continuar?',function(op){
                                            if(op==='yes'){
                                                var ajax = app.controller.std.Glob.ajax;
                                                var json = ajax('DELETE', 'providers/'+record.data.id,null);

                                                if(json.success){
                                                    Ext.Msg.alert('Aviso','Elemento Eliminado');
                                                    view.up().loadGrid();
                                                }else{
                                                    Ext.Msg.alert('Error','Error en eliminar registro' + json.msg);
                                                }
                                            }

                                        });

                                    },
                                    icon: 'img/cancel.png'
                                }
                            ]
                        }
                    ],
                    listeners: {
                        afterrender: 'iniGrid'
                    }
                }
            ]
        }
    ],
    listeners: {
        afterrender: 'iniicales'
    },

    iniGrid: function(component, eOpts) {
          var store = Ext.create('Ext.data.Store', {
                    storeId: 'storeDisp',
                    remoteSort: true,
                    pageSize: 25,

                    fields: [
                        { name: 'id'	    	},
                        { name: 'name'        	},
                        { name: 'cuit'   }
                    ],
                    proxy: {
                        type: 'memory',
                        reader: {
                            type: 'json',
                            root: 'data'
                        } ,
                        writer: {
                            type: 'json',
                            encode: true,
                            root: 'data'
                        }
                    },
                    autoLoad: false
                });

                component.reconfigure(store);
    },

    iniicales: function(component, eOpts) {
        var ajax = app.controller.std.Glob.ajax,
             json = ajax('GET', 'providers',null);


        var grid = component.down('grid');
        grid.loadGrid();

    }

});