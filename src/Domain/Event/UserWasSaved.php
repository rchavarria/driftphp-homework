<?php

namespace Domain\Event;

use Domain\Model\User\User;

class UserWasSaved
{

    /** @var User */
    private $user;

    /**
     * UserWasSaved constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

}
