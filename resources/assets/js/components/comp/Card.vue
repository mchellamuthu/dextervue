<template>
	<div class="class-block" data-toggle="tooltip" :title="title">
	    <div class="class-settings">
	      <span>
	        <div class="dropdown-toggle" data-toggle="dropdown">
	           <div class="class-settings-icon"><img :src="icon" icon="gear"></div>
	        </div>
	        <ul class="dropdown-menu">
	           <li>
	              <a href="" data-toggle="modal" data-target="#myInstituteModal" onclick="connectClass()">Edit class</a>
	           </li>
	           <li>
	              <a href="" data-toggle="modal" data-target="#myInstituteModal" onclick="connectParents()">Connect parents</a>
	           </li>
	           <li>
	              <a href="" data-toggle="modal" data-target="#myInstituteModal" onclick="connectStudents()">Connect students</a>
	           </li>
	           <li>
	              <a href="" data-toggle="modal" data-target="#myInstituteModal" onclick="connectTeachers()">Add co-teachers</a>
	           </li>
	           <li>
	              <a href="" data-toggle="modal" data-target="#myInstituteModal" onclick="connectParents()">Archive class</a>
	           </li>
	        </ul>
	      </span>
	    </div>
			<!-- <router-link :to="'/studentview/'+classid">	    --> 
		<a v-on:click="viewDetail(title, classid)">
	      <div class="class-image-content">
	         <img :src="avatar">
	         <div id="class-name">{{title}}</div>
	         <div id="no-of-students">{{submenu}}</div>
	      </div>
	      </a>
	  </div>
</template>


<script>

export default {
	props:['title','submenu','menus','avatar','path', 'icon','classid'],
	methods: {
		viewDetail(title, classId) {
			this.$emit('click', title, classId);
		}
	}
}
	
</script>