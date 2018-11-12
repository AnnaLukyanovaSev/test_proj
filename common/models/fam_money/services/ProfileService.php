<?php

namespace common\models\fam_money\services;

use common\models\fam_money\forms\ProfileForm;
use common\models\fam_money\Profile;
use common\models\fam_money\repositories\ProfileRepository;

class ProfileService
{
    private $profiles;

    public function __construct(ProfileRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function create(ProfileForm $form): Profile
    {
        $profile = Profile::create(
            $form->first_name,
            $form->last_name
        );
        $this->profiles->save($profile);
        return $profile;
    }

    public function edit($id, ProfileForm $form): void
    {
        $profile = $this->profiles->get($id);
        $profile->edit(
            $form->first_name,
            $form->last_name
        );
        $this->profiles->save($profile);
    }

    public function remove($id): void
    {
        $profile = $this->profiles->get($id);
        $this->profiles->remove($profile);
    }

}