<template>
<div>

	<!-- Class menu -->
  <classmenu selectedMenu="Classroom" :classMenuBtns="classMenu"></classmenu>

  <div class="container">
  	<div class="row">
  		<div class="selectable-btns">
	      <div class="btn-group" role="group">
	       	<router-link to="/studentview" class="btn btn-default"> Students </router-link>
	        <router-link to="/studentgroupview" class="btn btn-default btn-active"> Groups </router-link>
	        <router-link to="/viewreport" class="btn btn-default"> View reports </router-link>
	      </div>
	    </div>
  	</div>
  </div>

  <div class="student-group-view-list">
    <div class="group-points-content">
      <grouppointcard v-for="studentGroup in studentGroupLists" :key="studentGroup.id" :groupName="studentGroup.studentGroupName" :groupPoint="studentGroup.studentGroupPoint" :groupAvatars="studentGroup.avatar"></grouppointcard>
    </div>
  </div>

  
</div>
</template>

<script>
export default{
  data() {
    return {
      studentGroupLists: '',
      classMenu: [
        { name: 'Classroom', icon: 'glyphicon glyphicon-home', link: '/studentview' },
        { name: 'Stories', icon: 'glyphicon glyphicon-picture', link: '/studentgroupview' },
        { name: 'Messages', icon: 'glyphicon glyphicon-comment', link: '/viewreport' }
      ]
    }
  },
  mounted() {
    this.getStudentGroupLists();
  },
  methods: {
    getStudentGroupLists () {
      axios.get('/api/studentgroups')
      .then((response) => {
        this.studentGroupLists = response.data.data;
        console.log(this.studentGroupLists);
        for(var i = 0; i < this.studentGroupLists.length; i++) {
          if(this.studentGroupLists[i].studentGroupPoint > 0) {
            this.studentGroupLists[i].pointsAwarded = true;
          }
        }
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  }
}
</script>

<style>
.student-group-view-list {
  margin: 2rem;
}
</style>