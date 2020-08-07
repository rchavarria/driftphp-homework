<?php

namespace App\Domain\Event;

class UserWasDeleted
{

    /** @var string */
    private $uid;

    /**
     * UserWasDeleted constructor.
     * @param string $uid
     */
    public function __construct(string $uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

}
