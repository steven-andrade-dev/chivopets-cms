<?php

namespace App\Interfaces;

interface LocaleRepositoryInterface
{
    public function get_all_locale();
    public function get_locale_by_id($id);
    public function create_locale(array $data);
    public function update_locale($id, array $data);
    public function delete_locale($id);
}