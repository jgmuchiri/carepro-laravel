<div id="notes-index">
	<div class="content-heading">
	   <!-- START Language list-->
	   <div class="pull-right">
	   	  <div class="row">
	   	  	<div class="col-md-6">
	   	  		<div class="btn-group">
			         <button class="btn btn-success waves-effect m-b-5" id=""><i class="fa fa-plus m-r-5 btn-fa"></i><span> @lang('New Note')</span></button>
			     </div>
	   	  	</div>
	   	  	<div class="col-md-6">
	   	  		<div class="btn-group">
			         <button class="btn btn-danger waves-effect m-b-5" id="btn-incident"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> @lang('Incident report')</span></button>
			     </div>
	   	  	</div>
	   	  </div>
	   </div>
	   <h3 style="margin-top: 0px;">Notes</h3>
	</div>
	<hr>
	<div class="panel panel-default">
	   <div class="panel-heading">
	       <div class="row">
			 <div class="col-lg-4">
			    <div class="input-group">
			       <input class="input-sm form-control" type="text" placeholder="Search">
			       <span class="input-group-btn">
			          <button class="btn btn-sm btn-default" type="button">Search</button>
			       </span>
			    </div>
			 </div>
			 <div class="col-lg-8"></div>
		   </div>
	   </div>
	   <div class="panel-body">
			<div class="media-box-body">
			  <h4 class="media-box-heading general">10 October 2017 | General</h4>
			  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus suscipit eros elit, eget molestie turpis ultricies et. Nullam non ornare ligula, a venenatis urna. Vestibulum sodales egestas massa, quis laoreet arcu. Integer euismod enim sit amet metus iaculis tincidunt. Suspendisse sit amet mi velit. Integer eu commodo nunc. Integer vitae tortor nisl. Ut porttitor arcu a mauris auctor, in consectetur dolor hendrerit.Cras massa diam, vehicula at ipsum eget, lobortis malesuada mauris. In hac habitasse platea dictumst. Aenean consectetur posuere consequat. Curabitur in purus sed ex blandit tincidunt at nec eros. Curabitur ligula sapien, convallis eu elementum quis, auctor ac urna. Aliquam commodo fermentum tristique. Quisque placerat ornare sodales. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sodales viverra tellus, sollicitudin pharetra purus efficitur eu. Etiam ullamcorper quam nec ante tempus sagittis. Nullam hendrerit fermentum massa. Aenean sed ultrices purus. In porttitor vulputate eros sit amet ornare.</p>
			</div>
			<div class="media-box-body">
			  <h4 class="media-box-heading incident">9 October 2017 | Incedent</h4>
			  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus suscipit eros elit, eget molestie turpis ultricies et. Nullam non ornare ligula, a venenatis urna. Vestibulum sodales egestas massa, quis laoreet arcu. Integer euismod enim sit amet metus iaculis tincidunt. Suspendisse sit amet mi velit. Integer eu commodo nunc. Integer vitae tortor nisl. Ut porttitor arcu a mauris auctor, in consectetur dolor hendrerit.Cras massa diam, vehicula at ipsum eget, lobortis malesuada mauris. In hac habitasse platea dictumst. Aenean consectetur posuere consequat. Curabitur in purus sed ex blandit tincidunt at nec eros. Curabitur ligula sapien, convallis eu elementum quis, auctor ac urna. Aliquam commodo fermentum tristique. Quisque placerat ornare sodales. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sodales viverra tellus, sollicitudin pharetra purus efficitur eu. Etiam ullamcorper quam nec ante tempus sagittis. Nullam hendrerit fermentum massa. Aenean sed ultrices purus. In porttitor vulputate eros sit amet ornare.</p>
			</div>
		</div>
	</div>
</div>
<div style="display: none;" id="incident-create">
  <div class="content-heading">
     <!-- START Language list-->
     <div class="pull-right">
        <div class="btn-group">
           <button class="btn btn-success waves-effect m-b-5" id="incident-back-btn"> <i class="fa fa-chevron-left m-r-5 btn-fa"></i> <span> @lang('Back')</span></button>
        </div>
     </div>
     <h3 style="margin-top: 0px;">New Incident Report</h3>
  </div>
  <hr>
  <div class="panel panel-default">
     <div class="panel-heading" style="color: #515253;">
         <div class="row">
           <div class="col-lg-4">
              <h4>Date: 10 October 2017</h4>
              <h4>Time: 02:00 PM</h4>
           </div>
           <div class="col-lg-8"></div>
        </div>
     </div>
     <div class="panel-body">
        <div class="row">
            <div class="form-group col-md-6">
                <input id="title" class="form-control input-lg" placeholder="Title" name="title" type="text">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <input id="location" class="form-control input-lg" placeholder="Location" name="location" type="text">
            </div>
            <div class="form-group col-md-6">
                <input id="description" class="form-control input-lg" placeholder="Incident type(fall/bruise/sickness/etc)" name="description" type="text">
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <textarea name="text" rows="3" class="form-control input-lg" placeholder="Description"></textarea>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <textarea name="text" rows="3" class="form-control input-lg" placeholder="Actions Taken"></textarea>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <textarea name="text" rows="3" class="form-control input-lg" placeholder="Winesses(include their contact number)"></textarea>
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <textarea name="text" rows="3" class="form-control input-lg" placeholder="Remarks"></textarea>
              </div>
          </div>
        </div>
        <div class="row">
        	<div class="col-md-12">
                <input style="display:none;" id="upload" name="photo" type="file"/>
                <div class="panel widget child-upload">
                   <div class="panel-body text-center">
                      <div class="child-btn-fa">
                         <a href="" id="upload_link" title=""><i class="fa fa-upload"></i></a>
                      </div>
                      <p>
                         <span>Upload Incident Images</span>
                      </p>
                   </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
          <div class="col-md-6">
            <button class="btn btn-danger waves-effect m-b-5"><span> Cancel</span></button>
          </div>
          <div class="col-md-6">
            <button class="btn btn-success waves-effect m-b-5"><span> Save</span></button>
          </div>
        </div>
     </div>
  </div>  
</div>


