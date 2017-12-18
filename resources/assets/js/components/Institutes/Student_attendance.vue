<template>
<div>
	<!-- Class menu -->
  	<classmenu selectedMenu="Classroom" :classMenuBtns="classMenu"></classmenu>

  	<div class="student-view-list">
			<div class="points-content" id="whole-class-attendance">
		    <a>
		      <img src="images/group_icon.png">
		      <div id="name-content"><span>Whole class</span></div>
		   </a>
		  </div>
			<studentattendancecard v-for="(student, index) in studentLists" :key="student.id" :name="student.studentName" :avatar="student.avatar" :status="student.status" :statusValue="student.statusValue" :index="index" @click="takeAttendance"></studentattendancecard>
			<div class="points-content" id="add-new-student-attendance">
	    	<a>
	    		<div class="add-image">
	    			<img src="images/student_images/add_button.png">
	    		</div>
	    	</a>
	    </div>
	  </div>

	  <nav class="navbar navbar-default navbar-fixed-bottom">
		  <div class="container">
		    <div class="row">
		    	<div class="mark-attendance clearfix">
		    		<div class="pull-left mark-attendance-btns">
			    		<a @click="markAllPresent"><img src="images/student_images/present_image.png" width="6%"> Mark all present</a>
			    		<a @click="markAllAbsent"><img src="images/student_images/absent_image.png" width="6%"> Mark all absent</a>
			    	</div>
			    	<div class="pull-right">
			    		<router-link to="/studentview" href="#" class="btn btn-link">Cancel</router-link>
	          	<router-link to="/studentview" type="button" class="btn btn-primary default-btn">Save attendance</router-link>
			    	</div>
		    	</div>
		    </div>
		  </div>
		</nav>
</div>
</template>

<script>
export default {
	data () {
		return {
			studentLists: '',
			classMenu: [
        { name: 'Classroom', icon: 'glyphicon glyphicon-home', link: '/studentview/attendance' },
        { name: 'Stories', icon: 'glyphicon glyphicon-picture', link: '/stories' },
        { name: 'Messages', icon: 'glyphicon glyphicon-comment', link: '/message' }
       ]
		}
	},
	mounted() {
		this.getStudentList();
	},
	methods: {
		getStudentList () {
			axios.get('/api/students')
		  .then((response) => {
		  	this.studentLists = response.data.data;
		  })
		  .catch(function (error) {
		    console.log(error);
		  });
		},
		takeAttendance (status, index) {
			if(status == 'present') {
				this.studentLists[index].status = 'absent';
				this.studentLists[index].statusValue = "images/student_images/absent_image.png"; 
			}
			else if(status == 'absent') {
				this.studentLists[index].status = 'late';
				this.studentLists[index].statusValue = "images/student_images/late_image.png"; 
			}
			else if(status == 'late') {
				this.studentLists[index].status = 'late leave';
				this.studentLists[index].statusValue = "images/student_images/late_leave_image.png"; 
			}
			else if(status == 'late leave') {
				this.studentLists[index].status = 'present';
				this.studentLists[index].statusValue = "images/student_images/present_image.png"; 
			}
		},
		markAllPresent () {
			for(var i = 0; i < this.studentLists.length; i++) {
				this.studentLists[i].status = 'present';
				this.studentLists[i].statusValue = 'images/student_images/present_image.png';
			}
		},
		markAllAbsent () {
			for(var i = 0; i < this.studentLists.length; i++) {
				this.studentLists[i].status = 'absent';
				this.studentLists[i].statusValue = 'images/student_images/absent_image.png';
			}
		}
	}
}
</script>

<style>
#whole-class-attendance,
#add-new-student-attendance {
	filter: grayscale(100%);
  opacity: 0.5;
}

#whole-class-attendance > a,
#add-new-student-attendance > a {
	cursor: auto;
}

.mark-attendance,
.mark-attendance-btns {
	padding: 1rem;
}

.mark-attendance-btns > a {
	margin-right: 1rem;
}
</style>