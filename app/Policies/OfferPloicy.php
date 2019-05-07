<?php

namespace App\Policies;

use App\Offer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPloicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the word press post.
     *
     * @param  \App\User $user
     *
     * @return bool
     */
    public function view(User $user): bool
    {
        $Offers = Offer::all();
        foreach ($Offers as $offer) {
            if ($offer->type == 1) {
                return true;
            } elseif ($offer->type == 2) {
                return true;
            }
        }
    }

    /**
     * Determine whether the user can create word press posts.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the word press post.
     *
     * @param  \App\User $user
     *
     * @return bool
     */
    public function update(User $user): bool
    {
        $Offers = Offer::all();

        foreach ($Offers as $offer) {
            if ($offer->type == 1) {
                return true;
            } elseif ($offer->type == 2) {
                return true;
            }
        }
    }

    /**
     * Determine whether the user can delete the word press post.
     *
     * @param  \App\User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        $Offers = Offer::all();

        foreach ($Offers as $offer) {
            if ($offer->type == 1) {
                return true;
            } elseif ($offer->type == 2) {
                return true;
            }
        }
    }

    /**
     * Determine whether the user can restore the word press post.
     *
     * @param  \App\User $user
     *
     * @return bool
     */
    public function restore(User $user): bool
    {
        $Offers = Offer::all();

        foreach ($Offers as $offer) {
            if ($offer->type == 1) {
                return true;
            } elseif ($offer->type == 2) {
                return true;
            }
        }
    }

    /**
     * Determine whether the user can permanently delete the word press post.
     *
     * @param  \App\User $user
     *
     * @return bool
     */
    public function forceDelete(User $user): bool
    {
        $Offers = Offer::all();

        foreach ($Offers as $offer) {
            if ($offer->type == 1) {
                return true;
            } elseif ($offer->type == 2) {
                return true;
            }
        }
    }
}
