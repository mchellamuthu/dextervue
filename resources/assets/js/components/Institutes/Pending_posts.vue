<template>
<div>
	<!-- Class menu -->
  <classmenu selectedMenu="Stories" :classMenuBtns="classMenu"></classmenu>

  <div class="container">
  	<div class="row">
  		<div class="story-content-view">
  			<div class="col-md-5">
  				<div class="col-md-7 col-md-offset-5">
  					<div class="story-left-menu">
  						<ul class="list-unstyled">
  							<li :class="{ active: 'Class story' == activeBtn }" @click="activeBtn = 'Class story'">
  								<router-link to="/stories"><img src="images/story_view_images/classstorylogo.png" width="15%"> &nbsp; Class story</router-link>
  							</li>
  						</ul>
  						<div class="text-muted student-story-title">Student Stories</div>
  						<ul class="list-unstyled student-story-list">
  							<li class="" href="#studentAccountModal" data-toggle="modal">
  								<a ><img src="images/story_view_images/student_mode_icon.png" width="15%"> &nbsp; Student accounts</a>
  							</li>
  							<li :class="{ active: 'Pending posts' == activeBtn }" @click="activeBtn = 'Pending posts'">
  								<router-link to="/stories/pendingpost"><img src="images/story_view_images/pending_post_icon.png" width="15%"> &nbsp; Pending posts</router-link>
  							</li>
  							<li v-for="student in studentLists" :key="student.id" :class="{ active: student.studentFirstName == activeBtn }" @click="studentStory(student.studentFirstName)">
  								<a><img :src="student.avatar" width="15%"> &nbsp; {{student.studentFirstName}}</a>
  							</li>
  						</ul>
  					</div>
  				</div>
  			</div>
  			<div class="col-md-7">
  				<div class="col-md-10">
  					<div class="story-right-menu">
	  					<div class="panel panel-default">
						    <div class="panel-heading"><strong>Approve student posts</strong></div>
						    <div class="panel-body text-muted text-center pending-post">
						    	<h4><strong>No pending posts</strong></h4>
						    	<p>When students add to their Stories, you'll approve their posts here!</p>
						    </div>
							</div>
	  				</div>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>

  <studentaccountmodal></studentaccountmodal>
</div>
</template>

<script>
export default {
	data () {
		return {
			studentLists: '',
			activeBtn: 'Pending posts',
			classMenu: [
        { name: 'Classroom', icon: 'glyphicon glyphicon-home', link: '/studentview' },
        { name: 'Stories', icon: 'glyphicon glyphicon-picture', link: '/stories' },
        { name: 'Messages', icon: 'glyphicon glyphicon-comment', link: '/message' }
      ]
		}
	},
	mounted() {
		this.getStudentLists();
	},
	methods: {
		getStudentLists () {
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
		studentStory(studentFirstName) {
			this.activeBtn = studentFirstName;
			this.$router.push({ path:'/stories/studentstories' });
		}
	}
}
</script>