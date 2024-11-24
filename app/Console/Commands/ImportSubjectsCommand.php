<?php

namespace App\Console\Commands;

use App\Enums\EducationalInstitutionEnum;
use App\Models\Career;
use App\Models\Pensum;
use App\Models\Subject;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportSubjectsCommand extends Command
{
    protected $signature = 'import:subjects {file?}';

    protected $description = 'Import subjects from CSV file';

    public function __invoke()
    {
        $fileName = $this->argument('file') ?? 'subjects.csv';

        if (! Storage::exists("csv/{$fileName}")) {
            $this->error('CSV file not found!');

            return;
        }

        $filePath = Storage::path("csv/{$fileName}");

        $handle = fopen($filePath, 'r');
        $headers = fgetcsv($handle);
        $headers2 = fgetcsv($handle);

        $institution = $headers[0] == EducationalInstitutionEnum::UASD->name ? EducationalInstitutionEnum::UASD->value : '';

        $career = Career::create([
            'educational_institution' => $institution,
            'name' => $headers[1],
            'educational_level' => 1,
        ]);

        $pensum = Pensum::create([
            'career_id' => $career->id,
        ]);

        $columnMap = [
            'Clave' => 'code',
            'Asignatura' => 'name',
            'HT' => 'theoretical_hours',
            'HP' => 'practical_hours',
            'CR' => 'credits',
            'Prerequisitos' => 'prerequisites',
            'Semestre' => 'semester',
        ];

        $count = 0;
        $errors = 0;

        $this->output->progressStart();

        while (($data = fgetcsv($handle)) !== false) {
            $row = array_combine($headers2, $data);

            try {
                $subjectData = [
                    'code' => $row['Clave'],
                    'name' => $row['Asignatura'],
                    'theoretical_hours' => (int) $row['HT'],
                    'practical_hours' => (int) $row['HP'],
                    'credits' => (int) $row['CR'],
                    'prerequisites' => $row['Prerequisitos'] ?: null,
                    'semester' => (int) $row['Semestre'],
                ];

                $subject = Subject::create($subjectData);

                $pensum->subjects()->attach($subject->id, [
                    'semester' => (int) $row['Semestre'],
                    'prerequisites' => $row['Prerequisitos'] ? json_encode($row['Prerequisitos']) : null,
                ]);

                $count++;
                $this->output->progressAdvance();
            } catch (\Exception $e) {
                $errors++;
                $this->error("Error in the line {$count} ({$row['Clave']}): ".$e->getMessage());
            }
        }

        fclose($handle);

        $this->output->progressFinish();

        $this->info('Import completed:');
        $this->info("- Imported subjects: {$count}");

        if ($errors > 0) {
            $this->warn("- Errors found: {$errors}");
        }

        return 0;
    }
}
