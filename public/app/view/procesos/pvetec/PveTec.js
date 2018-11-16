/*
 * File: app/view/procesos/pvetec/PveTec.js
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

Ext.define('app.view.procesos.pvetec.PveTec', {
    extend: 'Ext.container.Container',
    alias: 'widget.pvetec',

    requires: [
        'app.view.procesos.tec.TecPveViewModel2',
        'app.view.procesos.pveprd.grid',
        'Ext.form.Label',
        'Ext.form.field.ComboBox',
        'Ext.grid.Panel',
        'Ext.toolbar.Toolbar',
        'Ext.button.Button'
    ],

    viewModel: {
        type: 'procesos.pvetec.pvetec'
    },
    defaultListenerScope: true,

    layout: {
        type: 'vbox',
        align: 'stretch'
    },
    items: [
        {
            xtype: 'label',
            text: 'Asocianción Proveedores Tecnicos'
        },
        {
            xtype: 'container',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            items: [
                {
                    xtype: 'container',
                    flex: 1,
                    layout: {
                        type: 'hbox',
                        align: 'stretch'
                    },
                    items: [
                        {
                            xtype: 'combobox',
                            flex: 1,
                            fieldLabel: 'Proveedor',
                            labelAlign: 'right',
                            name: 'provider_id',
                            readOnly: false,
                            allowBlank: false,
                            displayField: 'name',
                            store: 'proveedores',
                            valueField: 'id',
                            listeners: {
                                select: 'onComboboxSelect'
                            }
                        }
                    ]
                }
            ]
        },
        {
            xtype: 'container',
            flex: 1,
            layout: {
                type: 'hbox',
                align: 'stretch'
            },
            items: [
                {
                    xtype: 'pveprdgrid',
                    flex: 1,
                    itemId: 'gridIzq',
                    title: 'Tecnicos sin Asociar '
                },
                {
                    xtype: 'toolbar',
                    border: 2,
                    width: 62,
                    items: [
                        {
                            xtype: 'container',
                            margin: '0 0 100 0',
                            width: 45,
                            layout: {
                                type: 'vbox',
                                align: 'center'
                            },
                            items: [
                                {
                                    xtype: 'button',
                                    margins: '0 0 25 0 ',
                                    width: '',
                                    icon: 'img/arrowR.png',
                                    text: '',
                                    listeners: {
                                        click: 'pasaDerecha'
                                    }
                                },
                                {
                                    xtype: 'button',
                                    margins: '0 0 25 0',
                                    hidden: true,
                                    icon: 'img/arrowDR.png',
                                    text: '',
                                    listeners: {
                                        click: 'pasaTodoIzquierda'
                                    }
                                },
                                {
                                    xtype: 'button',
                                    margins: '15 0 25 0',
                                    icon: 'img/arrowL.png',
                                    text: '',
                                    listeners: {
                                        click: 'pasaIzquierda'
                                    }
                                },
                                {
                                    xtype: 'button',
                                    margins: '0 0 5 0',
                                    hidden: true,
                                    icon: 'img/arrowDL.png',
                                    text: '',
                                    listeners: {
                                        click: 'pasarTodoDerecha'
                                    }
                                }
                            ]
                        }
                    ]
                },
                {
                    xtype: 'pveprdgrid',
                    flex: 1,
                    itemId: 'gridDer',
                    title: 'Tecnicos Asociados'
                }
            ]
        }
    ],

    onComboboxSelect: function(combo, record, eOpts) {
        var prfId = combo.getValue(),
            conte 	= combo.up('pvetec'),
            gridIzq = conte.down('[itemId=gridIzq]'),
            gridDer = conte.down('[itemId=gridDer]');

        gridIzq.store.removeAll();
        gridDer.store.removeAll();


        var ajax = app.controller.std.Glob.ajax,
            json = ajax('GET', 'providers/technicians/'+combo.getValue(),null),
            jdis = ajax('GET', 'technicians',null);

        var disp = [];
        var disdata = jdis.data,
            estdata = json.data.technicians;
        for(var i=0;disdata.length>i; i++){
            var existe = false;
            for(var j=0;estdata.length>j; j++){
                if(disdata[i].id===estdata[j].id){
                    existe=true;
                    break;
                }
            }
            if(!existe){
                disp.push(disdata[i]);
            }
        }

        if(json.success){
            if(disp.length>0){
                gridIzq.store.add(disp);
            }
            if(estdata.length>0){
                gridDer.store.add(estdata);
            }
        }else{
            component.setValue(0);
            console.log("ERROR-seguridad.PerfilesObjetos");
        }
    },

    pasaDerecha: function(button, e, eOpts) {
        this.controlaPasajes('derecha');
    },

    pasaTodoIzquierda: function(button, e, eOpts) {
        this.controlaPasajes('todoDerecha');


    },

    pasaIzquierda: function(button, e, eOpts) {
          this.controlaPasajes('izquierda');
    },

    pasarTodoDerecha: function(button, e, eOpts) {
          this.controlaPasajes('todoIzquierda');
    },

    controlaPasajes: function(opcion) {
        var  conte 	= this,
            pveid	= conte.down('[name=provider_id]').getValue(),
            gridIzq = conte.down('[itemId=gridIzq]'),
            gridDer = conte.down('[itemId=gridDer]'),
            storeDer = gridDer.store,
            storeIzq = gridIzq.store;


        var ajax = app.controller.std.Glob.ajax;
        switch(opcion){
            case 'derecha':
                var  selection = gridIzq.getView().getSelectionModel().getSelection()[0];
                storeDer.add(selection.data);
                gridIzq.getView().getSelectionModel().selectNext();
                storeIzq.remove(selection);


                json = ajax('POST', 'providers/associate_technician',par);
                break;
            case 'todoDerecha':
                var dataIzq = gridIzq.store.data;
                dataIzq.each( function(record){
                    storeDer.add(record.data);
                });
                storeIzq.removeAll();
                break;
            case 'izquierda':
                var  selection = gridDer.getView().getSelectionModel().getSelection()[0];
                storeIzq.add(selection.data);
                gridDer.getView().getSelectionModel().selectNext();
                storeDer.remove(selection);

                var par = {technician_id:selection.data.id,provider_id:pveid};
                json = ajax('POST', 'providers/detach_technician',par);
                break;
            case 'todoIzquierda':
                var dataDer = gridDer.store.data;
                dataDer.each( function(record){
                    storeIzq.add(record.data);
                });
                storeDer.removeAll();
                break;
        }



    }

});