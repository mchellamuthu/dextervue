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
  							<li v-for="(student, index) in studentLists" :key="student.id" :class="{ active: student.studentFirstName == activeBtn }" @click="studentStory(student.studentFirstName, index)">
  								<a><img :src="student.avatar" width="15%"> &nbsp; {{student.studentFirstName}}</a>
  							</li>
  						</ul>
  					</div>
  				</div>
  			</div>
  			<div class="col-md-7">
  				<div class="col-md-10">
  					<div class="story-right-menu">

	  					<div class="panel panel-default story-header-panel">
						    <div class="panel-body">
						    	<div class="row">
						    		<div class="col-md-4">
						    			<img :src="selectedStudent.avatar" width="70%">
						    		</div>
						    		<div class="col-md-8 story-content-message">
						    			<h4><strong>Welcome to {{selectedStudent.studentFirstName}}'s story</strong></h4>
						    			<p>Share photos and updates with just this student and their parents.</p>
						    			<button class="btn btn-default btn-default-active" data-toggle="modal" data-target="#institutemodal">Invite {{selectedStudent.studentFirstName}}'s parents</button>
						    		</div>
						    	</div>
						    </div>
							</div>

							<!-- comment posting -->
					    <div class="comment-posting-content">
					    	<div class="row">
					    		<div class="col-md-1">
					    			<div class="profile-icon" id="comment-posting-profile-icon"></div>
					    		</div>
					    		<div class="col-md-11">
					    			<form>
					    				<div class="form-group">
										    <textarea class="form-control" id="storyInputTextArea" rows="2" :placeholder="placeholderText" v-model="postedTextMessage"></textarea>
										  </div>
					    			</form>
					    		</div>
					    		</div>
					    		<div v-if="isPostImageContentEnabled" class="post-image-content">
			    					<img :src="uploadedProfImage" width="50%">
			    					<button class="deleteImage text-muted" v-on:click="removeUploadedImage">X</button>
			    				</div>
			    				<div v-if="isPostDocContentEnabled" class="post-doc-content">
			    					<button class="deleteDoc text-muted" v-on:click="removeUploadedDoc">X</button>
			    					<div class="row">
			    						<div class="col-md-1 doc-icon"><i class="fa fa-file-excel-o fa-3x" aria-hidden="true"></i></div>
			    						<div class="col-md-11 doc-content">
			    							<div>{{docFileName}}</div>
			    							<div class="text-muted">{{docFileSize}}</div>
			    						</div>
			    					</div>
			    				</div>
					    	<hr>
				    		<div class="post-btns">
							    <div v-if="isAddPostingBtnsEnabled" class="pull-left">
						        <a href="#" class="btn btn-link" @click.prevent="onClickImagePicker"><i class="fa fa-camera" aria-hidden="true"></i>&nbsp;Add photo</a>
						        <a href="#" class="btn btn-link" @click.prevent="onClickDocPicker"><i class="fa fa-paperclip" aria-hidden="true"></i>&nbsp;Add file</a>
						        <a href="#" class="btn btn-link"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;Add card</a>
							    </div>
							    <div class="pull-right">
						         <div class="text-right"><button class="btn btn-primary default-btn" @click="post"> Post </button></div>
							    </div>
							    <div class="clearfix"></div>
								</div>
							</div>

							<div v-if="noStoryPostedYet" class="no-post">
								<div class="text-muted">
									<h4><strong>No posts.. Yet!</strong></h4>
									<p>Make your first post on {{selectedStudent.studentFirstName}}'s Story. Have class iPads or Chromebooks? Let students add to their own Stories!</p>
								</div>
							</div>

							<!-- story post -->

							<div v-if="isStoryPosted" class="panel panel-default" v-for="(story, index) in storyPostList" :key="story.id">
						    <div class="panel-heading story-panel-header">
						    	<div class="row">
										<div class="col-md-1">
											<div class="profile-icon" id="comment-posting-profile-icon"></div>
										</div>
										<div class="col-md-9 poster-name">
											<strong>{{story.userName}}</strong> <br>
											<div ><strong>-></strong><span class="text-muted"> &nbsp; {{story.className}}</span></div>
										</div>
										<div class="col-md-2 text-right">
											<span class="text-muted">{{story.duration}}</span>
										</div>
									</div>
						    </div>
						    <div v-if="story.isImageContent" class="panel-body story-panel-image-body">
						    	<div class="story-post-content-main" :style="{ backgroundImage: 'url(' + story.postedPhoto + ')' }"></div>
						    </div>
						    <div v-if="story.isFileContent" class="panel-body story-panel-doc-body">
						    	<div class="post-doc-content">
			    					<div class="row">
			    						<div class="col-md-1 doc-icon"><i class="fa fa-file-excel-o fa-3x" aria-hidden="true"></i></div>
			    						<div class="col-md-11 doc-content">
			    							<div>{{story.fileName}}</div>
			    							<div class="text-muted">{{story.fileSize}}</div>
			    						</div>
			    					</div>
			    				</div>
						    </div>
						    <div class="panel-footer story-panel-footer">
						    	<div class="posted-text-msg">{{story.postedTextMessage}}</div>
						    	<div class="pull-left">
						    		<span class="likeButton" @click="clickLike(index)" :class="{active: story.isLiked}">
						        	<i v-if="!story.isLiked" class="fa fa-thumbs-o-up" aria-hidden="true"></i>
						        	<transition name="bounce">
						        		<i v-if="story.isLiked" class="fa fa-thumbs-up" aria-hidden="true"></i>
						        	</transition>
						        	 Like
						        </span> &nbsp; &nbsp;
										<span class="commentButton" @click="clickComment(story.id)"><i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp; Comment</span> &nbsp; &nbsp;
										<span class="shareButton"><i class="fa fa-share" aria-hidden="true"></i>&nbsp; Share</span>
						    	</div>
						    	<div class="pull-right">
							    	<div class="dropdown" id="edit-post">
									    <a href="#" data-toggle="dropdown" class="dropdown-toggle" title="Edit post"><i class="fa fa-ellipsis-h fa-lg" aria-hidden="true"></i></a>
									    <ul class="dropdown-menu">
								        <li><a @click="editPost(story, index)">Edit post</a></li>
								        <li><a @click="deletePost(index)">Delete post</a></li>
									    </ul>
										</div>
						    	</div>
						    	<div class="clearfix"></div>
					        

									<div v-if="showCommentView == story.id"  class="comment-view">
										<div v-for="(data, idx) in story.comments" :key="data.id">
											<hr>
												<div class="row comment-text">
													<div class="col-md-1">
														<div class="profile-icon" id="comment-posting-profile-icon"></div>
													</div>
													<div class="col-md-10 comment-lines">
														<strong>{{data.user}}</strong>
														<div class="posted-comment">
															<p>{{data.commentLines}}</p>
														</div>
														<div class="commented-time text-muted">{{data.time}}</div>
													</div>
													<div class="col-md-1">
														<div class="text-muted" @click="removeComment(data, idx, index)"><i class="fa fa-times" aria-hidden="true"></i></div>
													</div>
												</div>
										</div>

										<hr>
										<div class="row">
											<div class="col-md-1">
												<div class="profile-icon" id="comment-posting-profile-icon"></div>
											</div>
											<div class="col-md-11 comment-lines">
												<form>
													<div class="form-group">
														<input type="text" class="form-control" id="commentInput" v-model="comment" v-on:keyup.13="commentValue(index, comment)" placeholder="Write a comment...">
													</div>
												</form>
											</div>
										</div>
									</div>
						    </div>
							</div>
	  				</div>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>

  <div id="editPostModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="modal-title"><strong>Edit post</strong></span>
          </div>
          <div class="modal-body add-photo-modal-body"> 
            <!-- comment posting -->
            <div class="comment-posting-content">
              <div class="row">
                <div class="col-md-1">
                  <div class="profile-icon" id="comment-posting-profile-icon"></div>
                </div>
                <div class="col-md-11">
                  <form>
                    <div class="form-group">
                      <textarea class="form-control" id="storyInputTextArea" rows="2" v-model="editPostedText" placeholder="Type your message..."></textarea>
                    </div>
                  </form>
                </div>
                </div>
                <div v-if="isEditPostImageContentEnabled" class="post-image-content">
                  <img :src="editProfImage" width="40%">
                  <button class="btn deleteImage text-muted" v-on:click="removeEditPost">X</button>
                </div>
                <div v-if="isEditPostDocContentEnabled" class="post-image-content">
						    	<div class="post-doc-content">
						    	<button class="deleteDoc text-muted" v-on:click="removeEditPost">X</button>
			    					<div class="row">
			    						<div class="col-md-1 doc-icon"><i class="fa fa-file-excel-o fa-3x" aria-hidden="true"></i></div>
			    						<div class="col-md-11 doc-content">
			    							<div>{{editPostFileName}}</div>
			    							<div class="text-muted">{{editPostFileSize}}</div>
			    						</div>
			    					</div>
			    				</div>
						    </div>
              
              <hr>
              <div class="post-btns">
                <div v-if="isAddPostBtnEnabled" class="pull-left">
                  <a href="#" class="btn btn-link" @click.prevent="addPhotoOnEditPost"><i class="fa fa-camera" aria-hidden="true"></i>&nbsp;Add photo</a>
                </div>
                <div class="pull-right">
                   <div class="text-right"><button class="btn btn-primary default-btn" data-dismiss="modal" @click="postEdited"> Post </button></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <removemodal removeTitle="Delete post" warningMessage="Are you sure you want to delete this post? This cannot be undone." removeBtnName="Delete post" :removableIdx="removableIdx" @click="remove"></removemodal>

  <studentaccountmodal></studentaccountmodal>

  <institutemodal modalId="institutemodal" :studentLists="studentLists"></institutemodal>
