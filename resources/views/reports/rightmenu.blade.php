<div class="box box-primary collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Available reports</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-plus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body" style="display: none;">
                  <ul class="products-list product-list-in-box">
                    <li>
                     
                        <a href="{!! route('reports.students.details') !!}" class="product-title">Students details </a>
                       
                    </li><!-- /.item -->
                    <li class="item">
                        <a href="{!! route('reports.students.payments.progression')!!}" class="product-title">Payment Progress</a>
                    </li>

                     <li class="item">
                        <a href="{!! route('reports.students.payments.paid')!!}" class="product-title">Full Paid student</a>
                    </li>
                     <li class="item">
                        <a href="{!! route('reports.students.payments.pending')!!}" class="product-title">Pending payments</a>
                    </li>
                  </ul>
          </div><!-- /.box-body -->              
 </div>