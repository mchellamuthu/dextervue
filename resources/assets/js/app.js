
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'
import vueXlsxTable from 'vue-xlsx-table'

Vue.use(vueXlsxTable, {rABS: false})
Vue.use(VueRouter)

const class_view = require('./components/Institutes/Class_view.vue');
const group_class_view = require('./components/Institutes/Group_class_view.vue');
const add_new_class = require('./components/Institutes/Add_new_class.vue');
const add_new_student = require('./components/Institutes/Add_new_students.vue');
const get_invite = require('./components/Institutes/Get_invites.vue');
const done_invite = require('./components/Institutes/Done_invites.vue');
const student_view = require('./components/Institutes/Student_view.vue');
const student_group_view = require('./components/Institutes/Student_group_view.vue');
const view_report = require('./components/Institutes/View_reports.vue');
// const class_view = 

Vue.component('classmenu',require('./components/comp/ClassMenu.vue'));
Vue.component('profilesection',require('./components/comp/ProfileSection.vue'));
Vue.component('card',require('./components/comp/Card.vue'));
Vue.component('selectcard',require('./components/comp/Select_card.vue'));
Vue.component('pointcard',require('./components/comp/Points_card.vue'));
Vue.component('grouppointcard',require('./components/comp/Group_points_card.vue'));

const routes = [
  {
    path: '/',
    component: class_view,
    props:true,
  },
  {
    path: '/groupclass',
    component: group_class_view,
    props:true,
  },
  {
    path: '/addnewclass',
    component: add_new_class
  },
  {
    path: '/addnewstudent',
    component: add_new_student
  },
  {
    path: '/getinvites',
    component: get_invite
  },
  {
    path: '/doneinvites',
    component: done_invite
  },
  {
    path: '/studentview',
    component: student_view
  },
  {
    path: '/studentgroupview',
    component: student_group_view
  },
  {
    path: '/viewreport',
    component: view_report
  }
]

const router = new VueRouter({
  routes // short for `routes: routes`
})

const app = new Vue({
    el: '#app',
    router
});

Vue.config.devtools = true;

/*children: [
          {
              path: '/',
              component: teacher_view,
              children: [
                {
                  path: '/',
                  component: class_view
                },
                {
                  path: '/groupclass',
                  name: 'groupclass',
                  component: group_class_view
                }
              ]
          }
      ]*/