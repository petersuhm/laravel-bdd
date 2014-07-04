<?php

namespace Suhm\Storage;

use Suhm\Entity\User;

interface UserRepository
{
    public function newInstance($input = null);
    public function persist(User $user);
    public function allUsers();
}
