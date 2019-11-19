<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepository
{
    public function create(User $user): User;
    public function get(string $id): ?User;
    public function getByEmailAndPassword(string $email, string $password): ?User;
    public function getAll();
    public function update(User $user);
    public function delete($id);
}
