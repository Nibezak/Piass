 <tr>
<th colspan="2"> General Average: </th>
<th> {!! $modules->where('academicYear', $academicYear)->sum('marks') / $modules->where('academicYear', $academicYear)->count();  !!} </th>
<th> Total credits: </th>
<th> {!! $modules->where('academicYear', $academicYear)->sum('module_credits') !!} </th>
<th> {!! $modules->where('academicYear', $academicYear)->sum('module_credits') * $modules->where('academicYear', $academicYear)->sum('marks') !!} </th>
</tr>