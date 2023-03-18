<?php

namespace App\Repositories\Eloquent;

use App\Models\Customer;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\CustomerRepositoryContract;

class CustomerRepository extends BaseRepository implements CustomerRepositoryContract
{
   public function __construct(Customer $customer)
   {
        $this->setModel($customer);
   }
    
}