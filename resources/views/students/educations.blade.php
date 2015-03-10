<div class="col-md-5">
              <!-- DIRECT CHAT -->
              <div  class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-book"></i> Eductions</h3>
                  <div class="box-tools pull-right">
                  
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
             
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="box-footer">
                  
                  @include('students.educationForm')
                  
                  {!! Form::submit($button, ['class' => 'btn btn-success']) !!}

                </div><!-- /.box-footer-->
              </div><!--/.direct-chat -->
            </div>
      </div>