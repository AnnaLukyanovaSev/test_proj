<?php

namespace common\models\fam_money\services;

use common\models\fam_money\forms\FamilyForm;
use common\models\fam_money\Family;
use common\models\fam_money\repositories\FamilyRepository;

class FamilyService
{
    private $families;

    public function __construct(FamilyRepository $families)
    {
        $this->families = $families;
    }

    public function create(): Family
    {
        $family = Family::create();
        $this->families->save($family);
        return $family;
    }

    public function edit($id): void
    {
        $family = $this->families->get($id);
        $this->families->save($family);
    }

    public function remove($id): void
    {
        $profile = $this->families->get($id);
        $this->families->remove($profile);
    }

}