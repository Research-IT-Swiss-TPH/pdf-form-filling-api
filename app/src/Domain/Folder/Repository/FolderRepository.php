<?php

namespace App\Domain\Folder\Repository;

use App\Factory\QueryFactory;
use App\Support\Helper\DateTimeHelper;
use DomainException;

final class FolderRepository 
{
    
    const MAX_PROJECTS_DEFAULT = 5;

    private QueryFactory $queryFactory;

    public function __construct(QueryFactory $queryFactory) 
    {
        $this->queryFactory = $queryFactory;
    }

    public function insertFolder(array $folder): int
    {
        return (int)$this->queryFactory->newInsert('folders', $this->toRow($folder), true)
            ->execute()
            ->lastInsertId();        
    }

    public function getFolderById(int $folderId): array
    {
        $query = $this->queryFactory->newSelect('folders');
        $query->select(
            [
                'id',
                'id_user',
                'title',
                'description',
                'created_at',
                'updated_at',
            ]
        );

        $query->where(['id' => $folderId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('Folder not found: %s', $folderId));
        }

        return $row;
    }

    public function updateFolder(int $folderId, array $folder): void
    {
        $folder['updated_at'] = DateTimeHelper::getDate();
        $row = $this->toRow($folder);

        $this->queryFactory->newUpdate('folders', $row)
            ->where(['id' => $folderId])
            ->execute();
    }

    public function existsFolderId(int $folderId): bool
    {
        $query = $this->queryFactory->newSelect('folders');
        $query->select('id')->where(['id' => $folderId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    public function deleteFolderById(int $folderId): void
    {
        $this->queryFactory->newDelete('folders')
            ->where(['id' => $folderId])
            ->execute();
    }


    private function toRow(array $folder): array
    {
        return [
            'id_user' => $folder['id_user'],
            'title' => $folder['title'],
            'description' => $folder['description'],
            'updated_at' => isset($folder['updated_at']) ? $folder['updated_at'] : null
        ];
    }    
}