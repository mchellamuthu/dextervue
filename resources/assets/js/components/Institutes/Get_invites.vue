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

				<div class="get-invite-student-panel">
					<div class="panel panel-default">
		        <div class="panel-heading get-invite-panel-header clearfix">
		        	<div><strong>Get student and parent invites</strong></div>
		        </div>

		        <div class="panel-body get-invite-panel-body">
		        	<div class="row invite-content">
		        		<img src="images/invite_image.png">
		        		<h5><strong>Invite students and parents!</strong></h5>
		        		<p>Students take ownership of their work and parents support learning at home. We've created invites for you</p>
		        	</div>

		        	
		        </div>

		        <div class="panel-footer clearfix get-invite-panel-footer">
			        <div class="pull-right">
			        		<router-link to="/addnewstudent"><a href="#" class="btn btn-link">Back</a></router-link>
			            <router-link to="/doneinvites"><button type="submit" class="btn btn-primary default-btn">Get invites</button></router-link>
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

  	}
  }
}
</script>

<style scoped>

.get-invite-student-panel {
	margin: 2rem 0rem;
}

.get-invite-panel-header,
.get-invite-panel-body {
	padding: 2rem;
}

.get-invite-panel-header,
.get-invite-panel-footer {
	background-color: #fff;
}

.invite-content {
	text-align: center;
}

/*check while making as a single css file*/
.timeline {
	margin-top: 3rem;
}

.timeline > ul > li {
	width: 30%;
	display: inline-block;
	text-align: center;
}

.timeline > ul > li.invite-point {
  color: rgb(255, 255, 255);
  font-weight: 600;
}

.timeline > ul > li.student-point {
  color: rgb(154, 161, 178);
}

.timeline > ul > li.class-point {
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
    width: 78%; 
    border-radius: 5px;
}

.add-class-timeline .add-class-timeline-outer-point {
    position: absolute; 
    top: 0px; 
    left: 78%; 
    width: 8px; 
    height: 8px; 
    margin-left: -4px; 
    margin-top: -2.5px; 
    border-radius: 100%; 
    background: rgb(255, 255, 255);
}
/*check while making as a single css file*/
</style>