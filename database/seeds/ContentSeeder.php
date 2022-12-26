<?php

use App\Content;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Home  */
        for ($i=0; $i < 3; $i++) { 
            Content::create([
                'section_id'=> 1,
                'order'     => 'AA',
                'image'     => 'images/home/Maskgroup-2.png',
                'content_1' => 'Engranajes para cajas de velocidad'
            ]);
        }

        Content::create([
            'section_id'=> 2,
            'image'     => 'images/home/Maskgroup-3.png',
            'content_1' => 'Empresa',
            'content_2' => '<p>Somos una empresa dedicada a la fabricación de engranajes, con la más alta calidad dentro del mercado argentino. Principalmente nos dedicamos a la fabricación de coronas y piñones para diferencial, coronas de arranque y engranajes de cajas de velocidad para automóviles, camiones y tractores.</p>
            <p>La mayor parte de la producción está destinada al mercado interno de la Argentina y a distintos países del Mercosur. Esta empresa se encuentra muy bien tecnificada para el desarrollo y producción de series pequeñas de engranajes, como así también para el desarrollo de piezas unitarias (órdenes especiales).</p>',
        ]);
        
        /** Empresa */
        Content::create([
            'section_id'=> 3,
            'content_1' => '<p>Somos una empresa dedicada a la fabricación de engranajes, con la más alta calidad dentro del mercado argentino. Principalmente nos dedicamos a la fabricación de coronas y piñones para diferencial, coronas de arranque y engranajes de cajas de velocidad para automóviles, camiones y tractores.</p>
            <p>La mayor parte de la producción está destinada al mercado interno de la Argentina y a distintos países del Mercosur. Esta empresa se encuentra muy bien tecnificada para el desarrollo y producción de series pequeñas de engranajes, como así también para el desarrollo de piezas unitarias (órdenes especiales).</p>',
            'content_2' => 'images/company/image136.png',
            'content_3' => 'images/company/image136.png',
            'content_4' => 'images/company/image136.png',
            'content_5' => '<iframe width="853" height="480" src="https://www.youtube.com/embed/OqSQo2aifAA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
        ]);
       
        for ($i= 0; $i < 10; $i++) { 
            Content::create([
                'section_id'=> 4,
                'content_1' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos eaque impedit odit quis, harum maiores doloribus. Labore expedita, enim vitae harum sapiente provident assumenda nulla nostrum asperiores fugiat dolore tenetur!',
                'content_2' => $i,
                'image'     => 'images/company/Enmascarar_grupo_483.png'
            ]);
        }
        
        Content::create([
            'section_id'=> 5,
            'image'     => 'images/productive_process/Mask_group-1.png',
            'content_1' => 'Forja',
            'content_2' => '<p>Contamos con 6 líneas de producción en esta área, la cual nos permite un alto volumen productivo. Trabajamos en materiales no ferrosos. Pudiendo adaptar matriceria diseñada para otras máquinas para poder ser utilizada en nuestras instalaciones fabriles.</p>'
        ]);  
    }
}




 


