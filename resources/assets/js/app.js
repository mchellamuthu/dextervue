
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

var SimpleVueValidation = require('simple-vue-validator');
Vue.use(SimpleVueValidation);

Vue.use(vueXlsxTable, {rABS: false})
Vue.use(VueRouter)

const staff_view = require('./components/Institutes/Staff_view.vue');
const story_view = require('./components/Institutes/Story_view.vue');
const staff_group_view = require('./components/Institutes/Staff_group_view.vue');
const class_view = require('./components/Institutes/Class_view.vue');
const group_class_view = require('./components/Institutes/Group_class_view.vue');
const add_new_class = require('./components/Institutes/Add_new_class.vue');
const add_new_student = require('./components/Institutes/Add_new_students.vue');
const get_invite = require('./components/Institutes/Get_invites.vue');
const done_invite = require('./components/Institutes/Done_invites.vue');
const student_view = require('./components/Institutes/Student_view.vue');
const student_group_view = require('./components/Institutes/Student_group_view.vue');
const view_report = require('./components/Institutes/View_reports.vue');
const view_attendance_report = require('./components/Institutes/View_attendance_report.vue');
const student_attendance = require('./components/Institutes/Student_attendance.vue');
const select_multiple = require('./components/Institutes/Select_multiple.vue');
const select_multiple_group = require('./components/Institutes/Select_multiple_group.vue');
const stories = require('./components/Institutes/Stories.vue');
const pending_posts = require('./components/Institutes/Pending_posts.vue');
const student_stories = require('./components/Institutes/Student_stories.vue');
const message = require('./components/Institutes/Message.vue');
// const class_view = 

Vue.component('classmenu',require('./components/comp/ClassMenu.vue'));
Vue.component('profilesection',require('./components/comp/ProfileSection.vue'));
Vue.component('card',require('./components/comp/Card.vue'));
Vue.component('selectcard',require('./components/comp/Select_card.vue'));
Vue.component('pointcard',require('./components/comp/Points_card.vue'));
Vue.component('grouppointcard',require('./components/comp/Group_points_card.vue'));
Vue.component('attendancebottom',require('./components/comp/Attendance_bottom_nav.vue'));
Vue.component('reportleftmenu',require('./components/comp/Report_left_menu.vue'));
Vue.component('leftmenustudentlist',require('./components/comp/Left_menu_student_list.vue'));
Vue.component('pointspanel',require('./components/comp/Points_panel.vue'));
Vue.component('institutemodal',require('./components/comp/Institute_modal.vue'));
Vue.component('studentviewlist',require('./components/comp/Student_view_list.vue'));
Vue.component('addandeditskillmodal',require('./components/comp/Add_and_edit_skill_modal.vue'));
Vue.component('removemodal',require('./components/comp/Remove_modal.vue'));
Vue.component('studentattendancecard',require('./components/comp/Student_attendance_card.vue'));
Vue.component('addstudentpointsmodal',require('./components/comp/Add_student_points_modal.vue'));
Vue.component('creategroupmodal',require('./components/comp/Create_group_modal.vue'));
Vue.component('studentaccountmodal',require('./components/comp/Student_account_modal.vue'));
Vue.component('updataEmailAddressModal',require('./components/comp/Update_email_address_modal.vue'));

const routes = [
  {
    path: '/',
    component: class_view,
    props:true,
  },
  {
    path: '/staffview',
    component: staff_view,
    props: true
  },
  {
    path: '/staffgroupview',
    component: staff_group_view,
    props: true
  },
  {
    path: '/storyview',
    component: story_view,
    props: true
  },
  {
    path: '/groupclass',
    component: group_class_view,
    props:true
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
    path: '/studentview/:id',
    component: student_view,
    props:true
  },
  {
    path: '/studentgroupview',
    component: student_group_view
  },
  {
    path: '/viewreport',
    component: view_report
  },
  {
    path: '/attendance',
    component: view_attendance_report
  },
  {
    path: '/studentview/attendance',
    component: student_attendance
  },
  {
    path: '/studentview/selectmultiple',
    component: select_multiple
  },
  {
    path: '/studentgroupview/selectmultiple',
    component: select_multiple_group
  },
  {
    path: '/stories',
    component: stories
  },
  {
    path: '/stories/pendingpost',
    component: pending_posts
  },
  {
    path: '/stories/studentstories',
    component: student_stories
  },
  {
    path: '/message',
    component: message
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