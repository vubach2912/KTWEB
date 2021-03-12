<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTransaction233APIRequest;
use App\Http\Requests\API\UpdateTransaction233APIRequest;
use App\Models\Transaction233;
use App\Repositories\Transaction233Repository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class Transaction233Controller
 * @package App\Http\Controllers\API
 */

class Transaction233APIController extends AppBaseController
{
    /** @var  Transaction233Repository */
    private $transaction233Repository;

    public function __construct(Transaction233Repository $transaction233Repo)
    {
        $this->transaction233Repository = $transaction233Repo;
    }

    /**
     * Display a listing of the Transaction233.
     * GET|HEAD /transaction233s
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $transaction233s = $this->transaction233Repository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($transaction233s->toArray(), 'Transaction233S retrieved successfully');
    }

    /**
     * Store a newly created Transaction233 in storage.
     * POST /transaction233s
     *
     * @param CreateTransaction233APIRequest $request
     *
     * @return Response
     */
    public function store(CreateTransaction233APIRequest $request)
    {
        $input = $request->all();

        $transaction233 = $this->transaction233Repository->create($input);

        return $this->sendResponse($transaction233->toArray(), 'Transaction233 saved successfully');
    }

    /**
     * Display the specified Transaction233.
     * GET|HEAD /transaction233s/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Transaction233 $transaction233 */
        $transaction233 = $this->transaction233Repository->find($id);

        if (empty($transaction233)) {
            return $this->sendError('Transaction233 not found');
        }

        return $this->sendResponse($transaction233->toArray(), 'Transaction233 retrieved successfully');
    }

    /**
     * Update the specified Transaction233 in storage.
     * PUT/PATCH /transaction233s/{id}
     *
     * @param int $id
     * @param UpdateTransaction233APIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransaction233APIRequest $request)
    {
        $input = $request->all();

        /** @var Transaction233 $transaction233 */
        $transaction233 = $this->transaction233Repository->find($id);

        if (empty($transaction233)) {
            return $this->sendError('Transaction233 not found');
        }

        $transaction233 = $this->transaction233Repository->update($input, $id);

        return $this->sendResponse($transaction233->toArray(), 'Transaction233 updated successfully');
    }

    /**
     * Remove the specified Transaction233 from storage.
     * DELETE /transaction233s/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Transaction233 $transaction233 */
        $transaction233 = $this->transaction233Repository->find($id);

        if (empty($transaction233)) {
            return $this->sendError('Transaction233 not found');
        }

        $transaction233->delete();

        return $this->sendSuccess('Transaction233 deleted successfully');
    }
}
