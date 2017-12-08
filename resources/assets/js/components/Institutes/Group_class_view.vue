<template>
<div>
  <!-- Profile details -->
  <profilesection></profilesection>

  <!-- Class menu -->
  <classmenu selectedMenu="Group" :classMenuBtns="classMenuBtns"></classmenu>

  <!-- class-view -->
   <div class="container">
    <!-- <div class="row selectable-btns">
      <div class="btn-group" role="group" aria-label="...">
        <router-link to="/"><button type="button" class="btn btn-default">Class</button></router-link>
        <router-link to="/groupclass"><button type="button" class="btn btn-default btn-active">Group</button></router-link>
      </div>
    </div> -->
		<div class="row class-view-list">
			<card v-for="classGroup in classGroupLists" :key="classGroup.id" :title="classGroup.className" :avatar="classGroup.avatar" @click="viewDetail"></card>
			
			<card data-target="#addNewGroupClassModal" data-toggle="modal" title="Add group" avatar="/images/class_images/addclass.png" ></card>
		</div>
	</div>

	<div id="addNewGroupClassModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-lg vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><strong>Create group</strong></h4>
          </div>
          <div class="modal-body create-group-class-modal-body">
          	<div class="create-group-name">
          		<form class="form-inline">
							  <div class="form-group">
							    <label for="groupName">Group name</label>
							    <input type="text" class="form-control" id="groupName" v-model="inputValue">
							  </div>
							</form>
          	</div>
          	<div class="create-group-class-list">
          		<!-- <selectcard v-for="(classroom, index) in classLists" :key="classroom.id" :name="classroom.className" :avatar="classroom.avatar" @click="selectClass(classroom.className, index)"></selectcard> -->
          		<div class="creation-content" v-for="(classroom, index) in classLists" :key="classroom.id" @click="selectClass(classroom.className, index)">
						    <a>
						      <img :src="classroom.avatar">
						      <div id="staff-name"><span>{{classroom.className}}</span> </div>
						      <div class="selection_outdoor_layer">
						         <div class="selection_inner_layer"><img :class="{ selected: classroom.clicked }" src="https://teach-static.classdojo.com/61349f8482ecfd35884ab4a8781fe218.png"></div>
						      </div>
						    </a>
						  </div>
          	</div>
            
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
            <button type="button" class="btn btn-primary" data-dismiss="modal" :disabled="showButton" @click="createGroup">Create group</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="viewGroupClassModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-lg vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="groupModalLabel">
             <div class="dropdown col-md-5">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="images/class_view_images/settings_icon.png"> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                   <li><a href="#editGroupClassModal" data-toggle="modal" @click="editClassGroup(groupName)"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Edit group</a></li>
                   <li><a @click="deleteClassGroup()"><span class="glyphicon glyphicon-trash"></span> &nbsp; Delete group</a></li>
                </ul>
             </div>
            <span class="group-title"><strong>{{groupName}}</strong></span>
            </h4>
          </div>
          <div class="modal-body view-group-class-modal-body">
          	<div class="view-group-class-list">
          		<div class="creation-content" v-for="(classroom, index) in classLists" :key="classroom.id">
						    <a>
						      <img :src="classroom.avatar">
						      <div id="staff-name"><span>{{classroom.className}}</span> </div>
						    </a>
						  </div>
          	</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-lg btn-block" id="award-group-btn">Award group</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="editGroupClassModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-lg vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><strong>Edit group</strong></h4>
          </div>
          <div class="modal-body edit-group-class-modal-body">
          	<div class="create-group-name">
          		<form class="form-inline">
							  <div class="form-group">
							    <label for="groupNameInput">Group name</label>
							    <input type="text" class="form-control" id="groupNameInput" v-model="groupNameInputValue">
							  </div>
							</form>
          	</div>
          	<div class="edit-group-class-list">
          		<div class="creation-content" v-for="(classroom, index) in classLists" :key="classroom.id" @click="selectClass(classroom.className, index)">
						    <a>
						      <img :src="classroom.avatar">
						      <div id="staff-name"><span>{{classroom.className}}</span> </div>
						      <div class="selection_outdoor_layer">
						         <div class="selection_inner_layer"><img :class="{ selected: classroom.clicked }" src="https://teach-static.classdojo.com/61349f8482ecfd35884ab4a8781fe218.png"></div>
						      </div>
						    </a>
						  </div>
          	</div>
          </div>
          <div class="modal-footer clearfix">
          	<div class="pull-left">
          		<a href="#" class="btn btn-link delete-btn" data-dismiss="modal" @click="deleteClassGroup">Delete group</a>
          	</div>
          	<div class="pull-right">
          		<a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
            	<button type="button" class="btn btn-primary" data-dismiss="modal" :disabled="showSaveGroupButton" @click="saveGroup">Save</button>
          	</div>
            
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

