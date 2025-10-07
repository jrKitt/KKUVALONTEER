<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VolunteerGoal;
use Illuminate\Auth\Access\Response;

class VolunteerGoalPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // ทุกคนสามารถดูเป้าหมายของตัวเองได้
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, VolunteerGoal $volunteerGoal): bool
    {
        return $user->id === $volunteerGoal->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // ทุกคนสามารถสร้างเป้าหมายได้
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, VolunteerGoal $volunteerGoal): bool
    {
        return $user->id === $volunteerGoal->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, VolunteerGoal $volunteerGoal): bool
    {
        return $user->id === $volunteerGoal->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, VolunteerGoal $volunteerGoal): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, VolunteerGoal $volunteerGoal): bool
    {
        return $user->isAdmin();
    }
}
