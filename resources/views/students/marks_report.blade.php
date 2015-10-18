<table class="table table-striped">
	<thead>
		<tr class="box-body table-responsive no-padding">
		<th> Module Code   </th>
		<th> Module Tittle </th>
		<th> Final Mark/20 </th>
		<th> Credits </th>
		<th> Credits/ Point </th>
		<th> Group Average </th>
		</tr>
	</thead>
  <tbody>
    @each('students.mark_item', $student->marks, 'module', 'student.empty')
  </tbody>
</table>