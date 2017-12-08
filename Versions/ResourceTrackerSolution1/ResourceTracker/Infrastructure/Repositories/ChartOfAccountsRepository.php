<?php
namespace AccountingSolution\Infrastructure\Repositories;

use AccountingSolution\DomainModel\IEntity;
use AccountingSolution\DomainModel\Transactions\AccountingElements;
use AccountingSolution\DomainModel\Transactions\Amount;
use AccountingSolution\DomainModel\Transactions\ChartOfAccounts;
use AccountingSolution\DomainModel\Transactions\ChartOfAccountsId;
use AccountingSolution\DomainModel\Transactions\IRepository;
use AccountingSolution\DomainModel\Transactions\Organization;
use AccountingSolution\DomainModel\Transactions\OrganizationId;
use AccountingSolution\DomainModel\Transactions\Transactions;
use AccountingSolution\DomainModel\Transactions\TransactionType;
use AccountingSolution\DomainModel\Transactions\UserId;
use AccountingSolution\DomainModel\Transactions\Users;

class ChartOfAccountsRepository extends BaseRepository implements IRepository
{
    public function __construct()
    {
        // TODO: Implement __construct() method.
    }

    public function find(ChartOfAccountsId $accountsId)
    {
        foreach($this->fetch() as $chart){
            if( $chart->getId()->sameValueAs($accountsId)) return $chart;
        }
        return;
    }

    public function fetch()
    {
        $charts = array();
        $chart = new ChartOfAccounts(new ChartOfAccountsId('237e6053-e7d3-4575-a7fc-c713c96b4bdd'),
            'Accounts Receivable','Accounts Receivable',
            new Organization(new OrganizationId(1)),
            new AccountingElements());
        //$peso = new Currency(CurrencyCode::PHP());
        $chart->addTransaction('Description',
            TransactionType::Credit(),
            new Amount(100.12),
            new Users(new UserId(11))
        );
        $charts[] = $chart;
        $charts[] = new ChartOfAccounts(new ChartOfAccountsId('3f8ac36b-53da-48dc-91e1-cb38a4cd4ff2'),
            '	Service Supplies','	Service Supplies',
            new Organization(new OrganizationId(1)),
            new AccountingElements());

        return $charts;
    }

    public function add(IEntity $accounts)
    {
        $transactions = $accounts->getTransactions();
        if(!empty($transactions)){

            foreach($transactions as $transaction){
                parent::add($transaction);
            }
        }
    }

    public function update(ChartOfAccounts $accounts)
    {
        // TODO: Implement update() method.
    }

    public function remove(ChartOfAccounts $accounts)
    {
        // TODO: Implement remove() method.
    }

    public function removeTransaction(ChartOfAccountsId $accountsId, Transactions $transactions)
    {
        // TODO: Implement removeTransaction() method.
    }

}