<?php namespace App\Http\Controllers;

use Redirect,Flash;

use App\Http\Requests\CreateNewFaculityRequest;
use App\Http\Requests\UpdateFaculityRequest;

use App\Models\Faculity;
use App\Http\Controllers\Controller;
use App\Commands\CreateFaculityCommand;
use App\Commands\FaculityUpdateCommand;


use Illuminate\Http\Request;

class FaculityController extends Controller {

	/**
	 *  @var App\Models\Faculity
	 */
	private $faculity ;
	
	function __construct(Faculity $faculity )
   {
   		parent::__construct();
		$this->faculity = $faculity;

		
	}

	/**
	 * Display a listing of the faculities.
	 *
	 * @return Response
	 */
	public function index()
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('faculity.view')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}

		$faculities = $this->faculity->paginate(20);

		return view('faculities.index',compact('faculities'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('faculity.create')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}

		$faculity  = new $this->faculity; 

		return view('faculities.create',compact('faculity'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateNewFaculityRequest $request)
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('faculity.create')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}
		$this->dispatch(
			 new CreateFaculityCommand($request)
			);

		Flash::success('The '.$request->name.' faculity was added successfully ');

		return Redirect::route('settings.faculities.index');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('faculity.update')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}

		$faculity = $this->faculity->findOrFail($id);

		return view('faculities.edit',compact('faculity'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateFaculityRequest $request,$id)
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('faculity.update')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}

		$faculity = $this->faculity->findOrFail($id);

		$faculity->update((array) $request->all());

		Flash::success('Faculity '.$request->name.' was well updated.');

		return Redirect::route('settings.faculities.index');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('faculity.delete')) 
		{			
			 Flash::error(trans('Sentinel::users.noaccess'));
             
             return redirect()->back();
		}

		if($this->faculity->destroy($id))
		{
			Flash::success(' The faculity was deleted successfully !');

			return Redirect::route('settings.faculities.index');
		}

		Flash::error(' Something went wrong while trying to delete faculity');

		return  Redirect::route('settings.faculities.index');
	}

}
