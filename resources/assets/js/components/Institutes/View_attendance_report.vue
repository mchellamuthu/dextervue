<template>
<div>
	<!-- Class menu -->
  <classmenu selectedMenu="Classroom" :classMenuBtns="classMenu"></classmenu>

  <div class="container">
  	<div class="row">
  		<div class="selectable-btns">
	      <div class="btn-group" role="group">
	       	 <router-link to="/studentview" class="btn btn-default "> Students </router-link>
          <router-link to="/studentgroupview" class="btn btn-default "> Groups </router-link>
          <router-link to="/viewreport" class="btn btn-default btn-active"> View reports </router-link>
	      </div>
	    </div>

      <div class="view-report-content">
        <div class="col-md-3 view-report-left-menu">
          <reportleftmenu></reportleftmenu>
          <leftmenustudentlist v-for="student in studentLists" :key="student.id" :studentName="student.studentName" :studentAvatar="student.avatar"></leftmenustudentlist>
        </div>
        <div class="col-md-9 view-report-right-menu">
          <div class="view-report-right-menu-header">
            <div class="row">
              <div class="col-md-2">
                <img src="images/group_icon.png" width="40px;">
              </div>
              <div class="col-md-4 view-report-title">
                <strong>Whole class</strong>
              </div>
              <div class="col-md-6">
                <div class="btn-group">
                    <router-link to="/viewreport" type="button" class="btn btn-default">Donut</router-link>
                    <router-link to="/attendance" type="button" class="btn btn-default btn-active">Attendance</router-link>
                  </div>
              </div>
            </div>
          </div>

          <div class="view-attendance-report-content">
          	<div class="view-attendance-period clearfix">
          		<div class="pull-left">
          			Attendance for the week of December 3, 2017 - December 9, 2017
          		</div>
          		<div class="pull-right">
          			 <div class="btn-group period-select-btn-group">
          			 		<div class="btn-group">
						        	<button type="button" class="btn btn-default" @click="prevWeek">&laquo;</button>
						        </div>
								    <div class="btn-group">
								    	<select class="selectpicker week-selector">
											  <option>This week</option>
											  <option>Last week</option>
											</select>
										</div>
										<div class="btn-group">
						        	<button type="button" class="btn btn-default" @click="nextWeek">&raquo;</button>
						        </div>
						    </div>
          		</div>
          	</div>

          	<div class="attendance-block-content">
              <div class="attendance-block">
                <div id="date" class="text-muted">Oct 28, 2017</div>
                <div id="week-name" style="">Monday</div>
                <div class="panel panel-default attendance-content">
                  <div class="panel-heading attendance-content-header active"><span class="glyphicon glyphicon-ok"></span></div>
                  <div class="panel-body attendance-content-body">No attendance</div>
                </div>
              </div>

              <div class="attendance-block">
                <div id="date" class="text-muted">Oct 29, 2017</div>
                <div id="week-name" style="">Tuesday</div>
                <div class="panel panel-default attendance-content">
                  <div class="panel-heading attendance-content-header"><span class="glyphicon glyphicon-ok"></span></div>
                  <div class="panel-body attendance-content-body">No attendance</div>
                </div>
              </div>

              <div class="attendance-block">
                <div id="date" class="text-muted">Oct 30, 2017</div>
                <div id="week-name" style="">Wednesday</div>
                <div class="panel panel-default attendance-content">
                  <div class="panel-heading attendance-content-header"><span class="glyphicon glyphicon-ok"></span></div>
                  <div class="panel-body attendance-content-body">No attendance</div>
                </div>
              </div>

              <div class="attendance-block">
                <div id="date" class="text-muted">Nov 01, 2017</div>
                <div id="week-name" style="">Thursday</div>
                <div class="panel panel-default attendance-content">
                  <div class="panel-heading attendance-content-header"><span class="glyphicon glyphicon-ok"></span></div>
                  <div class="panel-body attendance-content-body">No attendance</div>
                </div>
              </div>

              <div class="attendance-block">
                <div id="date" class="text-muted">Nov 02, 2017</div>
                <div id="week-name" style="">Friday</div>
                <div class="panel panel-default attendance-content">
                  <div class="panel-heading attendance-content-header"><span class="glyphicon glyphicon-ok"></span></div>
                  <div class="panel-body attendance-content-body">No attendance</div>
                </div>
              </div>

              <div class="attendance-block">
                <div id="date" class="text-muted">Nov 03, 2017</div>
                <div id="week-name" style="">Saturday</div>
                <div class="panel panel-default attendance-content">
                  <div class="panel-heading attendance-content-header"><span class="glyphicon glyphicon-ok"></span></div>
                  <div class="panel-body attendance-content-body">No attendance</div>
                </div>
              </div>

              <div class="attendance-block">
                <div id="date" class="text-muted">Nov 04, 2017</div>
                <div id="week-name" style="">Sunday</div>
                <div class="panel panel-default attendance-content">
                  <div class="panel-heading attendance-content-header"><span class="glyphicon glyphicon-ok"></span></div>
                  <div class="panel-body attendance-content-body">No attendance</div>
                </div>
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
export default{
  data() {
    return {
      studentLists: '',
      classMenu: [
        { name: 'Classroom', icon: 'glyphicon glyphicon-home', link: '/studentview' },
        { name: 'Stories', icon: 'glyphicon glyphicon-picture', link: '/stories' },
        { name: 'Messages', icon: 'glyphicon glyphicon-comment', link: '/message' }
      ]
    }
  },
  mounted() {
    this.getStudentList();
  },
  methods: {
    getStudentList () {
      axios.get('/api/students')
      .then((response) => {
        this.studentLists = response.data.data;
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    prevWeek () {
    	var selectedWeek = $('.week-selector .filter-option').text();
    	var currentSelected = (selectedWeek.indexOf("ago") !== -1) ? selectedWeek.split(' ')[0] : null;
    	var weeksList = this.getWeeks(currentSelected, "prev");
    	for(var j = 0; j < weeksList.length; j++) {
    		if(selectedWeek == weeksList[j]) {
    			var value = weeksList[j + 1];
    			$('.week-selector .filter-option').text(value);
    			break;
    		}
    	}
    },
    nextWeek () {

    },
    getWeeks (selectedWeekValue, btn) {
    	var value = selectedWeekValue != null ? (parseInt(selectedWeekValue) + 5) : 5;
    	var weeks = [];
    	weeks[0] = "This week";
    	weeks[1] = "Last week";
    	for(var i = 2; i < value; i++) {
    		weeks.push(i + " weeks ago");
    	}
    	return weeks;
    }
  }
}
</script>

<style>
.view-attendance-report-content {
	padding: 1rem;
}

.period-select-btn-group .btn {
	width: auto;
	border-color: rgb(0, 174, 239);
	color: rgb(0, 174, 239);
}

.attendance-block-content {
	margin: 5rem 1rem;
}
.attendance-content:hover {
  background-color: #ddd;
}

.attendance-block {
  width: 9rem; 
  display: inline-block; 
  margin: 1rem;
}

.attendance-content {
  border-radius: 5px; 
  cursor: pointer;
}

.attendance-content-header {
  text-align: center; 
  color: white !important; 
  font-size: 3rem;
}

.attendance-content-header.active {
  background-color: rgb(122, 191, 11);
}

.attendance-content-body {
  height: 14rem; 
  text-align: center;
  padding: 15px 0px;
}
</style>