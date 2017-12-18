<template>
<div :id="modalId" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-lg vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><strong>Create group</strong></h4>
          </div>
          <div class="modal-body edit-student-group-modal-body">
          	<div class="create-group-name">
          		<form class="form-inline">
							  <div class="form-group">
							    <label for="groupNameInput">Group name</label>
							    <input type="text" class="form-control" id="groupNameInput" refs="groupNameInput" v-model="groupNameInputValue">
							  </div>
							</form>
          	</div>
          	<div class="edit-student-group-list">
          		<div class="points-content" v-for="(student, index) in showLists" :key="student.id" @click="selectStudents(student.studentName, index)">
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
          <div class="modal-footer">
          		<a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
            	<button type="button" class="btn btn-primary default-btn" data-dismiss="modal" :disabled="showSaveGroupButton" v-on:click="saveGroup">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
	props: [ 'modalId', 'showLists' ],
	data () {
		return {
			groupNameInputValue: ''
		}
	},
	computed: {
    showSaveGroupButton: function() {
    	var count = this.getSelectedCount();
    	var result = (this.groupNameInputValue == '' || !(count > 0))
      return result
    }
  },
	methods: {
		selectStudents (studentName, index) {
			this.showLists[index].selected = !this.showLists[index].selected;
		},
		getSelectedCount() {
			var selectedCount = 0;
			for(var i = 0; i < this.showLists.length; i++) {
				if(this.showLists[i].selected) {
					selectedCount = selectedCount + 1;
				}
			}
			return selectedCount;
		},
		saveGroup () {
			this.$emit('click', this.groupNameInputValue);
			this.groupNameInputValue = '';
			for(var j = 0; j < this.showLists.length; j++) {
				this.showLists[j].selected = false;
			}
		}
	}
}
</script>