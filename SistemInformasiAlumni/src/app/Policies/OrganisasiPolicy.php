<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Organisasi;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganisasiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_organisasi');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Organisasi $organisasi): bool
    {
        return $user->can('view_organisasi');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_organisasi');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Organisasi $organisasi): bool
    {
        return $user->can('update_organisasi');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Organisasi $organisasi): bool
    {
        return $user->can('delete_organisasi');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_organisasi');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Organisasi $organisasi): bool
    {
        return $user->can('{{ ForceDelete }}');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('{{ ForceDeleteAny }}');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Organisasi $organisasi): bool
    {
        return $user->can('{{ Restore }}');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('{{ RestoreAny }}');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Organisasi $organisasi): bool
    {
        return $user->can('{{ Replicate }}');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('{{ Reorder }}');
    }
}
