<?php $modules      = $student->marks->sortBy('academicYear'); ?>
<?php $academicYear = $modules->count() > 0 ? $modules->first()->academicYear : 'N/A'; ?>
<?php $level        = $modules->count() > 0 ?$modules->first()->level: 'N/A'; ?>

@if ($modules->count() > 0)
<table class="table">
@include('students.marks_header',compact('academicYear','level'))
@forelse ($modules as $module)
  {{-- if we have new academic year then show new table header --}}
  @if($academicYear != $module->academicYear) 
    <?php $academicYear = $module->academicYear; ?>   
    <?php $level        = $module->level; ?>
    @include('students.marks_header',compact('academicYear','level'))
  @endif
  <tbody>
      @include('students.mark_item',compact('module'))
      {{-- If we have new academic year then show the total resuts --}}
    @if($modules->where('academicYear',$academicYear)->last()  == $module)   
      @include('students.marks_academic_summary')
    @endif
  @empty
    We have no marks to show here
  @endforelse
  </tbody>
</table>
@else
  <h3 class="progress-bar-warning" style="text-align:center">Sorry, {!! $student->names !!} does not seem to have any mark to report as of now.</h3>
@endif