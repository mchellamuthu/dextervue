<template>
   <nav class="navbar navbar-default main_navigation" role="navigation">
       <div class="container-fluid">
          <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#class-view-navbar-collapse">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             </button>
                
          </div>
          <div class="navbar-collapse collapse" id="class-view-navbar-collapse">
             <ul class="nav navbar-nav navbar-center custom_menu">
                <li v-for="menu in classMenu" :key="menu.name" :class="{active: menu.name == activeBtn}">
                  <router-link :to="menu.link">
                      <i :class="menu.icon" aria-hidden="true"></i>
                      {{menu.name}}
                  </router-link>
                </li>
             </ul>
          </div>
       </div>
    </nav>
</template>
<script>
  export default{
    props: ['selectedMenu', 'classMenuBtns'],
    data() {
      return {
       activeBtn: this.selectedMenu,
       classMenu: this.classMenuBtns
      }
    },
    methods: {
      
    }
  }
</script>