<template>
<div>
	<!-- Class menu -->
  	<classmenu selectedMenu="Classroom" :classMenuBtns="classMenu"></classmenu>

  	<div class="container">
	  	<div class="row">
	  		<div class="selectable-btns">
		      <div class="btn-group" role="group">
		       	<router-link to="/studentview/selectmultiple" class="btn btn-default btn-active"> Students </router-link>
		        <router-link to="/studentgroupview/selectmultiple" class="btn btn-default "> Groups </router-link>
		        <router-link to="/viewreport" class="btn btn-default"> View reports </router-link>
		      </div>
		    </div>
	  	</div>
	  </div>

  	<div class="student-view-list">
			<div class="points-content" id="whole-class">
		    <a>
		      <img src="images/group_icon.png">
		      <div id="name-content"><span>Whole class</span></div>
		   </a>
		  </div>
			<selectcard v-for="(student, index) in studentLists" :key="student.id" :name="student.studentName" :avatar="student.avatar" :clicked="student.selected" :index="index" @click="selectStudent"></selectcard>
			<div class="points-content" id="add-new-student">
	    	<a>
	    		<div class="add-image">
	    			<img src="images/student_images/add_button.png">
	    		</div>
	    	</a>
	    </div>
	  </div>

	  <addstudentpointsmodal modalId="addStudentPointsModal" :skills="skills" :studentName="studentName"></addstudentpointsmodal>

	  <institutemodal modalId="institutemodal" :studentLists="studentLists"></institutemodal>

	  <nav class="navbar navbar-default navbar-fixed-bottom">
		  <div class="container">
		    <div class="row">
		    	<div class="select-multiple-student clearfix">
		    		<div class="pull-left select-multiple-btn">
			    		<a @click="selectAll"> Select all</a>
			    		<span>{{selectedStudentCount}} Selected</span>
			    	</div>

			    	<div class="pull-right">
			    		<router-link to="/studentview" href="#" class="btn btn-link">Cancel</router-link>
	          	<button type="button" class="btn btn-primary default-btn" :disabled="disabledFeedbackBtn" @click="giveFeedback">Give feedback</button>
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
			studentName: '',
			skills: [],
			selectedStudentCount: 0,
			classMenu: [
        { name: 'Classroom', icon: 'glyphicon glyphicon-home', link: '/studentview/attendance' },
        { name: 'Stories', icon: 'glyphicon glyphicon-picture', link: '/stories' },
        { name: 'Messages', icon: 'glyphicon glyphicon-comment', link: '/message' }
       ]
		}
	},
	computed: {
		disabledFeedbackBtn() {
			var count = this.getSelectedCount();
			if(count > 0) {
				return false;
			}
			else {
				return true;
			}
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
		  })
		  .catch(function (error) {
		    console.log(error);
		  });
		},
		getSkills () {
			axios.get('/api/skills')
		  .then((response) => {
		  	this.skills = response.data.data;
		  })
		  .catch(function (error) {
		    console.log(error);
		  });
		},
		selectStudent (clicked, index) {
			this.studentLists[index].selected = !clicked;
			this.selectedStudentCount = this.getSelectedCount();
		},
		selectAll () {
			for(var i = 0; i < this.studentLists.length; i++) {
				this.studentLists[i].selected = true;
			}
			this.selectedStudentCount = this.studentLists.length;
		},
		giveFeedback () {
			$('#addStudentPointsModal').modal('show');
			var count = this.getSelectedCount();
			if(count > 1) {
				this.studentName = count + " Students"
			}
			else if(count == 1) {
				for(var j = 0; j < this.studentLists.length; j++) {
					if(this.studentLists[j].selected) {
						this.studentName = this.studentLists[j].studentName;
					}
				}
			}
		},
		getSelectedCount() {
			var selectedCount = 0;
			for(var i = 0; i < this.studentLists.length; i++) {
				if(this.studentLists[i].selected) {
					selectedCount = selectedCount + 1;
				}
			}
			return selectedCount;
		}
	}
}
</script>

<style>
#whole-class,
#add-new-student {
	filter: grayscale(100%);
  opacity: 0.5;
}

#whole-class-attendance > a,
#add-new-student-attendance > a {
	cursor: auto;
}

.select-multiple-student,
.select-multiple-btn {
	padding: 1rem;
}

.select-multiple-btn > span {
	margin: 0rem 35rem;
}
</style>