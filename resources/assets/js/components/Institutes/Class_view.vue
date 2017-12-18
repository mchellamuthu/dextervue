<template>
<div>
  <!-- Profile details -->
  <profilesection></profilesection>

  <!-- Class menu -->
  <classmenu selectedMenu="Classes" :classMenuBtns="classMenuBtns"></classmenu>

  <!-- class-view -->
   <div class="container">
    <div class="row selectable-btns">
      <div class="btn-group" role="group" aria-label="...">
        <router-link to="/" class="btn btn-default btn-active">Class</router-link>
        <router-link to="/groupclass" class="btn btn-default">Group</router-link>
      </div>
    </div>
		<div class="row class-view-list">
			<card v-for="classroom in classLists" :key="classroom.id" :classid="classroom.id" :title="classroom.className" :submenu="classroom.studentCount" :icon="classroom.icon" :avatar="classroom.avatar" @click="viewDetail"></card>
			<router-link to="/addnewclass"><card title="Add class" avatar="/images/class_images/addclass.png"></card></router-link>
		</div>
	</div>

	<updataEmailAddressModal></updataEmailAddressModal>

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
        { name: 'Classes', icon: '', link: '/' },
        { name: 'Staffs', icon: '', link: '/staffview' },
        { name: 'Stories', icon: '', link: '/storyview' }
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
		viewDetail (title, id) {
			this.$router.push({ path:'studentview/' + id });
		}
	}
}
	
</script>