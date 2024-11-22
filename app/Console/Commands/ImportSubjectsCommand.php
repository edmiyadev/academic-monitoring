<?php

namespace App\Console\Commands;

use App\Models\Subject;
use Illuminate\Console\Command;

class ImportSubjectsCommand extends Command
{
    protected $signature = 'import:subjects {file}';
    protected $description = 'Importa subjects desde un archivo CSV';

    public function handle()
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("El archivo no existe!");
            return 1;
        }

        // Abre el archivo CSV
        $handle = fopen($file, 'r');

        // Lee la primera línea como encabezados
        $headers = fgetcsv($handle);

        // Contador para filas procesadas
        $count = 0;

        // Procesa cada línea
        while (($data = fgetcsv($handle)) !== false) {
            $row = array_combine($headers, $data);

            try {
                Subject::create([
                    'clave' => $row['clave'],
                    'name' => $row['nombre'],
                    'ht' => '',
                    'hp' => '',
                    'cr' => '',
                    'semester' => '',
                    'prerequisites' => '',

                    'name' => $row['name'], // Ajusta estos campos según tu modelo
                    'description' => $row['description'],
                    // Agrega más campos según necesites
                ]);

                $count++;
            } catch (\Exception $e) {
                $this->error("Error en la línea {$count}: " . $e->getMessage());
            }
        }

        fclose($handle);

        $this->info("Se importaron {$count} subjects exitosamente!");

        return 0;
    }
}
