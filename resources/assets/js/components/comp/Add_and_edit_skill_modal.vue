<template>
<div :id="modalId" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog vertical-align-center">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">{{skillTitle}}</h4>
        </div>
        <div class="modal-body edit-skill-modal-body">
          <div class="dropdown class-icon-selection-dropdown">
	          <button class="btn btn-default dropdown-toggle-button" data-toggle="dropdown" id="dropdownMenu1" aria-expanded="false">
	         		<img :src="selectedImage"> <b class="caret"></b>
	         	</button>
	          <ul class="dropdown-menu" id="dropdown-image-add-class" aria-labelledby="dropdownMenu1">
	            <ul class='list-inline' >
	              <li v-for="list in imagelists" :key="list.avatar"><a @click="selectSkillImage(list.avatar)"><img :src="list.avatar" width="90%"></a>
	              </li>
	          	</ul>
	          </ul>
	        </div>

	        <div class="input-content">
	        	<form class="form-horizontal">
			        <div class="form-group">
			            <label for="classNameInput" class="control-label col-md-3">Name</label>
			            <div class="col-md-9">
			                <input type="text" class="form-control" id="classNameInput" placeholder="E.g., On task" v-model="inputValue">
			            </div>
			        </div>
			        <div class="form-group">
		            <label for="gradeInput" class="control-label col-xs-3">Point weight</label>
	              <select class="selectpicker col-xs-9" data-size="7" v-model="point">
								  <option>0</option>
								  <option>1</option>
								  <option>2</option>
								  <option>3</option>
								  <option>4</option>
								  <option>5</option>
								</select>
			        </div>
			    	</form>
	        </div>
        </div>
        <div class="modal-footer clearfix">
        	<div v-if="isDeleteButtonExists" class="pull-left">
        		<a href="#" class="btn btn-link" id="delete-skill-btn">Delete</a>
        	</div>
        	<div class="pull-right">
      		 	<a href="#" class="btn btn-link" data-dismiss="modal">Back</a>
        		<button type="button" class="btn btn-primary default-btn" data-dismiss="modal" :disabled="saveSkillBtn">Save</button>
        	</div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
	props: [ 'modalId', 'skillTitle', 'listOfSkillImages', 'selectedSkillImage', 'inputSkillValue', 'selectedPoint' ],
	data () {
		return { 
		}
	},
	computed: {
		saveSkillBtn() {
			var result = (this.inputValue == '' || !this.point);
			return result
		},
		selectedImage() {
			return this.selectedSkillImage;
		},
		inputValue() {
			return this.inputSkillValue;
		},
		point() {
			return this.selectedPoint;
		},
		imagelists() {
			return this.listOfSkillImages;
		},
		isDeleteButtonExists () {
			return this.skillTitle == "Edit skill";
		}
	},
	methods: {
		selectSkillImage (img) {
			this.selectedImage = img;
		}
	}
}
</script>