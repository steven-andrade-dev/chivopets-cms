<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarruselTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carrusel_items')->insert([
            [
                'title' => '+3.8',
                'subtitle' => 'Millones',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'value' => 0.0,
                'description' => 'Servicios veterinarios',
                'title_info_aditional' => '',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ],
            [
                'title' => '24/7',
                'subtitle' => '',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'value' => 0.0,
                'description' => 'Atención en emergencias',
                'title_info_aditional' => '',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ],
            [
                'title' => '$0.25',
                'subtitle' => '',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'value' => 0.0,
                'description' => 'Costro por servicio médico veterinario',
                'title_info_aditional' => '',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ],
            [ // content 2, carrusel id - 4
                'title' => '+110',
                'subtitle' => 'Médicos veterinarios',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'value' => 0.0,
                'description' => 'trabajando en distintas diciplinas',
                'title_info_aditional' => '',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ],
            [
                'title' => 'Consulta externa',
                'subtitle' => '',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'value' => 0.0,
                'description' => 'El área de Consulta Externa está diseñada para ofrecer atención médica integral a especies menores como perros, gatos y otras especies no convencionales que no requieren hospitalización. Con 12 consultorios equipados con tecnología de vanguardia, este servicio permite diagnósticos precisos, tratamientos efectivos y seguimientos de diversas enfermedades. Aquí, los propietarios encuentran un espacio de atención cálida y profesional, donde el conocimiento se traduce en un cuidado personalizado para cada paciente. El espacio de vacunación está específicamente preparado para garantizar la seguridad y eficacia de las inmunizaciones: Este servicio asegura que las vacunas se administren en condiciones óptimas, protegiendo la salud de las mascotas y ayudando a prevenir enfermedades contagiosas. Además, el área se complementa con sistemas tecnológicos que permiten el control y registro preciso de cada dosis aplicada.',
                'title_info_aditional' => 'Conoce más',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ],
            [
                'title' => 'Emergencia 24/7',
                'subtitle' => '',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'value' => 0.0,
                'description' => 'El área de Emergencia está destinada a brindar atención especializada en situaciones críticas de especies menores como perros y gatos. Con 8 consultorios de atención 24/7, dotados con tecnología avanzada, este servicio está preparado para enfrentar traumas, intoxicaciones y emergencias médico veterinarias agudas.',
                'title_info_aditional' => 'Conoce más',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ],
            [
                'title' => 'Cirugía',
                'subtitle' => '',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'value' => 0.0,
                'description' => 'El área de Cirugía es una unidad altamente especializada donde se realizan procedimientos quirúrgicos de diversa complejidad, desde intervenciones en tejidos blandos hasta cirugías ortopédicas avanzadas. Con 4 quirófanos equipados con tecnología de última generación, y una Central de Esterilización (CEYE) que garantiza la asepsia de todos los instrumentos, el área de Cirugía ofrece un entorno seguro y preciso para cada operación, siempre bajo la supervisión de cirujanos veterinarios experimentados.',
                'title_info_aditional' => 'Conoce más',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ],
            [ // content 3, carrusel id - 8
                'title' => 'Hospitalización',
                'subtitle' => '',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'value' => 0.0,
                'description' => 'El área de Hospitalización opera las 24 horas, brindando cuidados intensivos y atención continua a los pacientes que requieren un monitoreo prolongado. Se diferencia en dos subáreas: una para casos no infecciosos y otra para aquellos con enfermedades contagiosas, asegurando un ambiente controlado y seguro. Con infraestructura y equipamiento especializado –como módulos de jaulas, monitores de signos vitales y sistemas de control de acceso–, esta área garantiza la comodidad y la recuperación óptima de cada paciente.',
                'title_info_aditional' => 'Conoce más',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ],
            [
                'title' => '398,235',
                'subtitle' => 'Consultas realizadas',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'description' => '',
                'value' => 0.0,
                'title_info_aditional' => 'ACTUALIZADO: ABRIL 2025',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ],
            [
                'title' => '222,322',
                'subtitle' => 'Emergencias atendidas',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'description' => '',
                'value' => 0.0,
                'title_info_aditional' => 'ACTUALIZADO: ABRIL 2025',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ],
            [
                'title' => '176,777',
                'subtitle' => 'Mascotas hospitalizadas',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'description' => '',
                'value' => 0.0,
                'title_info_aditional' => 'ACTUALIZADO: ABRIL 2025',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ],
            [ // content 4, carrusel id - 12
                'title' => '61,759',
                'subtitle' => 'Cirugías realizadas',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'description' => '',
                'value' => 0.0,
                'title_info_aditional' => 'ACTUALIZADO: ABRIL 2025',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ],
            [
                'title' => 'Satisfacción General',
                'subtitle' => '4.9',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'description' => '',
                'value' => 4.9,
                'title_info_aditional' => '',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ],
            [
                'title' => 'Satisfacción del tratamiento',
                'subtitle' => '5.0',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'description' => '',
                'value' => 5.0,
                'title_info_aditional' => '',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ],
            [ // content 5, carrusel id - 15
                'title' => 'Satisfacción del personal',
                'subtitle' => '4.5',
                'image' => '',
                'href' => '',
                'introduction' => '',
                'description' => '',
                'value' => 4.5,
                'title_info_aditional' => '',
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'id_locale' => 1
            ]
        ]);

        DB::table('content_carousels')->insert([
            [ 'id_content' => 2, 'id_carousel' => 1 ],
            [ 'id_content' => 2, 'id_carousel' => 2 ],
            [ 'id_content' => 2, 'id_carousel' => 3 ],
            [ 'id_content' => 2, 'id_carousel' => 4 ],
            [ 'id_content' => 3, 'id_carousel' => 5 ],
            [ 'id_content' => 3, 'id_carousel' => 6 ],
            [ 'id_content' => 3, 'id_carousel' => 7 ],
            [ 'id_content' => 3, 'id_carousel' => 8 ],
            [ 'id_content' => 4, 'id_carousel' => 9 ],
            [ 'id_content' => 4, 'id_carousel' => 10 ],
            [ 'id_content' => 4, 'id_carousel' => 11 ],
            [ 'id_content' => 4, 'id_carousel' => 12 ],
            [ 'id_content' => 5, 'id_carousel' => 13 ],
            [ 'id_content' => 5, 'id_carousel' => 14 ],
            [ 'id_content' => 5, 'id_carousel' => 15 ],
        ]);
    }
}
