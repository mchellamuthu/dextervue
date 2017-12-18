<template>
<div>
	<!-- Class menu -->
  <classmenu selectedMenu="Stories" :classMenuBtns="instituteMenuLists"></classmenu>

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

	  					<div class="panel panel-default story-header-panel">
						    <div class="panel-body">
						    	<div class="row">
						    		<div class="col-md-4">
						    			<div class="connection-chart-layer">
                       <div class="circular-progress percent" id="parent-progress-in-stories">
                         <div class="meter">
                         		<div class="percent-content">
                         			<div class="connection-percent">%</div>
                         			<div class="connection-text"><span>Connected</span></div>
                         		</div>
                             <input type="hidden" min="0" max="100" value="60">
                         </div>
                       </div>
                     </div>
						    		</div>
						    		<div class="col-md-8 story-content-message">
						    			<h4><strong>7 parents still need to connect!</strong></h4>
						    			<p>Class Story is the easiest way to share classroom moments, photos, and updates with parents.</p>
						    			<button class="btn btn-default btn-default-active" data-toggle="modal" data-target="#institutemodal">Get invites</button>
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
										    <textarea class="form-control" id="storyInputTextArea" rows="2" placeholder="What's happening in your classroom?" v-model="postedTextMessage"></textarea>
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
									<p>Make your first post on Tyu's Story. Have class iPads or Chromebooks? Let students add to their own Stories!</p>
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
					        <span class="likeButton" @click="clickLike(index)" :class="{active: story.isLiked}">
					        	<i v-if="!story.isLiked" class="fa fa-thumbs-o-up" aria-hidden="true"></i>
					        	<transition name="bounce">
					        		<i v-if="story.isLiked" class="fa fa-thumbs-up" aria-hidden="true"></i>
					        	</transition>
					        	 Like
					        </span> &nbsp; &nbsp;
									<span class="commentButton" @click="clickComment(story.id)"><i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp; Comment</span> &nbsp; &nbsp;
									<span class="shareButton"><i class="fa fa-share" aria-hidden="true"></i>&nbsp; Share</span>

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

  <studentaccountmodal></studentaccountmodal>

  <institutemodal modalId="institutemodal" :studentLists="studentLists"></institutemodal>
</div>
</template>

<script>
import filestack from 'filestack-js'
export default {
	data () {
		return {
			activeBtn: 'Class story',
			studentLists: '',
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
			instituteMenuLists: [
        { name: 'Classes', icon: '', link: '/' },
        { name: 'Staffs', icon: '', link: '/staffview' },
        { name: 'Stories', icon: '', link: '/storyview' }
      ],
      storyPostList: [
      	{ id: 'u700', userName: 'Mr. preveen', duration: '2d', className: 'Demo class', postedTextMessage: 'Hello world', postedPhoto: '/images/story_image1.png', isImageContent: true, isFileContent: false, comments: [
	    	{ user: 'Mr.Vyas', commentLines: 'A variation of the ordinary lorem ipsum text.A variation of the ordinary lorem ipsum text.', id: 'cmnt0101', time: '10 mins' },
	    	{ user: 'Mr.Sai Prakash', commentLines: 'Hi! Hello world', id: 'cmnt0980', time: '8 days' }
	    ], fileName: '', fileSize: '', isLiked: true },
      	{ id: 'u701', userName: 'Mr. Jegath', duration: 'Today', className: 'Demo class', postedTextMessage: 'Hi! This is my class', postedPhoto: '', isImageContent: false, isFileContent: true, comments: [], fileName: 'globe.xls', fileSize: '8kb', isLiked: false }
      ]
		}
	},
	computed: {
		isStoryPosted () {
			return this.storyPostList != '';
		},
		noStoryPostedYet () {
			return this.storyPostList == '';
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
    studentStory(studentFirstName) {
			this.activeBtn = studentFirstName;
			this.$router.push({ path:'/stories/studentstories' });
		}
	}
}
</script>

<style scoped>


</style>

