 <template>
   <section class="profile-background">
      <button class="btn btn-default change-btn" onclick="changeCoverPhoto()"><i class="fa fa-camera fa-lg" aria-hidden="true"></i></button>
      <div class="col-md-6 col-md-offset-3">
         <div class="col-md-2">
            <div class="add-profile-photo" :style="{ backgroundImage: 'url(' + uploadedProfImage + ')' }" @click.prevent="onClickPick">
               <div v-if="addPhotoText" class="add-photo-section">Add your photo</div>
            </div>
         </div>
         <div class="col-md-10 school-detail-content">
            <h4>Mr. Sai Krish</h4>
            <p>Teacher at Government Higher Secondary School</p>
            <div>
               <!-- <button class="btn btn-primary"> PD Resources </button> -->
               <button class="btn btn-primary"> Edit Institute </button>
            </div>
         </div>
      </div>
    </section>   
</template>

<script>
import filestack from 'filestack-js'
import VueTypes from 'vue-types'
export default {
  props: {
    apikey: VueTypes.string.def('AxCK8Sd0ARlOOpib6Vd2Gz'),
    file: VueTypes.objectOf(VueTypes.any).def(null),
    link: VueTypes.bool.def(false),
    mode: VueTypes.string.def('pick'),
    options: VueTypes.objectOf(VueTypes.any).def({}),
    security: VueTypes.objectOf(VueTypes.any).def(null),
    cname: VueTypes.string.def(null),
    profImage: VueTypes.string.def(null),
    profPic: VueTypes.bool.def(false)
  },
  data () {
    return {
      uploadedProfImage: 'https://teach-static.classdojo.com/36e5601dbcb095383dec6c18a40401b4.png',
      addPhotoText: true
    }
  },
  methods: {
    onsuccess (result) {
      this.$emit('success', result)
      console.log(result)
      this.uploadedProfImage = result.filesUploaded[0].url;
      this.addPhotoText = false;
    },
    onError (err) {
      this.$emit('error', err)
    },
    onClickPick () {
        const client = filestack.init(this.apikey, this.security, this.cname)
        client.pick({
       }).then(response => this.onsuccess(response))
    }
  }
}
</script>
 