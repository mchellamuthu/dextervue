<template>
	<div class="points-content">
    <a>
      <img :src="avatar">
      <div id="name-content"><span>{{name}}</span></div>
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
      
    }
  }

}
	
</script>