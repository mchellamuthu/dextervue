<template>
<div>
<div :id="modalId" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="vertical-alignment-helper">
	  <div class="modal-dialog modal-lg vertical-align-center">
	    <div class="modal-content">
	      <div class="modal-header institute-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <span class="modal-title"><strong>Demo class</strong></span>
	        <ul id="myInstituteModal" class="nav nav-pills nav-justified">
		        <li class="active"><a href="#classTab" data-toggle="tab" class="class-tab">Class</a></li>
		        <li><a href="#studentsTab" data-toggle="tab" class="student-tab">Students</a></li>
		        <li><a href="#parentsTab" data-toggle="tab" class="parent-tab">Parents</a></li>
		        <li><a href="#skillsTab" data-toggle="tab" class="skill-tab">Skills</a></li>
		        <li><a href="#teachersTab" data-toggle="tab" class="teacher-tab">Teachers</a></li>
			    </ul>
	      </div>
	      <div class="modal-body institute-modal-body"> 
	      	<div class="tab-content">
	      		<div id="classTab" class="tab-pane fade in active">
	      			<div class="dropdown class-icon-selection-dropdown">
			          <button class="btn btn-default dropdown-toggle-button" data-toggle="dropdown" id="dropdownMenu1" aria-expanded="false">
			         		<img :src="selectedClassImage"> <b class="caret"></b>
			         	</button>
			          <ul class="dropdown-menu" id="dropdown-image-add-class" aria-labelledby="dropdownMenu1">
			            <ul class='list-inline' >
			              <li v-for="list in listOfImages" :key="list.avatar"><a @click="selectImage(list.avatar)"><img :src="list.avatar" width="90%"></a>
			              </li>
			          	</ul>
			          </ul>
			        </div>

			        <div class="input-content">
			        	<form class="form-horizontal" action="/examples/actions/confirmation.php" method="post">
					        <div class="form-group">
					            <label for="classNameInput" class="control-label col-md-3">Class name</label>
					            <div class="col-md-9">
					                <input type="text" class="form-control" id="classNameInput" placeholder="E.g., Homeroom" v-model="inputValue">
					            </div>
					        </div>
					        <div class="form-group">
				            <label for="gradeInput" class="control-label col-xs-3">Grade</label>
			              <select class="selectpicker col-xs-9" data-size="7" title="Select year" v-model="selectedGrade">
										  <option>Pre school</option>
										  <option>Kindergarten</option>
										  <option>1st grade</option>
										  <option>2nd grade</option>
										  <option>3rd grade</option>
										  <option>4th grade</option>
										  <option>5th grade</option>
										  <option>6th grade</option>
										  <option>7th grade</option>
										  <option>8th grade</option>
										  <option>9th grade</option>
										  <option>10th grade</option>
										  <option>11th grade</option>
										  <option>12th grade</option>
										  <option>Other</option>
										</select>
					        </div>
					        <div class="form-group class-input-save-btn">
					        	<button type="button" class="btn btn-primary default-btn">Save</button>
					        </div>
					    	</form>
			        </div>
	      		</div>

	      		<div id="studentsTab" class="tab-pane fade">
	      			<div class="row">
	      				<div class="col-md-6 student-portfolio">
	      					<div class="panel panel-default">
								    <div class="panel-body">
								    	<div id="student-portfolio-title"><strong>Set up student accounts!</strong></div>
								    	<div id="student-portfolio-content">
								    		<p>Students can customize their monsters, add work to their digital portfolio, and more! <a href="">Learn more</a></p>
								    		<p>
								    		<div>1. Pin Student Poster to your classroom wall.</div>
								    		<div>2. Students tap 'Login' from the app or classdojo.com to scan the code.</div></p>
								    	</div>
								    	<div class="student-portfolio-image">
								    		<img src="images/portfolio_image.png" width="100%">
								    	</div>
								    	<div class="student-portfolio-poster-btn">
								    		<button class="btn btn-default btn-lg"><i class="fa fa-file"></i> &nbsp; Get poster</button>
								    	</div>
								    	<p><a href=""><strong>Get invite codes</strong></a></p>
								    	<p>or <a href="">poster in another language</a></p>
								    </div>
									</div>

									<div class="panel panel-default">
								    <div class="panel-body">
								    	<strong>Students can log in at home!</strong>
								    	<div><a href=""><strong>Get invites</strong></a></div>
								    </div>
								  </div>

								  <div class="text-muted">
								  	<p>By using student accounts, you indicate that you have parent permission for students to set up and use ClassDojo accounts.</p>
								  	<a href="">Get sample consent letter</a>
								  </div>
	      				</div>
	      				<div class="col-md-6 student-view-lists">
	      					<ul class="list-unstyled">
	      						<studentviewlist v-for="list in studentLists" :key="list.id" :studentName="list.studentName" :studentAvatar="list.avatar" @click="editStudent"></studentviewlist>
	      					</ul>
	      					<a href="#addNewStudentModal" data-toggle="modal">
		      					<div class="media">
									    <div class="media-left">
						            <img src="images/add_new_student_icon.png" class="media-object" alt="Sample Image">
									    </div>
									    <div class="media-body add-new-student">
								        <p>Add student</p>
									    </div>
										</div>
									</a>
	      				</div>
	      			</div>
	      		</div>

	      		<div id="parentsTab" class="tab-pane fade">
	      			<div class="panel panel-default connect-parent-panel">
						    <div class="panel-body">
						    	<div class="row">
						    		<div class="col-md-9">
						    			<div class="connect-parent-content">
						    				<h3><strong>Invite parents to class!</strong></h3>
						    				<p>Get support at home! Share amazing moments from class and communicate directly in real-time.</p>
						    				<button class="btn btn-default btn-default-active" id="get-invite-btn"><i class="fa fa-file"></i> &nbsp;Get invites</button>
						    				<p><a href=""><strong>Get invite codes</strong></a></p>
								    		<p>or <a href="">poster in another language</a></p>
						    			</div>
						    		</div>
						    		<div class="col-md-3">
						    			<div class="connection-chart-layer">
                       <div class="circular-progress percent">
                         <div class="meter">
                         		<div class="percent-content">
                         			<div class="connection-percent">%</div>
                         			<div class="connection-text"><span>Connected</span></div>
                         		</div>
                             <input type="hidden" min="0" max="100" value="60">
                         </div>
                       </div>
                     </div>

                     <div id="connected-parents">
                     	<p>3/10 parents have connected with your class.</p>
                     </div>
						    		</div>
						    	</div>
						    </div>
							</div>

							<div class="invited-parents-list">
								<ul class="list-unstyled">
									<li v-for="list in studentLists" :key="list.id">
										<div class="media">
											<div class="row">
												<div class="col-md-10 student-name">
													<a @click="editStudent(list.studentName, list.avatar)">
														<div class="media-left">
											        <img :src="list.avatar" class="media-object" alt="Sample Image">
												    </div>
												    <div class="media-body">
											        <p>{{list.studentName}}</p>
												    </div>
											    </a>
												</div>
												<div class="col-md-2 invitation-details">
													<a href="#inviteParentModal" data-toggle="modal" @click="invite(list.studentName)">Invite parent</a>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
	      		</div>

	      		<div id="skillsTab" class="tab-pane">
	      			<div class="studentSkills">
	      				<div id="btn-content">
		          		<div class="btn-group" role="group">
						       	<button class="btn btn-default" :class="{ 'btn-active': 'Positive' == activateBtn}" @click="activateBtn = 'Positive'" data-toggle="tab" data-target="#editPositiveTab"> Positive </button>
						        <button class="btn btn-default" :class="{ 'btn-active': 'Needs work' == activateBtn}" @click="activateBtn = 'Needs work'" data-toggle="tab" data-target="#editNeedsWorkTab"> Needs work </button>
						      </div>
		          	</div>

		          	<div class="tab-content">
		          		<div id="editPositiveTab" class="tab-pane fade in active">
		          			<div class="points-content">
				          		<pointspanel v-for="skill in skills" :key="skill.id" :skillName="skill.skillName" :skillAvatar="skill.avatar" :skillpoint="skill.skillPoint" @click="editSkill"></pointspanel>
				          		<div class="panel panel-default points-panel" @click="addSkill">
											  <div class="panel-body">
			                    <img src="images/skill_icons/add-skill-icon.png" width="50%">
			                    <div id="skill-name">Add skills</div>
			                  </div>
											</div>
				          	</div>
		          		</div>
		          		<div id="editNeedsWorkTab" class="tab-pane fade">
		          			<div class="panel panel-default points-panel" @click="addSkill">
		                  <div class="panel-body">
		                    <img src="images/skill_icons/add-skill-icon.png" width="50%">
		                    <div id="skill-name">Add skills</div>
		                  </div>
		                </div>
		          		</div>

		          		<div class="points-option">
			          		<div class="panel panel-default points-option-content">
									    <div class="panel-body">
									    	Choose which points you'd like parents to see:
									    	<div class="points-option-btn">
									    		<form>
												    <label class="radio-inline">
												      <input type="radio" name="optradio" checked>All points
												    </label>
												    <label class="radio-inline">
												      <input type="radio" name="optradio">Positive points only
												    </label>
												    <label class="radio-inline">
												      <input type="radio" name="optradio">No points
												    </label>
												  </form>
									    	</div>
									    </div>
										</div>
			          	</div>
		          	</div>
	      			</div>
	      			
	      		</div>

	      		<div id="teachersTab" class="tab-pane">
	      			<div class="teacherContent">
	      				<div class="row">
	      					<div class="col-md-8">
	      						<h4><strong>Admin</strong></h4>
	      						<div class="media">
									    <div class="media-left">
								        <div class="profile-icon"></div>
									    </div>
									    <div class="media-body admin-name">
								        <p>Mr.Poct</p>
									    </div>
										</div>
	      						<div id="co-teachers-list">
	      							<ul class="list-unstyled">
	      								<li>
	      									<h4><strong>Co-teachers(1)</strong></h4>
	      									<div class="media">
												    <div class="media-left">
											        <div class="profile-icon"></div>
												    </div>
												    <div class="media-body admin-name">
											        <p>
											        	<span>Miss carter</span>
	      												<span><a href="#removeModal" data-toggle="modal" @click="leaveClass" class="leave-class">Leave class</a></span>
	      											</p>
												    </div>
													</div>
	      								</li>
	      							</ul>
	      						</div>
	      					</div>
	      					<div class="col-md-4">
	      						<div class="panel panel-default shared-class-content">
									    <div class="panel-body">
									    	<strong>This is a Shared class!</strong>
									    	<p>You can do many of the same things as the admin of the class — award points, view reports, message parents, and more! You can't, however, add or remove other teachers from the class.</p>
									    	<a href="">Learn more</a>
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
</div>

	<div id="editStudentModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-lg vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><strong>Edit student</strong></h4>
          </div>
          <div class="modal-body edit-student-modal-body">
          	<div class="row">
          		<div class="col-md-3">
          			<div class="student-image-content" data-toggle="modal" data-target="#editStudentImageModal">
          				<img :src="studentAvatarEdit">
          			</div>
          			<div class="student-view-report" data-toggle="modal" data-target="#studentReportModal">
          				View reports
          			</div>
          		</div>
          		<div class="col-md-9">
          			<div class="student-details-content">
          				<form>
								    <div class="form-group col-md-6">
								        <label for="studentFirstName" class="text-muted">First name</label>
								        <input type="text" class="form-control" id="studentFirstName" :value="studentFirstNameEdit">
								    </div>
								    <div class="form-group col-md-6">
								        <label for="studentLastName" class="text-muted">Last name</label>
								        <input type="text" class="form-control" id="studentLastName" :value="studentLastNameEdit">
								    </div>
								    <div class="form-group col-md-12">
								        <label for="inClasses" class="text-muted">In classes</label>
								        <input type="text" class="form-control" id="inClasses" value="Demo class" readonly="readonly">
								    </div>
								    <div class="form-group col-md-12">
								        <label for="inClasses" class="text-muted">Parents ({{parentCount}})</label>
								        <div id="parents-invite-content">
								        	<ul class="list-unstyled" v-for="parent in parentLists" :key=" parent.name">
								        		<li>
															<div class="row">
																<div class="col-md-1">
																	<div class="profile-icon"></div>
																</div>
																<div class="col-md-10">
																	<p class="text-muted">{{parent.emailId}} (Invite sent)</p>
																</div>
																<div class="col-md-1">
																	<!-- <span class="duration">{{parent.duration}}</span> -->
													        	<span class="disconnect-parent">
													        		<div class="dropdown">
																		    <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
																		    <ul class="dropdown-menu">
																	        <li><a href="#">Disconnect parent</a></li>
																		    </ul>
																			</div>
													        	</span>
																</div>
															</div>
								        		</li>
								        	</ul>
								        	<a href="#inviteParentModal" data-toggle="modal" class="connect-another-parent">
						      					<div class="media">
													    <div class="media-left">
										            <img src="images/add_new_student_icon.png" class="media-object" alt="Sample Image">
													    </div>
													    <div class="media-body add-new-student">
												        <p>Connect another parent</p>
													    </div>
														</div>
													</a>
								        </div>
								    </div>
									</form>
          			</div>
          		</div>
          	</div>
          </div>
          <div class="modal-footer edit-student-modal-footer clearfix">
          	<div class="pull-left">
          		<a href="#" class="btn btn-link" data-dismiss="modal" id="remove-student" @click="removeStudentClass">Remove student from class</a>
          	</div>
          	<div class="pull-right">
          		<a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
            	<button type="button" class="btn btn-primary default-btn">Save</button>
          	</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="inviteParentModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="modal-title"><strong>Invite {{studentNameEdit}} 's parents</strong></span>
          </div>
          <div class="modal-body invite-parent-modal-body"> 
          	<form>
          		<div class="input-group">
                <input type="email" ref="parent_email_input" class="form-control" placeholder="Enter parent email">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default btn-default-active" @click.prevent="inviteParent">Invite</button>
                </span>

              </div>
              <div v-if="validationMessage">Please provide a valid email address</div>
          	</form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="editStudentImageModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="modal-title"><strong>Override {{studentNameEdit}} 's monster</strong></span>
          </div>
          <div class="modal-body edit-student-image-modal-body"> 
          	<div class="row">
          		<div class="col-md-4">
          			<div class="student-image-content">
          				<img :src="studentAvatarEdit">
          			</div>
          		</div>
          		<div class="col-md-8">
          			<div class="student-image-option">
          				<select class="selectpicker override-monster">
									  <option>InstDojo monsters</option>
									  <option>Critters</option>
									  <option>Create new set</option>
									</select>
          			</div>

          			<div class="student-image-lists">
          				<ul id="dropdown-student-image">
				            <ul class='list-inline'>
				              <li v-for="list in listOfStudentImages" :key="list.avatar"><a @click="selectImage(list.avatar)"><img :src="list.avatar" width="50%"></a>
				              </li>
				          	</ul>
				          </ul>
          			</div>
          		</div>
          	</div>
          </div>
          <div class="modal-footer edit-student-image-modal-footer">
        		<a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
          	<button type="button" class="btn btn-primary default-btn" data-dismiss="modal">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="studentReportModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-lg vertical-align-center">
        <div class="modal-content">
          <div class="modal-header student-report-modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="modal-title"><strong>Reports</strong></span>
          </div>
          <div class="modal-body student-report-modal-body"> 
          	<div class="view-report-content" id="student-report-content">
			        <div class="col-md-3 view-report-left-menu" id="student-report-left-menu">
			          <div id="list-header">CLASSES</div>
			          <ul class="list-unstyled">
								  <li class="active">
								    <a>
								      <div class="row">
								        <div class="col-md-2">
								          <img src="images/group_icon.png" width="40px;">
								        </div>
								        <div class="col-md-10 student-content">
								          <p>All classes</p>
								        </div>
								      </div>
								    </a>
								  </li>
								  <li >
								    <a>
								      <div class="row">
								        <div class="col-md-2">
								          <img src="images/class_images/class1.png" width="40px;">
								        </div>
								        <div class="col-md-10 student-content">
								          <p>Demo class</p>
								        </div>
								      </div>
								    </a>
								  </li>
								</ul>
			        </div>
			        <div class="col-md-9 student-report-right-menu">
			          <div class="view-report-right-menu-header">
			            <div class="row">
			              <div class="col-md-2">
			                <img src="images/group_icon.png" width="40px;">
			              </div>
			              <div class="col-md-4 view-report-title">
			                <strong>All classes</strong>
			              </div>
			            </div>
			          </div>

			          <div class="view-report-right-menu-main">
			            <div class="view-report-period-selector clearfix">
			              <div class="pull-left">
			                <select class="selectpicker show-tick report-period">
			                  <option>Today </option>
			                  <option>Yesterday</option>
			                  <option>This week</option>
			                  <option>Last week</option>
			                  <option>This month</option>
			                  <option>Last month</option>
			                  <option>All time</option>
			                  <option>Custom date range</option>
			                </select>
			              </div>
			            </div>

			            <div class="view-report-chart-content">
			              <div class="text-muted">No points! Please try another date range.</div>
			              <img src="images/view_report_images/chart_image.png" width="50%">
			            </div>
			          </div>

			          <div class="student-report-right-menu-points-list">
			            <ul class="list-unstyled">
			              <li>
			                <div class="media report-points-content">
			                  <div class="dropdown">
			                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-angle-down fa-lg" aria-hidden="true"></i></a>
			                    <ul class="dropdown-menu">
			                      <li><a href="#">Remove</a></li>
			                    </ul>
			                  </div>
			                  <div class="media-left">
			                    <a href="#">
			                      <img src="images/view_report_images/report_point.png" class="media-object" alt="Sample Image">
			                      <div class="report-points-outer-layer"><div class="report-points-inner-layer">1</div></div>
			                    </a>
			                  </div>
			                  <div class="media-body">
			                    <strong class="media-heading">+1 to Rayn Mathew for Helping others</strong>
			                    <div class="text-muted">Dec 7, 2017 by Dixi Carter to whole class</div>
			                  </div>
			                </div>
			              </li>
			              <li>
			                <div class="media report-points-content">
			                  <div class="dropdown">
			                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-angle-down fa-lg" aria-hidden="true"></i></a>
			                    <ul class="dropdown-menu">
			                      <li><a href="#">Remove</a></li>
			                    </ul>
			                  </div>
			                  <div class="media-left">
			                    <a href="#">
			                      <img src="images/view_report_images/report_point.png" class="media-object" alt="Sample Image">
			                      <div class="report-points-outer-layer"><div class="report-points-inner-layer">3</div></div>
			                    </a>
			                  </div>
			                  <div class="media-body">
			                    <strong class="media-heading">+1 to Rayn Mathew for Helping others</strong>
			                    <div class="text-muted">Dec 7, 2017 by Dixi Carter to whole class</div>
			                  </div>
			                </div>
			              </li>
			            </ul>
			            
			          </div>
			        </div>
			      </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="addNewStudentModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
        <div class="modal-content">
          <div class="modal-header student-report-modal-header clearfix">
            <div class="pull-left"><strong>Add students</strong></div>
	        	<div class="pull-right"><vue-xlsx-table @on-select-file="handleSelectedFile"><a class="btn btn-link"><i class="fa fa-file" aria-hidden="true"></i> Import student list</a></vue-xlsx-table></div>
          </div>
          <div class="modal-body add-new-student-name-section">
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
          <div v-if="noStudentsAddedYet" class="modal-body no-students-added-yet text-muted">No students added yet</div>

	        <div v-if="newlyAddedStudentLists" class="modal-body added-student-list-modal-body">
            <div class="student-count text-muted"><strong>{{studentCount}}</strong></div>
	        	<div class="student-list" v-for="student in newAddedStudentLists" :key="student.studentFullName">
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
	        		<a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
	            <button type="submit" class="btn btn-primary default-btn" data-dismiss="modal" :disabled="showButton" @click="saveNewlyAddedStudents">Save</button>
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

  <addandeditskillmodal modalId="skillModal" :skillTitle="skillTitle" :listOfSkillImages="listOfSkillImages" :selectedSkillImage="selectedSkillImage" :inputSkillValue="inputSkillValue" :selectedPoint="selectedPoint"></addandeditskillmodal>

  <removemodal :removeTitle="removeTitle" :warningMessage="warningMessage" :removeBtnName="removeBtnName"></removemodal>

