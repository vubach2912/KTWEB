<?php

namespace App\Http\Controllers\Diablo2;

use App\Http\Requests\CreateBNETRequest;
use App\Http\Requests\UpdateBNETRequest;
use App\Repositories\BNETRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BNETController extends AppBaseController
{
    /** @var  BNETRepository */
    private $bNETRepository;

    public function __construct(BNETRepository $bNETRepo)
    {
        $this->bNETRepository = $bNETRepo;
    }

    /**
     * Display a listing of the BNET.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $bNETS = $this->bNETRepository->paginate(10);
        return view('bnets.index')->with('bNETS', $bNETS);
    }

    /**
     * Show the form for creating a new BNET.
     *
     * @return Response
     */
    public function create()
    {
        return view('bnets.create');
    }

    /**
     * Store a newly created BNET in storage.
     *
     * @param CreateBNETRequest $request
     *
     * @return Response
     */
    public function store(CreateBNETRequest $request)
    {
        $input = $request->all();

        $bNET = $this->bNETRepository->create($input);

        Flash::success('B N E T saved successfully.');

        return redirect(route('bnets.index'));
    }

    /**
     * Display the specified BNET.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bNET = $this->bNETRepository->find($id);

        if (empty($bNET)) {
            Flash::error('B N E T not found');
            return redirect(route('bnets.index'));
        }

        return view('bnets.show')->with('bNET', $bNET);
    }

    /**
     * Show the form for editing the specified BNET.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bNET = $this->bNETRepository->find($id,'uid');
        if (empty($bNET)) {
            Flash::error('B N E T not found');
            return redirect(route('bnets.index'));
        }
        return view('bnets.edit')->with('bNET', $bNET);
    }

    /**
     * Update the specified BNET in storage.
     *
     * @param int $id
     * @param UpdateBNETRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBNETRequest $request)
    {
        $bNET = $this->bNETRepository->find($id, 'uid');

        if (empty($bNET)) {
            Flash::error('B N E T not found');
            return redirect(route('bnets.index'));
        }
        $bNET = $this->bNETRepository->update($request->all(), $id);
        Flash::success('B N E T updated successfully.');
        return redirect(route('bnets.index'));
    }

    /**
     * Remove the specified BNET from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bNET = $this->bNETRepository->find($id);

        if (empty($bNET)) {
            Flash::error('B N E T not found');
            return redirect(route('bnets.index'));
        }

        $this->bNETRepository->delete($id);

        Flash::success('B N E T deleted successfully.');
        return redirect(route('bnets.index'));
    }
}
