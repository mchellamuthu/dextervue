<template>
<div>
  <!-- Profile details -->
  <profilesection></profilesection>

  <!-- Class menu -->
  <classmenu selectedMenu="Class" :classMenuBtns="classMenuBtns"></classmenu>

  <!-- class-view -->
   <div class="container">
    <!-- <div class="row selectable-btns">
      <div class="btn-group" role="group" aria-label="...">
        <router-link to="/"><button type="button"  class="btn btn-default btn-active">Class</button></router-link>
        <router-link to="/groupclass"><button type="button" class="btn btn-default">Group</button></router-link>
      </div>
    </div> -->
		<div class="row class-view-list">
			<card v-for="classroom in classLists" :key="classroom.id" :title="classroom.className" :submenu="classroom.studentCount" :icon="classroom.icon" :avatar="classroom.avatar" @click="viewDetail"></card>
			<router-link to="/addnewclass"><card title="Add class" avatar="/images/class_images/addclass.png"></card></router-link>
		</div>
	</div>

</div>

</template>

<script>

export default {
	beforeCreate: function() {
    document.body.className = 'home';
  },
	data () {
		return {
			classLists: '',
			classMenuBtns: [
        { name: 'Class', icon: '', link: '/' },
        { name: 'Group', icon: '', link: '/groupclass' }
       ]
		}
	},
	mounted() {
		this.getClassList();
	},
	methods: {
		getClassList () {
			axios.get('/api/class')
		  .then((response) => {
		  	this.classLists = response.data.data;
		  })
		  .catch(function (error) {
		    console.log(error);
		  });
		},
		viewDetail () {
			this.$router.push({ path:'studentview' });
		}
	}
}
	
</script>