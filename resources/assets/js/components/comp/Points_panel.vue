<template>
<div class="panel panel-default points-panel" v-on:click="editSkill(skillName, skillpoint, skillAvatar)">
  <div class="panel-body">
  	<img :src="skillAvatar" width="50%">
  	<div class="student-points-outer-layer"><div class="student-points-inner-layer">{{skillpoint}}</div></div>
  	<div id="skill-name">{{skillName}}</div>
  </div>
</div>
</template>

<script>
export default {
	props: [ 'skillAvatar', 'skillName', 'skillpoint' ],
	methods: {
		editSkill (name, point, avatar) {
			this.$emit('click', name, point, avatar);
		}
	}
}
</script>