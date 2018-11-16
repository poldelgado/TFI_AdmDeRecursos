/*
 * File: app/view/main/viewport.js
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

Ext.define('app.view.main.viewport', {
    extend: 'Ext.container.Viewport',
    alias: 'widget.viewport',

    requires: [
        'app.view.procesos.prod.Productos',
        'app.view.procesos.pve.Provedores',
        'app.view.procesos.orden.Ordenes',
        'Ext.button.Split',
        'Ext.menu.Menu',
        'Ext.menu.Item'
    ],

    height: 250,
    width: 400,

    layout: {
        type: 'hbox',
        align: 'stretch'
    },
    items: [
        {
            xtype: 'container',
            flex: 1,
            width: 199,
            layout: {
                type: 'vbox',
                align: 'stretch'
            },
            items: [
                {
                    xtype: 'container',
                    margin: '10 0 0 0',
                    layout: {
                        type: 'hbox',
                        align: 'stretch'
                    },
                    items: [
                        {
                            xtype: 'container',
                            flex: 1
                        },
                        {
                            xtype: 'button',
                            handler: function(button, e) {
                                var vp = button.up('viewport'),
                                    card = vp.down('[itemId=mainDesk]'),
                                    layout = card.getLayout();
                                layout.setActiveItem(0);
                            },
                            border: 0,
                            height: 137,
                            style: '\'background:transparent url(img/logo120.png) 0 0 no-repeat !important;',
                            width: 120
                        },
                        {
                            xtype: 'container',
                            flex: 1
                        }
                    ]
                },
                {
                    xtype: 'container',
                    selectCard: function(id) {
                        var vp = this.up('viewport'),
                            card = vp.down('[itemId=mainDesk]'),
                            layout = card.getLayout();
                        layout.setActiveItem(id);
                    },
                    itemId: 'menu',
                    margin: '20 0 0 0 ',
                    layout: {
                        type: 'vbox',
                        align: 'stretch'
                    },
                    items: [
                        {
                            xtype: 'button',
                            handler: function(button, e) {
                                var menu = button.up('[itemId=menu]');
                                menu.selectCard(0);
                            },
                            flex: 1,
                            text: 'Productos'
                        },
                        {
                            xtype: 'button',
                            handler: function(button, e) {
                                var menu = button.up('[itemId=menu]');
                                menu.selectCard(1);
                            },
                            flex: 1,
                            text: 'Proveedores'
                        },
                        {
                            xtype: 'button',
                            handler: function(button, e) {
                                var menu = button.up('[itemId=menu]');
                                menu.selectCard(2);
                            },
                            flex: 1,
                            text: 'Ordenes de Compras'
                        },
                        {
                            xtype: 'splitbutton',
                            flex: 1,
                            text: 'Estadisticas',
                            menu: {
                                xtype: 'menu',
                                items: [
                                    {
                                        xtype: 'menuitem',
                                        handler: function(item, e) {
                                            var menu = button.up('[itemId=menu]');
                                            menu.selectCard(3);
                                        },
                                        width: 165,
                                        text: 'Grafico 1'
                                    },
                                    {
                                        xtype: 'menuitem',
                                        handler: function(item, e) {
                                            var menu = button.up('[itemId=menu]');
                                            menu.selectCard(4);
                                        },
                                        text: 'grafico 2'
                                    }
                                ]
                            }
                        },
                        {
                            xtype: 'button',
                            handler: function(button, e) {
                                Ext.Msg.confirm('Aviso','Esta a punto de salir del sistema  .</br> ¿Desea Continuar?',function(btn){
                                    if (btn === "yes"){

                                        var ajax = app.controller.std.Glob.ajax,
                                            json = ajax('GET', 'logout',null);
                                        location.reload();

                                    }
                                });
                            },
                            flex: 1,
                            text: 'Logout'
                        }
                    ]
                }
            ]
        },
        {
            xtype: 'container',
            flex: 5,
            itemId: 'mainDesk',
            margin: '0 0 0 8',
            layout: 'card',
            items: [
                {
                    xtype: 'productos'
                },
                {
                    xtype: 'pve'
                },
                {
                    xtype: 'ordenes'
                }
            ]
        }
    ]

});