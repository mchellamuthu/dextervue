<template>
<div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="timeline">
					<ul>
	          <li class="class-point"><span>Class</span></li>
	          <li class="student-point"><span>Students</span></li>
	          <li class="invite-point"><span>Invites</span></li>
	        </ul>
	        <div class="add-class-timeline">
            <div class="add-class-timeline-outer-fill-layer"></div>
            <div class="add-class-timeline-outer-point"></div>
	         </div>
				</div>

				<div class="add-new-student-panel">
					<div class="panel panel-default">
		        <div class="panel-heading add-new-student-panel-header clearfix">
		        	<div class="pull-left"><strong>Add students</strong></div>
		        	<div class="pull-right"><vue-xlsx-table @on-select-file="handleSelectedFile"><a class="btn btn-link"><i class="fa fa-file" aria-hidden="true"></i> Import student list</a></vue-xlsx-table></div>
		        </div>

		        <div class="panel-body add-student-panel-body">
		        	<div class="text-muted">Start typing to add students from School Directory</div>

		        	<div class="add-new-student-input-group">
		        		<form>
	                <div class="form-group row">
	                	<div class="error-msg">
	                		<span v-if="fullNameErrorMsg"> Please enter first name and last name.</span>
	                		<span v-if="lastNameErrorMsg"> Last name is required. Don't worry, student last names are not shown in class unless you enable this in display settings</span>
	                		<span v-if="requiredEmailId" class="col-md-5 col-md-offset-5"> Email Id is required.</span>
	                  	<span v-if="validEmailId" class="col-md-5 col-md-offset-5"> Please enter valid email id.</span>
	                	</div>
	                  <div class="col-md-5 add-student-input">
	                     <input type="text" class="form-control" :class="{invalid: isValidStudentName}" id="add_input" placeholder="First and last name" ref="first_and_last_name">
	                  </div>
	                  <div class="col-md-5 add-email-input">
	                     <input type="text" class="form-control" :class="{invalid: isValidStudentEmailId}" id="add_email_input" placeholder="Email id" ref="student_email_id">
	                  </div>
	                  <div class="col-md-2 add-student-email-input-btn">
	                  	<button class="btn btn-info" @click.prevent="addStudents">Add</button>
	                  </div>
	                </div>
	            	</form>
		        	</div>
		        </div>

		        <div v-if="noStudentsAddedYet" class="panel-body no-students-added-yet text-muted">No students added yet</div>

		        <div v-if="newlyAddedStudentLists" class="panel-body added-student-list-panel-body">
              <div class="student-count text-muted"><strong>{{studentCount}}</strong></div>
		        	<div class="student-list" v-for="student in studentLists" :key="student.studentFullName">
		        		<div class="row">
                  <div class="col-md-1">
                    <img src="images/student_images/cute0.png" class="student-circle-image" width="50%">
                  </div>    
                  <div class="col-md-10 student-name-content">
                    <div id="student-name"><strong>{{student.studentFullName}}</strong></div>
                    <div id="student-email-id" class="text-muted"><i>{{student.studentEmail}}</i></div>
                  </div>
                  <div class="col-md-1">
                    <div class="text-muted" @click="removeStudent(student)"><i class="fa fa-times" aria-hidden="true"></i></div>
                  </div>
                </div>
		        	</div>
		        </div>

		        <div class="panel-footer clearfix add-student-panel-footer">
			        <div class="pull-right">
			        		<router-link to="/addnewclass"><a href="#" class="btn btn-link">Cancel</a></router-link>
			            <router-link to="/getinvites"><button type="submit" class="btn btn-primary default-btn" :disabled="showButton">Done adding student</button></router-link>
			        </div>
				    </div>
			    </div>
				</div>

			</div>
		</div>
	</div>

  <div id="importedStudentListModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-lg vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Confirm Word import</h4>
          </div>
          <div class="modal-body import-list-modal-body">
            <p>Please confirm that the names below are formatted correctly.</p>
            <div class="row">
              <div class="col-md-3">
                <div><strong>Full Name</strong></div>
              </div>
              <div class="col-md-3">
                <div><strong>First Name</strong></div>
              </div>
              <div class="col-md-3">
                <div><strong>Last Name</strong></div>
              </div>
              <div class="col-md-3">
                <div><strong>Email Id</strong></div>
              </div>
            </div>

            <div class="row student-imported-list" v-for="list in importedStudentLists" :key="list.fullName">
              <div class="col-md-3">
                <input type="text" class="form-control" name="full_name[]" :value="list.fullName">
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control" name="first_name[]" :value="list.firstName">
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control" name="last_name[]" :value="list.lastName">
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control" name="email_id[]" :value="list.emailId">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link" data-dismiss="modal">Back</a>
            <button type="button" class="btn btn-primary default-btn" data-dismiss="modal" @click="continueToImport">Continue</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
	beforeCreate: function() {
    document.body.className = 'addnewclass';
  },
  data () {
  	return {
  		noStudentsAddedYet: true,
      newlyAddedStudentLists: false,
  		firstAndLastName: '',
  		emailId: '',
  		fullNameErrorMsg: false,
  		lastNameErrorMsg: false,
  		requiredEmailId: false,
  		validEmailId: false,
  		isValidStudentName: false,
  		isValidStudentEmailId: false,
  		showButton: true,
      studentLists: [],
      studentCount: '',
      importedStudentLists: []
  	}
  },
  methods: {
  	addStudents () {
  		var studentName = this.$refs.first_and_last_name.value;
  		var studentEmailId = this.$refs.student_email_id.value;
  		var first_name = studentName.split(' ')[0];
      var last_name = studentName.substring(first_name.length).trim();
      if(studentName == '' || first_name == '') {
      	this.isValidStudentName = true;
      	this.isValidStudentEmailId = false;
      	this.fullNameErrorMsg = true;
      	this.lastNameErrorMsg = false;
      	this.requiredEmailId = false;
      	this.validEmailId = false;
      }
      else if(last_name == '') {
      	this.isValidStudentName = true;
      	this.isValidStudentEmailId = false;
      	this.lastNameErrorMsg = true;
      	this.fullNameErrorMsg = false;
      	this.requiredEmailId = false;
      	this.validEmailId = false;
      }
      else if(studentEmailId == '') {
      	this.isValidStudentName = false;
      	this.isValidStudentEmailId = true;
      	this.lastNameErrorMsg = false;
      	this.fullNameErrorMsg = false;
      	this.requiredEmailId = true;
      	this.validEmailId = false;
      }
      else if(studentEmailId != '' && !this.isEmail(studentEmailId)) {
    		this.isValidStudentName = false;
      	this.isValidStudentEmailId = true;
      	this.lastNameErrorMsg = false;
      	this.fullNameErrorMsg = false;
      	this.requiredEmailId = false;
      	this.validEmailId = true;
    	}
    	else {
    		this.isValidStudentName = false;
      	this.isValidStudentEmailId = false;
      	this.lastNameErrorMsg = false;
      	this.fullNameErrorMsg = false;
      	this.requiredEmailId = false;
      	this.validEmailId = false;
      	this.showButton = false;
      	this.noStudentsAddedYet = false;
        this.newlyAddedStudentLists = true;

        this.studentLists.push({
          studentFullName: studentName,
          studentFirstName: first_name,
          studentLastName: last_name,
          studentEmail: studentEmailId 
        });

        this.$refs.first_and_last_name.value = '';
        this.$refs.student_email_id.value = '';
        this.studentCount = this.studentLists.length > 1 ? this.studentLists.length + ' Students' : this.studentLists.length + ' Student';
    	}
  	},
  	isEmail(email) {
	    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	    return regex.test(email);
		},
    removeStudent (stud) {
      var index = this.studentLists.indexOf(stud);
      this.studentLists.splice(index, 1);
      if(this.studentLists.length < 1) {
        this.noStudentsAddedYet = true;
        this.newlyAddedStudentLists = false;
        this.showButton = true;
      }
      else {
        this.studentCount = this.studentLists.length > 1 ? this.studentLists.length + ' Students' : this.studentLists.length + ' Student';
        this.noStudentsAddedYet = false;
        this.newlyAddedStudentLists = true;
      }
    },
    handleSelectedFile (convertedData) {
      if(convertedData && convertedData.body) {
        var studentData = convertedData.body;
        for(var i = 0; i < studentData.length; i++) {
          this.importedStudentLists.push({
            fullName: studentData[i].StudentName,
            firstName: studentData[i].FirstName,
            lastName: studentData[i].LastName,
            emailId: studentData[i].EmailId
          });
        }
        $('#importedStudentListModal').modal('show');
      }
    },
    continueToImport() {
      var full_name = $('input[name="full_name[]"]').map(function () {
          return this.value; // $(this).val()
      }).get();
      var first_name = $('input[name="first_name[]"]').map(function () {
          return this.value; // $(this).val()
      }).get();
      var last_name = $('input[name="last_name[]"]').map(function () {
          return this.value; // $(this).val()
      }).get();
      var email_id = $('input[name="email_id[]"]').map(function () {
          return this.value; // $(this).val()
      }).get();

      for(var i= 0; i < full_name.length; i++) {
        this.studentLists.push({
          studentFullName: full_name[i],
          studentFirstName: first_name[i],
          studentLastName: last_name[i],
          studentEmail: email_id[i] 
        });
      }
      this.importedStudentLists = [];
      this.noStudentsAddedYet = false;
      this.newlyAddedStudentLists = true;
      this.showButton = false;
      this.studentCount = this.studentLists.length > 1 ? this.studentLists.length + ' Students' : this.studentLists.length + ' Student';
    }
  }
}
</script>

