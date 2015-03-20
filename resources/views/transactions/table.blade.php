   @if(!$transactions->isEmpty())
                  <table class="table table-striped">
                    <tbody>
                    <tr>
                    <th>Date</th>
                    <th>Description </th>
        						<th>Student </th>
        						<th>Debit</th>
        						<th>Credit </th>
        						<th>Balance </th>
        						<th>Done by</th>
        						<th><i class="fa fa-gear"></i> </th>
                    </tr>
					@foreach($transactions as $transaction)
                    <tr>
                      <td>{{ date('d-M-Y',strtotime($transaction->date ))}}</td>
                      <td>{{ $transaction->description }}</td>
                      <td>{{ $transaction->student->names }} 
                        <a href="{{route('fees.show',$transaction->student->id)}}"
                          class="label bg-green"> <i clas="fa fa-plus"></i>Register fees</a>
                      </td>
                   	  <td>{{ $transaction->debit }}</td>
                      <td>{{ $transaction->credit }}</td>
                      <td>{{ $transaction->balance }}</td>
                      <td>{{ $transaction->doneBy->first_name }}</td>

                      <td>
                        <a href="{{route('fees.destroy',$transaction->id)}}" onClick="return confirm('Are you sure you want to delete this Transaction?')"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
					@endforeach
                  </tbody>
              </table>
               <div class="box-tools row">
                   <div class="col-md-6">
                    {!! $transactions->render() !!}
                  </div>
              </div>
    @else
We have no record of transactions at the moment
    @endif