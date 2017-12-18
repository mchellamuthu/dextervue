<template>
<div>
<div :id="modalId" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog vertical-align-center">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <span class="modal-title"><strong>Give feedback to {{studentName}}</strong></span>
        </div>
        <div class="modal-body add-student-point-modal-body"> 
        	<div id="btn-content">
        		<div class="btn-group" role="group">
			       	<button class="btn btn-default" :class="{ 'btn-active': 'Positive' == activateBtn}" @click="activateBtn = 'Positive'" data-toggle="tab" data-target="#positiveTab"> Positive </button>
			        <button class="btn btn-default" :class="{ 'btn-active': 'Needs work' == activateBtn}" @click="activateBtn = 'Needs work'" data-toggle="tab" data-target="#needsWorkTab"> Needs work </button>
			      </div>
        	</div>

        	<div class="tab-content">
        		<div id="positiveTab" class="tab-pane fade in active">
        			<div class="points-content">
	          		<pointspanel v-for="skill in skills" :key="skill.id" :skillName="skill.skillName" :skillAvatar="skill.avatar" :skillpoint="skill.skillPoint"></pointspanel>
	          		<div class="panel panel-default points-panel" data-toggle="modal" data-target="#institutemodal" @click="editSkill">
								  <div class="panel-body">
								  	<img src="images/skill_icons/edit-skill-icon.png" width="50%">
								  	<div id="skill-name">Edit skills</div>
								  </div>
								</div>
	          	</div>
        		</div>
        		<div id="needsWorkTab" class="tab-pane fade">
        			<div class="panel panel-default points-panel" data-toggle="modal" data-target="#institutemodal" @click="addSkill">
                <div class="panel-body">
                  <img src="images/skill_icons/add-skill-icon.png" width="50%">
                  <div id="skill-name">Add skills</div>
                </div>
              </div>
        		</div>
        	</div>
        </div>

        <div class="modal-footer add-student-point-footer">
          <div class="row">
            <div class="col-md-6 text-center" id="add-photo-in-skill"><a v-on:click="addPhotoFromStudent"><i class="fa fa-camera fa-lg" aria-hidden="true"></i> &nbsp; Add photo</a></div>
            <div class="col-md-6 text-center" id="add-posts-in-skill"><a href="#addPhotoModal" data-toggle="modal"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> &nbsp; Add post</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="addPhotoModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="modal-title"><strong>Share on {{studentName}} 's story</strong></span>
          </div>
          <div class="modal-body add-photo-modal-body"> 
            <!-- comment posting -->
            <div class="comment-posting-content">
              <div class="row">
                <div class="col-md-2">
                  <div class="profile-icon"></div>
                </div>
                <div class="col-md-10">
                  <form>
                    <div class="form-group">
                      <textarea class="form-control" id="storyInputTextArea" rows="2" placeholder="Type your message..."></textarea>
                    </div>
                  </form>
                </div>
                </div>
                <div v-if="isPostImageContentEnabled" class="post-image-content">
                  <img :src="uploadedProfImage" width="20%">
                  <button class="btn deleteImage text-muted" v-on:click="removeUploadedImage">X</button>
                </div>
              
              <hr>
              <div class="post-btns">
                <div v-if="isAddPostingBtnsEnabled" class="pull-left">
                  <a href="#" class="btn btn-link" @click.prevent="onClickImagePicker"><i class="fa fa-camera" aria-hidden="true"></i>&nbsp;Add photo</a>
                </div>
                <div class="pull-right">
                   <div class="text-right"><button class="btn btn-primary default-btn" data-dismiss="modal" @click="addPost"> Post </button></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import filestack from 'filestack-js'
import VueTypes from 'vue-types'
export default {
	props: [ 'modalId', 'skills', 'studentName' ],
	data () {
		return {
			activateBtn: 'Positive',
      isPostImageContentEnabled: false,
      isAddPostingBtnsEnabled: true,
      uploadedProfImage: ''
		}
	},
  methods: {
    onsuccess (result) {
      $('#addPhotoModal').modal('show');
      this.uploadedProfImage = result.filesUploaded[0].url;
      this.isAddPostingBtnsEnabled = false;
      this.isPostImageContentEnabled = true;
    },
    onError (err) {
      this.$emit('error', err)
    },
    addPhotoFromStudent () {
        const client = filestack.init('AxCK8Sd0ARlOOpib6Vd2Gz')
        client.pick({
       }).then(response => this.onsuccess(response))
    },
    removeUploadedImage() {
      this.isPostImageContentEnabled = false;
      this.isAddPostingBtnsEnabled = true;
    },
    imagePickerSuccess (result) {
      this.uploadedProfImage = result.filesUploaded[0].url;
      this.isPostImageContentEnabled = true;
      this.isAddPostingBtnsEnabled = false;
    },
    imagePickerError (err) {
      this.$emit('error', err)
    },
    onClickImagePicker () {
      const options = {
        accept: 'image/*',
        maxFiles: 1
      }
        const client = filestack.init('AxCK8Sd0ARlOOpib6Vd2Gz')
        const ops = Object.assign({}, options)
        client.pick(ops).then(response => this.imagePickerSuccess(response)).catch((err) => this.imagePickerError(err))
    },
    addPost () {
      this.isPostImageContentEnabled = false;
      this.isAddPostingBtnsEnabled = true;
      $('#storyInputTextArea').val('');
    },
    editSkill (){
      $('#myInstituteModal li .skill-tab').tab('show');
    },
    addSkill () {
      $('#myInstituteModal li .skill-tab').tab('show');
    }
  }
}
</script>