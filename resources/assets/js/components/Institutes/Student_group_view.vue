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
    <grouppointcard v-for="(studentGroup, index) in studentGroupLists" :key="studentGroup.id" :groupName="studentGroup.studentGroupName" :groupPoint="studentGroup.studentGroupPoint" :index="index" :groupAvatars="studentGroup.avatar" @click="viewGroup"></grouppointcard>
    
    <div class="group-points-content add-new-content">
      <a href="#createGroupModal" data-toggle="modal">
        <div class="add-group-image">
          <img src="images/student_images/add_button.png">
        </div>
      </a>
    </div>
  </div>

  <div id="viewStudentGroupModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-lg vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="groupModalLabel">
             <div class="dropdown col-md-5">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="images/class_view_images/settings_icon.png"> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                   <li><a href="#editGroupModal" data-toggle="modal" @click="editStudentGroup(studentGroupName)"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Edit group</a></li>
                   <li><a @click="removeGroup"><span class="glyphicon glyphicon-trash"></span> &nbsp; Delete group</a></li>
                </ul>
             </div>
            <span class="group-title"><strong>{{studentGroupName}}</strong></span>
            </h4>
          </div>
          <div class="modal-body view-student-group-modal-body">
            <div class="view-student-group-list">
              <div class="points-content" v-for="(student, index) in studentLists" :key="student.id">
                <a @click="giveStudentPoints(student.studentFirstName, index)">
                  <img :src="student.avatar">
                  <div id="name-content"><span>{{student.studentFirstName}}</span> </div>
                </a>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary default-btn btn-block" id="award-group-btn" @click="awardGroup">Award group</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="editGroupModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-lg vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><strong>Edit group</strong></h4>
          </div>
          <div class="modal-body edit-student-group-modal-body">
            <div class="create-group-name">
              <form class="form-inline">
                <div class="form-group">
                  <label for="groupNameInput">Group name</label>
                  <input type="text" class="form-control" id="groupNameInput" refs="groupNameInput" v-model="studentGroupName">
                </div>
              </form>
            </div>
            <div class="edit-student-group-list">
              <div class="points-content" v-for="(student, index) in studentLists" :key="student.id" @click="selectStudents(student.studentName, index)">
                <a>
                  <img :src="student.avatar">
                  <div id="name-content"><span>{{student.studentFirstName}}</span> </div>
                  <div class="selection_outdoor_layer">
                     <div class="selection_inner_layer"><img :class="{ selectedContent: student.selected }" src="https://teach-static.classdojo.com/61349f8482ecfd35884ab4a8781fe218.png"></div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="modal-footer clearfix">
            <div class="pull-left">
              <a href="#" class="btn btn-link delete-btn" data-dismiss="modal">Delete group</a>
            </div>
            <div class="pull-right">
              <a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
              <button type="button" class="btn btn-primary default-btn" data-dismiss="modal" :disabled="showSaveGroupButton" @click="editGroup(studentGroupName)">Save</button>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>

  <removemodal :removeTitle="removeTitle" :warningMessage="warningMessage" :removeBtnName="removeBtnName"></removemodal>

  <creategroupmodal modalId="createGroupModal" modalTitle="Create group" :showLists="studentLists" @click="saveGroup"></creategroupmodal>

  <addstudentpointsmodal modalId="addStudentPointsModal" :skills="skills" :studentName="studentName" @click="addPhotoFromStudent"></addstudentpointsmodal>

  <institutemodal modalId="institutemodal" :studentLists="studentLists"></institutemodal>

  <attendancebottom></attendancebottom>
</div>
</template>

<script>
export default{
  data() {
    return {
      studentGroupLists: '',
      studentLists: '',
      studentImages: '',
      studentGroupName: '',
      editGroupIndex: '',
      skills: '',
      studentName: '',
      removeTitle: '',
      warningMessage: '',
      removeBtnName: '',
      classMenu: [
        { name: 'Classroom', icon: 'glyphicon glyphicon-home', link: '/studentview' },
        { name: 'Stories', icon: 'glyphicon glyphicon-picture', link: '/stories' },
        { name: 'Messages', icon: 'glyphicon glyphicon-comment', link: '/message' }
      ]
    }
  },
  computed: {
    showSaveGroupButton: function() {
      var count = this.getSelectedCount();
      var result = (this.studentGroupName == '' || !(count > 0))
      return result
    }
  },
  mounted() {
    this.getStudentGroupLists();
    this.getStudentLists();
    this.getStudentImages();
    this.getSkills();
  },
  methods: {
    removeGroup () {
      $('#removeModal').modal('show');
      this.removeTitle = "Delete this group?";
      this.warningMessage = "Are you sure you want to delete this group? This can't be undone.";
      this.removeBtnName = "Delete group";
    },
    getStudentGroupLists () {
      axios.get('/api/studentgroups')
      .then((response) => {
        this.studentGroupLists = response.data.data;
        for(var i = 0; i < this.studentGroupLists.length; i++) {
          if(this.studentGroupLists[i].studentGroupPoint > 0) {
            this.studentGroupLists[i].pointsAwarded = true;
          }
        }
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    getStudentLists () {
      axios.get('/api/students')
      .then((response) => {
        this.studentLists = response.data.data;
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    getStudentImages () {
      axios.get('/api/studentImages')
      .then((response) => {
        this.studentImages = response.data.data;
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
    saveGroup (groupName) {
      this.randomGroupImages();
      var groupAvatars = [];
      for(var i = 0; i < 4; i++) {
        groupAvatars.push({
          avatar: this.randomGroupImages()
        })
      }
      var avatarList = [];
      avatarList.push({
        avatar1: groupAvatars[0].avatar,
        avatar2: groupAvatars[1].avatar,
        avatar3: groupAvatars[2].avatar,
        avatar4: groupAvatars[3].avatar
      })

      this.studentGroupLists.push({
        studentGroupName: groupName,
        studentGroupPoint: 0,
        avatar: avatarList
      })
    },
    editGroup (groupName) {
      this.studentGroupLists[this.editGroupIndex].studentGroupName = groupName;
    },
    randomGroupImages() {
      var iconArray = this.studentImages
      var randIcon = Math.floor(Math.random()*(iconArray.length));
      return iconArray[randIcon].avatar;
    },
    viewGroup(name, index) {
      this.studentGroupName = name;
      this.editGroupIndex = index;
      $('#viewStudentGroupModal').modal('show');
    },
    editStudentGroup(groupName) {
      console.log(this.editGroupIndex);
      this.studentGroupName = groupName;
    },
    deleteStudentGroup() {

    },
    getSelectedCount() {
      var selectedCount = 0;
      for(var i = 0; i < this.studentLists.length; i++) {
        if(this.studentLists[i].selected) {
          selectedCount = selectedCount + 1;
        }
      }
      return selectedCount;
    },
    selectStudents (studentName, index) {
      this.studentLists[index].selected = !this.studentLists[index].selected;
    },
    addPhotoFromStudent () {

    },
    giveStudentPoints (studentName, index) {
      $('#addStudentPointsModal').modal('show');
      this.studentName = studentName;
    },
    awardGroup () {
      $('#addStudentPointsModal').modal('show');
      this.studentName = this.studentGroupName
    }
  }
}
</script>

<style>
.student-group-view-list {
  margin: 2rem;
}

.add-new-group {
  background-color: rgba(255, 255, 255, 0.5);
  border-radius: 5px;
  display: inline-block;
  box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 3px 0px;
  user-select: none;
  cursor: pointer;
  text-align: center;
  position: relative;
  height: 14rem;
  width: 22rem;
  margin: 2rem;
}
</style>