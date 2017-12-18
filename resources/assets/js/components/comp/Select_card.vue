<template>
	<div class="points-content">
    <a v-on:click="selectStudent(clicked)">
      <img :src="avatar">
      <div id="name-content"><span>{{studentFirstName}}</span> </div>
      <div class="selection_outdoor_layer">
         <div class="selection_inner_layer"><img :class="{ selectedContent: clicked }" src="https://teach-static.classdojo.com/61349f8482ecfd35884ab4a8781fe218.png"></div>
      </div>
    </a>
  </div>
</template>


<script>

export default {
	props:['name', 'avatar','clicked', 'index'],
  data () {
    return {
      studentFirstName: ''
    }
  },
  mounted() {
    this.getStudentFirstName();
  },
  methods: {
    getStudentFirstName() {
      this.studentFirstName = this.name.split(' ')[0];
    },
    selectStudent (clicked) {
      this.$emit('click', clicked, this.index);
    }
  }
}
	
</script>