/*
 * File: app/view/std/BienvenidaViewController.js
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

Ext.define('app.view.std.BienvenidaViewController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.bienvenida',

    control: {
        "bienvenida": {
            afterrender: 'getMenu'
        }
    },

    getMenu: function(component, eOpts) {
        console.log('imenu');

        var imenu = component.down('[itemId=iMenu]'),
            ajax  = app.controller.std.Glob.ajax,
            json  = ajax('std.seguridad', 'Menu', 'getIMenu', null ,null);

        imenu.removeAll();
        imenu.add(json.data);
    }

});
