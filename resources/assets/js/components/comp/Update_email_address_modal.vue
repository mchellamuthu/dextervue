<template>
<div>
	<div id="updateEmailAddressModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-lg vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><strong>Account settings</strong></h4>
          </div>
          <div class="modal-body update-email-address-modal-body">
              <div class="col-md-3 update-email-address-email-left-menu">
                <ul class="list-unstyled">
                  <li v-for="list in profileMenuLists" :key="list.name" :class="{ active: list.name == activeBtn }" @click="activeBtn = list.name" data-toggle="tab" :data-target="list.tab">
                    <a>{{list.name}}</a>
                  </li>
                </ul>
              </div>
              <div class="col-md-9 update-email-address-email-right-menu">
              	<div class="tab-content">
              		<div id="editProfile" class="tab-pane fade in active">
	              		<div class="profile-image">
	              			<div class="panel panel-default">
										    <div class="panel-body">
										    	<div class="add-profile-photo" id="editable-profile-pic" :style="{ backgroundImage: 'url(' + profImage + ')' }">
							            </div>
										    </div> 
										    <div class="panel-footer">
								            <a class="btn btn-link"  @click.prevent="editPhoto">Edit photo</a>
										    </div>
											</div>
	              		</div>
              			<div class="profile-details">
              				<form class="form-horizontal">
              					<div class="form-group" :class="{error: validation.hasError('title')}">
										        <label for="title" class="control-label col-xs-3">Title</label>
										        <div class="col-xs-7">
										            <input type="text" class="form-control" id="title" v-model="title">
										            <div class="message">{{ validation.firstError('title') }}</div>
										        </div>
										    </div>
										    <div class="form-group" :class="{error: validation.hasError('firstName')}">
										        <label for="first_name" class="control-label col-xs-3">First name</label>
										        <div class="col-xs-7">
										            <input type="text" class="form-control" id="first_name" v-model="firstName">
										            <div class="message">{{ validation.firstError('firstName') }}</div>
										        </div>
										    </div>
										    <div class="form-group" :class="{error: validation.hasError('lastName')}">
										        <label for="last_name" class="control-label col-xs-3">Last name</label>
										        <div class="col-xs-7">
										            <input type="text" class="form-control" id="last_name" v-model="lastName">
										            <div class="message">{{ validation.firstError('lastName') }}</div>
										        </div>
										    </div>
										    <div class="form-group" :class="{error: validation.hasError('userEmailId')}">
										        <label for="userEmail" class="control-label col-xs-3">Email</label>
										        <div class="col-xs-7">
										            <input type="email" class="form-control" id="userEmail" v-model="userEmailId">
										            <div class="message">{{ validation.firstError('userEmailId') }}</div>
										        </div>
										    </div>
										    <div class="form-group">
										        <label for="selectRole" class="control-label col-xs-3">Role</label>
								            <select class="selectpicker col-xs-7" v-model="selectRole">
														  <option>Teacher</option>
														  <option>School Leader</option>
														  <option>Other school staff</option>
														</select>
										    </div>
										    <div class="form-group">
										    	<div class="col-xs-offset-3 col-xs-7">
							            	<button type="submit" class="btn btn-primary default-btn" id="profile-update-btn" @click="saveProfileChanges">Save changes</button>
							            </div>
										    </div>
										</form>
              			</div>
              			
              		</div>
              		<div id="changePassword" class="tab-pane fade">
              			<div class="change-password-content">
              				<form class="form-horizontal">
              					<div class="form-group" :class="{error: validation.hasError('newPassword')}">
										        <label for="new_password" class="control-label col-xs-4">New password</label>
										        <div class="col-xs-5">
										            <input type="text" class="form-control" id="new_password" v-model="newPassword">
										            <div class="message">{{ validation.firstError('newPassword') }}</div>
										        </div>
										    </div>
										    <div class="form-group" :class="{error: validation.hasError('confirmPassword')}">
										        <label for="confirm_password" class="control-label col-xs-4">Confirm password</label>
										        <div class="col-xs-5">
										            <input type="text" class="form-control" id="confirm_password" v-model="confirmPassword">
										            <div class="message">{{ validation.firstError('confirmPassword') }}</div>
										        </div>
										    </div>
										    
										    <div class="form-group">
										    	<div class="col-xs-offset-4 col-xs-5">
							            	<button type="submit" class="btn btn-primary default-btn" id="profile-update-btn" @click="savePassword">Save password</button>
							            </div>
										    </div>
										</form>
              			</div>
              		</div>
              		<div id="languageAndRegion" class="tab-pane fade">
              			<div class="languageAndRegionContent">
              				<form class="form-horizontal">
										    <div class="form-group">
										        <label for="selectRole" class="control-label col-xs-3">Language</label>
								            <select class="selectpicker col-xs-7" v-model="selectLanguage">
														  <option>English(US)</option>
														  <option>English(UK)</option>
														  <option>Tamil</option>
														</select>
										    </div>
										    <div class="form-group">
										        <label for="selectRole" class="control-label col-xs-3">Time zone</label>
								            <select class="selectpicker col-xs-7" v-model="selectTimezone">
														  <option>America/Marigot</option>
														  <option>America/Lima</option>
														  <option>America/Merida</option>
														  <option>Africa/Merida</option>
														</select>
										    </div>
										</form>
              			</div>
              		</div>
              		<div id="messaging" class="tab-pane fade">
              			<!-- <input type="checkbox" checked data-toggle="toggle" data-style="slow"> -->
              			<div class="messagingContent">
              				<div class="message-content">
              					<div class="pull-left">
              						<h5><strong>Quiet hours</strong></h5>
              					</div>
              					<div class="pull-right">
              						<input type="checkbox" checked data-toggle="toggle" id="quietHours" name="quiteHours" data-style="slow">
              					</div>
              					<div class="clearfix"></div>
              					<p>Message push notifications are muted on your mobile devices during quiet hours</p>

              					<div class="hours-duration">
              						<form class="form-horizontal">
              							<div class="form-group">
											        <label for="selectRole" class="control-label">From</label>
									            <select class="selectpicker">
															  <option>12.00 am</option>
															  <option>12.30 am</option>
															  <option>1.00 am</option>
															  <option>1.30 am</option>
															  <option>2.00 am</option>
															  <option>2.30 am</option>
															  <option>3.00 am</option>
															  <option>3.30 am</option>
															  <option>4.00 am</option>
															  <option>4.30 am</option>
															  <option>5.00 am</option>
															  <option>5.30 am</option>
															  <option>6.00 am</option>
															  <option>6.30 am</option>
															  <option>7.00 am</option>
															  <option>7.30 am</option>
															  <option>8.00 am</option>
															  <option>8.30 am</option>
															  <option>9.00 am</option>
															  <option>9.30 am</option>
															  <option>10.00 am</option>
															  <option>10.30 am</option>
															  <option>11.00 am</option>
															  <option>11.30 am</option>
															  <option>12.00 pm</option>
															  <option>12.30 pm</option>
															  <option>1.00 pm</option>
															  <option>1.30 pm</option>
															  <option>2.00 pm</option>
															  <option>2.30 pm</option>
															  <option>3.00 pm</option>
															  <option>3.30 pm</option>
															  <option>4.00 pm</option>
															  <option>4.30 pm</option>
															  <option>5.00 pm</option>
															  <option>5.30 pm</option>
															  <option>6.00 pm</option>
															  <option>6.30 pm</option>
															  <option>7.00 pm</option>
															  <option>7.30 pm</option>
															  <option>8.00 pm</option>
															  <option>8.30 pm</option>
															  <option>9.00 pm</option>
															  <option>9.30 pm</option>
															  <option>10.00 pm</option>
															  <option>10.30 pm</option>
															  <option>11.00 pm</option>
															  <option>11.30 pm</option>
															</select>
												    </div>
												    <div class="form-group">
											        <label for="selectRole" class="control-label">To</label>
									            <select class="selectpicker">
															  <option>12.00 am</option>
															  <option>12.30 am</option>
															  <option>1.00 am</option>
															  <option>1.30 am</option>
															  <option>2.00 am</option>
															  <option>2.30 am</option>
															  <option>3.00 am</option>
															  <option>3.30 am</option>
															  <option>4.00 am</option>
															  <option>4.30 am</option>
															  <option>5.00 am</option>
															  <option>5.30 am</option>
															  <option>6.00 am</option>
															  <option>6.30 am</option>
															  <option>7.00 am</option>
															  <option>7.30 am</option>
															  <option>8.00 am</option>
															  <option>8.30 am</option>
															  <option>9.00 am</option>
															  <option>9.30 am</option>
															  <option>10.00 am</option>
															  <option>10.30 am</option>
															  <option>11.00 am</option>
															  <option>11.30 am</option>
															  <option>12.00 pm</option>
															  <option>12.30 pm</option>
															  <option>1.00 pm</option>
															  <option>1.30 pm</option>
															  <option>2.00 pm</option>
															  <option>2.30 pm</option>
															  <option>3.00 pm</option>
															  <option>3.30 pm</option>
															  <option>4.00 pm</option>
															  <option>4.30 pm</option>
															  <option>5.00 pm</option>
															  <option>5.30 pm</option>
															  <option>6.00 pm</option>
															  <option>6.30 pm</option>
															  <option>7.00 pm</option>
															  <option>7.30 pm</option>
															  <option>8.00 pm</option>
															  <option>8.30 pm</option>
															  <option>9.00 pm</option>
															  <option>9.30 pm</option>
															  <option>10.00 pm</option>
															  <option>10.30 pm</option>
															  <option>11.00 pm</option>
															  <option>11.30 pm</option>
															</select>
												    </div>
              						</form>
              					</div>

              				</div>

              				<div class="message-content">
              					<div class="pull-left">
              						<h5><strong>Mute weekend notifications</strong></h5>
              					</div>
              					<div class="pull-right">
              						<input type="checkbox" checked data-toggle="toggle" id="muteWeekend" name="muteWeekend" data-style="slow">
              					</div>
              					<div class="clearfix"></div>
              					<p>Message push notifications are muted on your mobile devices Sat - Sun</p>
              				</div>

              				<div class="message-content">
	            					<div class="pull-left">
	            						<h5><strong>Download message history</strong></h5>
	            					</div>
	            					<div class="pull-right">
	            						<a href="#downloadMessageHistoryModal" data-toggle="modal" class="btn btn-default message-download-btn">Download</a>
	            					</div>
	            					<div class="clearfix"></div>
	            					<p>View and download your conversations with parents</p>
	            				</div>
	            			</div>
              		</div>
              		<div id="comments" class="tab-pane fade">
              			<div class="comments-content">
            					<div class="pull-left">
            						<h5><strong>Comments</strong></h5>
            					</div>
            					<div class="pull-right">
            						<input type="checkbox" checked data-toggle="toggle" id="commentToggle" name="commentToggle" data-style="slow">
            					</div>
            					<div class="clearfix"></div>
            					<p>Let parents and collaborating teachers comment on your Class Story posts. You can delete individual comments on the posts themselves.</p>
            				</div>
              		</div>
              		<div id="advanced" class="tab-pane fade">advanced</div>
              		<div id="privacyAndTerms" class="tab-pane fade">privacy</div>
              	</div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="downloadMessageHistoryModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="modal-title"><strong>Download message history</strong></span>
          </div>
          <div class="modal-body download-message-history-modal-body"> 
          	<ul class="list-unstyled">
          		<div><strong>Your classes</strong></div>
          		<li v-for="list in classLists" :key="list.id">
          			<a><img :src="list.avatar" width="5%"> &nbsp; {{list.className}}</a>
          		</li>
          		<div><strong>Parents</strong></div>
          		<li></li>
          	</ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="commentsModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="modal-title"><strong>Disable Class Story comments?</strong></span>
          </div>
          <div class="modal-body"> 
          	When you disable comments, parents will no longer be able to comment on your Class Story posts. Comments made on previous posts will be hidden until you re-enable comments.
          </div>
          <div class="modal-footer">
          	<a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
          	<button type="button" class="btn btn-primary default-btn" data-dismiss="modal">Ok</button>
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
var SimpleVueValidation = require('simple-vue-validator');
var Validator = SimpleVueValidation.Validator;
export default {
	props: {
    apikey: VueTypes.string.def('AxCK8Sd0ARlOOpib6Vd2Gz')
  },
	data () {
		return {
			activeBtn: 'Edit profile',
			classLists: [],
			title: '',
			firstName: '',
			lastName: '',
			userEmailId: '',
			selectRole: '',
			profImage: 'https://teach-static.classdojo.com/36e5601dbcb095383dec6c18a40401b4.png',
			newPassword: '',
			confirmPassword: '',
			submitted: false,
			selectLanguage: '',
			selectTimezone: '',
			profileMenuLists: [
				{ name: 'Edit profile', tab: '#editProfile' },
				{ name: 'Change password', tab: '#changePassword' },
				{ name: 'Language and region', tab: '#languageAndRegion' },
				{ name: 'Messaging', tab: '#messaging' },
				{ name: 'Comments', tab: '#comments' },
				{ name: 'Advanced', tab: '#advanced' },
				{ name: 'Privacy & terms', tab: '#privacyAndTerms' }
			]
		}
	},
	validators: {
    newPassword: function(value) {
      return Validator.value(value).required().minLength(6);
    },
    'confirmPassword, newPassword': function(confirmPassword, newPassword) {
      if (this.submitted || this.validation.isTouched('confirmPassword')) {
        return Validator.value(confirmPassword).required().match(newPassword);
      }
    },
    title(value) {
    	return Validator.value(value).required();
    },
    firstName(value) {
    	return Validator.value(value).required();
    },
    lastName(value) {
    	return Validator.value(value).required();
    },
    userEmailId(value) {
    	return Validator.value(value).required();
    }
  },
	mounted() {
		this.assignProfileValues();
		this.getClassLists();
	},
	methods: {
		getClassLists() {
			axios.get('/api/class')
		  .then((response) => {
		  	this.classLists = response.data.data;
		  })
		  .catch(function (error) {
		    console.log(error);
		  });
		},
		assignProfileValues() {
			this.title = "Miss";
			this.firstName = "Banu";
			this.lastName = "Rega";
			this.userEmailId = "bkannan@gmail.com";
			this.selectRole = "Teacher";
		},
		onsuccess (result) {
      this.$emit('success', result)
      this.profImage = result.filesUploaded[0].url;
    },
    onError (err) {
      console.log(err);
    },
    editPhoto () {
        const client = filestack.init(this.apikey)
        client.pick({
       }).then(response => this.onsuccess(response))
    },
    savePassword () {
    	this.submitted = true;
      this.$validate()
      .then(function(success) {
        if (success) {
          alert('Validation succeeded!');
        }
      });
    },
    saveProfileChanges () {
      this.$validate()
      .then(function(success) {
        if (success) {
          alert('Validation succeeded!');
        }
        else {
        	alert('failuere');
        }
      });
    },
    set_checked(check) {
    	console.log(check);
    }
	}
}
</script>

<style>
#editable-profile-pic {
	width: 8.6rem;
	height: 8.6rem;
	margin: 0 auto;
}

.message {
	color: red;
}

.slow .toggle-group { 
	transition: left 0.7s; 
	-webkit-transition: left 0.7s; 
}
</style>