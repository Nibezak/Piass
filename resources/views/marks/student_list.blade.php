<div class="box">
@if (!empty((array) $students))
  <div class="box-header progress-bar-warning">
    <div class="box-title">
      <b>Faculity </b>: {!! $markingDetails->faculity !!},
      <b>Department </b>: {!! $markingDetails->department !!},
      <b>Module </b>: {!! $markingDetails->module !!},
      <b>Academic Year</b>: {!! $markingDetails->academicYear !!}

    </div>
  </div><!-- /.box-header -->
  <div class="box-body table-responsive no-padding">
    <table class="table table-hover">
      <thead>
      <tr>
        <th>Student ID</th>
        <th>Names </th>
        <th>Faculity</th>
        <th>Department</th>
        <th>Level</th>
        <th>Academic Year</th>
        <th>Marks</th>
      </tr>
      </thead>
      <tbody>
        @each ('marks.student_item', $students, 'student', 'marks.empty_student')
      </tbody>
    </table>
  </div><!-- /.box-body -->

  {{-- Only show the button if the  session has students --}}
  <div class="row">
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <a href="{{ route('marks.complete') }}" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-lg btn-success">
       Complete marking
    </a>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <a href="{{ route('marks.cancel') }}" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-lg btn-danger">
       Cancel marking
    </a>
  </div>
  </div>
@endif

</div>
