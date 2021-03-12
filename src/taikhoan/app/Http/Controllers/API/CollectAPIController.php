<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCollectAPIRequest;
use App\Http\Requests\API\UpdateCollectAPIRequest;
use App\Models\Collect;
use App\Repositories\CollectRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CollectController
 * @package App\Http\Controllers\API
 */

class CollectAPIController extends AppBaseController
{
    /** @var  CollectRepository */
    private $collectRepository;

    public function __construct(CollectRepository $collectRepo)
    {
        $this->collectRepository = $collectRepo;
    }

    /**
     * Display a listing of the Collect.
     * GET|HEAD /collects
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $collects = $this->collectRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($collects->toArray(), 'Collects retrieved successfully');
    }

    /**
     * Store a newly created Collect in storage.
     * POST /collects
     *
     * @param CreateCollectAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCollectAPIRequest $request)
    {
        $input = $request->all();

        $collect = $this->collectRepository->create($input);

        return $this->sendResponse($collect->toArray(), 'Collect saved successfully');
    }

    /**
     * Display the specified Collect.
     * GET|HEAD /collects/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Collect $collect */
        $collect = $this->collectRepository->find($id);

        if (empty($collect)) {
            return $this->sendError('Collect not found');
        }

        return $this->sendResponse($collect->toArray(), 'Collect retrieved successfully');
    }

    /**
     * Update the specified Collect in storage.
     * PUT/PATCH /collects/{id}
     *
     * @param int $id
     * @param UpdateCollectAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCollectAPIRequest $request)
    {
        $input = $request->all();

        /** @var Collect $collect */
        $collect = $this->collectRepository->find($id);

        if (empty($collect)) {
            return $this->sendError('Collect not found');
        }

        $collect = $this->collectRepository->update($input, $id);

        return $this->sendResponse($collect->toArray(), 'Collect updated successfully');
    }

    /**
     * Remove the specified Collect from storage.
     * DELETE /collects/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Collect $collect */
        $collect = $this->collectRepository->find($id);

        if (empty($collect)) {
            return $this->sendError('Collect not found');
        }

        $collect->delete();

        return $this->sendSuccess('Collect deleted successfully');
    }
}
