<template>
<div id="removeModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog vertical-align-center">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">{{removeTitle}}</h4>
        </div>
        <div class="modal-body remove-modal-body">
          <p>{{warningMessage}}</p>
          
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
          <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="remove(removableIdx)">{{removeBtnName}}</button>
        </div>
      </div>
    </div>
  </div>
</div>

</template>

<script>
export default {
	props: [ 'removeTitle', 'warningMessage', 'removeBtnName', 'removableIdx' ],
  methods: {
    remove(idx) {
      this.$emit('click', idx);
    }
  }
}
</script>