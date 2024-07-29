<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;
use Symfony\Component\Uid\Uuid;

class OutputSeeder extends AbstractSeed
{

    public function getDependencies(): array
    {
        return [
            'JobSeeder'
        ];
    }

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {

        $data = [
            [
                'uuid'      =>  Uuid::v4(),
                'id_job'	=> 1,
            ],
            [
                'uuid'      =>  Uuid::v4(),
                'id_job'	=> 2
            ],
        ];

        $outputs = $this->table('outputs');
        $outputs->insert($data)->saveData();
   }
}
