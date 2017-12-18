<template>
<div>
	<!-- Profile details -->
  <profilesection></profilesection>

  <!-- Class menu -->
  <classmenu selectedMenu="Staffs" :classMenuBtns="classMenuBtns"></classmenu>

  <!-- class-view -->
   <div class="container">
    <div class="row selectable-btns">
      <div class="btn-group" role="group" aria-label="...">
        <router-link to="/staffview" class="btn btn-default">Staff</router-link>
        <router-link to="/staffgroupview" class="btn btn-default btn-active">Group</router-link>
      </div>
    </div>
		<div class="row class-view-list">
			<card v-for="staff in staffGroupLists" :key="staff.id" :classid="staff.id" :title="staff.staffGroupName" :avatar="staff.avatar" @click="viewDetail"></card>
			<router-link to="/addnewclass"><card title="Add class" avatar="/images/class_images/addclass.png"></card></router-link>
		</div>
	</div>
</div>
</template>

<script>
export default {
	data() {
		return {
			staffGroupLists: [],
			classMenuBtns: [
        { name: 'Classes', icon: '', link: '/' },
        { name: 'Staffs', icon: '', link: '/staffview' },
        { name: 'Stories', icon: '', link: '/storyview' }
       ]
		}
	},
	mounted() {
		this.getStaffLists();
	},
	methods: {
		getStaffLists() {
			axios.get('/api/staffgroup')
		  .then((response) => {
		  	this.staffGroupLists = response.data.data;
		  })
		  .catch(function (error) {
		    console.log(error);
		  });
		},
    viewDetail(title, id) {
      console.log(title);
    }
	}
}
</script>