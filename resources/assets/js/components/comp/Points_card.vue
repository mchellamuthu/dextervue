<template>
	<div class="points-content">
    <a v-on:click="addPoints(name)">
      <img :src="avatar">
      <div id="name-content"><span>{{studentFirstName}}</span></div>
      <div class="select-outer-layer">
         <div class="select-inner-layer" :class="{ setPoints: givenPoints }">{{value}}</div>
      </div>
   </a>
  </div>
</template>


<script>

export default {
	props:['name', 'avatar','value', 'givenPoints'],
  data () {
    return {
      studentFirstName: ''
    }
  },
  mounted() {
    this.getStudentFirstName();
  },
  methods: {
    addPoints(name) {
      this.$emit('click', this.name);
    },
    getStudentFirstName() {
      this.studentFirstName = this.name.split(' ')[0];
    }
  }

}
	
</script>