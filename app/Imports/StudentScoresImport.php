<?php

namespace App\Imports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

// class StudentScoresImport implements ToModel, WithHeadingRow
// {
//     public function model(array $row)
//     {
//         $student = Registration::join('applicants','registration.student_id','applicants.id')
//             ->where(['course_code'=>'RUN-GST 109','settings_id'=>'7','surname'=> $row['surname'],'other_name' =>$row['firstname']])
//             ->first();


//         if ($student) {
//             $student->score = $row['score'];
//             $student->grade = $row['grade'];
//             $student->save();
//         }

//         return $student;
//     }
// }


class StudentScoresImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // Get all unique student names from the Excel rows
        $names = $rows->map(function ($row) {
            return [
                'surname' => $row['surname'],
                //'firstname' => $row['firstname'],
            ];
        })->unique();

        // Fetch all matching students at once
        $students = Registration::join('applicants','registration.student_id','applicants.id')
            ->where(['course_code'=>'RUN-GST 109','settings_id'=>'7'])
            ->whereIn('surname', $names->pluck('surname'))
            //->whereIn('other_name', $names->pluck('firstname'))
            ->get();

        foreach ($rows as $row) {
            $student = $students->first(function ($s) use ($row) {
                //return $s->surname === $row['surname'] && $s->other_name === $row['firstname'];
                return $s->surname === $row['surname'];
            });

            if ($student) {
                $student->score = $row['score'];
                $student->grade = $row['grade'];
                $student->save();
            }
        }
    }
}
