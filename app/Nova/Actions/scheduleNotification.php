<?php

namespace App\Nova\Actions;

use App\User;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\DateTime;

class scheduleNotification extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields $fields
     * @param  \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $user = User::all();

            foreach ($user as $users)
                $this->sendMessage($users->device_token, $model->name, $users->id, 5);

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
        return [
            DateTime::make("Start In", 'start_in')->format('DD MMM YYYY HH:I:S'),
        ];
    }
}
