<template>
<ul class="list-unstyled">
  <div id="list-header">CONNECTED</div>
  <li>
    <a>
      <div class="row">
        <div class="col-md-2">
          <img src="images/view_report_images/image1.png" width="40px;">
        </div>
        <div class="col-md-10 account-content">
          <p>Parent accounts</p>
          <canvas id="parent-account-chart"></canvas>
        </div>
      </div>
    </a>
  </li>
  <li>
    <a>
      <div class="row">
        <div class="col-md-2">
          <img src="images/view_report_images/image2.png" width="40px;">
        </div>
        <div class="col-md-10 account-content">
          <p>Student accounts</p>
          <canvas id="student-account-chart"></canvas>
        </div>
      </div>
    </a>
  </li>
  <div id="list-header" class="clearfix">
    <div class="pull-left">STUDENTS</div>
    <div class="pull-right">
      <select class="selectpicker show-tick sorting-student-name">
        <option>First name </option>
        <option>Last name</option>
        <option>% Positive</option>
        <option>Most positives</option>
        <option>Most needs work</option>
        <option>Highest combined</option>
      </select>
    </div>
  </div>
  <li class="active">
    <a>
      <div class="row">
        <div class="col-md-2">
          <img src="images/group_icon.png" width="40px;">
        </div>
        <div class="col-md-10 student-content">
          <p>Whole class</p>
        </div>
      </div>
    </a>
  </li>
</ul>
</template>