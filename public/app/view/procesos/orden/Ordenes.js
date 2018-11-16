/*
 * File: app/view/procesos/orden/Ordenes.js
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

Ext.define('app.view.procesos.orden.Ordenes', {
    extend: 'Ext.container.Container',
    alias: 'widget.ordenes',

    requires: [
        'app.view.procesos.orden.OrdenesViewModel',
        'app.view.std.grid.filter',
        'Ext.button.Button',
        'Ext.form.field.Text',
        'Ext.grid.Panel',
        'Ext.grid.column.Number',
        'Ext.grid.column.Date',
        'Ext.view.Table',
        'Ext.grid.column.Action'
    ],

    viewModel: {
        type: 'ordenes'
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
                        var win = Ext.widget('neworden'),
                            frm = win.down('form');
                        win.show();
                    },
                    icon: 'img/add.png',
                    iconAlign: 'right',
                    text: 'Nuevo'
                },
                {
                    xtype: 'button',
                    handler: function(button, e) {
                        window.open('export_purchase_orders','_blank');

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
                    xtype: 'filter',
                    margin: '3 0 0 0 ',
                    flex: 0
                },
                {
                    xtype: 'gridpanel',
                    flex: 1,
                    title: 'Ordenes de Compras',
                    columns: [
                        {
                            xtype: 'numbercolumn',
                            width: 67,
                            dataIndex: 'id',
                            text: '#',
                            format: '0,000'
                        },
                        {
                            xtype: 'datecolumn',
                            width: 151,
                            dataIndex: 'date_order',
                            text: 'Fecha'
                        },
                        {
                            xtype: 'gridcolumn',
                            width: 265,
                            dataIndex: 'product',
                            text: 'Producto'
                        },
                        {
                            xtype: 'gridcolumn',
                            width: 461,
                            dataIndex: 'provider',
                            text: 'Proveedor'
                        },
                        {
                            xtype: 'actioncolumn',
                            width: 48,
                            items: [
                                {
                                    handler: function(view, rowIndex, colIndex, item, e, record, row) {
                                        var win = Ext.widget('neworden'),
                                            frm = win.down('form');

                                        frm.loadRecord(record);
                                        win.show();

                                    },
                                    icon: 'img/medidas.png',
                                    tooltip: 'Calificar'
                                }
                            ]
                        },
                        {
                            xtype: 'actioncolumn',
                            width: 48,
                            items: [
                                {
                                    handler: function(view, rowIndex, colIndex, item, e, record, row) {
                                        var win = Ext.widget('neworden'),
                                            frm = win.down('form');

                                        frm.loadRecord(record);
                                        win.show();

                                    },
                                    icon: 'img/search.png',
                                    tooltip: 'Editar'
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
                                                var json = ajax('DELETE', 'purchase_orders/'+record.data.id,null);

                                                if(json.success){
                                                    Ext.Msg.alert('Aviso','Elemento Eliminado');
                                                    view.store.load();
                                                }else{
                                                    Ext.Msg.alert('Error','Error en eliminar registro' + json.msg);
                                                }
                                            }

                                        });
                                    },
                                    icon: 'img/cancel.png',
                                    tooltip: 'Eliminar'
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
                { name: 'id'	    				},
                { name: 'date_order'        		},
                { name: 'purchase_qualification_id' },
                { name: 'produc_id'   				},
                { name: 'provider_id'   			},
                { name: 'produc'   					},
                { name: 'provider'   				},
                { name: 'total'   					},
                {name:	'provider_id'				},
                {nme:'warranty_void'				}
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
         var ajax = app.controller.std.Glob.ajax,
             json = ajax('GET', 'purchase_orders',null);



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