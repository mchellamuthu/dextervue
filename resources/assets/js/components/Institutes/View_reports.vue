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
                    <router-link to="/viewreport" type="button" class="btn btn-default btn-active">Donut</router-link>
                    <router-link to="/attendance" type="button" class="btn btn-default">Attendance</router-link>
                  </div>
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
              <div class="pull-right report-period-btns">
                <a>View spreadsheet</a>
                <a>Print</a>
              </div>
            </div>

            <div class="view-report-chart-content">
              <div class="text-muted">No points! Please try another date range.</div>
              <img src="images/view_report_images/chart_image.png" width="50%">
            </div>
          </div>

          <div class="view-report-right-menu-points-list">
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
    }
  }
}
</script>

<style scoped>
/*.view-report-content {
  background-color: #fff;
  border: 1px solid rgb(218, 218, 218);
  height: 70rem;
  border-radius: 5px;
}

.view-report-left-menu,
.view-report-right-menu {
  padding: 0px;
  height: 70rem;
  overflow-y: auto;
  overflow-x: hidden;
}

.view-report-right-menu {
  background-color: rgb(245, 245, 243);
}

.view-report-left-menu {
  border-right: 1px solid rgb(218, 218, 218);
}

.view-report-left-menu > ul {
  margin: 0px;
}

.view-report-left-menu > ul > li {
  padding: 1rem;
  border-bottom: 1px solid rgb(218, 218, 218);
}

.view-report-left-menu > ul > li:hover {
  cursor: pointer;
}

.view-report-left-menu > ul > li.active {
  background-color: rgb(230, 246, 253);
}

#list-header {
  background-color: rgb(245, 245, 243);
  border-bottom: 1px solid rgb(218, 218, 218);
  padding: 5px 1.5rem 5px 1rem;
  font-size: 1.2rem;
}

#parent-account-chart,
#student-account-chart {
  width: 100% !important;
  height: 2rem !important;
  border-radius: 10rem;
}

.account-content > p {
  margin: 0px;
  color: black;
}

.student-content > p {
  padding: 1rem;
  color: black;
  margin: 0px;
}

.view-report-right-menu-header {
  padding: 2rem;
  border-bottom: 1px solid rgb(218, 218, 218);
  height: 89px;
  background-color: #fff;
}

.view-report-title {
  text-align: center;
  margin-top: 1rem;
}

.view-report-period-selector {
  padding: 1rem;
}

.report-period-btns > a {
  padding-right: 5rem;
}

.view-report-chart-content {
  height: 50rem;
  text-align: center;
}

.view-report-chart-content > img  {
  padding: 5rem 0rem;
}

.view-report-right-menu-main {
  border-bottom: 1px solid rgb(218, 218, 218);
  background-color: #fff;
}

.view-report-right-menu-points-list {
  padding: 3rem 15rem;
}

.report-points-content {
  padding: 1rem;
  border: 1px solid rgb(218, 218, 218);
  border-radius: 5px;
  background-color: #fff;
}

.report-points-content .media-left {
  position: relative;
}

.report-points-content .media-left > a > img {
  width: 6rem;
}

.report-points-content .media-body {
  padding: 1rem;
}

.report-points-outer-layer {
  position: absolute; 
  top: 0px; 
  right: 0px;
}

.report-points-inner-layer {
  display: inline-block; 
  border: 2px solid white; 
  border-radius: 50%; 
  color: white; 
  text-align: center; 
  padding: 0.2rem; 
  box-shadow: rgba(0, 0, 0, 0.15) 0px 1px 3px 0px; 
  min-width: 1.9rem; 
  font-size: 0.8rem; 
  background-color: rgb(147, 213, 83);
}

.report-points-content .dropdown {
  float: right;
}

.report-points-content .dropdown .dropdown-menu {
  left: auto;
  right: 0px;
}*/
</style>