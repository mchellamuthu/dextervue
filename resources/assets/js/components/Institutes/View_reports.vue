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
  	</div>
  </div>
</div>
</template>

<script>
export default{
  data() {
    return {
     classMenu: [
      { name: 'Classroom', icon: 'glyphicon glyphicon-home', link: '/studentview' },
      { name: 'Stories', icon: 'glyphicon glyphicon-picture', link: '/studentgroupview' },
      { name: 'Messages', icon: 'glyphicon glyphicon-comment', link: '/viewreport' }
     ]
    }
  }
}
</script>