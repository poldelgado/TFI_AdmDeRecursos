/*
 * File: app/view/procesos/Provedores.js
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

Ext.define('app.view.procesos.Provedores', {
    extend: 'Ext.container.Container',
    alias: 'widget.procesos.provedores',

    requires: [
        'app.view.procesos.ProductosViewModel1',
        'Ext.button.Button',
        'Ext.grid.Panel',
        'Ext.grid.column.Number',
        'Ext.view.Table',
        'Ext.grid.column.Action'
    ],

    viewModel: {
        type: 'procesos.provedores'
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
                    icon: 'img/add.png',
                    iconAlign: 'right',
                    text: 'Nuevo'
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
        afterrender: 'onContainerAfterRender'
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

    onContainerAfterRender: function(component, eOpts) {
        var json = {'success':true,
                    'data':[{id:1,name:'Gensys SA',cuit:23311800779}],
                    'msg':'Listado de Productos'};


        var grid = component.down('grid');


        if(json.success){
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




    }

});