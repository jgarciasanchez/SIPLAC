/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import axios from 'axios';
import $ from 'jquery';
import "toastr";
window.$ = window.jQuery = $;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**
 *Codigo para la gestion del mantenimiento del profesores
 *Uso de VueJs
 * 
 */
new Vue({

    el: '#horarios_list',
    created: function(){
        this.getAulas()
    	this.getHorarios();
    },
    data:{
    	list: [],
        aulas: [],
        horarios: [],
        carreras: [],
        grupos: [],

    },
    methods:{
        //Retorna todos los horarios
    	getHorarios: function(){
    		var url = 'horarios';
    		axios.get(url).then(response =>{
    			this.horarios = response.data;
    		});

    	},
        getAulas: function(){
            var url = 'aulas';
            axios.get(url).then(response =>{
                this.aulas = response.data;
            });

        }
    }
        
});
//###########################FIN MANTENIMIENTO PROFES##############################