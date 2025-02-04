<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $student;
    public function __construct()
    {
        $this->student = new Student();
    }

    // menampilkan semua data student
    public function index()
    {
        return $this->student->all();
    }

    // menyimpan data ke database posgresql
    public function store(Request $request)
    {
        return $this->student->create($request->all());
    }

    // menampillkan student
    public function show(string $id)
    {
        $student = $this->student->find($id);
    }

    // edit student
    public function update(Request $request, string $id)
    {
        $student = $this->student->find($id);
        $student->update($request->all());
        return $student;
    }

    // delete student
    public function destroy(string $id)
    {
        $student = $this->student->find($id);
        return $student->delete();
    }
}
