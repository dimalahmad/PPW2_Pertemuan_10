@extends('auth.layouts')

@section('content')
<div class="container mt-5">
    <h1>Curriculum Vitae</h1>
    <div class="card">
        <div class="card-header">Personal Information</div>
        <div class="card-body">
            <p><strong>Name:</strong> John Alex</p>
            <p><strong>Email:</strong> john.alex@example.com</p>
            <p><strong>Phone:</strong> +123456789</p>
            <p><strong>Address:</strong> 123 Street Name, City, Country</p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">Education</div>
        <div class="card-body">
            <ul>
                <li>Bachelor of Technology in Software Engineering, University XYZ, 2020</li>
                <li>High School Diploma, ABC High School, 2016</li>
            </ul>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">Work Experience</div>
        <div class="card-body">
            <ul>
                <li>Software Developer at Company A (2021 - Present)</li>
                <li>Intern at Company B (2020 - 2021)</li>
            </ul>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">Skills</div>
        <div class="card-body">
            <ul>
                <li>Programming Languages: Java, Python, JavaScript</li>
                <li>Frameworks: Laravel, React</li>
                <li>Databases: MySQL, PostgreSQL</li>
            </ul>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">Projects</div>
        <div class="card-body">
            <ul>
                <li>Project A - Description of the project.</li>
                <li>Project B - Description of the project.</li>
            </ul>
        </div>
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('cv.edit') }}">Edit CV</a>
    </li>
</div>
@endsection
