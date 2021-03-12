<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTradeHistoryRequest;
use App\Http\Requests\UpdateTradeHistoryRequest;
use App\Repositories\TradeHistoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TradeHistoryController extends AppBaseController
{
    /** @var  Trade HistoryRepository */
    private $tradeHistoryRepository;

    public function __construct(TradeHistoryRepository $tradeHistoryRepo)
    {
        $this->tradeHistoryRepository = $tradeHistoryRepo;
    }

    /**
     * Display a listing of the Trade History.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tradeHistories = $this->tradeHistoryRepository->paginate(10);

        return view('trade_histories.index')
            ->with('tradeHistories', $tradeHistories);
    }

    /**
     * Show the form for creating a new Trade History.
     *
     * @return Response
     */
    public function create()
    {
        return view('trade_histories.create');
    }

    /**
     * Store a newly created Trade History in storage.
     *
     * @param CreateTrade HistoryRequest $request
     *
     * @return Response
     */
    public function store(CreateTradeHistoryRequest $request)
    {
        $input = $request->all();

        $tradeHistory = $this->tradeHistoryRepository->create($input);

        Flash::success('Trade History saved successfully.');

        return redirect(route('tradeHistories.index'));
    }

    /**
     * Display the specified Trade History.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tradeHistory = $this->tradeHistoryRepository->find($id);

        if (empty($tradeHistory)) {
            Flash::error('Trade History not found');

            return redirect(route('tradeHistories.index'));
        }

        return view('trade_histories.show')->with('tradeHistory', $tradeHistory);
    }

    /**
     * Show the form for editing the specified Trade History.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tradeHistory = $this->tradeHistoryRepository->find($id);

        if (empty($tradeHistory)) {
            Flash::error('Trade History not found');

            return redirect(route('tradeHistories.index'));
        }

        return view('trade_histories.edit')->with('tradeHistory', $tradeHistory);
    }

    /**
     * Update the specified TradeHistory in storage.
     *
     * @param int $id
     * @param UpdateTradeHistoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTradeHistoryRequest $request)
    {
        $tradeHistory = $this->tradeHistoryRepository->find($id);

        if (empty($tradeHistory)) {
            Flash::error('Trade History not found');

            return redirect(route('tradeHistories.index'));
        }

        $tradeHistory = $this->tradeHistoryRepository->update($request->all(), $id);

        Flash::success('Trade History updated successfully.');

        return redirect(route('tradeHistories.index'));
    }

    /**
     * Remove the specified Trade History from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tradeHistory = $this->tradeHistoryRepository->find($id);

        if (empty($tradeHistory)) {
            Flash::error('Trade History not found');

            return redirect(route('tradeHistories.index'));
        }

        $this->tradeHistoryRepository->delete($id);

        Flash::success('Trade History deleted successfully.');

        return redirect(route('tradeHistories.index'));
    }
}
