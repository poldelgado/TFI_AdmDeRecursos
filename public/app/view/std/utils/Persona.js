/*
 * File: app/view/std/utils/Persona.js
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

Ext.define('app.view.std.utils.Persona', {
    extend: 'Ext.container.Container',
    alias: 'widget.persona',

    requires: [
        'app.view.std.form.Ent',
        'app.view.std.form.Txt',
        'app.view.std.form.SuperComboBox',
        'app.view.std.form.CUIT',
        'Ext.container.Container',
        'Ext.form.field.Number',
        'Ext.form.field.ComboBox'
    ],

    config: {
        perCliVisible: 'false',
        perCliSubmint: 'false'
    },

    defaultListenerScope: true,

    layout: {
        type: 'vbox',
        align: 'stretch'
    },
    items: [
        {
            xtype: 'container',
            layout: 'hbox',
            items: [
                {
                    xtype: 'ent',
                    fieldLabel: 'DNI',
                    labelWidth: 120,
                    name: 'NumDoc',
                    value: null,
                    allowBlank: false,
                    flex: 0,
                    listeners: {
                        blur: 'onNumberfieldBlur'
                    }
                },
                {
                    xtype: 'txt',
                    width: 110,
                    fieldLabel: 'Sexo',
                    labelWidth: 60,
                    name: 'PerSex',
                    readOnly: true
                },
                {
                    xtype: 'superComboBox',
                    scbCampoId: 'concat(p.perapel,", ",p.pernom) ',
                    scbTabla: 'lrd.per p,lrd.cli c',
                    scbCampoDisplay: 'concat(p.perapel,", ",p.pernom)',
                    scbWhere: 'c.PerId=p.PerId',
                    scbOtrosCampos: 'p.PerNumDoc,c.CliId, p.PerId,p.PerSex, p.PerCuit',
                    margin: '0 10 0 5 ',
                    hideEmptyLabel: false,
                    hideLabel: true,
                    name: 'PerAyP',
                    allowBlank: false,
                    flex: 1,
                    listeners: {
                        select: 'onComboboxSelect'
                    }
                }
            ]
        },
        {
            xtype: 'container',
            margin: '5 0 0 0',
            layout: 'hbox',
            items: [
                {
                    xtype: 'cuit',
                    name: 'PerCuit'
                },
                {
                    xtype: 'ent',
                    fieldLabel: 'Cliente',
                    labelWidth: 60,
                    name: 'CliId',
                    value: null,
                    readOnly: true,
                    flex: 0,
                    listeners: {
                        change: 'onNumberfieldBlur1'
                    }
                }
            ]
        }
    ],
    listeners: {
        beforerender: 'onContainerBeforeRender'
    },

    onNumberfieldBlur: function(component, event, eOpts) {
        var contenedor  = component.up().up(),
            comboPer	= contenedor.down('[name=PerAyP]'),
            cli			= contenedor.down('[name=CliId]'),
            sex			= contenedor.down('[name=PerSex]'),
            cuit		= contenedor.down('[name=PerCuit]'),
            proxy		= comboPer.store.proxy,
            parametros 	= Ext.JSON.decode(proxy.extraParams.parametros);

        parametros.where  = parametros.where.substr(0,(parametros.where.indexOf("AND p.pernumdoc")===-1?parametros.where.length:parametros.where.indexOf("AND p.pernumdoc")));
        if(component.getValue()){
            parametros.where += ' AND p.pernumdoc = '+component.getValue();
            proxy.setExtraParam('data','%');
            proxy.setExtraParam('parametros' ,Ext.JSON.encode(parametros));

            comboPer.setValue("");
            comboPer.store.load({
                callback: function(records, operation, success) {
                    if (success) {
                        comboPer.setValue(comboPer.store.getAt(0));
                        cli.setValue(records[0].raw.CliId);
                        sex.setValue(records[0].raw.PerSex);
                        cuit.setValue(records[0].raw.PerCuit);
                        cuit.fireEvent('keyup',cuit);

                    } else {
                        Ext.Msg.alert('Aviso', 'El DNI ingresado no corresponde a un agente en el sistema');
                        cli.setValue('');
                        sex.setValue('');
                        cuit.setValue('');
                    }
                }
            });
        }
    },

    onComboboxSelect: function(combo, record, eOpts) {
        console.log(combo.getValue());
    },

    onNumberfieldBlur1: function(field, newValue, oldValue, eOpts) {
        //console.log('original');
    },

    onContainerBeforeRender: function(component, eOpts) {
        var cli = component.down('[name=CliId]');

        if(component.perCliSubmint==='false'){
            cli.submitValue = false;
        }
        if(component.perCliVisible==='false'){
            cli.hide(true);
        }
    }

});