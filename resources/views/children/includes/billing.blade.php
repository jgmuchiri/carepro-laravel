<div class="content-heading">
   <!-- START Language list-->
   <div class="pull-right">
      <div class="btn-group">
         <button class="btn btn-success waves-effect m-b-5" data-toggle="modal" data-target="#newChild" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> @lang('New Invoice')</span></button>
      </div>
   </div>
   <h3 style="margin-top: 0px;">Billing</h3>
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
         <div class="col-lg-5"></div>
         <div class="col-lg-3">
            <div class="input-group pull-right">
               <select class="input-sm form-control">
                  <option value="0">Bulk action</option>
                  <option value="1">Email</option>
                  <option value="2">Download</option>
                  <option value="3">Pay</option>
                  <option value="3">Delete</option>
               </select>
               <span class="input-group-btn">
                  <button class="btn btn-sm btn-default">Apply</button>
               </span>
            </div>
         </div>
      </div>
   </div>
   <!-- START table-responsive-->
   <div class="table-responsive">
      <table class="table table-bordered table-hover" >
         <thead>
            <tr>
                <th data-check-all width="3">
                  <div class="checkbox c-checkbox" data-toggle="tooltip" data-title="Check All">
                     <label>
                        <input type="checkbox">
                        <span class="fa fa-check"></span>
                     </label>
                  </div>
                </th>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
         </thead>
         <tbody>
            <tr>
                <td>
                  <div class="checkbox c-checkbox">
                     <label>
                        <input type="checkbox">
                        <span class="fa fa-check"></span>
                     </label>
                  </div>
                </td>
                <td>10-Oct-17</td>
                <td>DayCare fees</td>
                <td>$500.00</td>
                <td>Due</td>
                <td class="text-center">
                    <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                    <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
            <tr>
                <td>
                  <div class="checkbox c-checkbox">
                     <label>
                        <input type="checkbox">
                        <span class="fa fa-check"></span>
                     </label>
                  </div>
                </td>
                <td>9-Oct-17</td>
                <td>Supplies</td>
                <td>$45.00</td>
                <td>Paid</td>
                <td class="text-center">
                    <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                    <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
            <tr>
                <td>
                  <div class="checkbox c-checkbox">
                     <label>
                        <input type="checkbox">
                        <span class="fa fa-check"></span>
                     </label>
                  </div>
                </td>
                <td>5-Oct-17</td>
                <td>Late Pick Up fees</td>
                <td>$60.00</td>
                <td>Paid</td>
                <td class="text-center">
                    <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                    <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>

         </tbody>
      </table>
   </div>
</div>