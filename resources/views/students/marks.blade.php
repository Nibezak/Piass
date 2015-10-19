@extends('layouts.default')
@section('title')
{!! $student->names !!}'s marks
@stop
@section('description')
Please find below {!! $student->names !!}'s marks as of now.
@stop
@section('content')
<div class="box">
<div class="box-header with-border" style="text-align: center">
  <h3 class="box-title"> DEGREE ACADEMIC TRANSCRIPT </h3>
</div>

<div style="display: inline-block;width: 20%;">
	
</div>
<div style="display: inline-block;width: 60%;text-align: center">
<p>PROTESTANT INSTITUTE OF ARTS AND SOCIAL SCIENCES (PIASS)<br/>
FACULTY OF EDUCATION			<br/>
P.O. Box 619 Butare - Phone: (+ 250)0252530619 Fax :( +250) 0252530298 	<br/>	
Web site: www.piass.ac.rw       Email: fathebu@yahoo.fr</p>
</div>
    @include('students.marks_transcript_header')
	@include('students.marks_report')
</div>
@stop