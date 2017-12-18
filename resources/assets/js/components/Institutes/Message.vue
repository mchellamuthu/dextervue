<template>
<div>
	<!-- Class menu -->
  <classmenu selectedMenu="Messages" :classMenuBtns="classMenu"></classmenu>

  <div class="container">
  	<div class="row">
  		<div class="message-content">
        <div class="col-md-3 message-left-menu">
          <ul class="list-unstyled">
          	<div class="list-header"><strong>Messages</strong></div>
          	<li :class="{ active: 'All parents' == activeBtn }" @click="activeBtn = 'All parents'">
          		<a>
					      <div class="row">
					        <div class="col-md-2">
					          <img src="images/all_parents_icon.png" width="40px;">
					        </div>
					        <div class="col-md-10 all-parents-content">
					          <div>All parents</div>
					          <div class="sub-text text-muted">4 parents connected</div>
					        </div>
					      </div>
					    </a>
          	</li>
          	<li v-for="student in studentLists" :key="student.id" :class="{ active: student.studentName == activeBtn }" @click="activeBtn = student.studentName">
          		<a>
					      <div class="row">
					        <div class="col-md-2">
					          <div class="profile-icon" id="comment-posting-profile-icon"></div>
					        </div>
					        <div class="col-md-10 students-parent-content">
					          <p>{{student.studentName}}'s Parent</p>
					        </div>
					      </div>
					    </a>
          	</li>
          	<li data-toggle="modal" data-target="#institutemodal" @click="inviteParentForChat">
          		<a>
					      <div class="row">
					        <div class="col-md-2">
					          <div class="profile-icon" id="comment-posting-profile-icon"></div>
					        </div>
					        <div class="col-md-10 all-parents-content">
					          <div>Bradley cure's Parent</div>
					          <div class="sub-text text-muted invite-parent">Invite parent</div>
					        </div>
					      </div>
					    </a>
          	</li>
          </ul>
        </div>
        <div class="col-md-9 message-right-menu">
          <div class="message-right-menu-header">
              <strong>{{messageTitle}}</strong>
          </div>

          <div class="chat-content">
          	<div v-if="isDefaultContentEnabled" class="default-content">
          		<div id="default-content-hint">
          			It’s quiet hours! Parents know that you may not reply until later 😊
          		</div>

          		<div class="example-chat-view">
          			<div><h4><strong>Example</strong></h4></div>
          			<div class="row">
          				<div class="col-md-4 col-md-offset-2">
          					<img src="images/student_images/cute10.png" width="100%">
          				</div>
          				<div class="col-md-6">
          					<div style="position: relative; text-align: left; width: 20rem; background-color: rgb(245, 245, 245); border-radius: 1rem; padding: 1.5rem; margin: 4rem 0rem;"><div style="width: 0px; height: 0px; border-top: 1rem solid transparent; border-right: 2rem solid rgb(245, 245, 245); border-bottom: 1rem solid transparent; position: absolute; left: -1.5rem; top: calc(50% - 1rem); "></div><span>Don't forget! School ends at 12pm tomorrow for conferences. I'm looking forward to seeing you all 😊</span></div>

          					<p style="text-align: left; padding-left: 1rem; color: rgb(0, 174, 239);"><span>Seen by 10 parents</span></p>
          				</div>
          			</div>
          			<div>Use this screen to send a message to all parents connected to Demo Class</div>
          		</div>
          	</div>

          	<div v-if="isChatTextListsEnabled" class="chat-text-lists">
              <div class="chat" data-chat="person2">
                <div class="conversation-start">
                    <span>Today, 5:38 PM</span>
                </div>
                <div v-for="chat in chatTextLists" :key="chat.text">
                	<div v-if="chat.type == 'bubble-you'">
                		<div class="bubble bubble-you">
		                   {{chat.text}}
		                   <span>{{chat.duration}}</span>
		                </div>
                	</div>
                	<div v-else-if="chat.type == 'bubble-me'">
                		<div class="bubble bubble-me">
		                   {{chat.text}}
		                   <span>{{chat.duration}}</span>
		                </div>
                	</div>
                </div>
            	</div>
          	</div>

          	<div class="chat-input-box">
          		<div class="input-group">
          			<input type="text" class="form-control" v-model="textMessage" :placeholder="chatPlaceholder">
		            <span class="input-group-btn">
	                <button type="button" class="btn btn-default"><i aria-hidden="true" class="fa fa-paperclip fa-2x"></i></button>
	                <button type="button" class="btn btn-default send-telegram-btn" @click="sendMessage"><i class="fa fa-telegram fa-2x" aria-hidden="true"></i></button>
		            </span>
			        </div>
			        
          	</div>
          </div>
        </div>
      </div>
  	</div>
  </div>

<institutemodal modalId="institutemodal" :studentLists="studentLists"></institutemodal>
  
</div>
</template>

