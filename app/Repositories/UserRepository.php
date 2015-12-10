<?php
namespace WebCoding\Repositories;

use WebCoding\Models\User;

/**
 * Class UserRepository
 * @package WebCoding\Repositories
 */
class UserRepository extends Repository
{
    /**
     * Constructeur
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}