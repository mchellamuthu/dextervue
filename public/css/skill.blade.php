    <div   class="modal" id="add-student-feedback-points" tabindex="-1" role="dialog" aria-labelledby="add-student-feedback-points" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"><strong>Give feedback to 5 students</strong></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="demo-class">
                       <div class="row">
                          <div style="text-align: center;">
                             <button class="btn" style="background-color: rgb(0, 174, 239); border-color: rgb(0, 174, 239); color: white; width: 25%;" id="positive-student-btn" onclick="positiveStudentFunction()" data-toggle="tab" href="#positiveStudentTab">Positive</button>
                             <button class="btn" style="margin-left: -9px; border-color: rgb(0, 174, 239); background-color: white; color: rgb(0, 174, 239); width: 25%;" id="needs-work-student-btn" onclick="needsStudentWorkFunction()" data-toggle="tab" href="#needStudentWorkTab">Needs work</button>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="tab-content">

                    <div id="positiveStudentTab" class="tab-pane fade in active">
                        <form id="points_form" data-url="{{route('points_update',request()->route('id')) }}">
     {{ csrf_field() }}
                       <div class="container" style="width: 100%;">
                          <div class="row" style="margin-top: 13px;">
                              <input type="hidden" name="sid" id="sid"  />
                              <input type="hidden" name="sdpoints" id="sdpoints" />


                              <?php
                              $points = \App\Skills::where('class_id',request()->route('id'))->where('user_id',Auth::User()->id)->get();

                               ?>
                               @if(count($points)>0)
                              @foreach($points as $point)
                                  <div class="col-md-3" >
                                      <div class="student-task" data-toggle="modal" data-target="#edit-skill-modal">
                                      <a class="getpoints" data-id="{{ $point->id}}">
                                     <div class="task-points">
                                       <div class="selected-btn"> {{ $point->points }} </div>
                                        </div>
                                        <img    style="width: 4rem;height: 4rem;" src="{{ asset('images/skill_icons/skill-icon10.png') }}">
                                        <div class="task-name">
                                           <p> {{ $point->skillname  }} </p>

                                        </div>
                                        </a>
                                     </div>
                             </div>

                              @endforeach
                          @else
                             {{ "No skills added !!!" }}
                          @endif
      <input type="hidden" name="skillid" id="skillid"/>


                             <div class="col-md-3" >
                                <div class="positive-tab-add-skills" data-toggle="modal" data-target="#myInstituteModal">
                                   <img src="{{ asset('https://teach-static.classdojo.com/08bc2344a8274aeaf08dd2d04ac8690c.png') }}">
                                   <div class="task-name">
                                      <p>Edit skills</p>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                       </form>
                    </div>

                    <div id="needStudentWorkTab" class="tab-pane fade">
                       <div class="container need-work-feedback-container">
                          <div class="row" >
                             <div class="col-md-3" >
                                <div class="need-work-feedback-to-add-skills" data-toggle="modal" data-target="#add-skill-modal">
                                   <img src="{{ asset('https://teach-static.classdojo.com/08bc2344a8274aeaf08dd2d04ac8690c.png') }}">
                                   <div class="task-name">
                                      <p>Add skills </p>
                                   </div>
                                </div>
                             </div>
                          </div>

                       </div>
                    </div>
                 </div>
              </div>
              <div class="modal-footer" style="padding: 0px;">
                 <div class="col-md-6" style="border-right: 1px solid rgb(218, 218, 218); height: 100%; padding: 15px; cursor: pointer;">
                    <a href="" style="text-decoration: none; color: black;">
                       <div class="text-center">
                          <img src="{{ asset('https://teach-static.classdojo.com/a6d93a4993c3d25376f74629e5ba3f4e.png') }}" width="24px" icon="photo" style="width: 16px;">
                          <span>Photo</span>
                       </div>
                    </a>
                 </div>
                 <div class="col-md-6" style="padding: 15px; cursor: pointer;">
                    <a href="" style="text-decoration: none; color: black;">
                       <div class="text-center" >
                          <img src="{{ asset('https://teach-static.classdojo.com/9c2e268c1a4d4c2ff5e4c13ecc5ee9e5.png') }}" width="24px" icon="post" style="width: 16px;">
                          <span>Add post</span>
                       </div>
                    </a>
                 </div>
              </div>
            </div>
          </div>
        </div>


        <div class="tab-pane fade" id="skill-edit-modal">
           <div class="row">
              <div class="demo-class">
                 <div class="row">
                    <div class="skill-points-btn">
                       <button class="btn" id="positive-desktop-btn" onclick="positiveDesktopFunction()" data-toggle="tab" href="#positiveDesktopTab">Positive</button>
                       <button class="btn" id="needs-desktop-work-btn" onclick="needsDesktopWorkFunction()" data-toggle="tab" href="#needsDesktopWorkTab">Needs work</button>
                    </div>
                 </div>
              </div>
           </div>
           <div class="tab-content">
              <div id="positiveDesktopTab" class="tab-pane fade in active">
                 <div class="container positive-desktop-container">
                    <div class="row">
                       <div class="col-md-3" >
                          <div class="student-task" data-toggle="modal" data-target="#edit-skill-modal">
                             <div class="task-points">
                                <div class="selected-btn">1</div>
                             </div>
                             <img src="{{ asset('images/skill_icons/skill-icon10.png') }}">
                             <div class="task-name">
                                <p>Helping others</p>
                             </div>
                          </div>
                       </div>
                       <div class="col-md-3">
                          <div class="student-task" data-toggle="modal" data-target="#edit-skill-modal">
                             <div class="task-points">
                                <div class="selected-btn">1</div>
                             </div>
                             <img src="{{ asset('images/skill_icons/skill-icon1.png') }}">
                             <div class="task-name">
                                <p>On task</p>
                             </div>
                          </div>
                       </div>
                       <div class="col-md-3">
                          <div class="student-task" data-toggle="modal" data-target="#edit-skill-modal">
                             <div class="task-points">
                                <div class="selected-btn">1</div>
                             </div>
                             <img src="{{ asset('images/skill_icons/skill-icon7.png') }}">
                             <div class="task-name">
                                <p>Participating</p>
                             </div>
                          </div>
                       </div>
                       <div class="col-md-3">
                          <div class="student-task" data-toggle="modal" data-target="#edit-skill-modal">
                             <div class="task-points">
                                <div class="selected-btn">1</div>
                             </div>
                             <img src="{{ asset('images/skill_icons/skill-icon6.png') }}">
                             <div class="task-name">
                                <p>Persistence</p>
                             </div>
                          </div>
                       </div>

                       <div class="col-md-3">
                          <div class="student-task" data-toggle="modal" data-target="#edit-skill-modal">
                             <div class="task-points">
                                <div class="selected-btn">1</div>
                             </div>
                             <img src="{{ asset('images/skill_icons/skill-icon5.png') }}">
                             <div class="task-name">
                                <p>Teamwork</p>
                             </div>
                          </div>
                       </div>
                       <div class="col-md-3">
                          <div class="student-task" data-toggle="modal" data-target="#edit-skill-modal">
                             <div class="task-points">
                                <div class="selected-btn">1</div>
                             </div>
                             <img src="{{ asset('images/skill_icons/skill-icon9.png') }}">
                             <div class="task-name">
                                <p>Working hard</p>
                             </div>
                          </div>
                       </div>
                       <div class="col-md-3">
                          <div class="positive-tab-add-skills" data-toggle="modal" data-target="#add-skill-modal">
                             <img src="{{ asset('images/skill_icons/add-skill-icon.png') }}">
                             <div class="task-name">
                                <p>Add skill</p>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>

              </div>
              <div id="needsDesktopWorkTab" class="tab-pane fade">
                 <div class="container need-work-containter">
                    <div class="row">
                       <div class="col-md-3" >
                          <div class="need-work-add-skills" data-toggle="modal" data-target="#add-skill-modal">
                             <img src="{{ asset('images/skill_icons/add-skill-icon.png') }}">
                             <div class="task-name">
                                <p>Add skill</p>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>

              <div class="row" style="width: 100%">
                 <div class="col-md-6 col-md-offset-3">
                    <div class="jumbotron parents-like-points">
                       Choose which points you'd like parents to see:
                       <div class="selecteable-radio-points">
                          <form>
                            <label class="radio-inline">
                              <input checked type="radio" name="optradio">All points
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






        <!-- My institute modal - START -->

        <div class="modal fade bs-example-modal-lg" id="myInstituteModal" tabindex="-1" role="dialog" aria-labelledby="myInstituteModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg" role="document">
              <!-- <div class="modal-content">
                 <div class="modal-header">
                    <h class="modal-title" id="myInstituteModalLabel"><strong>Refer a teacher!</strong></h>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                 </div>
                 <div class="modal-body">
                    ...
                 </div>
                 <div class="modal-footer">

                 </div>
              </div> -->
              <div class="modal-content">
                 <div class="modal-header institute-header">
                    <div style="text-align: center;"><strong>Demo class</strong> </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul id="myEditModalTab" class="nav nav-tabs col-xs-12">
                       <li class="active"><a class="connect-class" href="#class-edit-modal" data-toggle="tab">Class</a></li>
                       <li class=""><a class="student-class" href="#student-edit-profile" data-toggle="tab">Students</a></li>
                       <li class=""><a class="parent-class" href="#parent-edit-modal" data-toggle="tab">Parents</a></li>
                       <li class=""><a class="skill-class" href="#skill-edit-modals" data-toggle="tab">Skills</a></li>
                       <li class=""><a class="teacher-class" href="#teacher-edit-modal" data-toggle="tab">Teachers</a></li>
                    </ul>
                 </div>
                 <div class="modal-body institute-body">
                    <div id="myTabContent" class="tab-content">
                       <div class="tab-pane fade" id="student-edit-profile">
                          <div class="panel-body">
                             <div class="row">
                                <div class="col-md-6">

                                   <?php //include("student_account.php"); ?>

                                   <div style="text-align: center;" class="text-muted">
                                      <p>By using student accounts, you indicate that you have parent permission for students to set up and use ClassDojo accounts.</p>
                                      <a href="https://www.classdojo.com/studentstories/" target="_blank">
                                      <span>Get sample consent letter</span></a>
                                   </div>
                                </div>
                                <div class="col-md-6">
                                   <div id="add-student-list">
                                      <a href="">
                                         <li class="add-student">
                                            <img src="{{ asset('images/student_images/cute1.png') }}" width="30px" height="30px">
                                            <span>David Leonard</span>
                                         </li>
                                      </a>
                                      <a href="">
                                         <li class="add-student">
                                            <img src="{{ asset('images/student_images/cute2.png') }}" width="30px" height="30px">
                                            <span>John Rabi</span>
                                         </li>
                                      </a>
                                   </div>
                                   <a data-toggle="modal" data-target="#add-student-modal" href="https://www.classdojo.com/studentstories/" target="_blank" id="add-new-student">
                                      <img src="{{ asset('images/add_new_student_icon.png') }}" width="32px" icon="plus_blue"><span>Add students</span>
                                   </a>
                                </div>
                             </div>
                          </div>
                       </div>


                       <div class="tab-pane fade" id="skill-edit-modals">
                          <div class="row">
                             <div class="demo-class">
                                <div class="row">
                                   <div class="skill-points-btn">
                                      <button class="btn" id="positive-desktop-btn" onclick="positiveDesktopFunction()" data-toggle="tab" href="#positiveDesktopTab">Positive</button>
                                      <button class="btn" id="needs-desktop-work-btn" onclick="needsDesktopWorkFunction()" data-toggle="tab" data-target="#needsDesktopWorkTab" href="#needsDesktopWorkTab">Needs work</button>
                                   </div>
                                </div>
                             </div>
                          </div>


                          <div class="tab-content">
                             <div id="positiveDesktopTab" class="tab-pane fade in active">
                                <div class="container positive-desktop-container">
                                   <div class="row">

                                       <?php
                                       $points = \App\Skills::where('class_id',request()->route('id'))->where('user_id',Auth::User()->id)->get();

                                        ?>
                                        @if(count($points)>0)
                                       @foreach($points as $point)
                                           <div class="col-md-3" >
                                               <div class="student-task" data-toggle="modal" data-target="#edit-skill-modal">
                                               <a class="getpoints1" data-id="{{ $point->id}}">
                                              <div class="task-points">
                                                <div class="selected-btn"> {{ $point->points }} </div>
                                                 </div>
                                                 <img    style="width: 4rem;height: 4rem;" src="{{ asset('images/skill_icons/skill-icon10.png') }}">
                                                 <div class="task-name">
                                                    <p> {{ $point->skillname  }} </p>

                                                 </div>
                                                 </a>
                                              </div>
                                      </div>

                                       @endforeach
                                   @else
                                      {{ "No skills added !!!" }}
                                   @endif


                                      <div class="col-md-3">
                                         <div class="positive-tab-add-skills" data-toggle="modal" data-target="#add-skill-modal">
                                            <img src="{{ asset('images/skill_icons/add-skill-icon.png') }}">
                                            <div class="task-name">
                                               <p>Add skill</p>
                                            </div>
                                         </div>
                                      </div>

                                   </div>
                                </div>

                             </div>
                             <div id="needsDesktopWorkTab" class="tab-pane fade">
                                <div class="container need-work-containter">
                                   <div class="row">
                                      <div class="col-md-3" >
                                         <div class="need-work-add-skills" data-toggle="modal" data-target="#add-skill-modal">
                                            <img src="{{ asset('images/skill_icons/add-skill-icon.png') }}">
                                            <div class="task-name">
                                               <p>Add skill</p>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </div>

                             <div class="row" style="width: 100%">
                                <div class="col-md-6 col-md-offset-3">
                                   <div class="jumbotron parents-like-points">
                                      Choose which points you'd like parents to see:
                                      <div class="selecteable-radio-points">
                                         <form>
                                           <label class="radio-inline">
                                             <input checked type="radio" name="optradio">All points
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
                       <div class="tab-pane fade" id="teacher-edit-modal">
                          <div class="row" style="width: 100%">
                             <div class="col-md-8">
                                <strong>Add collaborators to this class</strong>
                                <div class="input-group">
                                   <input type="text" class="form-control" id="teacher-email-id" placeholder="Enter teacher's email">
                                   <span class="input-group-btn">
                                   <button class="btn btn-secondary" id="teacher-email-to-invite" type="button" disabled="">Invite</button>
                                   </span>
                                </div>
                             </div>
                             <div class="col-md-4">
                                <div class="jumbotron share-class-details">
                                   <strong>Share your class!</strong>
                                   <div class="share-class-details-content">
                                      Inviting co-teachers or specialty teachers to join your class will let them award points to students, share updates and photos with parents, and review student progress.
                                   </div>
                                   <div class="share-class-details-link"><a href="https://www.classdojo.com/studentstories/" target="_blank">
                                      <span>Learn more</span></a>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                       <div class="tab-pane fade" id="parent-edit-modal">
                          <div class="jumbotron myInstitute-parent-content">
                             <div class="container row">
                                <div class="col-md-8 text-center">
                                   <h4><strong>Invite parents to class!</strong></h4>
                                   Get support at home! Share amazing moments from class and communicate directly in real-time.
                                   <div><button class="btn btn-primary parent-invite-btn">
                                      <img src="{{ asset('images/pdf_icon.png') }}" width="20px" icon="file_pdf_white">
                                      <span>Get invites</span>
                                      </button>
                                   </div>
                                   <a href="">Get invite codes</a> or <a href="">poster in another language</a>
                                </div>
                                <div class="col-md-4">
                                   <div class="connection-chart-layer">
                                      <div class="circular-progress percent">
                                        <div class="meter">
                                            <div class="connection-percent">%</div>
                                            <div class="connection-text">Connected</div>
                                             <input type="hidden" min="0" max="100" value="37">
                                        </div>
                                      </div>
                                    </div>
                                   <div class="parents-connected">
                                      <span>0/2 parents have connected with your class.</span>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div id="student-list">
                             <div class="student-list-content">
                                <img src="{{ asset('images/student_images/cute1.png') }}" width="30px" height="30px">
                                <span>David Leonard</span>
                                <a href="">Invite parent</a>
                             </div>
                             <div class="student-list-content">
                                <img src="{{ asset('images/student_images/cute2.png') }}" width="30px" height="30px">
                                <span>John Rabi</span>
                                <a href="">Invite parent</a>
                             </div>
                          </div>
                       </div>
                       <div class="tab-pane fade in active" id="class-edit-modal">
                          <div class="container" style="width: 100%;">
                             <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                   <div class="col-md-4 col-md-offset-4">
                                      <div class="dropdown class-icon-selection-dropdown">
                                         <button class="btn btn-default dropdown-toggle-button" data-toggle="dropdown" id="dropdownMenu1"><img src="{{ asset('images/class_images/class1.png') }}" class="img-responsive"><span></span></button>
                                         <ul class="dropdown-menu" id="dropdown-image-add-class" aria-labelledby="dropdownMenu1">
                                            <li>
                                               <div class="container row" style="width: 100%;">
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class1.png') }}" ></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class2.png') }}" ></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class3.png') }}" ></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class4.png') }}" ></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class5.png') }}"></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class6.png') }}" ></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class7.png') }}" ></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class8.png') }}" ></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class9.png') }}" ></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class10.png') }}"></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class11.png') }}"></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class12.png') }}"></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class13.png') }}"></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class14.png') }}"></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class15.png') }}"></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class16.png') }}"></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class17.png') }}"></a>
                                                  </div>
                                                  <div class="col-md-3 col-xs-6 class-icons">
                                                     <a><img src="{{ asset('images/class_images/class18.png') }}"></a>
                                                  </div>
                                               </div>
                                            </li>
                                         </ul>
                                      </div>
                                   </div>

                                </div>
                             </div>
                          </div>
                          <div class="container-fluid" id="add_class_details">
                             <form>
                                <div class="form-group row">
                                   <label for="inputEmail3" class="col-sm-3 col-form-label">Class name</label>
                                   <div class="col-sm-9">
                                      <input type="email" class="form-control" id="inputEmail3" placeholder="e.g., &quot;Homeroom&quot;">
                                   </div>
                                </div>
                                <div class="form-group row">
                                   <label for="exampleSelect1" class="col-sm-3 col-form-label">Grade</label>
                                   <div class="col-sm-9">
                                      <select class="form-control" id="exampleSelect1">
                                         <option value="" selected>Select year</option>
                                         <option class="Select-option">Pre-School</option>
                                         <option class="Select-option">Kindergarten</option>
                                         <option class="Select-option">1st Grade</option>
                                         <option class="Select-option">2nd Grade</option>
                                         <option class="Select-option">3rd Grade</option>
                                         <option class="Select-option">4th Grade</option>
                                         <option class="Select-option">5th Grade</option>
                                         <option class="Select-option">6th Grade</option>
                                         <option class="Select-option">7th Grade</option>
                                         <option class="Select-option">8th Grade</option>
                                         <option class="Select-option">9th Grade</option>
                                         <option class="Select-option">10th Grade</option>
                                         <option class="Select-option">11th Grade</option>
                                         <option class="Select-option">12th Grade</option>
                                         <option class="Select-option">Other</option>
                                      </select>
                                   </div>
                                </div>
                             </form>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
              <!-- Add skill modal - START -->
              <div class="modal fade" id="add-skill-modal" tabindex="-1" role="dialog" aria-labelledby="addSkillModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                    <div class="modal-content">
                       <div class="modal-header">
                          <h class="modal-title" id="addSkillModalLabel"><strong>Add Skill</strong></h>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                       </div>
                       <div class="modal-body add-skill-modal-body">
                          <div class="container-fluid">
                             <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                   <div class="col-md-4 col-md-offset-4">
                                      <div class="dropdown add-skill-icon-selection-dropdown">
                                         <button class="btn btn-default dropdown-toggle-button" data-toggle="dropdown" id="dropdownMenu1"><img src="{{ asset('images/skill_icons/skill-icon1.png') }}" class="img-responsive"><span></span></button>
                                         <ul class="dropdown-menu" id="dropdown-image-add-skill" aria-labelledby="dropdownMenu1">
                                            <li>
                                                <div class="container row" style="width: 100%;">
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class1.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class2.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class3.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class4.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class5.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class6.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class7.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class8.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class9.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class10.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class11.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class12.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class13.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class14.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class15.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class16.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class17.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class18.png') }}"></a>
                                                   </div>
                                                </div>
                                            </li>
                                         </ul>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>

                          <div class="container-fluid" id="add_skill_details">
                              <form id="skill_form" data-url="{{route('class.addskill',request()->route('id')) }}">
           {{ csrf_field() }}

                                <div class="form-group row">
                                   <label for="edit-skill-input-name" class="col-md-4 col-form-label">Name</label>
                                   <div class="col-md-8">
                                      <input type="text" class="form-control" name="skillname" id="add-skill-input-name" value="">
                                       <input type="hidden" class="form-control" name="skillimage" id="skillimage" value="skill-icon1.png">
                                   </div>
                                </div>
                                <div class="form-group row">
                                   <label for="add-skill-point-select" class="col-md-4 col-form-label">Point weight</label>
                                   <div class="col-md-8">
                                      <select class="form-control" name="pointweight" id="add-skill-point-select">
                                         <option class="Select-option" selected="">0</option>
                                         <option class="Select-option">1</option>
                                         <option class="Select-option">2</option>
                                         <option class="Select-option">3</option>
                                         <option class="Select-option">4</option>
                                         <option class="Select-option">5</option>
                                      </select>
                                   </div>
                                </div>
                             </form>
                          </div>
                       </div>
                       <div class="modal-footer add-skill-modal-footer">
                          <div id="add-skill-save-btn">
                             <a href="">Cancel</a>
                             <button type="submit" id="add_skill" class="btn btn-primary">Save</button>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
              <!-- Add skill modal - END -->

              <!-- EDIT skill modal - START -->
            <div class="modal fade" id="edit-skill-modal" tabindex="-1" role="dialog" aria-labelledby="editSkillModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                    <div class="modal-content">
                       <div class="modal-header">
                          <h class="modal-title" id="editSkillModalLabel"><strong>Edit Skill</strong></h>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                       </div>
                       <div class="modal-body edit-skill-modal-body">
                          <div class="container-fluid">
                             <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                   <div class="col-md-4 col-md-offset-4">
                                      <div class="dropdown add-skill-icon-selection-dropdown">
                                         <button class="btn btn-default dropdown-toggle-button" data-toggle="dropdown" id="dropdownMenu1"><img src="" id="eimage" class="img-responsive"><span></span></button>
                                         <ul class="dropdown-menu" id="dropdown-image-add-skill" aria-labelledby="dropdownMenu1">
                                            <li>
                                                <div class="container row" style="width: 100%;">
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class1.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class2.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class3.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class4.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class5.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class6.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class7.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class8.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class9.png') }}" ></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class10.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class11.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class12.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class13.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class14.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class15.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class16.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class17.png') }}"></a>
                                                   </div>
                                                   <div class="col-md-3 col-xs-6 class-icons">
                                                      <a><img src="{{ asset('images/class_images/class18.png') }}"></a>
                                                   </div>
                                                </div>
                                            </li>
                                         </ul>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>

                          <div class="container-fluid" id="edit_skill_details">
                              <form id="editskill_form" data-url="{{route('class.editskill',request()->route('id')) }}">
           {{ csrf_field() }}

                                <div class="form-group row">
                                   <label for="edit-skill-input-name" class="col-md-4 col-form-label">Name</label>
                                   <div class="col-md-8">
                                      <input type="text" class="form-control" name="editskillname" id="editskillname" value="">
                                       <input type="hidden" class="form-control" name="editskillid" id="editskillid" value="">
                                       <input type="text" class="form-control" name="editskillimage" id="editskillimage" value="">
                                   </div>
                                </div>
                                <div class="form-group row">
                                   <label for="add-skill-point-select" class="col-md-4 col-form-label">Point weight</label>
                                   <div class="col-md-8">
                                      <select class="form-control" name="editpointweight" id="editpointweight">
                                         <option class="Select-option" selected="">0</option>
                                         <option class="Select-option">1</option>
                                         <option class="Select-option">2</option>
                                         <option class="Select-option">3</option>
                                         <option class="Select-option">4</option>
                                         <option class="Select-option">5</option>
                                      </select>
                                   </div>
                                </div>
                             </form>
                          </div>
                       </div>
                       <div class="modal-footer add-skill-modal-footer">
                          <div id="add-skill-save-btn">
                             <a href="">Cancel</a>
                             <button type="submit" id="edit_skill" class="btn btn-primary">Save</button>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
              <!-- EDIT skill modal - END -->

           </div>
        </div>