</div>
</template>

<script>
import swal from 'sweetalert2'
export default {
	props: [ 'studentLists', 'modalId' ],
	data () {
		return {
			listOfImages: '',
			listOfStudentImages: '',
			listOfSkillImages: '',
			selectedClassImage: 'images/class_images/class4.png',
			inputValue: 'Demo class',
			selectedGrade: '',
			studentNameEdit: '',
			studentFirstNameEdit: '',
			studentLastNameEdit: '',
			studentAvatarEdit: '',
			validationMessage: false,
			monsterValue: '',
			skills: '',
			activateBtn: 'Positive',
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
      studentCount: '',
      newAddedStudentLists: [],
      importedStudentLists: [],
			parentLists: [
				{ name: 'Hari K', emailId: 'hariharan@gmail.com', inviteAccepted: 'yes', duration: '50d' }
			],
			selectedSkillImage: 'images/skill_icons/skill-icon1.png',
			inputSkillValue: '',
			selectedPoint: '',
			skillTitle: '',
			removeTitle: '',
			warningMessage: '',
			removeBtnName: ''
		}
	},
	computed: {
		parentCount() {
			return this.parentLists.length;
		},
		monsterCreateBtn() {
			var result = this.monsterValue == '';
      return result
		}
	},
	mounted() {
		this.getClassImages();
		this.getStudentImages();
		this.getSkills();
		this.getSkillImages();
	},
	methods: {
		getClassImages () {
			axios.get('/api/classimages')
		  .then((response) => {
		  	this.listOfImages = response.data.data;
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
		selectImage (img) {
			this.selectedClassImage = img;
			this.studentAvatarEdit = img;
		},
		editStudent (studentName, studentAvatar) {
			$('#editStudentModal').modal('show');
			this.studentNameEdit = studentName;
			var first_name = studentName.split(' ')[0];
      var last_name = studentName.substring(first_name.length).trim();
			this.studentFirstNameEdit = first_name;
			this.studentLastNameEdit = last_name;
			this.studentAvatarEdit = studentAvatar;
		},
		isEmail(email) {
	    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	    return regex.test(email);
		},
		inviteParent () {
			if(this.isEmail(this.$refs.parent_email_input.value)) {
				this.parentLists.push({
					emailId: this.$refs.parent_email_input.value
				});
				this.$refs.parent_email_input.value = '';
				$('#inviteParentModal').modal('hide');
			}
			else {
				this.validationMessage = true;
			}
		},
		getStudentImages () {
			axios.get('/api/studentImages')
		  .then((response) => {
		  	this.listOfStudentImages = response.data.data;
		  })
		  .catch(function (error) {
		    console.log(error);
		  });
		},
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


        this.newAddedStudentLists.push({
          studentFullName: studentName,
          studentFirstName: first_name,
          studentLastName: last_name,
          studentEmail: studentEmailId 
        });

        this.$refs.first_and_last_name.value = '';
        this.$refs.student_email_id.value = '';
        this.studentCount = this.newAddedStudentLists.length > 1 ? this.newAddedStudentLists.length + ' Students' : this.newAddedStudentLists.length + ' Student';
    	}
  	},
    removeStudent (stud) {
      var index = this.newAddedStudentLists.indexOf(stud);
      this.newAddedStudentLists.splice(index, 1);
      if(this.newAddedStudentLists.length < 1) {
        this.noStudentsAddedYet = true;
        this.newlyAddedStudentLists = false;
        this.showButton = true;
      }
      else {
        this.studentCount = this.newAddedStudentLists.length > 1 ? this.newAddedStudentLists.length + ' Students' : this.newAddedStudentLists.length + ' Student';
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
        this.newAddedStudentLists.push({
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
      this.studentCount = this.newAddedStudentLists.length > 1 ? this.newAddedStudentLists.length + ' Students' : this.newAddedStudentLists.length + ' Student';
    },
    saveNewlyAddedStudents () {
    	for(var j = 0; j < this.newAddedStudentLists.length; j++) {
    		this.studentLists.push({
    			studentName: this.newAddedStudentLists[j].studentFullName,
    			avatar: "images/student_images/cute11.png",
    			studentPoint: 0
    		});
    	}
    	this.newAddedStudentLists = [];
    	this.newlyAddedStudentLists = false;
    	this.noStudentsAddedYet = true;
    	this.showButton = true;
    },
    addSkill () {
    	$('#skillModal').modal('show');
    	this.skillTitle = "Add skill";
    },
    editSkill (skillName, skillPoint, skillAvatar) {
    	this.inputSkillValue = skillName;
    	this.selectedSkillImage = skillAvatar;
    	this.selectedPoint = skillPoint;
    	this.skillTitle = "Edit skill";
    	$('#skillModal').modal('show');
    },
    getSkillImages () {
			axios.get('/api/skillImages')
		  .then((response) => {
		  	this.listOfSkillImages = response.data.data;
		  })
		  .catch(function (error) {
		    console.log(error);
		  });
		},
		invite (studentName) {
			this.studentNameEdit = studentName;
		},
		removeStudentClass () {
			$('#removeModal').modal('show');
			this.removeTitle = "Remove student";
			this.warningMessage = "Do you want to remove this student from your class? This will remove all information and feedback for this student. It can't be undone.";
			this.removeBtnName = "Remove student";
		},
		leaveClass () {
			this.removeTitle = "Leave class";
			this.warningMessage = "Are you sure?";
			this.removeBtnName = "Leave class";
		}
	}
}
</script>

<style>


</style>

