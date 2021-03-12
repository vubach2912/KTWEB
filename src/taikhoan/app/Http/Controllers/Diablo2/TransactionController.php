<?php

namespace App\Http\Controllers\Diablo2;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Repositories\TransactionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TransactionController extends AppBaseController
{
    /** @var  TransactionRepository */
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepo)
    {
        $this->transactionRepository = $transactionRepo;
    }

    /**
     * Display a listing of the Transaction.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->name){
            $username = Auth::user()->name;
        }

        $transactions = $this->transactionRepository;
        if (!empty($request->username))
            $data['transactions'] = $transactions->find(["username" => $request->username]);
        $data['transactions'] = $transactions->getAllFindName($username);
        $data['surplus'] = $transactions->Surplus($username);
        $data['sumSurplus'] = $transactions->getSurplus($username);

        return view('transactions.index',$data);
    }

    /**
     * Show the form for creating a new Transaction.
     *
     * @return Response
     */
    public function create()
    {
        return redirect(route('transactions.index'));
        // return view('transactions.create');
    }

    /**
     * Store a newly created Transaction in storage.
     *
     * @param CreateTransactionRequest $request
     *
     * @return Response
     */
    public function store(CreateTransactionRequest $request)
    {
        $input = $request->all();

        $transaction = $this->transactionRepository->create($input);

        Flash::success('Transaction saved successfully.');

        return redirect(route('transactions.index'));
    }

    /**
     * Display the specified Transaction.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        // $transaction = $this->transactionRepository->find($id);

        // if (empty($transaction)) {
        //     Flash::error('Transaction not found');

        //     return redirect(route('transactions.index'));
        // }

        // return view('transactions.show')->with('transaction', $transaction);
        return redirect(route('transactions.index'));
    }

    /**
     * Show the form for editing the specified Transaction.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // $transaction = $this->transactionRepository->find($id);

        // if (empty($transaction)) {
        //     Flash::error('Transaction not found');

        //     return redirect(route('transactions.index'));
        // }

        // return view('transactions.edit')->with('transaction', $transaction);
        return redirect(route('transactions.index'));
    }

    /**
     * Update the specified Transaction in storage.
     *
     * @param int $id
     * @param UpdateTransactionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransactionRequest $request)
    {
        // $transaction = $this->transactionRepository->find($id);

        // if (empty($transaction)) {
        //     Flash::error('Transaction not found');

        //     return redirect(route('transactions.index'));
        // }

        // $transaction = $this->transactionRepository->update($request->all(), $id);

        // Flash::success('Transaction updated successfully.');

        // return redirect(route('transactions.index'));
        return redirect(route('transactions.index'));
    }

    /**
     * Remove the specified Transaction from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        // $transaction = $this->transactionRepository->find($id);

        // if (empty($transaction)) {
        //     Flash::error('Transaction not found');

        //     return redirect(route('transactions.index'));
        // }

        // $this->transactionRepository->delete($id);

        // Flash::success('Transaction deleted successfully.');

        // return redirect(route('transactions.index'));
        return redirect(route('transactions.index'));
    }
}