</div>
</template>

<script>
import filestack from 'filestack-js'
export default {
	data () {
		return {
			studentLists: '',
			selectedStudent: '',
			selectedStudentName: '',
			isAddPostingBtnsEnabled: true,
			isPostImageContentEnabled: false,
			isPostDocContentEnabled: false,
			postedPhoto: '',
			showCommentView: '',
			uploadedProfImage: '',
      isPostImageContentEnabled: false,
      docFileName: '',
      docFileSize: '',
      isPostDocContentEnabled:  false,
      isAddPostingBtnsEnabled: true,
      filesStackResult: '',
      postedTextMessage: '',
      comment: '',
      commentData: [
	    	{ user: 'Mr.Vyas', commentLines: 'A variation of the ordinary lorem ipsum text.A variation of the ordinary lorem ipsum text.', id: 'cmnt0101', time: '10 mins' },
	    	{ user: 'Mr.Sai Prakash', commentLines: 'Hi! Hello world', id: 'cmnt0980', time: '8 days' }
	    ],
			classMenu: [
        { name: 'Classroom', icon: 'glyphicon glyphicon-home', link: '/studentview' },
        { name: 'Stories', icon: 'glyphicon glyphicon-picture', link: '/stories' },
        { name: 'Messages', icon: 'glyphicon glyphicon-comment', link: '/message' }
      ],
      storyPostList: [
      	{ id: 'u700', userName: 'Mr. preveen', duration: '2d', className: 'Demo class', postedTextMessage: 'Hello world', postedPhoto: '/images/story_image1.png', isImageContent: true, isFileContent: false, comments: [
	    	{ user: 'Mr.Vyas', commentLines: 'A variation of the ordinary lorem ipsum text.A variation of the ordinary lorem ipsum text.', id: 'cmnt0101', time: '10 mins' },
	    	{ user: 'Mr.Sai Prakash', commentLines: 'Hi! Hello world', id: 'cmnt0980', time: '8 days' }
	    ], fileName: '', fileSize: '', isLiked: true },
      	{ id: 'u701', userName: 'Mr. Jegath', duration: 'Today', className: 'Demo class', postedTextMessage: 'Hi! This is my class', postedPhoto: '', isImageContent: false, isFileContent: true, comments: [], fileName: 'globe.xls', fileSize: '8kb', isLiked: false }
      ],
      isEditPostImageContentEnabled: false,
      isEditPostDocContentEnabled: false,
      isAddPostBtnEnabled: false,
      editPostedText: '',
      editProfImage: '',
      editPostFileName: '',
      editPostFileSize: '',
      editPostIndex: '',
      removableIdx: ''
		}
	},
	computed: {
		placeholderText() {
			return "Share something about " + this.selectedStudent.studentFirstName + "...";
		},
		isStoryPosted () {
			return this.storyPostList != '';
		},
		noStoryPostedYet () {
			return this.storyPostList == '';
		},
		activeBtn: {
			get: function() {
      	return this.selectedStudentName;
			},
			set: function(newValue) {
				this.selectedStudentName = newValue;
			}
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
		  	this.selectedStudent = this.studentLists[0];
		  	this.selectedStudentName = this.selectedStudent.studentFirstName;
		  })
		  .catch(function (error) {
		    console.log(error);
		  });
		},
		studentStory(studentFirstName, studentIdx) {
			this.activeBtn = studentFirstName;
			this.selectedStudent = this.studentLists[studentIdx];
		},
		clickLike(index) {
			this.storyPostList[index].isLiked = !this.storyPostList[index].isLiked;
		},
		clickComment(id) {
			this.showCommentView = id;
		},
		removeComment(data, commentIdx, storyIdx) {
			var index = this.storyPostList[storyIdx].comments.indexOf(data);
	    this.storyPostList[storyIdx].comments.splice(index, 1);
		},
		imagePickerSuccess (result) {
			this.filesStackResult = result;
	    this.uploadedProfImage = result.filesUploaded[0].url
	    this.isPostImageContentEnabled = true
	    this.isAddPostingBtnsEnabled = false
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
    removeUploadedImage() {
    	this.isPostImageContentEnabled = false
    	this.isAddPostingBtnsEnabled = true
    },
    docPickerSuccess (result) {
    	this.filesStackResult = result;
    	var uploadedDoc = result.filesUploaded[0]
    	this.docFileName = uploadedDoc.filename
    	if (uploadedDoc.size > 1024 * 1024) {
       this.docFileSize = (Math.round(uploadedDoc.size * 100 / (1024 * 1024)) / 100).toString() + 'MB'
    	}
      else {
       this.docFileSize = (Math.round(uploadedDoc.size * 100 / 1024) / 100).toString() + 'KB'
      }
    	this.isPostDocContentEnabled = true
    	this.isAddPostingBtnsEnabled = false
    },
    docPickerError (err) {
    	this.$emit('error', err)
    },
    onClickDocPicker () {
    	const options = {
    		accept: '.docx',
    		maxFiles: 1
    	}
    	const client = filestack.init('AxCK8Sd0ARlOOpib6Vd2Gz')
    	const ops = Object.assign({}, options)
    	client.pick(ops).then(response => this.docPickerSuccess(response)).catch((err) => this.docPickerError(err))
    },
    removeUploadedDoc() {
    	this.isPostDocContentEnabled = false
    	this.isAddPostingBtnsEnabled = true
    },
    commentValue (index, comment) {
    	this.storyPostList[index].comments.push({
    		user: 'Mr.Praveen',
    		commentLines: comment,
    		id: 'cmd009',
    		time: '1 min'
    	});
    	this.comment = '';
    },
    post () {
    	if(this.filesStackResult && (this.filesStackResult.filesUploaded[0].mimetype == 'image/jpeg' || this.filesStackResult.filesUploaded[0].mimetype == 'image/png')) {
    		this.isPostDocContentEnabled = false;
    		this.isPostImageContentEnabled = false;
    		this.isAddPostingBtnsEnabled = true
    		
      	this.storyPostList.push({
      		id: 'u789',
      		userName: 'Mr.Akash',
      		duration: '5d',
      		className: 'Demo class',
      		postedTextMessage: this.postedTextMessage,
      		postedPhoto: this.filesStackResult.filesUploaded[0].url,
      		isImageContent: true,
      		isFileContent: false,
      		comments: [],
      		fileName: '',
      		fileSize: '',
      		isLiked: false
      	});
      	this.postedTextMessage = '';
    	}
    	else if(this.filesStackResult){
    		this.isPostDocContentEnabled = false;
    		this.isPostImageContentEnabled = false;
    		this.isAddPostingBtnsEnabled = true;
    		var uploadedDoc = this.filesStackResult.filesUploaded[0];
	    	this.docFileName = uploadedDoc.filename;
	    	if (uploadedDoc.size > 1024 * 1024) {
	       this.docFileSize = (Math.round(uploadedDoc.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
	    	}
	      else {
	       this.docFileSize = (Math.round(uploadedDoc.size * 100 / 1024) / 100).toString() + 'KB';
	      }

	      this.storyPostList.push({
      		id: 'u745',
      		userName: 'Mr.Naveen',
      		duration: 'Today',
      		className: 'Demo class',
      		postedTextMessage: this.postedTextMessage,
      		postedPhoto: '',
      		isImageContent: false,
      		isFileContent: true,
      		comments: [],
      		fileName: this.docFileName,
      		fileSize: this.docFileSize,
      		isLiked: false
      	});
      	this.postedTextMessage = '';
    	}
    	else if(this.postedTextMessage != '') {
    		this.storyPostList.push({
      		id: 'u775',
      		userName: 'Mr.Prakash',
      		duration: 'Today',
      		className: 'Demo class',
      		postedTextMessage: this.postedTextMessage,
      		postedPhoto: '',
      		isImageContent: false,
      		isFileContent: false,
      		comments: [],
      		fileName: '',
      		fileSize: '',
      		isLiked: false
      	});
      	this.postedTextMessage = '';
    	}
    },
    editPost (story, index) {
    	console.log(story);
    	console.log(index);
    	this.editPostIndex = index;
    	this.editPostedText = story.postedTextMessage;
    	if(story.isImageContent) {
    		this.isEditPostImageContentEnabled = true;
    		this.editProfImage = story.postedPhoto;
    	}
    	else if(story.isFileContent) {
    		this.isEditPostDocContentEnabled = true;
    		this.editPostFileSize = story.fileSize;
    		this.editPostFileName = story.fileName;
    	}
    	$('#editPostModal').modal('show');
    },
    removeEditPost() {
    	this.isEditPostImageContentEnabled = false;
    	this.isEditPostDocContentEnabled = false;
    	this.isAddPostBtnEnabled = true;
    },
    addPhotoOnEditPost () {
    	const options = {
			  accept: 'image/*',
			  maxFiles: 1
			}
      const client = filestack.init('AxCK8Sd0ARlOOpib6Vd2Gz')
      const ops = Object.assign({}, options)
      client.pick(ops).then(response => this.addPhotoOnEditPostSuccess(response)).catch((err) => this.addPhotoOnEditPostError(err))
    },
    addPhotoOnEditPostSuccess(result) {
	    this.editProfImage = result.filesUploaded[0].url
	    this.isEditPostImageContentEnabled = true
	    this.isAddPostBtnEnabled = false
    },
    postEdited() {
    	this.storyPostList[this.editPostIndex].postedTextMessage = this.editPostedText;
    	if(this.isEditPostImageContentEnabled) {
    		this.storyPostList[this.editPostIndex].isImageContent = true;
    		this.storyPostList[this.editPostIndex].isFileContent = false;
    		this.storyPostList[this.editPostIndex].postedPhoto = this.editProfImage;
    	}
    	this.editPostedText = '';
    	this.isEditPostImageContentEnabled = false;
    	this.isEditPostDocContentEnabled = false;
    },
    deletePost (index) {
    	$('#removeModal').modal('show');
    	this.removableIdx = index;
    },
    remove(idx) {
    	this.storyPostList.splice(idx, 1);
    }
	}
}
</script>