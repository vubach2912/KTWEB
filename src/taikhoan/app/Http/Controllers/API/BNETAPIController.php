<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBNETAPIRequest;
use App\Http\Requests\API\UpdateBNETAPIRequest;
use App\Models\BNET;
use App\Repositories\BNETRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BNETController
 * @package App\Http\Controllers\API
 */

class BNETAPIController extends AppBaseController
{
    /** @var  BNETRepository */
    private $bNETRepository;

    public function __construct(BNETRepository $bNETRepo)
    {
        $this->bNETRepository = $bNETRepo;
    }

    /**
     * Display a listing of the BNET.
     * GET|HEAD /bNETS
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $bNETS = $this->bNETRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($bNETS->toArray(), 'B N E T S retrieved successfully');
    }

    /**
     * Store a newly created BNET in storage.
     * POST /bNETS
     *
     * @param CreateBNETAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBNETAPIRequest $request)
    {
        $input = $request->all();

        $bNET = $this->bNETRepository->create($input);

        return $this->sendResponse($bNET->toArray(), 'B N E T saved successfully');
    }

    /**
     * Display the specified BNET.
     * GET|HEAD /bNETS/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var BNET $bNET */
        $bNET = $this->bNETRepository->find($id);

        if (empty($bNET)) {
            return $this->sendError('B N E T not found');
        }

        return $this->sendResponse($bNET->toArray(), 'B N E T retrieved successfully');
    }

    /**
     * Update the specified BNET in storage.
     * PUT/PATCH /bNETS/{id}
     *
     * @param int $id
     * @param UpdateBNETAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBNETAPIRequest $request)
    {
        $input = $request->all();

        /** @var BNET $bNET */
        $bNET = $this->bNETRepository->find($id);

        if (empty($bNET)) {
            return $this->sendError('B N E T not found');
        }

        $bNET = $this->bNETRepository->update($input, $id);

        return $this->sendResponse($bNET->toArray(), 'BNET updated successfully');
    }

    /**
     * Remove the specified BNET from storage.
     * DELETE /bNETS/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var BNET $bNET */
        $bNET = $this->bNETRepository->find($id);

        if (empty($bNET)) {
            return $this->sendError('B N E T not found');
        }

        $bNET->delete();

        return $this->sendSuccess('B N E T deleted successfully');
    }
}
