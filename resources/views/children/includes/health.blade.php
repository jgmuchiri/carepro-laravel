<div class="content-heading">
   <h3 style="margin-top: 0px;">Health</h3>
</div>
 <ul class="nav nav-tabs tabs-bordered">
    <li class="active">
        <a href="#medications" data-toggle="tab" aria-expanded="false">
            <span class="visible-xs"><img src="{{ url('assets/img/icons/med.jpg') }}"></span>
            <span class="hidden-xs"><img src="{{ url('assets/img/icons/med.jpg') }}"> Medications</span>
        </a>
    </li>
    <li class="">
        <a href="#allergies" data-toggle="tab" aria-expanded="true">
            <span class="visible-xs"><img src="{{ url('assets/img/icons/al.png') }}"></span>
            <span class="hidden-xs"><img src="{{ url('assets/img/icons/al.png') }}"> Allergies</span>
        </a>
    </li>
    <li class="">
        <a href="#food" data-toggle="tab" aria-expanded="false">
            <span class="visible-xs"><img src="{{ url('assets/img/icons/food.png') }}"></i></span>
            <span class="hidden-xs"><img src="{{ url('assets/img/icons/food.png') }}"> Food Preferences</span>
        </a>
    </li>
    <li class="">
        <a href="#contacts" data-toggle="tab" aria-expanded="false">
            <span class="visible-xs"><img src="{{ url('assets/img/icons/contact.png') }}"></span>
            <span class="hidden-xs"><img src="{{ url('assets/img/icons/contact.png') }}"> Contacts</span>
        </a>
    </li>
</ul>
<div class="tab-content" style="margin-top:20px;">
    <div class="tab-pane active" id="medications">
        <div class="content-heading">
           <!-- START Language list-->
           <div class="pull-right">
              <div class="btn-group">
                 <button class="btn btn-success waves-effect m-b-5" data-toggle="modal" data-target="#newChild" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> @lang('New Medication')</span></button>
              </div>
           </div>
           <h3 style="margin-top:0px;margin-bottom:20px;">Medications</h3>
        </div>
        <div class="panel panel-default">
         <div class="panel-body">
            <!-- START table-responsive-->
            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Frequency</th>
                        <th>Start</th>
                        <th>Stop</th>
                        <th class="text-center">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>1</td>
                        <td>Tylenol(Acetaminophen)</td>
                        <td>1 tab(200mg) Every 6 hours</td>
                        <td>10 October 2017</td>
                        <td>15 October 2017</td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <!-- END table-responsive-->
         </div>
      </div>
    </div>
    <div class="tab-pane" id="allergies">
        <div class="content-heading">
           <!-- START Language list-->
           <div class="pull-right">
              <div class="btn-group">
                 <button class="btn btn-success waves-effect m-b-5" data-toggle="modal" data-target="#newChild" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> @lang('Add Allergy')</span></button>
              </div>
           </div>
           <h3 style="margin-top:0px;margin-bottom:20px;">Allergies</h3>
        </div>
        <div class="panel panel-default">
         <div class="panel-body">
            <!-- START table-responsive-->
            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Remarks</th>
                        <th>Treatment</th>
                        <th>Date first noted</th>
                        <th>Last Event Date</th>
                        <th class="text-center">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>1</td>
                        <td>Pea Nuts</td>
                        <td>Anaphlytic shock</td>
                        <td>Epipen Injection</td>
                        <td>10 October 2017</td>
                        <td>15 October 2017</td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <!-- END table-responsive-->
         </div>
      </div>
    </div>
    <div class="tab-pane" id="food">
        <div class="content-heading">
           <!-- START Language list-->
           <div class="pull-right">
              <div class="btn-group">
                 <button class="btn btn-success waves-effect m-b-5" data-toggle="modal" data-target="#newChild" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> @lang('Add a Preference')</span></button>
              </div>
           </div>
           <h3 style="margin-top:0px;margin-bottom:20px;">Food Preferences</h3>
        </div>
        <div class="panel panel-default">
         <div class="panel-body">
            <!-- START table-responsive-->
            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Food Name</th>
                        <th>Remarks</th>
                        <th>Preffered Time</th>
                        <th class="text-center">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>1</td>
                        <td>Cheese Sandwich</td>
                        <td>Use wheat bread</td>
                        <td>Lunch</td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <!-- END table-responsive-->
         </div>
      </div>
    </div>
    <div class="tab-pane" id="contacts">
        <div class="content-heading">
           <!-- START Language list-->
           <div class="pull-right">
              <div class="btn-group">
                 <button class="btn btn-success waves-effect m-b-5" data-toggle="modal" data-target="#newChild" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> @lang('New Contact')</span></button>
              </div>
           </div>
           <h3 style="margin-top:0px;margin-bottom:20px;">Emergency Contacts</h3>
        </div>
        <div class="panel panel-default">
         <div class="panel-body">
            <!-- START table-responsive-->
            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Relation</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th class="text-center">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>1</td>
                        <td>Joe Stick</td>
                        <td>Uncle</td>
                        <td>123-384-4444</td>
                        <td>123 State st Watertown, NY 12003</td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                     </tr>
                     <tr>
                        <td>2</td>
                        <td>Eric Mind</td>
                        <td>Brother</td>
                        <td>233-488-4444</td>
                        <td>123 State st City town, NY 2388</td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <!-- END table-responsive-->
         </div>
      </div>

      <div class="content-heading">
           <!-- START Language list-->
           <div class="pull-right">
              <div class="btn-group">
                 <button class="btn btn-success waves-effect m-b-5" data-toggle="modal" data-target="#newChild" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> @lang('New Provider')</span></button>
              </div>
           </div>
           <h3 style="margin-top:0px;margin-bottom:0px;">Health Providers</h3>
           <h6 style="margin-top:0px;margin-bottom:10px;">doctors,insurance,clinics</h6>
        </div>
        <div class="panel panel-default">
         <div class="panel-body">
            <!-- START table-responsive-->
            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Type/Role</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Remarks</th>
                        <th class="text-center">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>1</td>
                        <td>Joe Stick</td>
                        <td>Primary</td>
                        <td>123-384-4444</td>
                        <td>123 State st Watertown, NY 12003</td>
                        <td>call for any questions</td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                     </tr>
                     <tr>
                        <td>2</td>
                        <td>Eric Mind</td>
                        <td>Allergist</td>
                        <td>233-488-4444</td>
                        <td>123 State st City town, NY 2388</td>
                        <td></td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <!-- END table-responsive-->
         </div>
      </div>
    </div>
</div>
</div>