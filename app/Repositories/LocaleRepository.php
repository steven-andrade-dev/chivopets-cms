<?php

namespace App\Repositories;
use App\Interfaces\LocaleRepositoryInterface;
use App\Models\Locale; 

class LocaleRepository implements LocaleRepositoryInterface
{
    public function get_all_locale()
    {
    $locales = Locale::withCount('contents')->get();
    foreach ($locales as $locale) {
        $locale->can_delete = $locale->contents_count === 0;
    }
    return $locales;
    }

    public function get_locale_by_id($id)
    {
        return Locale::find($id);
    }

        public function create_locale(array $data)
    {
        return Locale::create($data);
    }

    public function update_locale($id, array $data)
    {
        $locale = Locale::findOrFail($id);
        $locale->update($data);
        return $locale;
    }

    public function delete_locale($id)
    {
        $locale = Locale::findOrFail($id);
        $locale->delete();
        return true;
    }

}