<script>
export default {
	data() {
		return {
			studentLists: '',
			activeBtn: 'All parents',
			isDefaultContentEnabled: true,
			isChatTextListsEnabled: false,
			textMessage: '',
			classMenu: [
        { name: 'Classroom', icon: 'glyphicon glyphicon-home', link: '/studentview' },
        { name: 'Stories', icon: 'glyphicon glyphicon-picture', link: '/stories' },
        { name: 'Messages', icon: 'glyphicon glyphicon-comment', link: '/message' }
      ],
      chatTextLists: [
      	{ text: 'Hi', type: 'bubble-you', duration: '11.28 pm' },
      	{ text: 'how are you!!!', type: 'bubble-you', duration: '11.40 pm' },
      	{ text: 'Yeah i am fine', type: 'bubble-me', duration: '12.00 pm' },
      	{ text: 'Ha ha ha ha ha', type: 'bubble-you', duration: '12.10 pm' }
      ]
		}
	},
	computed: {
		chatPlaceholder() {
			if(this.activeBtn == "All parents") {
				return "Message all parent";
			}
			else {
				return "Message " + this.activeBtn + "'s parent";
			}
		},
		messageTitle() {
			if(this.activeBtn == "All parents") {
				return this.activeBtn;
			} else {
				return this.activeBtn + "'s Parent";
			}
		}
	},
	mounted() {
		this.getStudentLists();
	},
	methods: {
		getStudentLists() {
			axios.get('/api/students')
      .then((response) => {
        this.studentLists = response.data.data;
      })
      .catch(function (error) {
        console.log(error);
      });
		},
		getCurrentTime() {
      var currentTime;
      var currentDate = new Date();
      var hour = currentDate.getHours();
      var meridiem = hour >= 12 ? "PM" : "AM";
      currentTime = ((hour + 11) % 12 + 1) + ":" + currentDate.getMinutes() + meridiem;
      return currentTime;
    },
		sendMessage () {
			this.isDefaultContentEnabled = false;
			this.isChatTextListsEnabled = true;
			this.chatTextLists.push({
				text: this.textMessage,
				type: 'bubble-me',
				duration: this.getCurrentTime()
			});
			this.textMessage = '';
			console.log(this.chatTextLists);
		},
		inviteParentForChat() {
			$('#myInstituteModal li .parent-tab').tab('show');
		}
	}
}
</script>

<style>
.message-content {
  background-color: #fff;
  border: 1px solid rgb(218, 218, 218);
  height: 70rem;
  border-radius: 5px;
  margin: 2rem 0rem;
}

.message-left-menu {
  padding: 0px;
  height: 70rem;
  overflow-y: auto;
  overflow-x: hidden;
}

.message-right-menu {
	padding: 0px;
}

.message-left-menu > ul {
  margin: 0px;
}

.message-left-menu > ul > li {
  padding: 1rem;
}

.message-left-menu > ul > li:hover {
  cursor: pointer;
}

.message-left-menu > ul > li.active {
  background-color: rgb(230, 246, 253);
  font-weight: 600;
}

.message-left-menu {
  border-right: 1px solid rgb(218, 218, 218);
}

.list-header {
	-webkit-box-flex: 0;
    flex: 0 0 auto;
    padding: 12px 16px;
    border-bottom: 1px solid rgb(218, 218, 218);
}

.sub-text {
	font-size: 11px;
}

.all-parents-content {
	color: black;
	padding: 0rem 2.5rem;
}

.invite-parent {
	color: rgb(0, 174, 239);
}

.message-right-menu-header {
  padding: 1rem;
  border-bottom: 1px solid rgb(218, 218, 218);
  height: 45px;
}

.example-chat-view {
	padding: 7rem 15rem;
	height:53rem;
}

.example-chat-view .row {
	height: 28rem;
}

#default-content-hint {
	padding: 10px;
  border-bottom: 1px solid rgb(218, 218, 218);
  background-color: rgb(245, 245, 243);
}

.chat-input-box {
	padding: 2rem;
}

.chat-input-box .input-group .form-control,
.chat-input-box .input-group .input-group-btn .btn {
	height: 40px !important;
}

.chat-input-box .input-group .input-group-btn .send-telegram-btn,
.chat-input-box .input-group .input-group-btn .send-telegram-btn:hover {
	background-color: transparent !important;
	border: none !important;
	outline: none !important;
	box-shadow: none !important;
	color: green;
}

.chat-text-lists {
	height: 57rem;
	overflow-y: auto;
	overflow-x: hidden;
}

.chat {
	padding: 2rem;
}

.conversation-start {
    position: relative;
    width: 100%;
    margin-bottom: 27px;
    text-align: center;
}

.conversation-start span {
	font-size: 14px;
    display: inline-block;
    color: gray;
}

.conversation-start span:after {
	right: 0;
}

.conversation-start span:before {
	left: 0;
}

.conversation-start span:after,
.conversation-start span:before {
	position: absolute;
    top: 10px;
    display: inline-block;
    width: 40%;
    height: 1px;
    content: '';
    background-color: lightgray;
}

.bubble {
    font-size: 12px;
    position: relative;
    display: inline-block;
    clear: both;
    margin-bottom: 8px;
    padding: 5px 14px;
    vertical-align: top;
    border-radius: 5px;
}

.bubble:before {
	position: absolute;
    display: block;
    width: 8px;
    height: 6px;
    content: '\00a0';
    transform: rotate(29deg) skew(-35deg);
}

.bubble-you {
	float: left;
    color: white;
    background-color: rgb(0, 174, 239);
    align-self: flex-start;
    @include animation-name(slideFromLeft);
}

.bubble-you:before {
	left: -3px;
    background-color: rgb(0, 174, 239);
}

.bubble-me {
	float: right;
    color: dark;
    background-color: #eceff1;
    align-self: flex-end;
    @include animation-name(slideFromRight);
}

.bubble-me:before {
	right: -3px;
    background-color: #eceff1;
}

.bubble > span {
	padding-left: 1rem;
	font-size: 9px;
	float: right;
	padding-top: 4px;
}

.students-parent-content > p {
  padding: 1rem;
  color: black;
  margin: 0px;
  font-size: 12px;
}

</style>