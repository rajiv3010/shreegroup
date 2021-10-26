        <!-- quick support -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <!-- /.nav-tabs-custom -->
          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="/email/" method="post">
              {{ csrf_field() }}
                @if(Auth::guest())
                <div class="form-group">
                  <input type="text" class="form-control" name="emailto" placeholder="Email to:admin">
                </div>
                <input type="hidden" name="category_name" value="Admin Message">
               @else
               <div class="form-group">
                    <select name="category_name" class="form-control">
                      <option value=""> -- Select -- </option>
                      <option value="Undelivered Cheque">Undelivered Cheque</option>
                      <option value="Commission Cheque Query">Commission Cheque Query</option>
                      <option value="Pan Card">Pan Card</option>
                      <option value="Address Update">Address Update</option>
                      <option value="Name Correction">Name Correction</option>
                      <option value="Upgrade Package">Upgrade Package</option>
                      <option value="Account/Site Activation">Account/Site Activation</option>
                      <option value="Transfer">Transfer</option>
                      <option value="Renewal">Renewal</option>
                      <option value="Pin Request">Pin Request</option>
                      <option value="TDS/TAX">TDS/TAX</option>
                      <option value="Stop Payment">Stop Payment</option>
                      <option value="Online Transfer/NEFT">Online Transfer/NEFT</option>
                      <option value="Lost Password">Lost Password</option>
                      <option value="Register e-Mail Id/Phone">Register e-Mail Id/Phone</option>
                      <option value="Other">Other</option>
                    </select>
                </div>
               @endif
                
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea name="message" class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
            </div>
            <div class="box-footer clearfix">
              <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>
              </form>
        </section>