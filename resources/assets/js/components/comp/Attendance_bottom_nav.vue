<template>
<nav class="navbar navbar-default navbar-fixed-bottom">
  <div class="container-fluid">
    <!-- Collection of nav links and other content for toggling -->
      <ul class="nav navbar-nav navbar-center student-attendance-btns">
        <li><router-link to="/studentview/attendance"><i class="fa fa-clock-o fa-lg" aria-hidden="true"></i> Attendance</router-link></li>
        <li><router-link to="/studentview/selectmultiple"><i class="fa fa-check-square-o fa-lg" aria-hidden="true"></i> Select multiple</router-link></li>
        <li><a href="#"><i class="fa fa-random fa-lg" aria-hidden="true"></i> Random</a></li>
        <li><a href="#"><i class="fa fa-address-card-o fa-lg" aria-hidden="true"></i> Digital marksheet</a></li>
      </ul>
  </div>
</nav>
</template>

<style scoped>
.student-attendance-btns > li:hover > a {
	color: rgb(0, 174, 239);
}
</style>