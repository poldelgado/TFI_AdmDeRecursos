/*
 * File: app/view/std/form/Fch.js
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

Ext.define('app.view.std.form.Fch', {
    extend: 'Ext.form.field.Date',
    alias: 'widget.fch',

    config: {
        addMonth: '0'
    },

    width: 205,
    fieldLabel: 'Fecha',
    labelAlign: 'right',
    labelWidth: 80,
    allowBlank: false,
    format: 'd/m/Y',
    minValue: '01/01/1900',
    submitFormat: 'Y-m-d',
    defaultListenerScope: true,

    listeners: {
        afterrender: 'onDatefieldAfterRender'
    },

    onDatefieldAfterRender: function(component, eOpts) {
        if(this.conValue){
            if (this.getValue()===""||this.getValue()===null){
                var date = new Date();
                date.setMonth(date.getMonth() + parseInt(this.addMonth));
                this.setValue(date);
            }
        }
    }

});