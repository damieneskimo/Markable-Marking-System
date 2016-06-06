@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <div class="jumbotron">
                    <h1>Markable Marking System</h1>
                    <p>Markable Marking System is a web application to make the homework marking process easier and less time-consuming. The main features and functionalities includes:
                        <ul style="list-style: none; line-height: 1.6em; font-size: 1.2em;">
                            <li><b>Authentication</b>. You can sign up with any email address or log in with the correct credentials</li>
                            <li><b>Students can create, edit and delete their own homework</b>. Use TinyMce as a rich text editor for the student to enter any content and also integrate UniSharp as file manager so the students can upload their homework. To see the example homework, please log in and check the homework of <b>Damien</b>.</li>
                            <li><b>Comments</b>. Students can review other students' homework and give comments, but they couldn't see other student's marks. They can also edit and delete their own comment.</li>
                            <li><b>Instant Marking</b>. When a teacher logs in, he can see every student’s homework in different folders, and then he can review each homework and gives a mark accordingly. The marking criteria are listed as templates, such as 'Perfect' 'Well done', 'Good enough', 'Keep practicing', 'Not quite well! Try again!'.</li>
                            <li><b>Pagination</b>. Use Laravel's pagination to show limited items in each page.</li>
                        </ul>
                    <p>For testing purpose, please use the following credenticals:</p>
                    <ul style="list-style: none; line-height: 1.6em; font-size: 1.2em;">
                        <li class="text-danger">As a student: email - 'damien@test.com'  password - 'password'</li>
                        <li class="text-danger">As a teacher: email - 'tutor@test.com'  password - 'password'</li>
                    </ul>
                    </p>
                </div>
            </div>
        </div><!-- /.row -->
    </div>
@endsection
