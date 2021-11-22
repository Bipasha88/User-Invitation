<?php

namespace App\Repositories\Invite;

use App\Models\Invite;
use App\Repositories\Base\BaseRepository;

class InviteRepository extends BaseRepository implements IInviteRepository {

    public function __construct(Invite $model)
    {
        parent::__construct($model);
    }
}
