<template>
<ul class="list-unstyled">
  <li>
    <a>
      <div class="row">
        <div class="col-md-2">
          <img :src="studentAvatar" width="40px;">
        </div>
        <div class="col-md-10 student-content">
          <p>{{studentName}}</p>
        </div>
      </div>
    </a>
  </li>
</ul>
</template>

<script>
export default {
	props: [ 'studentName', 'studentAvatar' ]
}
</script>