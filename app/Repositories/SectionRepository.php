<?php

namespace App\Repositories;

use App\Interfaces\SectionRepositoryInterface;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionRepository implements SectionRepositoryInterface
{
    public function get_all_section(Request $request, $page)
    {
        return Section::with('parent')->whereIn('status', ['Creado', 'Publicado'])->where('id_locale', $request->idLanguage)->paginate($page);
    }

    public function get_section_by_id($id)
    {
        return Section::find($id);
    }

    public function update_section($id, array $data)
    {
        // $section = Section::findOrFail($id);
        // $section->update($data);

        $section = Section::findOrFail($id);

        if ($section->status == 'Creado') {
            $section->update($data);
        } else {

            $newSection = $section->replicate();
            $newSection->fill($data);
            $newSection->save();

            $newSection->section_id_parent = $section->id;
            $newSection->status = 'Borrador';
            $newSection->save();
        }

        return $section;
    }

    public function update_section_publish($id)
    {
        $section = Section::findOrFail($id);

        if ($section->parent) {
            $section->fill($section->parent->only(['name']));
            $section->parent->delete();
        }

        $section->status = 'Publicado';
        $section->save();



        return $section;
    }
}
