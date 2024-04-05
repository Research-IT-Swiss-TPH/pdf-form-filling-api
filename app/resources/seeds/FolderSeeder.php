<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class FolderSeeder extends AbstractSeed
{
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
                'id_customer'	=> 1,
                'title'				=> 'study 1.1 foo',
                'description'	=> '1st study of customer 1 foo',                
                'created'			=> date('Y-m-d H:i:s'),
            ],
            [
                'id_customer'	=> 1,
                'title'				=> 'study 1.2 foo',
                'description'	=> '2nd study of customer 1 foo',                
                'created'			=> date('Y-m-d H:i:s'),
            ],
            [
                'id_customer'	=> 2,
                'title'				=> 'study 2.1 bar',
                'description'	=> '1st study of customer 2 bar',                
                'created'			=> date('Y-m-d H:i:s'),
            ],
        ];

        $customers= $this->table('folders');
        $customers->insert($data)->saveData();
   }
}