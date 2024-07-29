<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;
use Symfony\Component\Uid\Uuid;


class DocumentSeeder extends AbstractSeed
{

    public function getDependencies(): array
    {
        return [
            'FolderSeeder'
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
                'uuid'          =>  Uuid::v4(),
                'id_folder'		=>  1,
                'title'			=> 'document 1.1',
                'description'	=> '1st document in folder 1',                
                'language'		=> 'english',                
            ],
            [
                'uuid'          =>  Uuid::v4(),
                'id_folder'		=>  1,
                'title'		    => 'document 1.2',
                'description'	=> '2nd document in folder 1',                
                'language'		=> 'german',                
            ],
            [
                'uuid'          =>  Uuid::v4(),
                'id_folder'		=>  2,
                'title'			=> 'document 2.1',
                'description'	=> '1st document in folder 2',                
                'language'		=> 'french',                
            ],
        ];

        $documents = $this->table('documents');
        $documents->insert($data)->saveData();
   }
}
