<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTradeAccountRequest;
use App\Http\Requests\UpdateTradeAccountRequest;
use App\Repositories\TradeAccountRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TradeAccountController extends AppBaseController
{
    /** @var  TradeAccountRepository */
    private $tradeAccountRepository;

    public function __construct(TradeAccountRepository $tradeAccountRepo)
    {
        $this->tradeAccountRepository = $tradeAccountRepo;
    }

    /**
     * Display a listing of the TradeAccount.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tradeAccounts = $this->tradeAccountRepository->paginate(20);

        return view('trade_accounts.index')
            ->with('tradeAccounts', $tradeAccounts);
    }

    /**
     * Show the form for creating a new TradeAccount.
     *
     * @return Response
     */
    public function create()
    {
        return view('trade_accounts.create');
    }

    /**
     * Store a newly created TradeAccount in storage.
     *
     * @param CreateTradeAccountRequest $request
     *
     * @return Response
     */
    public function store(CreateTradeAccountRequest $request)
    {
        $input = $request->all();

        $tradeAccount = $this->tradeAccountRepository->create($input);

        Flash::success('Trade Account saved successfully.');

        return redirect(route('tradeAccounts.index'));
    }

    /**
     * Display the specified TradeAccount.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tradeAccount = $this->tradeAccountRepository->find($id);

        if (empty($tradeAccount)) {
            Flash::error('Trade Account not found');

            return redirect(route('tradeAccounts.index'));
        }

        return view('trade_accounts.show')->with('tradeAccount', $tradeAccount);
    }

    /**
     * Show the form for editing the specified TradeAccount.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tradeAccount = $this->tradeAccountRepository->find($id);

        if (empty($tradeAccount)) {
            Flash::error('Trade Account not found');

            return redirect(route('tradeAccounts.index'));
        }

        return view('trade_accounts.edit')->with('tradeAccount', $tradeAccount);
    }

    /**
     * Update the specified TradeAccount in storage.
     *
     * @param int $id
     * @param UpdateTradeAccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTradeAccountRequest $request)
    {
        $tradeAccount = $this->tradeAccountRepository->find($id);

        if (empty($tradeAccount)) {
            Flash::error('Trade Account not found');

            return redirect(route('tradeAccounts.index'));
        }

        $tradeAccount = $this->tradeAccountRepository->update($request->all(), $id);

        Flash::success('Trade Account updated successfully.');

        return redirect(route('tradeAccounts.index'));
    }

    /**
     * Remove the specified TradeAccount from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tradeAccount = $this->tradeAccountRepository->find($id);

        if (empty($tradeAccount)) {
            Flash::error('Trade Account not found');

            return redirect(route('tradeAccounts.index'));
        }

        $this->tradeAccountRepository->delete($id);

        Flash::success('Trade Account deleted successfully.');

        return redirect(route('tradeAccounts.index'));
    }
}
