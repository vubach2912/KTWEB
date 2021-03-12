<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTransaction23APIRequest;
use App\Http\Requests\API\UpdateTransaction23APIRequest;
use App\Models\Transaction23;
use App\Repositories\Transaction23Repository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class Transaction23Controller
 * @package App\Http\Controllers\API
 */

class Transaction23APIController extends AppBaseController
{
    /** @var  Transaction23Repository */
    private $transaction23Repository;

    public function __construct(Transaction23Repository $transaction23Repo)
    {
        $this->transaction23Repository = $transaction23Repo;
    }

    /**
     * Display a listing of the Transaction23.
     * GET|HEAD /transaction23s
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $transaction23s = $this->transaction23Repository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($transaction23s->toArray(), 'Transaction23S retrieved successfully');
    }

    /**
     * Store a newly created Transaction23 in storage.
     * POST /transaction23s
     *
     * @param CreateTransaction23APIRequest $request
     *
     * @return Response
     */
    public function store(CreateTransaction23APIRequest $request)
    {
        $input = $request->all();

        $transaction23 = $this->transaction23Repository->create($input);

        return $this->sendResponse($transaction23->toArray(), 'Transaction23 saved successfully');
    }

    /**
     * Display the specified Transaction23.
     * GET|HEAD /transaction23s/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Transaction23 $transaction23 */
        $transaction23 = $this->transaction23Repository->find($id);

        if (empty($transaction23)) {
            return $this->sendError('Transaction23 not found');
        }

        return $this->sendResponse($transaction23->toArray(), 'Transaction23 retrieved successfully');
    }

    /**
     * Update the specified Transaction23 in storage.
     * PUT/PATCH /transaction23s/{id}
     *
     * @param int $id
     * @param UpdateTransaction23APIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransaction23APIRequest $request)
    {
        $input = $request->all();

        /** @var Transaction23 $transaction23 */
        $transaction23 = $this->transaction23Repository->find($id);

        if (empty($transaction23)) {
            return $this->sendError('Transaction23 not found');
        }

        $transaction23 = $this->transaction23Repository->update($input, $id);

        return $this->sendResponse($transaction23->toArray(), 'Transaction23 updated successfully');
    }

    /**
     * Remove the specified Transaction23 from storage.
     * DELETE /transaction23s/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Transaction23 $transaction23 */
        $transaction23 = $this->transaction23Repository->find($id);

        if (empty($transaction23)) {
            return $this->sendError('Transaction23 not found');
        }

        $transaction23->delete();

        return $this->sendSuccess('Transaction23 deleted successfully');
    }
}
