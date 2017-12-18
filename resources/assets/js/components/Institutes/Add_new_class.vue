<template>
<div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">

				<div class="timeline">
					<ul>
	          <li class="class-point"><span>Class</span></li>
	          <li class="student-point"><span>Students</span></li>
	          <li class="invite-point"><span>Invites</span></li>
	        </ul>
	        <div class="add-class-timeline">
            <div class="add-class-timeline-outer-fill-layer"></div>
            <div class="add-class-timeline-outer-point"></div>
	         </div>
				</div>
				

				<div class="add-new-class-panel">
					<div class="panel panel-default">
		        <div class="panel-heading add-new-class-panel-header"><strong>Add a new class</strong></div>

		        <div class="panel-body">
		        	<div class="dropdown class-icon-selection-dropdown">
                <button class="btn btn-default dropdown-toggle-button" data-toggle="dropdown" id="dropdownMenu1" aria-expanded="false">
               		<img :src="selectedClassImage"> <b class="caret"></b>
               	</button>
	              <ul class="dropdown-menu" id="dropdown-image-add-class" aria-labelledby="dropdownMenu1">
                  <ul class='list-inline' >
                    <li v-for="list in listOfImages" :key="list.avatar"><a @click="selectImage(list.avatar)"><img :src="list.avatar" width="90%"></a>
                    </li>
                </ul>
	              </ul>
	            </div>

	            <div class="input-content">
	            	<form class="form-horizontal" action="/examples/actions/confirmation.php" method="post">
					        <div class="form-group">
					            <label for="classNameInput" class="control-label col-md-3">Class name</label>
					            <div class="col-md-9">
					                <input type="text" class="form-control" id="classNameInput" placeholder="E.g., Homeroom" v-model="inputValue">
					            </div>
					        </div>
					        <div class="form-group">
				            <label for="gradeInput" class="control-label col-xs-3">Grade</label>
		                <select class="selectpicker col-xs-9" data-size="7" title="Select year" v-model="selectedGrade">
										  <option>Pre school</option>
										  <option>Kindergarten</option>
										  <option>1st grade</option>
										  <option>2nd grade</option>
										  <option>3rd grade</option>
										  <option>4th grade</option>
										  <option>5th grade</option>
										  <option>6th grade</option>
										  <option>7th grade</option>
										  <option>8th grade</option>
										  <option>9th grade</option>
										  <option>10th grade</option>
										  <option>11th grade</option>
										  <option>12th grade</option>
										  <option>Other</option>
										</select>
					        </div>
					    	</form>
	            </div>
		        </div>

		        <div class="panel-footer clearfix">
			        <div class="pull-right">
			        		<router-link to="/"><a href="#" class="btn btn-link">Cancel</a></router-link>
			            <router-link to="/addnewstudent"><button type="submit" class="btn btn-primary default-btn" :disabled="showButton">Add class</button></router-link>
			        </div>
				    </div>
			    </div>
				</div>
			</div>
		</div>
	</div>
</div>
</template>

<script>
export default {
	beforeCreate: function() {
    document.body.className = 'addnewclass';
  },
	data () {
		return {
			listOfImages: '',
			selectedClassImage: 'images/class_images/class4.png',
			inputValue: '',
			selectedGrade: ''
		}
	},
	mounted() {
		this.getClassImages();
	},
	computed: {
    showButton: function () {
      var result = (this.inputValue == '' || !this.selectedGrade)
      return result
    }
  },
	methods: {
		getClassImages () {
			axios.get('/api/classimages')
		  .then((response) => {
		  	this.listOfImages = response.data.data;
		  })
		  .catch(function (error) {
		    console.log(error);
		  });
		},
		selectImage (img) {
			this.selectedClassImage = img;
		}
	}
}
</script>

<style scoped>

/*check while making as a single css file*/
.timeline {
	margin-top: 3rem;
}

.timeline > ul > li {
	width: 30%;
	display: inline-block;
	text-align: center;
}

.timeline > ul > li.class-point {
  color: rgb(255, 255, 255);
  font-weight: 600;
}

.timeline > ul > li.student-point {
  color: rgb(154, 161, 178);
}

.timeline > ul > li.invite-point {
  color: rgb(154, 161, 178);
}

.add-class-timeline {
    background: rgba(0, 0, 0, 0.5); 
    border-radius: 5px; 
    height: 3px; 
    position: relative;
}

.add-class-timeline .add-class-timeline-outer-fill-layer {
    position: absolute; 
    top: 0px; 
    height: 3px; 
    background: rgb(122, 191, 11); 
    width: 21%; 
    border-radius: 5px;
}

.add-class-timeline .add-class-timeline-outer-point {
    position: absolute; 
    top: 0px; 
    left: 21%; 
    width: 8px; 
    height: 8px; 
    margin-left: -4px; 
    margin-top: -2.5px; 
    border-radius: 100%; 
    background: rgb(255, 255, 255);
}
/*check while making as a single css file*/
</style>