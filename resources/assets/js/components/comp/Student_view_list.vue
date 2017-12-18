<template>
<li>
	<a v-on:click="editStudent(studentName, studentAvatar)">
		<div class="media">
	    <div class="media-left">
        <img :src="studentAvatar" class="media-object" alt="Sample Image">
	    </div>
	    <div class="media-body">
        <p>{{studentName}}</p>
	    </div>
		</div>
	</a>
</li>
</template>

<script>
export default {
	props: [ 'studentName', 'studentAvatar' ],
	methods: {
		editStudent(name, avatar) {
			this.$emit('click', name, avatar);
		}
	}
}
</script>