</template>

<script>
import swal from 'sweetalert2'
export default {
	data () {
		return {
			classGroupLists: '',
			classLists: '',
			isClassSelected: false,
			inputValue: '',
			groupName: '',
			groupNameInputValue: '',
      classMenuBtns: [
        { name: 'Class', icon: '', link: '/' },
        { name: 'Group', icon: '', link: '/groupclass' }
       ]
		}
	},
	mounted() {
		this.getGroupClassList();
		this.getClassList();
	},
	 computed: {
    showButton: function () {
      var result = (this.inputValue == '' || !this.isClassSelected)
      return result
    },
    showSaveGroupButton: function() {
    	var result = (this.groupName == '' || !this.isClassSelected)
      return result
    }
  },
	methods: {
		getGroupClassList () {
			axios.get('/api/groupclass')
		  .then((response) => {
		  	this.classGroupLists = response.data.data;
		  })
		  .catch(function (error) {
		    console.log(error);
		  });
		},
		getClassList () {
			axios.get('/api/class')
		  .then((response) => {
		  	this.classLists = response.data.data;
		  })
		  .catch(function (error) {
		    console.log(error);
		  });
		},
		selectClass(cName, index) {
      var values = []
      this.classLists[index].clicked = !this.classLists[index].clicked;
      this.classLists.forEach((select) => {
        if(select.clicked) {
          values.push(select)
        }
      })
      if(values.length >= 1) {
        this.isClassSelected = true;
      } else {
        this.isClassSelected = false;
      }
    },
    createGroup () {
    	this.classGroupLists.push({
    		className: this.inputValue,
    		avatar: 'images/class_group_icon.png',
    		icon: '/images/class_images/settings_icon.png'
    	});
    	this.inputValue = '';
    	this.isClassSelected = false;
    	for(var i = 0; i < this.classLists.length; i++) {
    		this.classLists[i].clicked = false;
    	}
    },
    viewDetail(title) {
    	$('#viewGroupClassModal').modal('show');
    	this.groupName = title;
    },
    editClassGroup(gName) {
    	this.groupNameInputValue = gName;
    },
    saveGroup () {
    	$('#viewGroupClassModal').modal('hide');
    },
    deleteClassGroup () {
      swal({
        title: 'Delete this group?',
        text: "Are you sure you want to delete this group? This can't be undone.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete group',
        cancelButtonText: 'Cancel',
        allowOutsideClick: false
      }).then(function(result) {
        if (result.value) {
          swal(
            'Deleted!',
            'Your group has been deleted.',
            'success'
          )
          $('#viewGroupClassModal').modal('hide');
        } else if (result.dismiss === 'cancel') {
          swal(
            'Cancelled',
            'Your group is safe :)',
            'error'
          )
        }
      })
    }
	}
}
	
</script>

<style scoped>
	.create-group-class-modal-body,
	.view-group-class-modal-body,
	.edit-group-class-modal-body {
		background-color: #f5f5f5;
		padding: 0px;
	}

	.create-group-class-list,
	.view-group-class-list,
	.edit-group-class-list {
		padding: 5px;
		max-height: 40rem;
    overflow-y: auto;
    overflow-x: hidden;
	}

	.create-group-name {
		background-color: #fff;
		padding: 2rem;
		text-align: center;
	}

	#award-group-btn {
		border-radius: 5px !important;
	}

	.delete-btn,
	.delete-btn:hover,
	.delete-btn:focus,
	.delete-btn.focus,
	.delete-btn:active,
	.delete-btn.active {
		color: red !important;
	}
</style>