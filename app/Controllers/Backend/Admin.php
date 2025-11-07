<?php

namespace App\Controllers\Backend;
use App\Models\UserModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class Admin extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
   

    public function usersList()
    {
        $data['users'] = $this->userModel->findAll();
        return view('admin/users_list', $data);
    }

    public function viewUser($id)
    {
        $data['user'] = $this->userModel->find($id);
        return view('admin/view_user', $data);
    }

    public function editUser($id)
    {
        $data['user'] = $this->userModel->find($id);
        return view('admin/edit_user', $data);
    }

    public function updateUser($id)
    {
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'dob'        => $this->request->getPost('dob'),
            'gender'     => $this->request->getPost('gender'),
            'address'    => $this->request->getPost('address')
        ];

        $this->userModel->update($id, $data);
        return redirect()->to('backend/admin/users')->with('success', 'User updated successfully!');
    }

    public function deleteUser($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('backend/admin/users')->with('success', 'User deleted successfully!');
    }

    // === Export Excel ===
    public function exportExcel()
    {
        $users = $this->userModel->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'ID')
              ->setCellValue('B1', 'First Name')
              ->setCellValue('C1', 'Last Name')
              ->setCellValue('D1', 'Email')
              ->setCellValue('E1', 'DOB')
              ->setCellValue('F1', 'Gender')
              ->setCellValue('G1', 'Address');

        // Data
        $row = 2;
        foreach ($users as $user) {
            $sheet->setCellValue("A$row", $user['id']);
            $sheet->setCellValue("B$row", $user['first_name']);
            $sheet->setCellValue("C$row", $user['last_name']);
            $sheet->setCellValue("D$row", $user['email']);
            $sheet->setCellValue("E$row", $user['dob']);
            $sheet->setCellValue("F$row", $user['gender']);
            $sheet->setCellValue("G$row", $user['address']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'users_list.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    // === Export PDF ===
    public function exportPDF()
    {
        $users = $this->userModel->findAll();
        $html = view('admin/pdf_template', ['users' => $users]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('users_list.pdf', ["Attachment" => true]);
    }
}
