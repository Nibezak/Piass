<?php namespace App\Http\Controllers;

use App\Commands\CreateFaculityCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNewFaculityRequest;
use App\Http\Requests\UpdateFaculityRequest;
use App\Models\Faculity;
use Flash;
use Log;
use Redirect;

class FaculityController extends Controller {

	/**
	 *  @var App\Models\Faculity
	 */
	private $faculity;

	function __construct(Faculity $faculity) {
		parent::__construct();
		$this->faculity = $faculity;

	}

	/**
	 * Display a listing of the faculities.
	 *
	 * @return Response
	 */
	public function index() {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('faculity.view')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$faculities = $this->faculity->paginate(20);

		return view('faculities.index', compact('faculities'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('faculity.create')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$faculity = new $this->faculity;

		// First log
		Log::info($this->user->email . ' viewed Faculity form');

		return view('faculities.create', compact('faculity'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateNewFaculityRequest $request) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('faculity.create')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}
		$this->dispatch(
			new CreateFaculityCommand($request)
		);

		// First log
		Log::info($this->user->email . ' added a new Faculity with information :' . json_encode($request->all()));
		Flash::success('The ' . $request->name . ' faculity was added successfully ');

		return Redirect::route('settings.faculities.index');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('faculity.update')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$faculity = $this->faculity->findOrFail($id);

		// First log
		Log::info($this->user->email . ' viewed faculity with information' . json_encode($faculity));

		return view('faculities.edit', compact('faculity'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateFaculityRequest $request, $id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('faculity.update')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$faculity = $this->faculity->findOrFail($id);
		$oldData = $faculity;
		$faculity->update((array) $request->all());

		// First log
		Log::info($this->user->email . ' changed faculity information from ' . json_encode($oldData) . ' to ' . json_encode($faculity));

		Flash::success('Faculity ' . $request->name . ' was well updated.');

		return Redirect::route('settings.faculities.index');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('faculity.delete')) {
			Flash::error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		//Check if this faculity has department before removing it
		//If it has departments then tell user to remove those department firsts
		$faculity = $this->faculity->findOrFail($id);
		$oldData = $faculity;
		if (!$faculity->departments->isEmpty()) {
			Flash::error('The faculity you are trying to delete has departments, Please remove those departments first.');

			return redirect()->back();
		}

		if ($this->faculity->destroy($id)) {
			// First log
			Log::info($this->user->email . ' deleted faculity with information :' . json_encode($oldData));

			Flash::success(' The faculity was deleted successfully !');

			return Redirect::route('settings.faculities.index');
		}

		Flash::error(' Something went wrong while trying to delete faculity');

		return Redirect::route('settings.faculities.index');
	}

}
