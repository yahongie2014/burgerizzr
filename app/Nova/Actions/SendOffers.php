<?php

namespace App\Nova\Actions;

use App\Un_register_user;
use App\User;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOffers extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model){
            $user_reg = Un_register_user::all();
            foreach ($user_reg as $user_regs)
                $this->sendMessage($user_regs->device_token,$model->name,$user_regs->id,5);

            $user = User::all();

            foreach ($user as $users)
             $this->sendMessage($users->device_token,$model->name,$users->id,5);

        }
        return Action::message(__("general.offers"));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
