<template>
<a>
	<div class="group-image-content">
		<div class="group-image-1">

			<div :src="avatar1" class="group-image-background">
				<div class="group-image-outer-layer" :style="{ backgroundImage: 'url(' + avatar1 + ')' }"></div>
				<img :src="avatar1">
			</div>

			<div :src="avatar2" class="group-image-background">
				<div class="group-image-outer-layer" :style="{ backgroundImage: 'url(' + avatar2 + ')' }"></div>
				<img :src="avatar2">
			</div>

		</div>
		<div class="group-image-2">

			<div :src="avatar3" class="group-image-background">
				<div class="group-image-outer-layer" :style="{ backgroundImage: 'url(' + avatar3 + ')' }"></div>
				<img :src="avatar3">
			</div>

			<div :src="avatar4" class="group-image-background">
				<div class="group-image-outer-layer" :style="{ backgroundImage: 'url(' + avatar4 + ')' }"></div>
				<img :src="avatar4">
			</div>

		</div>
	</div>

	<div class="group_title"><span>{{groupName}}</span></div>
 <div class="select-outer-layer">
    <div class="select-inner-layer">{{groupPoint}}</div>
 </div>
</a>

</template>

<script>
export default {
	props: ['groupName', 'groupPoint', 'groupAvatars'],
	data () {
		return {
			avatar1: '',
			avatar2: '',
			avatar3: '',
			avatar4: ''
		}
	},
	mounted() {
		this.getGroupAvatars();
	},
	methods: {
		getGroupAvatars () {
			this.avatar1 = this.groupAvatars.avatar1;
			this.avatar2 = this.groupAvatars.avatar2;
			this.avatar3 = this.groupAvatars.avatar3;
			this.avatar4 = this.groupAvatars.avatar4;
		}
	}
}
</script>