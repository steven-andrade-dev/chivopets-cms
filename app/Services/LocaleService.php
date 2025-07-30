<?php
 
namespace App\Services;
use App\Interfaces\LocaleRepositoryInterface;


class LocaleService
{
    public function __construct(private LocaleRepositoryInterface $repo) {}

    public function getLocale()
    {
        return $this->repo->get_all_locale();
    }

      public function createLocale(array $data)
    {
        $data['created_by_id'] = 1;
        $data['published_at'] = $data['published_at'] ?? now();
        $data['updated_by_id'] = $data['updated_by_id'] ?? 1;

        return $this->repo->create_locale($data);
    }

    public function updateLocale($id, array $data)
    {
        return $this->repo->update_locale($id, $data);
    }

    public function deleteLocale($id)
    {
        return $this->repo->delete_locale($id);
    }

}