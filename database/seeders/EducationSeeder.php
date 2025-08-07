<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        Education::create([
            'degree_ar' => 'بكالوريوس علوم الحاسوب',
            'degree_en' => 'Bachelor of Science in Computer Science',
            'institution_ar' => 'جامعة كفر الشيخ - كلية الحاسبات والمعلومات',
            'institution_en' => 'University of Kafrelsheikh -- Faculty of Computers and Information',
            'field_of_study_ar' => 'علوم الحاسوب',
            'field_of_study_en' => 'Computer Science',
            'gpa' => 3.12,
            'gpa_scale' => '4.0',
            'start_date' => '2020-09-01',
            'end_date' => '2024-07-01',
            'description_ar' => 'تخرجت بدرجة بكالوريوس في علوم الحاسوب بمعدل تراكمي 3.12 من 4.0. دراسة شاملة في أساسيات علوم الحاسوب، البرمجة، هياكل البيانات، الخوارزميات، قواعد البيانات، وهندسة البرمجيات.',
            'description_en' => 'Graduated with a Bachelor of Science in Computer Science with a GPA of 3.12/4.0. Comprehensive study in computer science fundamentals, programming, data structures, algorithms, databases, and software engineering.',
            'location' => 'كفر الشيخ، مصر'
        ]);
    }
}
