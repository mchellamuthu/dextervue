<template>
	<div class="creation-content">
    <a>
      <img :src="avatar">
      <div id="staff-name"><span>{{name}}</span> </div>
      <div class="selection_outdoor_layer">
         <div class="selection_inner_layer"><img :class="{ selected: clicked }" src="https://teach-static.classdojo.com/61349f8482ecfd35884ab4a8781fe218.png"></div>
      </div>
    </a>
  </div>
</template>


<script>

export default {
	props:['name', 'avatar','clicked']
}
	
</script>