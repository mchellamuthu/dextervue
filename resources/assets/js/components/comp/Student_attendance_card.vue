<template>
	<div class="points-content">
    <a v-on:click="takeAttendance(status)">
      <img :src="avatar">
      <div id="name-content"><span>{{studentFirstName}}</span></div>
      <div class="attendance_outdoor_layer">
         <div class="attendance_inner_layer"><img :src="statusValue"></div>
      </div>
   </a>
  </div>
</template>

<script>

export default {
	props:['name', 'avatar','imageValue', 'statusValue', 'index', 'status' ],
  data () {
    return {
      studentFirstName: ''
    }
  },
  mounted() {
    this.getStudentFirstName();
  },
  methods: {
    getStudentFirstName() {
      this.studentFirstName = this.name.split(' ')[0];
    },
    takeAttendance (status) {
    	this.$emit('click', status, this.index);
    }
  }

}
	
</script>