<style scoped lang="css">
/*.add-new-student-panel {
	margin: 2rem 0rem;
}

.add-new-student-panel-header,
.add-student-panel-body,
.add-student-panel-footer {
	background-color: #fff;
}

.add-student-panel-body {
	padding: 2rem;
	border-bottom: 1px solid #ddd;
}

.added-student-list-panel-body {
	background-color: #f5f5f5;
	height: 30rem;
  padding: 0px !important;
  overflow-y: auto;
  overflow-x: hidden;
}

.add-new-student-input-group {
	padding-top: 2rem;
}

.no-students-added-yet {
  text-align: center;
  vertical-align: middle;
  background-color: #f5f5f5;
  height: 30rem;
}

.error-msg {
	color: red;
}

.invalid {
	border: 2px solid rgb(242, 92, 84);
}

.student-list,
.student-count {
	background-color: #fff;
	padding: 2rem;
  border-bottom: 1px solid rgb(218, 218, 218);
}

.student-circle-image {
  width: 4rem;
  background-color: rgb(246, 239, 239);
  border-radius: 50%;
  border: 2px solid rgba(0, 0, 0, 0.05);
}

.student-name-content {
  padding: 0rem 3rem;
}

.vue-xlsx-container .xlsx-button {
  background-color: transparent !important;
  border: none !important;
}

.student-imported-list {
  padding: 1rem 0rem;
}

.import-list-modal-body {
  background-color: #f5f5f5;
  height: 30rem;
  overflow-y: auto;
  overflow-x: hidden;
}*/


	/*check while making as a single css file*/
.timeline {
	margin-top: 3rem;
}

.timeline > ul > li {
	width: 30%;
	display: inline-block;
	text-align: center;
}

.timeline > ul > li.student-point {
  color: rgb(255, 255, 255);
  font-weight: 600;
}

.timeline > ul > li.class-point {
  color: rgb(154, 161, 178);
}

.timeline > ul > li.invite-point {
  color: rgb(154, 161, 178);
}

.add-class-timeline {
    background: rgba(0, 0, 0, 0.5); 
    border-radius: 5px; 
    height: 3px; 
    position: relative;
}

.add-class-timeline .add-class-timeline-outer-fill-layer {
    position: absolute; 
    top: 0px; 
    height: 3px; 
    background: rgb(122, 191, 11); 
    width: 50%; 
    border-radius: 5px;
}

.add-class-timeline .add-class-timeline-outer-point {
    position: absolute; 
    top: 0px; 
    left: 50%; 
    width: 8px; 
    height: 8px; 
    margin-left: -4px; 
    margin-top: -2.5px; 
    border-radius: 100%; 
    background: rgb(255, 255, 255);
}
/*check while making as a single css file*/
</style>