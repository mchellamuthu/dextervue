<template>
<div>
	<!-- Class menu -->
  <classmenu selectedMenu="Classroom" :classMenuBtns="classMenu"></classmenu>

  <div class="container">
  	<div class="row">
  		<div class="selectable-btns">
	      <div class="btn-group" role="group">
	       	<router-link to="/studentview" class="btn btn-default btn-active"> Students </router-link>
	        <router-link to="/studentgroupview" class="btn btn-default "> Groups </router-link>
	        <router-link to="/viewreport" class="btn btn-default"> View reports </router-link>
	      </div>
	    </div>
  	</div>
  </div>

  <div class="student-view-list">
		<div class="points-content">
	    <a>
	      <img src="images/group_icon.png">
	      <div id="name-content"><span>Whole class</span></div>
	      <div class="select-outer-layer">
	         <div class="select-inner-layer" :class="{ setPoints: wholeClassPointsAwarded }">0</div>
	      </div>
	   </a>
	  </div>
		<pointcard v-for="(student, index) in studentLists" :key="student.id" :name="student.studentName" :avatar="student.avatar" :value="student.studentPoint" :givenPoints="student.pointsAwarded" @click="addPoints"></pointcard>
		<div class="points-content add-new-content">
    	<a href="#addNewStudentModal" data-toggle="modal">
    		<div class="add-image">
    			<img src="images/student_images/add_button.png">
    		</div>
    	</a>
    </div>
  </div>

  <attendancebottom></attendancebottom>

  <addstudentpointsmodal modalId="addStudentPointsModal" :skills="skills" :studentName="studentName"></addstudentpointsmodal>

  <institutemodal modalId="institutemodal" :studentLists="studentLists"></institutemodal>

  <!-- <div id="institutemodal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <institutemodal modalId="institutemodal" :studentLists="studentLists"></institutemodal>
  </div> -->

  

</div>
</template>

<script>
import filestack from 'filestack-js'
  export default{
    data() {
      return {
       activeBtn: this.selectedMenu,
       studentLists: '',
       wholeClassPointsAwarded: false,
       studentName: '',
       skills: '',
       classMenu: [
        { name: 'Classroom', icon: 'glyphicon glyphicon-home', link: '/studentview' },
        { name: 'Stories', icon: 'glyphicon glyphicon-picture', link: '/stories' },
        { name: 'Messages', icon: 'glyphicon glyphicon-comment', link: '/message' }
       ]
      }
    },
    mounted() {
			this.getStudentList();
			this.getSkills();
		},
    methods: {
      getStudentList () {
				axios.get('/api/students')
			  .then((response) => {
			  	this.studentLists = response.data.data;
			  	for(var i = 0; i < this.studentLists.length; i++) {
			  		if(this.studentLists[i].studentPoint > 0) {
			  			this.studentLists[i].pointsAwarded = true;
			  		}
			  	}
			  })
			  .catch(function (error) {
			    console.log(error);
			  });
			},
			addPoints(name) {
	    	$('#addStudentPointsModal').modal('show');
	    	this.studentName = name;
	    },
	    getSkills () {
				axios.get('/api/skills')
			  .then((response) => {
			  	this.skills = response.data.data;
			  })
			  .catch(function (error) {
			    console.log(error);
			  });
			}
    }
  }
</script>

<style scoped>


</style>