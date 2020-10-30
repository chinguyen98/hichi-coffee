<?php

namespace App\Policies;

use App\Customer;
use App\News;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function viewAny(Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\News  $news
     * @return mixed
     */
    public function view(Customer $customer, News $news)
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function create(Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\News  $news
     * @return mixed
     */
    public function update(Customer $customer, News $news)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\News  $news
     * @return mixed
     */
    public function delete(Customer $customer, News $news)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\News  $news
     * @return mixed
     */
    public function restore(Customer $customer, News $news)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\News  $news
     * @return mixed
     */
    public function forceDelete(Customer $customer, News $news)
    {
        //
    }
}
