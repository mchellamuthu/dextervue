<template>
<div>
	<!-- Class menu -->
  	<classmenu selectedMenu="Classroom" :classMenuBtns="classMenu"></classmenu>

  	<div class="container">
	  	<div class="row">
	  		<div class="selectable-btns">
		      <div class="btn-group" role="group">
		       	<router-link to="/studentview/selectmultiple" class="btn btn-default"> Students </router-link>
		        <router-link to="/studentgroupview/selectmultiple" class="btn btn-default btn-active"> Groups </router-link>
		        <router-link to="/viewreport" class="btn btn-default"> View reports </router-link>
		      </div>
		    </div>
	  	</div>
	  </div>

  	<div class="student-group-view-list">
			<div class="group-points-content" v-for="(group, index) in studentGroupLists" :key="group.id">
				<a @click="selectGroup(group.selected, index)">
					<div class="group-image-content" v-for="avatar in group.avatar" :key="avatar.avatar1">
						<div class="group-image-1">

							<div :src="avatar.avatar1" class="group-image-background">
								<div class="group-image-outer-layer" :style="{ backgroundImage: 'url(' + avatar.avatar1 + ')' }"></div>
								<img :src="avatar.avatar1">
							</div>

							<div :src="avatar.avatar2" class="group-image-background">
								<div class="group-image-outer-layer" :style="{ backgroundImage: 'url(' + avatar.avatar2 + ')' }"></div>
								<img :src="avatar.avatar2">
							</div>

						</div>
						<div class="group-image-2">

							<div :src="avatar.avatar3" class="group-image-background">
								<div class="group-image-outer-layer" :style="{ backgroundImage: 'url(' + avatar.avatar3 + ')' }"></div>
								<img :src="avatar.avatar3">
							</div>

							<div :src="avatar.avatar4" class="group-image-background">
								<div class="group-image-outer-layer" :style="{ backgroundImage: 'url(' + avatar.avatar4 + ')' }"></div>
								<img :src="avatar.avatar4">
							</div>

						</div>
					</div>

					<div class="group_title"><span>{{group.studentGroupName}}</span></div>
					<div class="selection_outdoor_layer">
	         	<div class="selection_inner_layer"><img :class="{ selectedContent: group.selected }" src="https://teach-static.classdojo.com/61349f8482ecfd35884ab4a8781fe218.png"></div>
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
			studentGroupLists: '',
			studentLists: '',
			skills: '',
			studentName: '',
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
		this.getStudentGroupLists();
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
		getStudentGroupLists () {
      axios.get('/api/studentgroups')
      .then((response) => {
        this.studentGroupLists = response.data.data;
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    selectGroup (clicked, index) {
			this.studentGroupLists[index].selected = !clicked;
			this.selectedStudentCount = this.getSelectedCount();
		},
		selectAll () {
			for(var i = 0; i < this.studentGroupLists.length; i++) {
				this.studentGroupLists[i].selected = true;
			}
			this.selectedStudentCount = this.studentGroupLists.length;
		},
		giveFeedback () {
			$('#addStudentPointsModal').modal('show');
			var count = this.getSelectedCount();
			if(count > 1) {
				this.studentName = count + " groups"
			}
			else if(count == 1) {
				for(var j = 0; j < this.studentGroupLists.length; j++) {
					if(this.studentGroupLists[j].selected) {
						this.studentName = this.studentGroupLists[j].studentGroupName;
					}
				}
			}
		},
		getSelectedCount() {
			var selectedCount = 0;
			for(var i = 0; i < this.studentGroupLists.length; i++) {
				if(this.studentGroupLists[i].selected) {
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